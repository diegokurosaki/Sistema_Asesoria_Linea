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
    // Consulta para obtener materias de la carrera seleccionada
    $stmt = $conexion->prepare("
        SELECT m.ID_Materia, m.Nombre_Materia
        FROM Materias m
        JOIN Carre_Cuatri_Mater ccm ON m.ID_Materia = ccm.IdMaterias
        WHERE ccm.IdCarreras = ?
    ");
    $stmt->bind_param('i', $idCarrera);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    $materias = [];
    while ($row = $resultado->fetch_assoc()) {
        $materias[] = $row;
    }
    
    echo json_encode($materias);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$conexion->close();
?>