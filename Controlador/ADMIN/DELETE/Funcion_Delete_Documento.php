<?php
include('../../../Modelo/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $conexion = (new Conectar())->conexion();

    try {
        $conexion->begin_transaction();

        $Ruta = BuscarRutaDocente($conexion, $id);

        if ($Ruta) {
            deleteDocumento($conexion, $id, $Ruta);
            $conexion->commit();
            
            // Éxito: mostrar un mensaje y redirigir
            echo '<script type="text/javascript">';
            echo 'alert("¡La eliminación fue exitosa!");';
            echo 'window.location = "../../../Vista/ADMIN/Documento.php";'; // Reemplazar con la ruta de redirección deseada
            echo '</script>';
            exit();
        } else {
            throw new Exception("No se encontró la ruta del archivo.");
        }

    } catch (Exception $e) {
        $conexion->rollback();
        // Mostrar un mensaje de error y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ADMIN/Documento.php";'; // Reemplazar con la ruta de redirección deseada
        echo '</script>';
        exit();
    }
    $conexion->close();
}

function BuscarRutaDocente($conexion, $id) {
    $ubicacion = "";
    // Prepara la consulta para obtener la ubicación del archivo
    $stmt = $conexion->prepare("SELECT ubicacion FROM Documentos WHERE Id_Documento = ?;");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    
    // Asigna el resultado a una variable
    $stmt->bind_result($ubicacion);

    $LocationFinal = "../../../" . $ubicacion;
    $stmt->fetch();
    $stmt->close();
    
    // Devuelve la ruta del archivo
    return $LocationFinal;
}

function deleteDocumento($conexion, $id, $Ruta) {
    // Elimina el registro de la base de datos
    $stmt = $conexion->prepare("DELETE FROM Documentos WHERE Id_Documento = ?;");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    // Elimina el archivo del sistema
    if (file_exists($Ruta)) {
        unlink($Ruta);
    } else {
        throw new Exception("El archivo no existe.");
    }
}
?>