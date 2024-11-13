<?php include('head.php'); ?>

<div class="container mt-5">
        <h2>Formulario del Documento</h2>
        <form action="../../../Controlador/DOCENTE/INSERT/Funcion_Insert_Documento.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre_usuario_e">Titulo: </label>
                <input type="text" class="form-control" id="Titulo" name="Titulo" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Tema: </label>
                <input type="text" class="form-control" id="Tema" name="Tema" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Docente:</label>
                <select class="form-select" id="ID_Docente" name="ID_Docente" required>
                    <option value="" selected disabled>-- Seleccionar Carrera --</option>
                    <?php
                        // Incluye el archivo de conexión a la base de datos
                        include('../../../Modelo/Conexion.php');
                        // Establece la conexión a la base de datos
                        $conexion = (new Conectar())->conexion();

                        $busqueda_docente = $conexion->query("SELECT ID_Usuario_D, Nombre_Usuario_D, Apellido_Paterno_D, Apellido_Materno_D FROM Docente");
                        while($resultado_docente = $busqueda_docente->fetch_assoc()){
                            echo "<option value='".$resultado_docente['ID_Usuario_D']."'>".$resultado_docente['Nombre_Usuario_D']." ".$resultado_docente['Apellido_Paterno_D']." ".$resultado_docente['Apellido_Materno_D']."</option>";
                        }
                    ?>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_paterno_e">Subir Archivo: </label>
                <input type="file" class="form-control" id="Archivo" name="Archivo" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Documento.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>