<?php include('head.php'); ?>

<div class="container mt-5">
        <h2>Formulario Tópico</h2>
        <form action="../../../Controlador/ADMIN/INSERT/Funcion_Insert_Topico.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre_usuario_e">Nombre: </label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Tema: </label>
                <textarea class="form-control" name="Tema" id="Tema" required></textarea>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_usuario_e">Clave: </label>
                <input type="text" class="form-control" id="Clave" name="Clave" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Clave.
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Carrera:</label>
                <select class="form-select" id="IDCarrera" name="IDCarrera" required>
                    <option value="" selected disabled>-- Seleccionar Carrera --</option>
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
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Cuatrimestre:</label>
                <select class="form-select" id="IDCuatrimestre" name="IDCuatrimestre" required>
                    <option value="" selected disabled>-- Seleccionar Carrera --</option>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Materia:</label>
                <select class="form-select" id="IDMateria" name="IDMateria" required>
                    <option value="" selected disabled>-- Seleccionar Carrera --</option>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Docente:</label>
                <select class="form-select" id="IDDocente" name="IDDocente" required>
                    <option value="" selected disabled>-- Seleccionar Carrera --</option>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Topico.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>