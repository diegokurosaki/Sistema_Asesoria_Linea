<?php
// Inicia una sesión PHP para manejar variables de sesión.
session_start();

// Configura la localización a español.
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México.
date_default_timezone_set('America/Mexico_City');

try {
    // Verifica si la solicitud es de tipo POST.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Incluye el archivo de conexión a la base de datos.
        include('../../../Modelo/Conexion.php');
        // Establece una conexión a la base de datos.
        $conexion = (new Conectar())->conexion();

        // Obtiene la información del formulario
        $Titulo = $_POST['Titulo'];
        $Tema = $_POST['Tema'];
        $ID_Docente = $_POST['ID_Docente'];

        // Obtiene la fecha y hora actual para el registro del producto.
        $registro = date('Y-m-d H:i:s', time());

        // Obtiene la información del archivo subido.
        $Archivo = $_FILES['Archivo']; // Asegúrate de que el nombre del campo en el formulario coincida.

        // Sube la imagen del producto y obtiene la ruta de la imagen.
        $Ruta = subirImagen($Archivo, $ID_Docente);

        // Inserta el documento en la base de datos.
        if (InsertDocumento($conexion, $Titulo, $Tema, $registro, $Ruta, $ID_Docente)) {
            // Muestra un mensaje de éxito en JavaScript y redirige a la página de productos.
            echo '<script type="text/javascript">';
            echo 'alert("¡Producto agregado exitosamente!");';
            echo 'window.location = "../../../Vista/DOCENTE/Documento.php";';
            echo '</script>';
        } else {
            // Lanza una excepción si ocurre un error al insertar el producto en la base de datos.
            throw new Exception("Error al agregar el producto: " . $conexion->error);
        }

        // Cierra la conexión a la base de datos.
        $conexion->close();
    }
} catch (Exception $e) {
    // Captura y maneja cualquier excepción lanzada durante el proceso.
    echo '<script type="text/javascript">';
    echo 'alert("Error: ' . $e->getMessage() . '");';
    echo 'window.location = "../../../Vista/DOCENTE/Documento.php";';
    echo '</script>';
}

function InsertDocumento($conexion, $Titulo, $Tema, $registro, $Ruta, $ID_Docente){
    // Prepara una consulta para insertar el producto en la base de datos.
    $stmtProducto = $conexion->prepare("INSERT INTO Documentos (Titulo, Tema, Fch_subida, Ubicacion, Id_Docente_Subio) VALUES (?,?,?,?,?);");
    // Vincula los parámetros de la consulta.
    $stmtProducto->bind_param("ssssi", $Titulo, $Tema, $registro, $Ruta, $ID_Docente);
    // Ejecuta la consulta de inserción del producto.
    $stmtProducto->execute();
    // Cierra la consulta preparada del producto.
    $stmtProducto->close();

    return true;
}

// Función para subir la imagen del documento.
function subirImagen($Archivo, $ID_Docente) {
    // ubicacion
    $Point = "../../../";
    // Directorio base para los documentos.
    $baseDir = "Documentos/Docente/";
    // Ruta del directorio específico para el docente.
    $targetDir = $baseDir . $ID_Docente . '/';
    // Buscar en documentos
    $location = $Point . $targetDir . '/';

    // Crea el directorio si no existe.
    if (!file_exists($location)) {
        mkdir($location, 0755, true);
    }
    
    // Obtiene la extensión del archivo.
    $fileExtension = strtolower(pathinfo($Archivo["name"], PATHINFO_EXTENSION));
    
    // Tipos de archivo permitidos.
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf');
    
    // Verifica si la extensión del archivo está permitida.
    if (!in_array($fileExtension, $allowedTypes)) {
        throw new Exception("Error: Solo se permiten archivos JPG, JPEG, PNG, GIF, DOC, DOCX, XLS, XLSX, PPT, PPTX o PDF.");
    }
    
    // Genera un nombre único para el archivo.
    $filename = pathinfo($Archivo["name"], PATHINFO_FILENAME) . '_' . uniqid() . '.' . $fileExtension;
    // Ruta completa de destino para el archivo.
    $targetFile = $targetDir . $filename;
    $locationEnd = $location . $filename;
    
    // Sube el archivo al directorio de destino.
    if (move_uploaded_file($Archivo["tmp_name"], $locationEnd)) {
        // Devuelve la ruta del archivo.
        return $targetFile;
    } else {
        // Lanza una excepción si ocurre un error al subir el archivo.
        throw new Exception("Error al subir el archivo.");
    }
}
?>