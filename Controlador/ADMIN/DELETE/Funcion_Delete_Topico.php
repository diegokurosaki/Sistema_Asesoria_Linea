<?php
include('../../../Modelo/Conexion.php');

function deleteTopico($conexion, $id) {
    $stmt = $conexion->prepare("DELETE FROM Topicos WHERE ID_Topico = ?;");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $conexion = (new Conectar())->conexion();

    try {
        $conexion->begin_transaction();

        deleteTopico($conexion, $id);

        $conexion->commit();

        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("¡La eliminación fue exitosa!");';
        echo 'window.location = "../../../Vista/ADMIN/Topico.php";'; // Reemplazar con la ruta de redirección deseada
        echo '</script>';
        exit();

    } catch (Exception $e) {
        $conexion->rollback();
        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ADMIN/Topico.php";'; // Reemplazar con la ruta de redirección deseada
        echo '</script>';
        exit();
    }

    $conexion->close();
}
?>