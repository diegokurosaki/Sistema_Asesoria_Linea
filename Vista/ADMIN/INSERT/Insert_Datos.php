<?php include('head.php'); ?>

<div class="container mt-5">
        <h2>Formulario a Calificar Usuario</h2>
        <form action="../../../Controlador/ADMIN/INSERT/Funcion_Insert_Datos.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre_usuario_e">Carrera: </label>
                <select class="form-select" id="IdCarrera">
                    <option value="" selected>-- Seleccionar Carrera --</option>
                    <?php
                        // Incluye el archivo de conexión a la base de datos
                        include('../../../Modelo/Conexion.php');
                        // Establece la conexión a la base de datos
                        $conexion = (new Conectar())->conexion();

                        $busqueda_Carrera = $conexion->query("SELECT Id_Carrera, Nombre_Carrera FROM Carrera");
                        while($resultado_Carrera = $busqueda_Carrera->fetch_assoc()){
                            echo "<option value='".$resultado_Carrera['Id_Carrera']."'>".$resultado_Carrera['Nombre_Carrera']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Alumnos: </label>
                <select class="form-select" id="IdAlumnos">
                    <option value="" selected>-- Seleccionar Alumnos --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Materia: </label>
                <select class="form-select" id="IdMaterias">
                    <option value="" selected>-- Seleccionar Materia --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Parcial: </label>
                <select class="form-control" id="Registro_parcial">
                    <option value="" selected disabled>-- Salecciona Opción--</option>
                    <option value="P1">P1</option>
                    <option value="P2">P2</option>
                    <option value="EFO">EFO</option>
                </select>
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Calificación: </label>
                <input type="text" class="form-control" id="Calificacion">
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Observaciones: </label>
                <textarea class="form-control" id="Observacion"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Información:</label>
                <table class="table table-bordered" id="materiasTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Alumno</th>
                            <th>Materia</th>
                            <th>Parcial</th>
                            <th>Calificación</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <input type="hidden" id="DatosTablaAlumnos" name="DatosTablaAlumnos">

        <button class="btn btn-success" type="button" id="addMateria">Agregar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Datos_Informacion.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>