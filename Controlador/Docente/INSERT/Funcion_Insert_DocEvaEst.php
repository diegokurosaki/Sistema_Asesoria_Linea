<?php
// Configura la localización a español.
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México.
date_default_timezone_set('America/Mexico_City');

// Incluye la conexión a la base de datos
include('../../../Modelo/Conexion.php');

// Establecer la conexión
$conexion = (new Conectar())->conexion();

// Verificar si se recibieron los datos por POST
if (isset($_POST['idCita']) && isset($_POST['Respuesta']) && isset($_POST['Observacion'])) {
    $idCita = $_POST['idCita'];
    $Respuesta = $_POST['Respuesta'];
    $Observacion = $_POST['Observacion'];
    
    // Obtiene la fecha y hora actual para el registro del producto.
    $registro = date('Y-m-d H:i:s', time());

    $sqlInsert = "INSERT INTO registrar_cita_doc_alumno (IdCitas, FechaActual, Respuesta, Observacion) 
                  VALUES ('$idCita', '$registro', '$Respuesta', '$Observacion')";
    
    if ($conexion->query($sqlInsert) === TRUE) {
        echo "Evaluación guardada exitosamente.";
    } else {
        echo "Error al guardar la evaluación: " . $conexion->error;
    }
}
?>