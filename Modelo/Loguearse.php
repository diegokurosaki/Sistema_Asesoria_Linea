<?php
// Iniciar la sesión
session_start();

// Desactivar la notificación de errores para evitar mostrar mensajes de error al usuario
error_reporting(0);

// Comprobar si ha pasado más de 5 minutos desde la última actividad
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    session_unset();     // Limpiar las variables de sesión
    session_destroy();     // Destruir la sesión
    // Redirigir a la página de inicio de sesión con mensaje
    echo '<script>
        alert("Lo siento, tu tiempo de sesión ha terminado.");
        window.location = "../../index.php";
    </script>';
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Actualizar la última actividad

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Mostrar alerta en JavaScript
    echo '<script>
        alert("Por favor, debes iniciar sesión.");
        window.location = "../../index.php";
    </script>';

    session_destroy();     // Destruir la sesión
    die();     // Finalizar la ejecución del script
}
?>