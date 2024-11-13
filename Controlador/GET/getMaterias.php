<?php
include('../../Modelo/Conexion.php'); 

// Crear una nueva conexión a la base de datos
$conexion = (new Conectar())->conexion();

// Preparar la consulta SQL
$sql = "SELECT ID_Materia, Nombre_Materia FROM Materias";

// Ejecutar la consulta
if ($stmt = $conexion->prepare($sql)) {
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Recopilar los resultados
    $materias = array();
    while ($row = $resultado->fetch_assoc()) {
        $materias[] = $row;
    }

    // Devolver los resultados como JSON
    echo json_encode($materias);

    // Cerrar la declaración
    $stmt->close();
} else {
    echo json_encode(array("error" => "No se pudo preparar la consulta."));
}

// Cerrar la conexión
$conexion->close();
?>