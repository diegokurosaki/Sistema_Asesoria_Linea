<?php
// Inicia la sesión PHP
session_start();

// Incluye el archivo de conexión a la base de datos
include('../../../Modelo/Conexion.php');

function EliminarPreguntasPorEncuesta($conexion, $ID_Encuesta) {
    // Elimina las preguntas asociadas a la encuesta
    $stmt = $conexion->prepare("DELETE FROM Encuesta_Pregunta WHERE ID_Encuestas = ?");
    $stmt->bind_param('i', $ID_Encuesta);
    $stmt->execute();
    $stmt->close();
}

function EliminarEncuesta($conexion, $ID_Encuesta) {
    // Elimina la encuesta
    $stmt = $conexion->prepare("DELETE FROM Encuesta WHERE ID_Encuesta = ?");
    $stmt->bind_param('i', $ID_Encuesta);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Establece la conexión a la base de datos
    $conexion = (new Conectar())->conexion();

    try {
        // Obtiene el ID de la encuesta a eliminar desde la URL
        $ID_Encuesta = $_GET['id'];

        // Inicia la transacción
        $conexion->begin_transaction();

        // Elimina las preguntas asociadas a la encuesta
        EliminarPreguntasPorEncuesta($conexion, $ID_Encuesta);

        // Elimina la encuesta
        EliminarEncuesta($conexion, $ID_Encuesta);

        // Confirma la transacción
        $conexion->commit();

        // Éxito: muestra un mensaje y redirige
        echo '<script type="text/javascript">';
        echo 'alert("¡La encuesta ha sido eliminada exitosamente!");';
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
} else {
    // Si no se proporciona un ID de encuesta en la URL, redirige a la página de encuestas
    echo '<script type="text/javascript">';
    echo 'alert("ID de encuesta no especificado.");';
    echo 'window.location = "../../../Vista/ADMIN/Encuestas.php";';
    echo '</script>';
    exit();
}
?>