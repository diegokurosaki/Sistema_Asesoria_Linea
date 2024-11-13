<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include('../../Modelo/Conexion.php');
// Obtener la instancia de conexión
$conexion = (new Conectar())->conexion();

// Obtener las credenciales de usuario desde el formulario de inicio de sesión
$Correo = $_POST['correo'];
$Clave = $_POST['contrasena'];

// Verificar las credenciales en las diferentes tablas de usuarios
$tipoUsuario = verificarCredenciales($conexion, $Correo, $Clave);

// dependiendo el tipo de usuario
if ($tipoUsuario) {
    // Almacenar el correo electrónico del usuario en la sesión
    $_SESSION['usuario'] = $Correo;

    // Redirigir según el tipo de usuario
    redirigirUsuario($tipoUsuario);
} else {
    // Si no se encontró un usuario con las credenciales, mostrar un mensaje de error y redirigir
    mostrarErrorYRedirigir("Error, al parecer no estás registrado");
}

// Función para verificar credenciales en las tablas Estudiante, Docente y Administrador
function verificarCredenciales($conexion, $Correo, $Clave) {
    // Verificar en la tabla Estudiante
    $sql_estudiante = "SELECT Contrasena_E FROM Estudiante WHERE Correo_electronico_E = ?";
    // Ejecutar consulta y obtener hash de la contraseña del estudiante
    if ($hash = consultarBaseDeDatos($conexion, $sql_estudiante, $Correo)) {
        // Verificar si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($Clave, $hash)) {
            return 'Estudiante'; // Retornar 'Estudiante' si las credenciales son válidas
        }
    }

    // Verificar en la tabla Docente
    $sql_docente = "SELECT Contrasena_D FROM Docente WHERE Correo_electronico_D = ?";
    // Ejecutar consulta y obtener hash de la contraseña del docente
    if ($hash = consultarBaseDeDatos($conexion, $sql_docente, $Correo)) {
        // Verificar si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($Clave, $hash)) {
            return 'Docente'; // Retornar 'Docente' si las credenciales son válidas
        }
    }

    // Verificar en la tabla Administrador
    $sql_administrador = "SELECT Contrasena_A FROM Administrador WHERE Correo_electronico_A = ?";
    // Ejecutar consulta y obtener hash de la contraseña del administrador
    if ($hash = consultarBaseDeDatos($conexion, $sql_administrador, $Correo)) {
        // Verificar si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($Clave, $hash)) {
            return 'Administrador'; // Retornar 'Administrador' si las credenciales son válidas
        }
    }

    // Retornar false si las credenciales no coinciden en ninguna tabla
    return false;
}

// Función para consultar la base de datos y obtener el hash de la contraseña
function consultarBaseDeDatos($conexion, $sql, $Correo) {
    // Preparar la sentencia SQL
    $stmt = mysqli_prepare($conexion, $sql);
    // Vincular el parámetro de la consulta con el valor del correo electrónico
    mysqli_stmt_bind_param($stmt, "s", $Correo);
    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);
    // Obtener el resultado de la consulta
    $result = mysqli_stmt_get_result($stmt);
    // Obtener la fila resultante como un array asociativo
    $row = mysqli_fetch_assoc($result);

    // Retornar el primer valor del array (el hash de la contraseña) si existe, o false si no existe
    return $row ? array_values($row)[0] : false;
}

// Función para redirigir según el tipo de usuario
function redirigirUsuario($tipoUsuario) {
    // Evaluar el tipo de usuario y redirigir a la página correspondiente
    switch ($tipoUsuario) {
        case 'Estudiante':
            // Redirigir a la página de inicio de Estudiante
            header("Location: ../../Vista/ESTUDIANTE/Principal.php");
            break;
        case 'Docente':
            // Redirigir a la página de inicio de Docente
            header("Location: ../../Vista/Docente/Principal.php");
            break;
        case 'Administrador':
            // Redirigir a la página de inicio de Administrador
            header("Location: ../../Vista/ADMIN/Principal.php");
            break;
        default:
            // Mostrar un mensaje de error y redirigir si el tipo de usuario es desconocido
            mostrarErrorYRedirigir("Usuario Desconocido");
            break;
    }
    exit(); // Detener la ejecución después de redirigir
}

// Función para mostrar un mensaje de error y redirigir
function mostrarErrorYRedirigir($mensaje) {
    // Generar el script de JavaScript para mostrar un mensaje de alerta
    echo '<script type="text/javascript">';
    echo 'alert("' . $mensaje . '");'; // Mostrar el mensaje de error
    // Redirigir a la página principal después de cerrar el mensaje de alerta
    echo 'window.location = "../../index.php";';
    echo '</script>';
    exit(); // Detener la ejecución después de mostrar el mensaje
}
?>