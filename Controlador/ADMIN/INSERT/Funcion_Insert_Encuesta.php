<?php
// Inicia la sesión PHP
session_start();

// Configura la localización a español
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');

// Incluye el archivo de conexión a la base de datos
include('../../../Modelo/Conexion.php');

function InsertarEncuesta($conexion, $ID_Topico, $registro){
    // Inserta los datos en la tabla Encuesta
    $stmt = $conexion->prepare("INSERT INTO Encuesta (Fecha_Encuesta, ID_Topicos) VALUES (?, ?)");
    $stmt->bind_param('si', $registro, $ID_Topico);
    $stmt->execute();
    $ID_Encuesta = $stmt->insert_id; // Devuelve el ID generado para la encuesta insertada
    $stmt->close();
    return $ID_Encuesta;
}

function InsertarEncuestaPreguntas($conexion, $ID_Encuesta, $ID_Pregunta) {
    $stmt = $conexion->prepare("INSERT INTO Encuesta_Pregunta (ID_Encuestas, ID_Preguntas) VALUES (?, ?)");
    $stmt->bind_param('ii', $ID_Encuesta, $ID_Pregunta);
    $stmt->execute();
    $stmt->close();
}

function InsertarPreguntas($conexion, $pregunta){
    $stmtpre = $conexion->prepare("INSERT INTO Pregunta (Nombre_Pregunta) VALUES (?)");
    $stmtpre->bind_param('s', $pregunta);
    $stmtpre->execute();
    $ID_Pregunta = $stmtpre->insert_id; // Devuelve el ID generado para la pregunta insertada
    $stmtpre->close();
    return $ID_Pregunta;
}

// Se asegura que el código solo se ejecute si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Establece la conexión a la base de datos
        $conexion = (new Conectar())->conexion();
        
        // Inicia la transacción
        $conexion->begin_transaction();

        // Obtiene el ID del tópico desde el formulario
        $ID_Topico = $_POST['ID_Topico']; // Cambiado para coincidir con el formulario HTML

        // Obtiene la fecha y hora actual para el registro
        $registro = date('Y-m-d H:i:s', time());

        // Inserta los datos en la tabla Encuesta y obtiene el ID generado
        $ID_Encuesta = InsertarEncuesta($conexion, $ID_Topico, $registro);

        if (isset($_POST['DatosTablaPregunta'])) {
            $datosTabla = json_decode($_POST['DatosTablaPregunta'], true);

            // Verifica que los datos estén en el formato JSON esperado
            if (json_last_error() === JSON_ERROR_NONE) {
                $numFilas = count($datosTabla);

                // Itera sobre las preguntas y las inserta en la base de datos
                for ($i = 0; $i < $numFilas; $i++) {
                    $pregunta = $datosTabla[$i]['pregunta'];
                    $ID_Pregunta = InsertarPreguntas($conexion, $pregunta);

                    // Inserta la relación de la encuesta con las preguntas
                    InsertarEncuestaPreguntas($conexion, $ID_Encuesta, $ID_Pregunta);
                }
            } else {
                throw new Exception("Los datos de la tabla no están en el formato JSON esperado.");
            }
        } else {
            throw new Exception("No se recibieron datos de la tabla.");
        }

        // Confirma la transacción
        $conexion->commit();

        // Éxito: muestra un mensaje y redirige
        echo '<script type="text/javascript">';
        echo 'alert("¡El registro fue exitoso!");';
        echo 'window.location = "../../../Vista/ADMIN/Encuestas.php";';
        echo '</script>';
        exit();

    } catch (Exception $e) {
        // Revierte la transacción en caso de error
        $conexion->rollback();

        // Muestra un mensaje de error
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ADMIN/Encuestas.php";';
        echo '</script>';
        exit();
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>