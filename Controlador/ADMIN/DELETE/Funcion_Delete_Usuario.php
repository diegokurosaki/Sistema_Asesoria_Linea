<?php
include('../../../Modelo/Conexion.php');

function deleteEstudiante($conexion, $id) {
    $stmt = $conexion->prepare("DELETE FROM Estudiante WHERE ID_Usuario_E = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

function deleteDocente($conexion, $id) {
    // Primero, eliminar las relaciones en Docente_Materia
    $stmt_rel = $conexion->prepare("DELETE FROM Docente_Materia WHERE IdDocente = ?");
    $stmt_rel->bind_param('i', $id);
    $stmt_rel->execute();
    $stmt_rel->close();

    // Luego, eliminar al docente
    $stmt = $conexion->prepare("DELETE FROM Docente WHERE ID_Usuario_D = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

function deleteAdministrador($conexion, $id) {
    $stmt = $conexion->prepare("DELETE FROM Administrador WHERE ID_Usuario_A = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $rol = $_GET['rol'];
    $id = $_GET['id'];

    $conexion = (new Conectar())->conexion();

    try {
        $conexion->begin_transaction();

        if ($rol === 'Estudiante') {
            deleteEstudiante($conexion, $id);
        } elseif ($rol === 'Docente') {
            deleteDocente($conexion, $id);
        } elseif ($rol === 'Administrador') {
            deleteAdministrador($conexion, $id);
        }

        $conexion->commit();

        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("¡La eliminación fue exitosa!");';
        echo 'window.location = "../../../Vista/ADMIN/Usuario.php";'; // Reemplazar con la ruta de redirección deseada
        echo '</script>';
        exit();

    } catch (Exception $e) {
        $conexion->rollback();
        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ADMIN/Usuario.php";'; // Reemplazar con la ruta de redirección deseada
        echo '</script>';
        exit();
    }

    $conexion->close();
}
?>