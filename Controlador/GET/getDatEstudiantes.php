<?php
include('../../Modelo/Conexion.php');

header('Content-Type: application/json');

// Verifica si se ha enviado un ID de carrera
if (!isset($_GET['IdCarrera'])) {
    echo json_encode(['error' => 'ID de carrera no proporcionado']);
    exit();
}

$idCarrera = intval($_GET['IdCarrera']);
$conexion = (new Conectar())->conexion();

try {
    // Consulta para obtener estudiantes de la carrera seleccionada
    $stmt = $conexion->prepare("
        SELECT ID_Usuario_E, CONCAT(Nombre_Usuario_E, ' ', Apellido_Paterno_E, ' ', Apellido_Materno_E) AS Nombre_Alumno
        FROM Estudiante
        WHERE IdCarrera = ?;");
    $stmt->bind_param('i', $idCarrera);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    $estudiantes = [];
    while ($row = $resultado->fetch_assoc()) {
        $estudiantes[] = $row;
    }
    
    echo json_encode($estudiantes);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$conexion->close();
?>