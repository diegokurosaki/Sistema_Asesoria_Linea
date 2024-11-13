<?php include(__DIR__ . '/../../../Modelo/Loguearse2.php'); ?>

<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include("../../../Modelo/Conexion.php");

$fecha_inicio = $_POST['Fecha_Inicio'];
$fecha_fin = $_POST['Fecha_Fin'];

// Obtener la instancia de conexión a la base de datos
$conexion = (new Conectar())->conexion();

// Consultar la base de datos para obtener los datos de tópicos
$sql = "SELECT 
            MONTH(Fch_Cita) AS Mes, 
            COUNT(*) AS Total_Topicos
        FROM 
            Citas
        WHERE 
            Fch_Cita BETWEEN ? AND ?
        GROUP BY 
            MONTH(Fch_Cita)
        ORDER BY 
            MONTH(Fch_Cita)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si la consulta fue exitosa
if (!$resultado) {
    // En caso de error, mostrar el mensaje de error y finalizar la ejecución
    die("Error en la consulta: " . $conexion->error);
}

// Crear un array para almacenar los datos del gráfico
$data = array();

// Agregar la cabecera al array
$data[] = ['Mes', 'Total'];

// Crear un array con los nombres de los meses en español
$meses = [
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
];

// Agregar los datos de la consulta al array
while ($fila = $resultado->fetch_assoc()) {
    $data[] = [$meses[(int)$fila['Mes']], (int)$fila['Total_Topicos']];
}

// Convertir el array a formato JSON
$jsonData = json_encode($data);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reportes Gráficos</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" integrity="sha384-RxqHG2ilm4r6aFRpGmBbGTjsqwfqHOKy1ArsMhHusnRO47jcGqpIQqlQK/kmGy9R" crossorigin="anonymous"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu hoja de estilos personalizada -->
    <link href="../../../css/boton.css" rel="stylesheet">
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
    // Esperar a que el documento esté listo
    document.addEventListener("DOMContentLoaded", function() {
        // Cargar la biblioteca Google Charts con el paquete "corechart"
        google.charts.load("current", { packages: ["corechart"] });
        
        // Configurar la función de retorno cuando la biblioteca esté cargada
        google.charts.setOnLoadCallback(drawChart);

        // Función para dibujar el gráfico
        function drawChart() {
            // Convertir los datos PHP (formato JSON) en un objeto DataTable de Google Charts
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>);

            // Configurar las opciones del gráfico
            var options = {
                title: 'Total Tópicos por Mes',
                is3D: true,
            };

            // Crear una instancia de PieChart y asignarla al elemento con el ID 'grafico'
            var chart = new google.visualization.PieChart(document.getElementById('grafico'));
            
            // Dibujar el gráfico con los datos y opciones configuradas
            chart.draw(data, options);

            // Convertir el gráfico a una URL de datos
            var imgData = chart.getImageURI();

            // Establecer la URL de datos en el campo de entrada oculto con el ID 'variable'
            document.getElementById('variable').value = imgData;
        }
    });
    </script>
</head>
<style>
    body {
        background: #bae0f5;
    }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index_DEV.php">Inicio
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-assembly" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                <path d="M15.5 9.422c.312 .18 .503 .515 .5 .876v3.277c0 .364 -.197 .7 -.515 .877l-3 1.922a1 1 0 0 1 -.97 0l-3 -1.922a1 1 0 0 1 -.515 -.876v-3.278c0 -.364 .197 -.7 .514 -.877l3 -1.79c.311 -.174 .69 -.174 1 0l3 1.79h-.014z" />
            </svg></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?cerrar_sesion=true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M9 12h12l-3 -3" />
                            <path d="M18 15l3 -3" />
                        </svg>Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <h1 class="mt-5 text-center border border-dark">Reportes Gráficos</h1>
    <div class="container mt-5">
        <form method="post" id="hacer_pdf" action="../../../Controlador/Reportes/Reporte_Conteo_Topico.php" enctype="multipart/form-data"> 
            <input type="hidden" name="Fecha_Inicio" id="Fecha_Inicio" value="<?php echo $fecha_inicio ?>">
            <input type="hidden" name="Fecha_Fin" id="Fecha_Fin" value="<?php echo $fecha_fin ?>">
            <input type="hidden" name="variable" id="variable" >
            <div id="grafico" style="width: 100%; height: 500px;"></div>
            <center>
                <button type="submit" class="btn-custom">
                    <span class="bgContainer"><span>Generar PDF</span></span>
                    <span class="arrowContainer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-type-pdf" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M5 12v-7a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                            <path d="M17 18h2" />
                            <path d="M20 15h-3v6" />
                            <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                        </svg>
                    </span>
                </button>
                <a href="../Reportes.php" class="btn btn-warning mt-5 mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-refund" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                        <path d="M15 14v-2a2 2 0 0 0 -2 -2h-4l2 -2m0 4l-2 -2" />
                    </svg>REGRESAR</a>
            </center>
        </form>
    </div>
</div>

<footer class="bg-dark text-white text-center p-3 mt-4">
    <p>&copy; 2023 Tu Sitio. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>