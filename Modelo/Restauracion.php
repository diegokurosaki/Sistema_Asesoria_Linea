<?php
// Configuración regional y zona horaria
setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/Mexico_City');

// Configuración de la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "Asesoria_Linea";

// Verificar si se proporcionó el nombre del archivo
if (isset($_GET['archivo'])) {
    $archivo = $_GET['archivo'];
    $ruta_archivo = 'backups/' . $archivo;

    // Crear conexión
    $conn = new mysqli($host, $user, $password);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Seleccionar base de datos
    $conn->select_db($database);

    // Intentar eliminar la base de datos
    if (!$conn->query("DROP DATABASE $database")) {
        // Si falla, eliminar todas las tablas dentro de la base de datos
        $result = $conn->query("SHOW TABLES");
        while ($row = $result->fetch_array()) {
            $conn->query("DROP TABLE IF EXISTS " . $row[0]);
        }
    } else {
        // Si la eliminación fue exitosa, recrear la base de datos
        $conn->query("CREATE DATABASE $database");
        $conn->select_db($database);
    }

    // Verificar que el archivo de respaldo exista
    if (!file_exists($ruta_archivo)) {
        die("El archivo de respaldo no existe.");
    }

    // Leer el archivo SQL y ejecutar los comandos
    $sqlFile = file_get_contents($ruta_archivo);
    if ($conn->multi_query($sqlFile)) {
        echo '<script type="text/javascript">';
        echo 'alert("¡Restauración de la base de datos completada exitosamente!");';
        echo 'window.location = "../Vista/ADMIN/SQL_Admin.php";';
        echo '</script>';
    } else {
        echo "Error al restaurar la base de datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo 'No se proporcionó el nombre del archivo.';
}
?>