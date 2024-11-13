<?php
// Inicia la sesión PHP
session_start();

// Configura la localización a español
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');

// Incluye el archivo de conexión a la base de datos
include('../../../Modelo/Conexion.php');

function UpdateEstudianteinsertAdministrador($conexion, $Nombre, $Tema, $Clave, $IDCarrera, $IDCuatrimestre, $IDMateria, $IDDocente, $ID_ADMIN, $ID_Topico) {
    $stmt = $conexion->prepare("UPDATE Topicos SET Nombre = ?, Temas = ?, Clave = ?, IdCarre = ?, IdCuatri = ?, IdMateri = ?, IdDocent = ?, ID_Administrador_Autorizo = ? WHERE ID_Topico = ?");
    $stmt->bind_param('sssiiiiii', $Nombre, $Tema, $Clave, $IDCarrera, $IDCuatrimestre, $IDMateria, $IDDocente, $ID_ADMIN, $ID_Topico);
    $stmt->execute();
    $stmt->close();
}

// Función para obtener el ID de usuario
function obtenerIDUsuario($conexion, $usuario) {
    $consulta = $conexion->prepare("SELECT ID_Usuario_A FROM Administrador WHERE Correo_electronico_A = ?;");
    $consulta->bind_param("s", $usuario);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $fila = $resultado->fetch_assoc();
    return $fila['ID_Usuario_A'];
}

// Se asegura que el código solo se ejecute si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Establece la conexión a la base de datos
        $conexion = (new Conectar())->conexion();
        $conexion->begin_transaction();

        // Obtiene el ID del administrador a partir del correo electrónico del usuario
        $usuario = $_SESSION['usuario'];
        $ID_ADMIN = obtenerIDUsuario($conexion, $usuario);

        // Obtiene los datos del formulario
        $ID_Topico = $_POST['id'];
        $Nombre = $_POST['Nombre'];
        $Tema = $_POST['Tema'];
        $Clave = $_POST['Clave'];
        $IDCarrera = $_POST['IDCarrera'];
        $IDCuatrimestre = $_POST['IDCuatrimestre'];
        $IDMateria = $_POST['IDMateria'];
        $IDDocente = $_POST['IDDocente'];

        // Inserta los datos en la base de datos
        UpdateEstudianteinsertAdministrador($conexion, $Nombre, $Tema, $Clave, $IDCarrera, $IDCuatrimestre, $IDMateria, $IDDocente, $ID_ADMIN, $ID_Topico);

        // Confirma la transacción
        $conexion->commit();

        // Éxito: muestra un mensaje y redirige
        echo '<script type="text/javascript">';
        echo 'alert("¡La Modificación fue exitosa!");';
        echo 'window.location = "../../../Vista/ADMIN/Topico.php";';
        echo '</script>';
        exit();

    } catch (Exception $e) {
        // Revierte la transacción en caso de error
        $conexion->rollback();

        // Muestra un mensaje de error
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ADMIN/Topico.php";';
        echo '</script>';
        exit();
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>