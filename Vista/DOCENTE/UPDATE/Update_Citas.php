<?php include('head.php'); ?>

<?php
include('../../../Modelo/Conexion.php');

// Verifica si la variable $_GET['id'] está definida y no es nula
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_citas = $_GET['id'];
    
    // Crear la conexión
    $conexion = (new Conectar())->conexion();

    $consulta = $conexion->prepare("SELECT *
                FROM
                    Citas C
                INNER JOIN 
                    Estudiante E ON C.ID_Estudiante_Citado = E.ID_Usuario_E
                INNER JOIN 
                    Topicos T ON C.ID_Topicos = T.ID_Topico
                WHERE 
                    C.ID_Cita = ?");

    $consulta->bind_param("i", $id_citas);
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
        <h2>Formulario Citas</h2>
        <form action="../../../Controlador/DOCENTE/UPDATE/Funcion_Update_Citas.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id_citas; ?>">
            <div class="form-group">
                <label for="nombre_usuario_e">Titulo: </label>
                <input type="text" class="form-control" id="Titulo" name="Titulo" value="<?php echo htmlspecialchars($row['Titulo']); ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu titulo.
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_usuario_e">Fecha: </label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo htmlspecialchars($row['Fch_Cita']); ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu fecha.
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_usuario_e">Hora: </label>
                <input type="time" class="form-control" id="hora" name="hora" value="<?php echo htmlspecialchars($row['Hora_Cita']); ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu hora.
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_usuario_e">Link: </label>
                <input type="text" class="form-control" id="Link" name="Link" value="<?php echo htmlspecialchars($row['Link']); ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu link.
                </div>
            </div>           
            <div class="mb-3">
                <label for="ID_Carrera" class="form-label">Topico:</label>
                <select class="form-select" id="ID_Topico" name="ID_Topico" required>
                    <option value="" selected disabled>-- Seleccionar Topico --</option>
                    <?php
                        $busqueda_Topico = $conexion->query("SELECT ID_Topico, Nombre FROM Topicos");
                        while($resultado_Topico = $busqueda_Topico->fetch_assoc()){
                            $selected = ($row['ID_Topicos'] == $resultado_Topico['ID_Topico']) ? 'selected' : '';
                            echo "<option value='".$resultado_Topico['ID_Topico']."' $selected>".$resultado_Topico['Nombre']."</option>";
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
                            $selecteds = ($row['ID_Estudiante_Citado'] == $resultado_Estudiante['ID_Usuario_E']) ? 'selected' : '';
                            echo "<option value='".$resultado_Estudiante['ID_Usuario_E']."' $selecteds>".$resultado_Estudiante['Nombre_Usuario_E']."</option>";
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