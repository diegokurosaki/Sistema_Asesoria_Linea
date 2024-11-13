<?php
// Inicia la sesión PHP
session_start();

// Configura la localización a español
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');

// Incluye la conexión a la base de datos
include('../../../Modelo/Conexion.php');

// Se asegura que el código solo se ejecute si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Establece la conexión a la base de datos
        $conexion = (new Conectar())->conexion();
        $conexion->begin_transaction();

        // Obtiene los datos enviados por POST
        $idCompartirRecurso = $_POST['id_compartir_recurso'];
        $calificacion = $_POST['calificacion'];
        $comentarios = $_POST['comentarios'];
        $fechaEvaluacion = date('Y-m-d H:i:s', time());

        // Consulta para insertar la evaluación
        $query = $conexion->prepare("
            INSERT INTO Evaluacion_Material (Calificacion, Comentarios, Fecha_Evaluacion, ID_Compartir_Recursos)
            VALUES (?, ?, ?, ?)
        ");
        $query->bind_param("issi", $calificacion, $comentarios, $fechaEvaluacion, $idCompartirRecurso);
        $query->execute();

        // Confirma la transacción
        $conexion->commit();

        // Mensaje de éxito
        echo "¡Evaluación registrada exitosamente!";
    } catch (Exception $e) {
        // Revierte la transacción en caso de error
        $conexion->rollback();
        echo "ERROR: " . $e->getMessage();
    }
    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>