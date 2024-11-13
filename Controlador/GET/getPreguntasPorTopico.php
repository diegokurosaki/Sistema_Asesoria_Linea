<?php
include('../../Modelo/Conexion.php');
$conexion = (new Conectar())->conexion();

// Obtener el ID del tópico enviado mediante POST
$idTopico = isset($_POST['idTopico']) ? $_POST['idTopico'] : '';

if ($idTopico) {
    // Consulta para obtener las preguntas asociadas al tópico seleccionado
    $queryPreguntas = "SELECT P.ID_Pregunta, P.Nombre_Pregunta 
                        FROM Encuesta E 
                        INNER JOIN Encuesta_Pregunta EP ON E.ID_Encuesta = EP.ID_Encuestas
                        INNER JOIN Pregunta P ON EP.ID_Preguntas = P.ID_Pregunta 
                        WHERE E.ID_Topicos = '$idTopico'";

    $result = $conexion->query($queryPreguntas);
    $preguntas = array();

    while ($pregunta = $result->fetch_assoc()) {
        $preguntas[] = $pregunta;
    }

    // Devolver las preguntas como JSON
    echo json_encode($preguntas);
}
?>