<?php
// Incluye la conexión a la base de datos
include('../../../Modelo/Conexion.php');

// Establecer la conexión
$conexion = (new Conectar())->conexion();

// Verificar si se recibieron los datos por POST
if (isset($_POST['idCita']) && isset($_POST['comentarios'])) {
    $idCita = $_POST['idCita'];
    $comentarios = $_POST['comentarios'];
    $calificacionCita = $_POST['calificacionCita'];
    
    // Insertar la evaluación en la tabla Evaluacion_Citas
    $fecha = date('Y-m-d'); // Fecha actual
    $hora = date('H:i:s');  // Hora actual
    $sqlInsert = "INSERT INTO Evaluacion_Citas (ID_Citas, Fecha_Evaluacion, Hora_Evaluacion, Comentarios, calificacionCita) 
                  VALUES ('$idCita', '$fecha', '$hora', '$comentarios', '$calificacionCita')";
    
    if ($conexion->query($sqlInsert) === TRUE) {
        echo "Evaluación guardada exitosamente.";
    } else {
        echo "Error al guardar la evaluación: " . $conexion->error;
    }
}
?>