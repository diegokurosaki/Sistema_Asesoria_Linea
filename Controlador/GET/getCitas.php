<?php
// Iniciar sesión
session_start();
$idEstudiante = $_SESSION['usuario'];

// Conectar a la base de datos
include('../../Modelo/Conexion.php');
$conexion = (new Conectar())->conexion();

function obtenerCitasNotificacion($conexion, $idEstudiante) {
    $fechaActual = date('Y-m-d');
    $horaActual = date('H:i:s');
    
    // Consulta para obtener citas para hoy, mañana o pasadas
    $stmt = $conexion->prepare("SELECT C.Titulo, C.Fch_Cita, C.Hora_Cita 
        FROM Citas C
        INNER JOIN Estudiante E ON C.ID_Estudiante_Citado = E.ID_Usuario_E
        WHERE E.Correo_electronico_E = ? 
        AND (C.Fch_Cita = ? OR C.Fch_Cita = DATE_ADD(?, INTERVAL 1 DAY) OR (C.Fch_Cita < ? AND C.Hora_Cita < ?))");

    $stmt->bind_param('sssss', $idEstudiante, $fechaActual, $fechaActual, $fechaActual, $horaActual);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $citas = [];
    while ($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
    $stmt->close();
    
    return $citas;
}

// Obtener las citas
$citas = obtenerCitasNotificacion($conexion, $idEstudiante);

// Devolver las citas en formato JSON
header('Content-Type: application/json');
echo json_encode($citas);
?>