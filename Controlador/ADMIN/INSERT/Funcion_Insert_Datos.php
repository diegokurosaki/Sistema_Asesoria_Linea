<?php
session_start();
setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/Mexico_City');

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('../../../Modelo/Conexion.php');
        $conexion = (new Conectar())->conexion();

        if (isset($_POST['DatosTablaAlumnos'])) {
            $datosTabla = json_decode($_POST['DatosTablaAlumnos'], true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $numFilas = count($datosTabla);

                for ($i = 0; $i < $numFilas; $i++) {
                    $idAlumno = $datosTabla[$i]['idAlumno'];
                    $idMateria = $datosTabla[$i]['idMateria'];
                    $registroParcial = $datosTabla[$i]['registroParcial'];
                    $calificacion = $datosTabla[$i]['calificacion'];
                    $observaciones = $datosTabla[$i]['observaciones'];

                    // Llama a la función para insertar datos
                    if (!insertarDato($conexion, $registroParcial, $calificacion, $observaciones, $idAlumno, $idMateria)) {
                        throw new Exception("Error al insertar los datos en la base de datos.");
                    }
                }
            } else {
                throw new Exception("Los datos de la tabla no están en el formato JSON esperado.");
            }
        } else {
            throw new Exception("No se recibieron datos de la tabla.");
        }

        echo '<script type="text/javascript">';
        echo 'alert("¡Datos agregados exitosamente!");';
        echo 'window.location = "../../../Vista/ADMIN/Datos_Informacion.php";';
        echo '</script>';

        $conexion->close();
    }
} catch (Exception $e) {
    echo '<script type="text/javascript">';
    echo 'alert("Error: ' . $e->getMessage() . '");';
    echo 'window.location = "../../../Vista/ADMIN/Datos_Informacion.php";';
    echo '</script>';
}

function insertarDato($conexion, $registroParcial, $calificacion, $observaciones, $idAlumno, $idMateria) {
    // Prepara la consulta de inserción
    $stmtProducto = $conexion->prepare("INSERT INTO Datos (Registro_parcial, Calificacion, Observacion, ID_Estudiant, ID_Materi) VALUES (?, ?, ?, ?, ?)");

    if ($stmtProducto === false) {
        return false; // Maneja el error de preparación
    }

    // Vincula los parámetros
    $stmtProducto->bind_param("sisii", $registroParcial, $calificacion, $observaciones, $idAlumno, $idMateria);

    // Ejecuta la consulta
    $resultado = $stmtProducto->execute();

    // Cierra la consulta preparada
    $stmtProducto->close();

    return $resultado; // Devuelve true si fue exitoso, false en caso contrario
}
?>