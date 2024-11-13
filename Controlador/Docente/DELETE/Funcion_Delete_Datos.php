<?php
include('../../../Modelo/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $conexion = (new Conectar())->conexion();

    try {
        $conexion->begin_transaction();

        // Intentar eliminar los datos
        if (deleteDatosEstudiantes($conexion, $id)) {
            $conexion->commit();
            
            // Éxito: mostrar un mensaje y redirigir
            echo '<script type="text/javascript">';
            echo 'alert("¡La eliminación fue exitosa!");';
            echo 'window.location = "../../../Vista/DOCENTE/Datos_Informacion.php";'; // Reemplazar con la ruta de redirección deseada
            echo '</script>';
            exit();
        } else {
            throw new Exception("Error al eliminar los datos.");
        }

    } catch (Exception $e) {
        $conexion->rollback();
        // Mostrar un mensaje de error y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/DOCENTE/Datos_Informacion.php";'; // Reemplazar con la ruta de redirección deseada
        echo '</script>';
        exit();
    }
    $conexion->close();
}

function deleteDatosEstudiantes($conexion, $id) {
    $stmt = $conexion->prepare("DELETE FROM Datos WHERE ID_Estudiant = ?;");
    
    if ($stmt === false) {
        return false;
    }
    
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    $stmt->close();

    return $result; // Devuelve true si la ejecución fue exitosa, false en caso contrario
}
?>