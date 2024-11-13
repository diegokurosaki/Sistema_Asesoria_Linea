<?php
include('../../Modelo/Conexion.php'); 

// Crear una nueva conexión a la base de datos
$conexion = (new Conectar())->conexion();

// Preparar la consulta SQL
$sql = "SELECT ID_Carrera, Nombre_Carrera FROM Carrera";

// Ejecutar la consulta
if ($stmt = $conexion->prepare($sql)) {
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Recopilar los resultados
    $carreras = array();
    while ($row = $resultado->fetch_assoc()) {
        $carreras[] = $row;
    }

    // Devolver los resultados como JSON
    echo json_encode($carreras);

    // Cerrar la declaración
    $stmt->close();
} else {
    echo json_encode(array("error" => "No se pudo preparar la consulta."));
}

// Cerrar la conexión
$conexion->close();
?>