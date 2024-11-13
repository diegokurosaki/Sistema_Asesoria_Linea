<?php include('head.php'); ?>

<div class="container mt-5">
    <h2>Evaluar Encuesta</h2>
    <form id="evaluacionForm" action="../../Controlador/Estudiante/INSERT/Funcion_Insert_Evaluacion_Encuesta.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="mb-3">
            <label for="ID_Topico" class="form-label">Tópico:</label>
            <select class="form-select" id="ID_Topico" name="ID_Topico" required onchange="cargarPreguntas()">
                <option value="" selected disabled>-- Seleccionar Tópico --</option>
                <?php
                    // Incluye el archivo de conexión a la base de datos
                    include('../../Modelo/Conexion.php');
                    $conexion = (new Conectar())->conexion();

                    $usuario = $_SESSION['usuario'];

                    // Consulta para obtener los tópicos asociados al estudiante que no haya contestado
                    $query = "SELECT 
                            ID_Topico, Nombre 
                        FROM 
                            Topicos";
                    
                    $busqueda = $conexion->query($query);
                    while ($resultado = $busqueda->fetch_assoc()) {
                        echo "<option value='".$resultado['ID_Topico']."'>".$resultado['Nombre']."</option>";
                    }
                ?>
            </select>
            <div class="invalid-feedback">
                Por favor, selecciona una opción.
            </div>
        </div>

        <!-- Sección donde se mostrará la tabla con las preguntas -->
        <div class="mb-3">
            <table class="table table-bordered" id="evaluacionTable">
                <thead>
                    <tr>
                        <th>Pregunta</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="preguntasTableBody">
                    <!-- Preguntas y opciones se cargarán aquí dinámicamente con JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Campo oculto para almacenar las respuestas -->
        <input type="hidden" id="DatosTablaPregunta" name="DatosTablaPregunta">
        <button type="button" class="btn btn-primary" onclick="enviarFormulario()">Enviar</button>
        <a class="btn btn-warning" href="Principal.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>