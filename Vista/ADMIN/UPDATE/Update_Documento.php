<?php include('head.php'); ?>

<?php
include('../../../Modelo/Conexion.php');

// Verifica si la variable $_GET['id'] está definida y no es nula
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_documento = $_GET['id'];
    
    // Crear la conexión
    $conexion = (new Conectar())->conexion();

    $consulta = $conexion->prepare("
        SELECT 
            DO.ID_Documento, DO.Titulo, DO.Tema,
            DO.Fch_subida, DO.Ubicacion, DO.ID_Docente_Subio, 
            D.Nombre_Usuario_D, D.Apellido_Paterno_D, D.Apellido_Materno_D
        FROM
            Documentos DO
        INNER JOIN
            Docente D ON D.ID_Usuario_D = DO.ID_Docente_Subio
        WHERE 
            DO.ID_Documento = ?
    ");

    $consulta->bind_param("i", $id_documento);
    $consulta->execute();
    $resultado = $consulta->get_result();

    // Verifica si se encontraron resultados
    if ($row = $resultado->fetch_assoc()) {
        // Ahora, $row contiene la información del documento que puedes usar en el formulario
        $imagen = $row['Ubicacion']; // La ruta del archivo que deseas procesar
        $nombre_archivo = basename($imagen);
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
    <h2>Formulario de Usuario</h2>
    <form action="../../../Controlador/ADMIN/UPDATE/Funcion_Update_Documento.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" id="id_documento" name="id_documento" value="<?php echo htmlspecialchars($id_documento); ?>">
        <div class="form-group">
            <label for="Titulo">Título: </label>
            <input type="text" class="form-control" id="Titulo" name="Titulo" value="<?php echo htmlspecialchars($row['Titulo']); ?>" required>
            <div class="invalid-feedback">
                Por favor, ingresa el título.
            </div>
        </div>
        <div class="form-group">
            <label for="Tema">Tema: </label>
            <input type="text" class="form-control" id="Tema" name="Tema" value="<?php echo htmlspecialchars($row['Tema']); ?>" required>
            <div class="invalid-feedback">
                Por favor, ingresa el tema.
            </div>
        </div>
        <div class="mb-3">
            <label for="ID_Docente" class="form-label">Docente:</label>
            <select class="form-select" id="ID_Docente" name="ID_Docente" required>
                <option value="" disabled>-- Seleccionar Docente --</option>
                <?php
                $busqueda_docente = $conexion->query("SELECT ID_Usuario_D, Nombre_Usuario_D, Apellido_Paterno_D, Apellido_Materno_D FROM Docente");
                while ($resultado_docente = $busqueda_docente->fetch_assoc()) {
                    $selected = ($row['ID_Docente_Subio'] == $resultado_docente['ID_Usuario_D']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($resultado_docente['ID_Usuario_D']) . "' $selected>" . htmlspecialchars($resultado_docente['Nombre_Usuario_D']) . " " . htmlspecialchars($resultado_docente['Apellido_Paterno_D']) . " " . htmlspecialchars($resultado_docente['Apellido_Materno_D']) . "</option>";
                }
                ?>
            </select>
            <div class="invalid-feedback">
                Por favor, selecciona una opción.
            </div>
        </div>
        <div class="form-group">
            <label for="ArchivoActual">Archivo Actual: </label>
            <input type="text" class="form-control" id="ArchivoActual" value="<?php echo htmlspecialchars($nombre_archivo); ?>" disabled>
        </div>
        <div class="form-group">
            <label for="opcion">¿Desea Reemplazar el Archivo Anteriormente Subido?</label>
            <select class="form-control" id="opcion" name="opcion" required>
                <option value="" selected disabled>-- Seleccionar Opción --</option>
                <option value="SI">Sí</option>
                <option value="NO">No</option>
            </select>
            <div class="invalid-feedback">
                Por favor, escoge una opción.
            </div>
        </div>
        <div class="form-group" id="file-upload-section">
            <label for="Archivo">Subir Archivo: </label>
            <input type="file" class="form-control" id="Archivo" name="Archivo">
            <div class="invalid-feedback">
                Por favor, ingresa el archivo.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Documento.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>