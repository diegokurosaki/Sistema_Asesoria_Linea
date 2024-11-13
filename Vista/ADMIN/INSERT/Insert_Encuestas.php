<?php include('head.php'); ?>

<div class="container mt-5">
    <h2>Formulario Encuesta</h2>
    <form action="../../../Controlador/ADMIN/INSERT/Funcion_Insert_Encuesta.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="mb-3">
            <label for="ID_Topico" class="form-label">Tópico:</label>
            <select class="form-select" id="ID_Topico" name="ID_Topico" required>
                <option value="" selected disabled>-- Seleccionar Tópico --</option>
                <?php
                    // Incluye el archivo de conexión a la base de datos
                    include('../../../Modelo/Conexion.php');
                    // Establece la conexión a la base de datos
                    $conexion = (new Conectar())->conexion();

                    $busqueda = $conexion->query("SELECT 
                                                    T.ID_Topico, T.Nombre 
                                                 FROM 
                                                    Topicos T
                                                 LEFT JOIN 
                                                    Encuesta E ON T.ID_Topico = E.ID_Topicos
                                                 WHERE 
                                                    E.ID_Topicos IS NULL");

                    while($resultado = $busqueda->fetch_assoc()){
                        echo "<option value='".$resultado['ID_Topico']."'>".$resultado['Nombre']."</option>";
                    }
                ?>
            </select>
            <div class="invalid-feedback">
                Por favor, selecciona una opción.
            </div>
        </div>
        <div class="mb-3">
            <label for="pregunta">Pregunta: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="pregunta">
                <button class="btn btn-outline-secondary" type="button" id="addPregunta">Agregar</button>
                    <div class="invalid-feedback">
                        Por favor, ingresa tu Nombre.
                    </div>
            </div>
        </div>
        <div class="mb-3">
                <table class="table table-bordered" id="preguntaTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pregunta</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
        <input type="hidden" id="DatosTablaPregunta" name="DatosTablaPregunta">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Encuestas.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>