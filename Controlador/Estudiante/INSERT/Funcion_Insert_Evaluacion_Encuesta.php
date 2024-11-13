<?php
// Inicia la sesión PHP
session_start();

// Configura la localización a español
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');

// Incluye el archivo de conexión a la base de datos
include('../../../Modelo/Conexion.php');

// Función para obtener el ID de usuario del estudiante
function obtenerIDUsuarioEstudiante($conexion, $usuario) {
    $consulta = $conexion->prepare("SELECT ID_Usuario_E FROM Estudiante WHERE Correo_electronico_E = ?;");
    $consulta->bind_param("s", $usuario);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $fila = $resultado->fetch_assoc();
    return $fila['ID_Usuario_E'];
}

// Función para insertar la evaluación del tópico con calificación acumulada
function InsertarEvaluacionTopico($conexion, $ID_Topico, $respuestas) {
    $fechaRegistro = date('Y-m-d H:i:s', time());

    // Obtener el ID del estudiante
    $usuario = $_SESSION['usuario'];
    $ID_Estudiante = obtenerIDUsuarioEstudiante($conexion, $usuario);

    // Iterar a través de las respuestas decodificadas y realizar la inserción
    foreach ($respuestas as $idPregunta => $opcionSeleccionada) {
        // Preparar la consulta de inserción
        $consulta = $conexion->prepare("INSERT INTO Evaluacion_Estudiante_Topico (Calificacion, ID_EstudianteEva, ID_TopicoEva, Fecha_EvaTopico) VALUES (?, ?, ?, ?);");

        // Asignar los valores a la consulta. Cambia `siis` a `ssis` para usar el tipo string en `Calificacion`
        $consulta->bind_param("siis", $opcionSeleccionada, $ID_Estudiante, $ID_Topico, $fechaRegistro);

        // Ejecutar la consulta
        if (!$consulta->execute()) {
            throw new Exception("Error al insertar la evaluación: " . $consulta->error);
        }
    }

    // Cerrar la consulta
    $consulta->close();
}

// Se asegura que el código solo se ejecute si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Establece la conexión a la base de datos
        $conexion = (new Conectar())->conexion();
        $conexion->begin_transaction();

        // Obtiene el ID del tópico seleccionado
        $ID_Topico = $_POST['ID_Topico'];
        
        // Obtener el usuario de la sesión
        $usuario = $_SESSION['usuario'];

        // Verificar que se hayan enviado respuestas
        if (isset($_POST['DatosTablaPregunta'])) {
            // Decodificar la cadena JSON a un array PHP
            $respuestas = json_decode($_POST['DatosTablaPregunta'], true);
            
            // Llamar a la función para insertar la evaluación con la calificación total acumulada
            InsertarEvaluacionTopico($conexion, $ID_Topico, $respuestas);
        }

        // Confirma la transacción
        $conexion->commit();

        // Éxito: muestra un mensaje y redirige
        echo '<script type="text/javascript">';
        echo 'alert("¡El registro fue exitoso!");';
        echo 'window.location = "../../../Vista/ESTUDIANTE/Evaluar_Encuesta.php";';
        echo '</script>';
        exit();

    } catch (Exception $e) {
        // Revierte la transacción en caso de error
        $conexion->rollback();

        // Muestra un mensaje de error
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ESTUDIANTE/Evaluar_Encuesta.php";';
        echo '</script>';
        exit();
    }
    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>