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
        $idDocent = $_POST['idDocent'];
        $idDocument = $_POST['idDocument'];
        $idCarrer = $_POST['idCarrer'];
        $idTopic = $_POST['idTopic'];

        // Obtiene la fecha y hora actual para el registro del producto.
        $registro = date('Y-m-d H:i:s', time());

        $BuscarEstudiantes = BuscarEstudiantesCarrera($conexion, $idCarrer);

        // Inserta el documento en la base de datos.
        if (InsertarCompartir($conexion, $idDocent, $BuscarEstudiantes, $idDocument, $idTopic, $registro)) {
            // Muestra un mensaje de éxito en JavaScript y redirige a la página de productos.
            echo '<script type="text/javascript">';
            echo 'alert("¡Se ha Compartido el Documento Exitosamente!");';
            echo 'window.location = "../../../Vista/ADMIN/Documento.php";';
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
    echo 'window.location = "../../../Vista/ADMIN/Documento.php";';
    echo '</script>';
}

function BuscarEstudiantesCarrera($conexion, $idCarrer) {
    // Preparar la consulta SQL
    $stmtBusCarr = $conexion->prepare("SELECT ID_Usuario_E FROM Estudiante WHERE IdCarrera = ?;");

    // Vincular el parámetro a la consulta preparada
    $stmtBusCarr->bind_param("i", $idCarrer);

    // Ejecutar la consulta
    $stmtBusCarr->execute();

    // Obtener los resultados
    $result = $stmtBusCarr->get_result();

    // Crear un array para almacenar los ID's de los estudiantes
    $estudiantes = [];

    // Recorrer los resultados y agregar cada ID al array
    while ($row = $result->fetch_assoc()) {
        $estudiantes[] = $row['ID_Usuario_E'];
    }

    // Cerrar la declaración preparada
    $stmtBusCarr->close();

    // Devolver el array de ID's
    return $estudiantes;
}

function InsertarCompartir($conexion, $idDocent, $BuscarEstudiantes, $idDocument, $idTopic, $registro) {
    // Obtén el número de estudiantes
    $num = count($BuscarEstudiantes);

    // Inicia una transacción para asegurar que todas las inserciones se completen o ninguna lo haga
    $conexion->begin_transaction();

    try {
        for ($i = 0; $i < $num; $i++) {
            // Prepara la consulta para insertar en la base de datos
            $stmtCompartir = $conexion->prepare("INSERT INTO Compartir_Recursos (ID_Docente_Com, ID_Estudiante_Com, ID_Documento_Com, ID_Topico_Com, Fecha_Compartida) VALUES (?, ?, ?, ?, ?);");

            // Vincula los parámetros de la consulta
            $stmtCompartir->bind_param("iiiis", $idDocent, $BuscarEstudiantes[$i], $idDocument, $idTopic, $registro);

            // Ejecuta la consulta de inserción
            if (!$stmtCompartir->execute()) {
                // Si falla la ejecución, lanza una excepción
                throw new Exception("Error al insertar el registro para el estudiante ID: " . $BuscarEstudiantes[$i]);
            }

            // Cierra la declaración preparada
            $stmtCompartir->close();
        }

        // Si todo sale bien, confirma la transacción
        $conexion->commit();
        return true;
    } catch (Exception $e) {
        // Si ocurre un error, deshace la transacción
        $conexion->rollback();

        // Puedes registrar el error o mostrarlo, dependiendo de tus necesidades
        error_log($e->getMessage());

        // Retorna false para indicar que la operación falló
        return false;
    }
}
?>