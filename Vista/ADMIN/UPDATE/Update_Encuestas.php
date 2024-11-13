<?php include('head.php'); ?>

<?php
include('../../../Modelo/Conexion.php');

// Verifica si la variable $_GET['id'] está definida y no es nula
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_encuesta = $_GET['id'];
    
    // Crear la conexión
    $conexion = (new Conectar())->conexion();

    // Primera consulta para obtener información de la encuesta
    $consulta1 = $conexion->prepare("SELECT *
                FROM
                    encuesta E
                INNER JOIN 
                    Topicos T ON E.ID_Topicos = T.ID_Topico
                WHERE 
                    E.ID_Encuesta = ?");
    $consulta1->bind_param("i", $id_encuesta);
    $consulta1->execute();
    $resultado1 = $consulta1->get_result();

    // Verifica si se encontraron resultados
    if ($row = $resultado1->fetch_assoc()) {
        // Segunda consulta para obtener las preguntas de la encuesta
        $consultas = $conexion->prepare("SELECT *
                    FROM
                        encuesta_pregunta EP
                    INNER JOIN 
                        pregunta P ON EP.ID_Preguntas = P.ID_Pregunta
                    WHERE 
                        EP.ID_Encuestas = ?");  // Cambiado de E.ID_Encuesta a EP.ID_Encuestas
        $consultas->bind_param("i", $id_encuesta);
        $consultas->execute();
        $resultados = $consultas->get_result();

        // Verifica si se encontraron preguntas asociadas
        if ($resultados->num_rows > 0) {
            $rows = [];
            while ($data = $resultados->fetch_assoc()) {
                $rows[] = $data;
            }
        } else {
            echo "No se encontró ninguna pregunta asociada a la encuesta.";
            exit;
        }

        // Cierra la consulta y libera recursos
        $consultas->close();
    } else {
        echo "No se encontró ninguna encuesta con la ID proporcionada.";
        exit;
    }

    // Cierra la consulta y libera recursos
    $consulta1->close();
} else {
    echo "ID de encuesta no especificado.";
    exit;
}
?>

<div class="container mt-5">
    <h2>Formulario Encuesta</h2>
    <form action="../../../Controlador/ADMIN/Update/Funcion_Update_Encuesta.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    <input type="hidden" id="id" name="id" value='<?php echo $id_encuesta; ?>'>
        <div class="mb-3">
            <label for="ID_Topico" class="form-label">Tópico:</label>
            <select class="form-select" id="ID_Topico" name="ID_Topico" required>
                <option value="" selected disabled>-- Seleccionar Tópico --</option>
                <?php
                    $busqueda = $conexion->query("SELECT 
                                                    T.ID_Topico, T.Nombre 
                                                 FROM 
                                                    Topicos T
                                                 LEFT JOIN 
                                                    Encuesta E ON T.ID_Topico = E.ID_Topicos");

                    // Itera sobre los tópicos para generar las opciones del select
                    while($resultado = $busqueda->fetch_assoc()){
                        $selected = ($row['ID_Topico'] == $resultado['ID_Topico']) ? 'selected' : ''; // Corregido: comparación correcta
                        echo "<option value='".$resultado['ID_Topico']."' $selected>".$resultado['Nombre']."</option>";
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
                <button class="btn btn-outline-secondary" type="button" id="addPreguntaUpdate">Agregar</button>
                    <div class="invalid-feedback">
                        Por favor, ingresa la pregunta.
                    </div>
            </div>
        </div>
        <div class="mb-3">
            <table class="table table-bordered" id="preguntaTableUpdate">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pregunta</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Itera sobre las preguntas obtenidas y genera filas en la tabla
                        if (!empty($rows)) {
                            foreach ($rows as $pregunt) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($pregunt['ID_Pregunta'], ENT_QUOTES, 'UTF-8') . "</td>
                                        <td>" . htmlspecialchars($pregunt['Nombre_Pregunta'], ENT_QUOTES, 'UTF-8') . "</td>
                                        <td><button type='button' class='btn btn-danger btn-sm removeMateriaUpdate'>Eliminar</button></td>
                                    </tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Campo oculto para enviar las preguntas en formato JSON -->
        <input type="hidden" id="DatosTablaPreguntaUpdate" name="DatosTablaPreguntaUpdate">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Encuestas.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>