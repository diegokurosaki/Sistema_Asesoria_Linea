<?php include('head.php'); ?>

<div class="container mt-5">
        <h2>Formulario Citas</h2>
        <form action="../../../Controlador/ADMIN/INSERT/Funcion_Insert_Citas.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre_usuario_e">Título: </label>
                <input type="text" class="form-control" id="Titulo" name="Titulo" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_usuario_e">Fecha: </label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Clave.
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_usuario_e">Hora: </label>
                <input type="time" class="form-control" id="hora" name="hora" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Clave.
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_usuario_e">Link: </label>
                <input type="text" class="form-control" id="Link" name="Link" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>           
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Tópico:</label>
                <select class="form-select" id="ID_Topico" name="ID_Topico" required>
                    <option value="" selected disabled>-- Seleccionar Topico --</option>
                    <?php
                        // Incluye el archivo de conexión a la base de datos
                        include('../../../Modelo/Conexion.php');
                        // Establece la conexión a la base de datos
                        $conexion = (new Conectar())->conexion();

                        $busqueda_Carrera = $conexion->query("SELECT ID_Topico, Nombre FROM Topicos");
                        while($resultado_Carrera = $busqueda_Carrera->fetch_assoc()){
                            echo "<option value='".$resultado_Carrera['ID_Topico']."'>".$resultado_Carrera['Nombre']."</option>";
                        }
                    ?>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>

            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Estudiante:</label>
                <select class="form-select" id="ID_Estudiante" name="ID_Estudiante" required>
                    <option value="" selected disabled>-- Seleccionar Estudiante --</option>
                    <?php
                        $busqueda_Estudiante = $conexion->query("SELECT ID_Usuario_E, Nombre_Usuario_E FROM Estudiante");
                        while($resultado_Estudiante = $busqueda_Estudiante->fetch_assoc()){
                            echo "<option value='".$resultado_Estudiante['ID_Usuario_E']."'>".$resultado_Estudiante['Nombre_Usuario_E']."</option>";
                        }
                    ?>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Citas.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>