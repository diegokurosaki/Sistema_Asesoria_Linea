<?php
// Incluir el archivo de Loguearse.php
include('../../Modelo/Loguearse.php');

// Verificar si se solicita cerrar sesión
if(isset($_GET['cerrar_sesion'])) {
    // Destruir la sesión
    session_destroy(); 
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu principal</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/index_admin.css">
        <link rel="shortcut icon" href="../../img/logo.png">
    </head>
    <body> 
        <header><!--Contenedor del nav-->
            <a href="#" class="logo">
            <img src="../../img/logo.png" alt="">
            <h2 class="nombre">Sistema Web para la Impartición de Asesorías en Línea</h2>
            </a>

            <nav><!--Opciones del nav-->
                <a href="?cerrar_sesion=true" class="comic-button">Cerrar Sesión</a>
            </nav>
        </header>
        <div class="mensaje"><!--CONTENEDOR DEL MENSAJE DE BIENVENIDA-->
            <h2>Bienvenido usuario Estudiante</h2>
        </div>
        <!-- notificacion -->
        <div id="alertaCitas"></div>
        
        <div class="contenedor"><!--LAS CARDS-->
            <a href="Evaluar_Documento.php" class="card"><!--INICIO PRIMERA CARD-->
            <div class="image"><span class="text"></span></div>
            <span class="title">Archivos compartidos</span>
            </a><!--FIN PRIMERA CARD-->
            <a href="Evaluar_Encuesta.php"class="card section2" ><!--INICIO SEGUNDA CARD-->
            <div class="image image2"><span class="text"></span></div>
            <span class="title">Evaluación Tópico</span>    
            </a><!--FIN SEGUNDA CARD-->
            <a href="Evaluar_Cita.php"class="card section2" ><!--INICIO SEGUNDA CARD-->
            <div class="image image3"><span class="text"></span></div>
            <span class="title">Evaluación Cita</span>    
            </a><!--FIN SEGUNDA CARD-->
    </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/NotificacionCitas.js"></script>
</html>