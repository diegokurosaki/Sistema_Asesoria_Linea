<?php
// Inicia la sesión PHP
session_start();

// Configura la localización a español
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');

// Incluye el archivo de conexión a la base de datos
include('../../../Modelo/Conexion.php');

function InsertarCitas($conexion, $Titulo, $fecha, $hora, $Link, $ID_Topico, $ID_Estudiante) {
    $stmt = $conexion->prepare("INSERT INTO Citas (Titulo, Fch_Cita, Hora_Cita, Link, ID_Topicos, ID_Estudiante_Citado) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssii', $Titulo, $fecha, $hora, $Link, $ID_Topico, $ID_Estudiante);
    $stmt->execute();
    $stmt->close();
}

// Se asegura que el código solo se ejecute si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Establece la conexión a la base de datos
        $conexion = (new Conectar())->conexion();
        $conexion->begin_transaction();

        // Obtiene los datos del formulario
        $Titulo = $_POST['Titulo'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $Link = $_POST['Link'];
        $ID_Topico = $_POST['ID_Topico'];
        $ID_Estudiante = $_POST['ID_Estudiante'];

        // Inserta los datos en la base de datos
        InsertarCitas($conexion, $Titulo, $fecha, $hora, $Link, $ID_Topico, $ID_Estudiante);

        // Confirma la transacción
        $conexion->commit();

        // Éxito: muestra un mensaje y redirige
        echo '<script type="text/javascript">';
        echo 'alert("¡El registro fue exitoso!");';
        echo 'window.location = "../../../Vista/DOCENTE/Citas.php";';
        echo '</script>';
        exit();

    } catch (Exception $e) {
        // Revierte la transacción en caso de error
        $conexion->rollback();

        // Muestra un mensaje de error
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/DOCENTE/Citas.php";';
        echo '</script>';
        exit();
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>