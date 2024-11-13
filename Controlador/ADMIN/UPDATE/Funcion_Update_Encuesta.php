<?php
// Inicia la sesión PHP
session_start();

// Configura la localización a español
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');

// Incluye el archivo de conexión a la base de datos
include('../../../Modelo/Conexion.php');

function updateEncuesta($conexion, $registro, $ID_Topico, $ID_Encuesta) {
    // Actualiza los datos en la tabla Encuesta
    $stmt = $conexion->prepare("UPDATE Encuesta SET Fecha_Encuesta = ?, ID_Topicos = ? WHERE ID_Encuesta = ?");
    $stmt->bind_param('sii', $registro, $ID_Topico, $ID_Encuesta);
    $stmt->execute();
    $stmt->close();
}

function eliminarPreguntasPorEncuesta($conexion, $ID_Encuesta) {
    // Elimina las preguntas asociadas a la encuesta
    $stmt = $conexion->prepare("DELETE FROM Encuesta_Pregunta WHERE ID_Encuestas = ?");
    $stmt->bind_param('i', $ID_Encuesta);
    $stmt->execute();
    $stmt->close();
}

function insertarEncuestaPreguntas($conexion, $ID_Encuesta, $ID_Pregunta) {
    $stmt = $conexion->prepare("INSERT INTO Encuesta_Pregunta (ID_Encuestas, ID_Preguntas) VALUES (?, ?)");
    $stmt->bind_param('ii', $ID_Encuesta, $ID_Pregunta);
    $stmt->execute();
    $stmt->close();
}

function insertarPreguntas($conexion, $pregunta) {
    // Verifica si la pregunta ya existe en la tabla
    $stmtCheck = $conexion->prepare("SELECT ID_Pregunta FROM Pregunta WHERE Nombre_Pregunta = ?");
    $stmtCheck->bind_param('s', $pregunta);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        // Si la pregunta ya existe, recupera el ID y no la inserta nuevamente
        $stmtCheck->bind_result($ID_Pregunta);
        $stmtCheck->fetch();
        $stmtCheck->close();
        return $ID_Pregunta;
    } else {
        // Si la pregunta no existe, la inserta y obtiene el nuevo ID
        $stmtCheck->close();
        $stmtpre = $conexion->prepare("INSERT INTO Pregunta (Nombre_Pregunta) VALUES (?)");
        $stmtpre->bind_param('s', $pregunta);
        $stmtpre->execute();
        $ID_Pregunta = $stmtpre->insert_id; // Devuelve el ID generado para la pregunta insertada
        $stmtpre->close();
        return $ID_Pregunta;
    }
}

// Se asegura que el código solo se ejecute si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Establece la conexión a la base de datos
        $conexion = (new Conectar())->conexion();
        
        // Inicia la transacción
        $conexion->begin_transaction();

        // Verifica que los parámetros ID_Topico e ID_Encuesta existan en POST
        if (isset($_POST['ID_Topico'], $_POST['id'])) {
            $ID_Topico = $_POST['ID_Topico'];
            $ID_Encuesta = $_POST['id'];

            // Obtiene la fecha y hora actual para el registro
            $registro = date('Y-m-d H:i:s', time());

            // Elimina las preguntas asociadas a la encuesta y actualiza los datos de la encuesta
            eliminarPreguntasPorEncuesta($conexion, $ID_Encuesta);
            updateEncuesta($conexion, $registro, $ID_Topico, $ID_Encuesta);

            // Verifica si existen datos de preguntas en POST
            if (isset($_POST['DatosTablaPreguntaUpdate'])) {
                $datosTabla = json_decode($_POST['DatosTablaPreguntaUpdate'], true);

                // Verifica que los datos estén en el formato JSON esperado
                if (json_last_error() === JSON_ERROR_NONE) {
                    $numFilas = count($datosTabla);

                    // Itera sobre las preguntas y las inserta en la base de datos
                    for ($i = 0; $i < $numFilas; $i++) {
                        $pregunta = $datosTabla[$i]['nombre'];
                        $ID_Pregunta = insertarPreguntas($conexion, $pregunta);

                        // Inserta la relación de la encuesta con las preguntas
                        insertarEncuestaPreguntas($conexion, $ID_Encuesta, $ID_Pregunta);
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
            echo 'alert("¡La Modificación fue exitosa!");';
            echo 'window.location = "../../../Vista/ADMIN/Encuestas.php";';
            echo '</script>';
            exit();

        } else {
            throw new Exception("No se recibieron todos los parámetros necesarios.");
        }

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