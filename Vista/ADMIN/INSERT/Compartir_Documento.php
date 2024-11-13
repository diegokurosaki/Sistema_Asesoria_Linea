<?php include('head.php'); ?>

<?php
include('../../../Modelo/Conexion.php');

// Verifica si la variable $_GET['id'] está definida y no es nula
if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['IdD']) && !empty($_GET['IdD'])) {
    
    $id_documento = $_GET['id'];
    $ID = $_GET['IdD'];

    // Crear la conexión
    $conexion = (new Conectar())->conexion();

    // Preparar la consulta
    $consulta = $conexion->prepare("SELECT 
                T.ID_Topico, T.Nombre, T.Clave, T.IdCarre 
                FROM 
                    Topicos T 
                WHERE 
                    T.IdDocent = ?;");

    $consulta->bind_param("i", $ID);
    $consulta->execute();
    $resultado = $consulta->get_result();

    // Verifica si se encontraron resultados
    if ($resultado->num_rows > 0) {
        // Si hay resultados, se muestra el primer registro
        $row = $resultado->fetch_assoc(); // Obtener el primer registro
    } else {
        // No se encontró ningún documento con la ID proporcionada
        echo "No se encontró ningún documento con la ID proporcionada.";
        exit;
    }

    // Cierra la consulta
    $consulta->close();
} else {
    // Maneja el caso en que la variable $_GET['id'] no está definida o está vacía
    echo "ID de documento no especificado.";
    exit;
}
?>

<div class="container mt-5">
    <h2>Compartir Recursos</h2>
    <form action="../../../Controlador/ADMIN/INSERT/Funcion_Compartir_Documento.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        
        <input type="hidden" id="idDocent" name="idDocent" value="<?php echo htmlspecialchars($ID); ?>">
        <input type="hidden" id="idDocument" name="idDocument" value="<?php echo htmlspecialchars($id_documento); ?>">
        <input type="hidden" id="idCarrer" name="idCarrer" value="<?php echo htmlspecialchars($row['IdCarre']); ?>">

        <div class="form-group">
            <label for="nombre_usuario_e">Topico: </label>
                <select class="form-select" id="idTopic" name="idTopic">
                    <option value="" selected>-- Seleccionar Topico --</option>
                    <?php
                        // Rewind the result set pointer to ensure it can be re-used
                        $resultado->data_seek(0); 
                        while($row = $resultado->fetch_assoc()){
                            echo "<option value='".$row['ID_Topico']."'>".$row['Nombre']. ", Clave: " .$row['Clave']."</option>";
                        }
                    ?>
                </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Documento.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>