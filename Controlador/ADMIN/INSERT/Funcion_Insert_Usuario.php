<?php
include('../../../Modelo/Conexion.php');

function insertEstudiante($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_carrera) {
    $stmt = $conexion->prepare("INSERT INTO Estudiante (Nombre_Usuario_E, Apellido_Materno_E, Apellido_Paterno_E, Telefono_E, Fecha_Nacimiento_E, Genero_E, Correo_electronico_E, Contrasena_E, IdCarrera) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssssi', $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_carrera);
    $stmt->execute();
    $stmt->close();
}

function insertDocente($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $grado_academico, $materias) {
    $stmt = $conexion->prepare("INSERT INTO Docente (Nombre_Usuario_D, Apellido_Materno_D, Apellido_Paterno_D, Telefono_D, Fecha_Nacimiento_D, Genero_D, Correo_electronico_D, Contrasena_D) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssss', $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena);
    $stmt->execute();
    $id_docente = $conexion->insert_id;
    $stmt->close();

    $stmt_docente_materia = $conexion->prepare("INSERT INTO Docente_Materia (IdDocente, IdMateria, Grado_academico) VALUES (?, ?, ?)");
    $conteo = count($materias);
    for ($i = 0; $i < $conteo; $i++) {
        $id_materia = $materias[$i]['id'];
        $stmt_docente_materia->bind_param('iis', $id_docente, $id_materia, $grado_academico);
        $stmt_docente_materia->execute();
    }
    $stmt_docente_materia->close();
}

function insertAdministrador($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena) {
    $stmt = $conexion->prepare("INSERT INTO Administrador (Nombre_Usuario_A, Apellido_Materno_A, Apellido_Paterno_A, Telefono_A, Fecha_Nacimiento_A, Genero_A, Correo_electronico_A, Contrasena_A) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssss', $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_usuario = $_POST['ID_Tipo'];
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
            insertEstudiante($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $id_carrera);
        } elseif ($tipo_usuario === 'Docente') {
            $grado_academico = $_POST['grado_estudios'];
            $materias = json_decode($_POST['DatosTablaMateria'], true);
            insertDocente($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena, $grado_academico, $materias);
        } elseif ($tipo_usuario === 'Administrador') {
            insertAdministrador($conexion, $nombre, $apellido_materno, $apellido_paterno, $telefono, $fecha_nacimiento, $genero, $correo, $contrasena);
        }

        $conexion->commit();

        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("¡El registro fue exitoso!");';
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