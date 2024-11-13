<?php include('head.php'); ?>

<?php
include('../../../Modelo/Conexion.php');

// Verifica si la variable $_GET['id'] está definida y no es nula
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID_Topico = $_GET['id'];
    
    // Crear la conexión
    $conexion = (new Conectar())->conexion();

    $consulta = $conexion->prepare("SELECT *
                            FROM 
                                Topicos T
                            INNER JOIN 
                                Carrera C on T.IdCarre = C.Id_Carrera
                            INNER JOIN 
                                Cuatrimestre C2 on T.IdCuatri = C2.Id_Cuatrimestre
                            INNER JOIN 
                                Materias M on T.IdMateri = M.ID_Materia
                            INNER JOIN 
                                Docente D on T.IdDocent = D.ID_Usuario_D
                            INNER JOIN 
                                Administrador A on T.ID_Administrador_Autorizo = A.ID_Usuario_A
                WHERE 
                    T.ID_Topico = ?");

    $consulta->bind_param("i", $ID_Topico);
    $consulta->execute();
    $resultado = $consulta->get_result();

    // Verifica si se encontraron resultados
    if ($row = $resultado->fetch_assoc()) {
        // Ahora, $row contiene la información del documento que puedes usar en el formulario
    } else {
        // No se encontró ningún documento con la ID proporcionada
        echo "No se encontró ningún documento con la ID proporcionada.";
        exit;
    }

    // Cierra la consulta y libera recursos
    $consulta->close();
} else {
    // Maneja el caso en que la variable $_GET['id'] no está definida o está vacía
    echo "ID de documento no especificado.";
    exit;
}
?>

<div class="container mt-5">
        <h2>Formulario Topico</h2>
        <form action="../../../Controlador/ADMIN/UPDATE/Funcion_Update_Topico.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?php echo $ID_Topico; ?>">
            <div class="form-group">
                <label for="nombre_usuario_e">Nombre: </label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo $row['Nombre']; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Tema: </label>
                <textarea class="form-control" name="Tema" id="Tema"><?php echo $row['Temas']; ?></textarea>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_usuario_e">Clave: </label>
                <input type="text" class="form-control" id="Clave" name="Clave" value="<?php echo $row['Clave']; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Clave.
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Carrera:</label>
                <select class="form-select" id="IDCarrera" name="IDCarrera" required>
                    <option value="" selected disabled>-- Seleccionar Carrera --</option>
                        <?php
                            $busqueda_Carrera = $conexion->query("SELECT Id_Carrera, Nombre_Carrera FROM Carrera");
                            while($resultado_Carrera = $busqueda_Carrera->fetch_assoc()){
                                $selected = ($row['IdCarre'] == $resultado_Carrera['Id_Carrera']) ? 'selected' : ''; 
                                echo "<option value='".$resultado_Carrera['Id_Carrera']."' $selected>".$resultado_Carrera['Nombre_Carrera']."</option>";
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
                    <option value="" selected disabled>-- Seleccionar Cuatrimestre --</option>
                        <?php
                            $busqueda_Cuatrimestre = $conexion->query("SELECT Id_Cuatrimestre, Nombre_Cuatrimestre FROM Cuatrimestre");
                            while($resultado_Cuatrimestre = $busqueda_Cuatrimestre->fetch_assoc()){
                                $selected = ($row['IdCuatri'] == $resultado_Cuatrimestre['Id_Cuatrimestre']) ? 'selected' : ''; 
                                echo "<option value='".$resultado_Cuatrimestre['Id_Cuatrimestre']."' $selected>".$resultado_Cuatrimestre['Nombre_Cuatrimestre']."</option>";
                            }
                        ?>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Materia:</label>
                <select class="form-select" id="IDMateria" name="IDMateria" required>
                    <option value="" selected disabled>-- Seleccionar Carrera --</option>
                        <?php
                            $busqueda_Materia = $conexion->query("SELECT ID_Materia, Nombre_Materia FROM Materias");
                            while($resultado_Materia = $busqueda_Materia->fetch_assoc()){
                                $selected = ($row['IdMateri'] == $resultado_Materia['ID_Materia']) ? 'selected' : ''; 
                                echo "<option value='".$resultado_Materia['ID_Materia']."' $selected>".$resultado_Materia['Nombre_Materia']."</option>";
                            }
                        ?>     
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una opción.
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Docente:</label>
                <select class="form-select" id="IDDocente" name="IDDocente" required>
                    <option value="" selected disabled>-- Seleccionar Carrera --</option>
                        <?php
                            $busqueda_Docente = $conexion->query("SELECT ID_Usuario_D, Nombre_Usuario_D, Apellido_Paterno_D, Apellido_Materno_D FROM Docente");
                            while($resultado_Docente = $busqueda_Docente->fetch_assoc()){
                                $selected = ($row['IdDocent'] == $resultado_Docente['ID_Usuario_D']) ? 'selected' : ''; 
                                echo "<option value='".$resultado_Docente['ID_Usuario_D']."' $selected>".$resultado_Docente['Nombre_Usuario_D']." ".$resultado_Docente['Apellido_Paterno_D']." ".$resultado_Docente['Apellido_Materno_D']."</option>";
                            }
                        ?>  
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