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
            <h2>Bienvenido usuario adminsitrador</h2>
        </div>
        <div class="contenedor"><!--LAS CARDS-->
            <a href="Usuario.php" class="card"><!--INICIO PRIMERA CARD-->
            <div class="image"><span class="text"></span></div>
            <span class="title">Gestión de Usuarios</span>
            </a><!--FIN PRIMERA CARD-->
            <a href="Documento.php"class="card section2" ><!--INICIO SEGUNDA CARD-->
            <div class="image image2"><span class="text"></span></div>
            <span class="title">Gestión de documentos</span>    
            </a><!--FIN SEGUNDA CARD-->
            <a href="Citas.php" class="card"><!--INICIO TERCERA CARD-->
            <div class="image image3"><span class="text"></span></div>
            <span class="title">Gestión de Citas</span>
            </a><!--FIN TERCERA CARD-->
            <a href="Datos_Informacion.php"class="card"><!--INICIO CUARTA CARD-->
            <div class="image image4"><span class="text"></span></div>
            <span class="title">Gestión de datos</span>
            </a><!--FIN CUARTA CARD-->
            <a href="Topico.php" class="card"><!--INICIO QUINTA CARD-->
            <div class="image image5"><span class="text"></span></div>
            <span class="title">Gestión de Tópicos</span>
            </a><!--FIN QUINTA CARD-->
            <a href="Encuestas.php" class="card"><!--INICIO SEXTA CARD-->
            <div class="image image6"><span class="text"></span></div>
            <span class="title">Gestión de Encuestas</span>
            </a><!--FIN SEXTA CARD-->
            <a href="Reportes.php" class="card"><!--INICIO SEPTIMA CARD-->
            <div class="image image7"><span class="text"></span></div>
            <span class="title">Reportes</span>
            </a><!--FIN SEPTIMA CARD-->
            <a href="SQL_Admin.php" class="card"><!--INICIO OCTAVA CARD-->
            <div class="image image8"><span class="text"></span></div>
            <span class="title">Respaldo y restauración BD</span>
            </a><!--FIN OCTAVA CARD-->
        </div>
    </body> 
</html>