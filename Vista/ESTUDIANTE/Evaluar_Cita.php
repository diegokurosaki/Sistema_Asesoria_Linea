<?php include('head.php'); ?>

<?php
session_start();
// Incluye la conexión a la base de datos y la sesión
include('../../Modelo/Conexion.php');

// Esta variable almacena el correo del usuario
$usuario = $_SESSION['usuario']; 

// Establecer la conexión a la base de datos
$conexion = (new Conectar())->conexion();

// Obtener las citas relacionadas con el usuario
$sqlCitas = "SELECT 
                c.ID_Cita, c.Titulo, c.Fch_Cita, c.Hora_Cita, c.Link, e.ID_Evaluacion_Cita 
             FROM 
                Citas c 
             LEFT JOIN 
                Evaluacion_Citas e ON c.ID_Cita = e.ID_Citas
             INNER JOIN 
                estudiante es ON c.ID_Estudiante_Citado = es.ID_Usuario_E
             WHERE 
                es.Correo_electronico_E = '$usuario'";
                
$resultadoCitas = $conexion->query($sqlCitas);
?>

<h2 class="mb-4">Citas Programadas</h2>
    <div class="row">
        <?php
        if ($resultadoCitas->num_rows > 0) {
            // Mostrar cada cita en una tarjeta
            while ($cita = $resultadoCitas->fetch_assoc()) {
                $evaluada = !is_null($cita['ID_Evaluacion_Cita']); // Verificar si la cita ya fue evaluada
                ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title"><?php echo htmlspecialchars($cita['Titulo']); ?></h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($cita['Fch_Cita']); ?></p>
                            <p><strong>Hora:</strong> <?php echo htmlspecialchars($cita['Hora_Cita']); ?></p>
                            <p><strong>Enlace:</strong> <a href="<?php echo htmlspecialchars($cita['Link']); ?>" target="_blank">Ver Cita</a></p>
                            <?php if ($evaluada): ?>
                                <p class="text-success"><strong>Evaluada</strong></p>
                            <?php else: ?>
                                <!-- Botón para evaluar la cita, visible si no ha sido evaluada -->
                                <button class="btn btn-success evaluar-cita" data-id-cita="<?php echo $cita['ID_Cita']; ?>" data-bs-toggle="modal" data-bs-target="#evaluacionModal">Evaluar Cita</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No hay citas programadas.</p>";
        }
        ?>
    </div>
</div>

<!-- Modal para Evaluar la Cita -->
<div class="modal fade" id="evaluacionModal" tabindex="-1" aria-labelledby="evaluacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evaluacionModalLabel">Evaluar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEvaluacion">
                    <input type="hidden" id="idCita" name="idCita">
                    <div class='mb-3'>
                        <label for='calificacionCita' class='form-label'>Calificación (1 a 5):</label>
                        <select class='form-select' id='calificacionCita' name='calificacionCita' required>
                            <option value=''>Seleccionar</option>
                            <option value='1'>1 - Muy Malo</option>
                            <option value='2'>2 - Malo</option>
                            <option value='3'>3 - Neutral</option>
                            <option value='4'>4 - Bueno</option>
                            <option value='5'>5 - Excelente</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comentarios" class="form-label">Comentarios:</label>
                        <textarea class="form-control" id="comentarios" name="comentarios" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Evaluación</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>