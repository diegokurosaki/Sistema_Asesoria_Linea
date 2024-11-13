<?php
include('../../../Modelo/Conexion.php');

function UpdateEstudiante($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_carrera, $id_usuario) {
    $stmt = $conexion->prepare("UPDATE Estudiante SET Nombre_Usuario_E = ?, Apellido_Materno_E = ?, Apellido_Paterno_E = ?, Telefono_E = ?, Fecha_Nacimiento_E = ?, Genero_E = ?, Correo_electronico_E = ?, Contrasena_E = ?, IdCarrera = ? WHERE ID_Usuario_E = ?");
    $stmt->bind_param('ssssssssii', $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_carrera, $id_usuario);
    $stmt->execute();
    $stmt->close();
}

function UpdateDocente($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $grado_academico, $materias, $id_usuario) {
    $stmt = $conexion->prepare("UPDATE Docente SET Nombre_Usuario_D = ?, Apellido_Materno_D = ?, Apellido_Paterno_D = ?, Telefono_D = ?, Fecha_Nacimiento_D = ?, Genero_D = ?, Correo_electronico_D = ?, Contrasena_D = ? WHERE ID_Usuario_D = ?");
    $stmt->bind_param('ssssssssi', $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_usuario);
    $stmt->execute();
    $stmt->close();

    deleteDocenteMateria($conexion, $id_usuario);

    $stmt_docente_materia = $conexion->prepare("INSERT INTO Docente_Materia (IdDocente, IdMateria, Grado_academico) VALUES (?, ?, ?)");
    $conteo = count($materias);
    for ($i = 0; $i < $conteo; $i++) {
        $id_materia = $materias[$i]['id'];
        $stmt_docente_materia->bind_param('iis', $id_usuario, $id_materia, $grado_academico);
        $stmt_docente_materia->execute();
    }
    $stmt_docente_materia->close();
}

function deleteDocenteMateria($conexion, $id_usuario) {
    // Primero, eliminar las relaciones en Docente_Materia
    $stmt_rel = $conexion->prepare("DELETE FROM Docente_Materia WHERE IdDocente = ?");
    $stmt_rel->bind_param('i', $id_usuario);
    $stmt_rel->execute();
    $stmt_rel->close();
}

function UpdateAdministrador($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_usuario) {
    $stmt = $conexion->prepare("UPDATE Administrador SET Nombre_Usuario_A = ?, Apellido_Materno_A = ?, Apellido_Paterno_A = ?, Telefono_A = ?, Fecha_Nacimiento_A = ?, Genero_A = ?, Correo_electronico_A = ?, Contrasena_A = ? WHERE ID_Usuario_A = ?");
    $stmt->bind_param('ssssssssi', $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_usuario);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $nombre = $_POST['nombre_usuario'];
    $apellido_materno = $_POST['apellido_materno'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $correo = $_POST['correo_electronico'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $conexion = (new Conectar())->conexion();

    try {
        $conexion->begin_transaction();

        if ($tipo_usuario === 'Estudiante') {
            $id_carrera = $_POST['ID_Carrera'];
            UpdateEstudiante($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_carrera, $id_usuario);
        } elseif ($tipo_usuario === 'Docente') {
            $grado_academico = $_POST['grado_estudios'];
            $materias = json_decode($_POST['DatosTablaMateria'], true);
            UpdateDocente($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $grado_academico, $materias, $id_usuario);
        } elseif ($tipo_usuario === 'Administrador') {
            UpdateAdministrador($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_usuario);
        }

        $conexion->commit();

        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("¡La Modificación fue exitosa!");';
        echo 'window.location = "../../../Vista/ADMIN/Usuario.php";';
        echo '</script>';
        exit();

    } catch (Exception $e) {
        $conexion->rollback();

        // Mostrar un mensaje de error
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ADMIN/Usuario.php";';
        echo '</script>';
        exit();
    }
    $conexion->close();
}
?>