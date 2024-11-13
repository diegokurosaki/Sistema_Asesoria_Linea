<?php include('head.php'); ?>

<?php
// Inicia la sesión PHP y obtiene el usuario de la sesión
session_start();

// Incluye la conexión a la base de datos
include('../../Modelo/Conexion.php');

// Obtener el usuario actual desde la sesión
$usuario = $_SESSION['usuario'];

// Establece la conexión a la base de datos
$conexion = (new Conectar())->conexion();

// Consulta para obtener los documentos compartidos con el estudiante
$query = "
    SELECT 
        D.ID_Documento, 
        D.Titulo, 
        D.Tema, 
        D.Fch_subida, 
        D.Ubicacion, 
        C.ID_Compartir_Recurso,
        (SELECT COUNT(*) FROM Evaluacion_Material EM WHERE EM.ID_Compartir_Recursos = C.ID_Compartir_Recurso) AS Evaluado
    FROM 
        Documentos D
    INNER JOIN 
        Compartir_Recursos C ON D.ID_Documento = C.ID_Documento_Com
    INNER JOIN 
        Estudiante E ON C.ID_Estudiante_Com = E.ID_Usuario_E
    WHERE 
        E.Correo_electronico_E = '$usuario'
";

// Ejecutar la consulta y obtener los resultados
$resultado = $conexion->query($query);
?>

<div class="container mt-5">
    <h2>Documentos Compartidos</h2>
    <div class="row">
        <?php
        // Generar cards para cada documento compartido
        while ($documento = $resultado->fetch_assoc()) {
            $idDocumento = $documento['ID_Documento'];
            $titulo = $documento['Titulo'];
            $tema = $documento['Tema'];
            $fchSubida = $documento['Fch_subida'];
            $ubicacion = $documento['Ubicacion']; // Incluye ruta completa y nombre del archivo
            $idCompartirRecurso = $documento['ID_Compartir_Recurso'];
            $evaluado = $documento['Evaluado'];

            $ruta = "../../" . $ubicacion;
            // Asegúrate de que la ruta del archivo sea accesible en el navegador (relativa a la carpeta pública del servidor)
            echo "
            <div class='col-md-4'>
                <div class='card mb-4 shadow-sm'>
                    <div class='card-body'>
                        <h5 class='card-title'>$titulo</h5>
                        <p class='card-text'>Tema: $tema</p>
                        <p class='card-text'>Fecha de subida: $fchSubida</p>

                        <!-- Botón para descargar el archivo -->
                        <a class='btn btn-primary' href='$ruta' download>Descargar</a>

                        <!-- Botón para ver el archivo en un modal -->
                        <button class='btn btn-info' data-bs-toggle='modal' data-bs-target='#verDocumento$idDocumento'>Ver</button>";

                        // Verifica si ya fue evaluado
                        if ($evaluado > 0) {
                            echo "<button class='btn btn-success' disabled>Evaluado</button>";
                        } else {
                            echo "<button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#evaluarDocumento$idDocumento'>Evaluar</button>";
                        }

                        echo "
                    </div>
                </div>
            </div>

            <!-- Modal para Ver Documento -->
            <div class='modal fade' id='verDocumento$idDocumento' tabindex='-1' aria-labelledby='verDocumentoLabel$idDocumento' aria-hidden='true'>
                <div class='modal-dialog modal-lg'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='verDocumentoLabel$idDocumento'>$titulo</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <!-- Mostrar el documento dentro de un iframe -->
                            <iframe src='$ruta' width='100%' height='500px'></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Evaluar Documento -->
            <div class='modal fade' id='evaluarDocumento$idDocumento' tabindex='-1' aria-labelledby='evaluarDocumentoLabel$idDocumento' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='evaluarDocumentoLabel$idDocumento'>Evaluar $titulo</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <form id='formEvaluacion$idDocumento' method='POST'>
                                <div class='mb-3'>
                                    <label for='calificacion$idDocumento' class='form-label'>Calificación (1 a 5):</label>
                                    <select class='form-select' id='calificacion$idDocumento' name='calificacion' required>
                                        <option value=''>Seleccionar</option>
                                        <option value='1'>1 - Muy Malo</option>
                                        <option value='2'>2 - Malo</option>
                                        <option value='3'>3 - Neutral</option>
                                        <option value='4'>4 - Bueno</option>
                                        <option value='5'>5 - Excelente</option>
                                    </select>
                                </div>
                                <div class='mb-3'>
                                    <label for='comentarios$idDocumento' class='form-label'>Comentarios:</label>
                                    <textarea class='form-control' id='comentarios$idDocumento' name='comentarios' rows='3' required></textarea>
                                </div>
                                <input type='hidden' name='id_compartir_recurso' value='$idCompartirRecurso'>
                                <button type='button' class='btn btn-primary' onclick='enviarEvaluacion($idDocumento)'>Enviar Evaluación</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
    </div>
</div>

<?php include('footer.php'); ?>