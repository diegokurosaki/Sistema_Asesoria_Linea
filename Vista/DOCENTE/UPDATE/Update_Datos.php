<?php include('head.php'); ?>

<?php
include('../../../Modelo/Conexion.php');

// Verifica si la variable $_GET['id'] está definida y no es nula
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Crear la conexión
    $conexion = (new Conectar())->conexion();

    $consulta = $conexion->prepare("SELECT 
                D.Registro_parcial, D.Calificacion, D.Observacion, 
                D.ID_Estudiant, E.Nombre_Usuario_E, 
                E.Apellido_Paterno_E, E.Apellido_Materno_E, 
                D.ID_Materi, M.Nombre_Materia
            FROM
                Datos D
            INNER JOIN
                Estudiante E ON D.ID_Estudiant = E.ID_Usuario_E
            INNER JOIN
                Materias M on D.ID_Materi = M.ID_Materia
            WHERE
                E.ID_Usuario_E = ?;");

    $consulta->bind_param("i", $id);
    $consulta->execute();
    $resultado = $consulta->get_result();

    $row = [];
    if ($resultado->num_rows > 0) {
        while ($data = $resultado->fetch_assoc()) {
            $row[] = $data;
        }
    } else {
        echo "No se encontró ningún registro con la ID proporcionada.";
        exit;
    }

    $consulta->close();
} else {
    echo "Error: ID no proporcionado.";
    exit;
}
?>

<div class="container mt-5">
    <h2>Formulario a Calificar Usuario</h2>
    <form action="../../../Controlador/DOCENTE/UPDATE/Funcion_Update_Datos.php" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
        
        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
            <label for="Calificacion">Estudiante: </label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row[0]['Nombre_Usuario_E'] . " " . $row[0]['Apellido_Paterno_E'] . " " . $row[0]['Apellido_Materno_E']); ?>" disabled>
        </div>

        <div class="form-group">
            <label for="IdMaterias">Materia: </label>
            <select class="form-select" id="IdMaterias" name="IdMaterias">
                <option value="" selected>-- Seleccionar Materia --</option>
                <?php
                    $busqueda_docente = $conexion->prepare("SELECT M.ID_Materia, M.Nombre_Materia 
                        FROM
                            Estudiante E
                        INNER JOIN
                            Carrera C on E.IdCarrera = C.Id_Carrera
                        INNER JOIN
                            Carre_Cuatri_Mater CCM on C.Id_Carrera = CCM.IdCarreras
                        INNER JOIN
                            Materias M on CCM.IdMaterias = M.ID_Materia
                        WHERE 
                            E.ID_Usuario_E = ?;");
                    
                    $busqueda_docente->bind_param('i', $id);
                    $busqueda_docente->execute();
                    $resultado_docente = $busqueda_docente->get_result();

                    while ($row_docente = $resultado_docente->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row_docente['ID_Materia']) . "'>" . htmlspecialchars($row_docente['Nombre_Materia']) . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Registro_parcial">Parcial: </label>
            <select class="form-select" id="Registro_parcial" name="Registro_parcial">
                <option value="" selected disabled>-- Selecciona Opción --</option>
                <option value="P1">P1</option>
                <option value="P2">P2</option>
                <option value="EFO">EFO</option>
            </select>
        </div>
        <div class="form-group">
            <label for="Calificacion">Calificación: </label>
            <input type="text" class="form-control" id="Calificacion" name="Calificacion">
        </div>
        <div class="form-group">
            <label for="Observacion">Observaciones: </label>
            <textarea class="form-control" id="Observacion" name="Observacion"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Información:</label>
            <table class="table table-bordered" id="materiasTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Materia</th>
                        <th>Parcial</th>
                        <th>Calificación</th>
                        <th>Observaciones</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($row as $materia) {
                        echo "<tr>
                            <td>" . htmlspecialchars($materia['ID_Materi'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>" . htmlspecialchars($materia['Nombre_Materia'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>" . htmlspecialchars($materia['Registro_parcial'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>" . htmlspecialchars($materia['Calificacion'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>" . htmlspecialchars($materia['Observacion'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td><button type='button' class='btn btn-danger btn-sm removeMateria'>Eliminar</button></td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <input type="text" id="DatosTablaUpdateAlumnos" name="DatosTablaUpdateAlumnos">

        <button class="btn btn-success" type="button" id="addMateria">Agregar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Datos_Informacion.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>