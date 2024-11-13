<?php
// Incluir el archivo de Loguearse.php
include(__DIR__ . '/../../../Modelo/Loguearse2.php');

// Verificar si se solicita cerrar sesión
if(isset($_GET['cerrar_sesion'])) {
    // Destruir la sesión
    session_destroy(); 
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: ../../../index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invertario</title>
    <!-- Enlace a la hoja de estilos de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tu hoja de estilos personalizada -->
    <link href="../../../css/reporte.css" rel="stylesheet">
    <link href="../../../css/boton.css" rel="stylesheet">
    <link href="../../../css/checkbox.css" rel="stylesheet">
</head>
<style>
    body {
        background: #bae0f5;
    }

        .user-fields {
            display: none;
        }
</style>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container-fluid">
            <a class="btn btn-light" href="../Principal.php">Inicio</a>
            <span class="navbar-brand mb-0 h1 mx-auto">Sistema Web de Impartición de Asesorías en Línea</span>
            <a href="?cerrar_sesion=true" class="btn btn-light">Cerrar Sesión</a>
        </div>
    </nav>
    <!-- Contenido principal -->
    <div class="container mt-4 ">
        <!-- Puedes agregar contenido adicional aquí según tus necesidades -->