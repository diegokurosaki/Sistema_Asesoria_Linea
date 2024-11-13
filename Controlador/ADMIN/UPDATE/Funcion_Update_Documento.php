<?php
// Inicia una sesión PHP para manejar variables de sesión.
session_start();

// Configura la localización a español.
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México.
date_default_timezone_set('America/Mexico_City');

// Incluye el archivo de conexión a la base de datos.
include('../../../Modelo/Conexion.php');

try {
    // Verifica si la solicitud es de tipo POST.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establece una conexión a la base de datos.
        $conexion = (new Conectar())->conexion();

        // Obtiene la información del formulario
        $Titulo = htmlspecialchars($_POST['Titulo']);
        $Tema = htmlspecialchars($_POST['Tema']);
        $opcion = htmlspecialchars($_POST['opcion']);
        $ID_Docente = intval($_POST['ID_Docente']);
        $id_documento = intval($_POST['id_documento']);

        // Obtiene la fecha y hora actual para el registro del producto.
        $registro = date('Y-m-d H:i:s', time());

        $Ruta = ""; // Inicializa la variable para la ruta del archivo

        if ($opcion === "SI" && isset($_FILES['Archivo'])) {
            // Obtiene la información del archivo subido.
            $Archivo = $_FILES['Archivo'];

            // Sube la imagen del producto y obtiene la ruta de la imagen.
            $Ruta = subirImagen($Archivo, $ID_Docente);
        }

        // Modificar el documento en la base de datos.
        if (UpdateDocumento($conexion, $Titulo, $Tema, $registro, $Ruta, $ID_Docente, $id_documento)) {
            // Muestra un mensaje de éxito en JavaScript y redirige a la página de documentos.
            echo '<script type="text/javascript">';
            echo 'alert("¡La Modificación fue exitosa!");';
            echo 'window.location = "../../../Vista/ADMIN/Documento.php";';
            echo '</script>';
        } else {
            // Lanza una excepción si ocurre un error al actualizar el documento en la base de datos.
            throw new Exception("Error al actualizar el documento: " . $conexion->error);
        }

        // Cierra la conexión a la base de datos.
        $conexion->close();
    }
} catch (Exception $e) {
    // Captura y maneja cualquier excepción lanzada durante el proceso.
    echo '<script type="text/javascript">';
    echo 'alert("Error: ' . htmlspecialchars($e->getMessage()) . '");';
    echo 'window.location = "../../../Vista/ADMIN/Documento.php";';
    echo '</script>';
}

function UpdateDocumento($conexion, $Titulo, $Tema, $registro, $Ruta, $ID_Docente, $id_documento){
    if ($Ruta !== "") {
        // Prepara una consulta para actualizar el documento en la base de datos.
        $stmtProducto = $conexion->prepare("UPDATE Documentos SET Titulo = ?, Tema = ?, Fch_subida = ?, Ubicacion = ?, Id_Docente_Subio = ? WHERE ID_Documento = ?");
        // Vincula los parámetros de la consulta.
        $stmtProducto->bind_param("ssssii", $Titulo, $Tema, $registro, $Ruta, $ID_Docente, $id_documento);
    } else {
        // Prepara una consulta para actualizar el documento sin cambiar la ubicación del archivo.
        $stmtProducto = $conexion->prepare("UPDATE Documentos SET Titulo = ?, Tema = ?, Fch_subida = ?, Id_Docente_Subio = ? WHERE ID_Documento = ?");
        // Vincula los parámetros de la consulta.
        $stmtProducto->bind_param("sssii", $Titulo, $Tema, $registro, $ID_Docente, $id_documento);
    }

    // Ejecuta la consulta de actualización del documento.
    $stmtProducto->execute();
    // Cierra la consulta preparada del documento.
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