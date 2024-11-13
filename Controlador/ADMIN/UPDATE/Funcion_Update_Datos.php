<?php
include('../../../Modelo/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica si ID_ESTU está presente y no está vacío
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die('ID_ESTU no está definido o está vacío.');
    }

    $ID_ESTU = $_POST['id'];
    $conexion = (new Conectar())->conexion();

    try {

        $conexion->begin_transaction();

        deleteDatosEstudiantes($conexion, $ID_ESTU);

        if (isset($_POST['DatosTablaUpdateAlumnos'])) {
            $datosTabla = json_decode($_POST['DatosTablaUpdateAlumnos'], true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $numFilas = count($datosTabla);

                for ($i = 0; $i < $numFilas; $i++) {
                    $idMateria = $datosTabla[$i]['idMateria'];
                    $registroParcial = $datosTabla[$i]['registroParcial'];
                    $calificacion = $datosTabla[$i]['calificacion'];
                    $observaciones = $datosTabla[$i]['observaciones'];

                    // Llama a la función para insertar datos
                    if (!insertarDato($conexion, $registroParcial, $calificacion, $observaciones, $ID_ESTU, $idMateria)) {
                        throw new Exception("Error al insertar los datos en la base de datos.");
                    }
                }
            } else {
                throw new Exception("Los datos de la tabla no están en el formato JSON esperado.");
            }
        } else {
            throw new Exception("No se recibieron datos de la tabla.");
        }

        $conexion->commit();

        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("¡La Modificación fue exitosa!");';
        echo 'window.location = "../../../Vista/ADMIN/Datos_Informacion.php";';
        echo '</script>';
        exit();

    } catch (Exception $e) {
        $conexion->rollback();

        // Mostrar un mensaje de error
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ADMIN/Datos_Informacion.php";';
        echo '</script>';
        exit();
    } finally {
        $conexion->close(); // Asegúrate de cerrar la conexión en todos los casos
    }
}

function deleteDatosEstudiantes($conexion, $ID_ESTU) {
    // Primero, eliminar las relaciones en Datos
    $stmt_rel = $conexion->prepare("DELETE FROM Datos WHERE ID_Estudiant = ?");
    $stmt_rel->bind_param('i', $ID_ESTU);
    $stmt_rel->execute();
    $stmt_rel->close();
}

function insertarDato($conexion, $registroParcial, $calificacion, $observaciones, $ID_ESTU, $idMateria) {
    // Prepara la consulta de inserción
    $stmtProducto = $conexion->prepare("INSERT INTO Datos (Registro_parcial, Calificacion, Observacion, ID_Estudiant, ID_Materi) VALUES (?, ?, ?, ?, ?)");

    if ($stmtProducto === false) {
        return false; // Maneja el error de preparación
    }

    // Vincula los parámetros
    // Ajusta los tipos según el esquema de tu base de datos
    $stmtProducto->bind_param("sisii", $registroParcial, $calificacion, $observaciones, $ID_ESTU, $idMateria);

    // Ejecuta la consulta
    $resultado = $stmtProducto->execute();

    // Cierra la consulta preparada
    $stmtProducto->close();

    return $resultado; // Devuelve true si fue exitoso, false en caso contrario
}
?>