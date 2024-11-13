<?php include('head.php'); ?>

<center><div class="table-responsive">
        <h2 class="mb-4">Agendar Citas</h2>
            <!-- Botones -->
            <a class="btn btn-primary" href="INSERT/Insert_Citas.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                </svg>Nuevo</a>
        <!-- Tabla para mostrar los registros -->
        <table class="table table-hover table-striped mt-4" class="table">
            <thead>
                <tr class="table-primary"> 
                    <th scope="col">Nmr.</th>
                    <th scope="col">Título</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Tópico</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Incluye el archivo de conexión a la base de datos
                    include('../../Modelo/Conexion.php');

                    // Establece la conexión a la base de datos
                    $conexion = (new Conectar())->conexion();
                    
                    // Parámetros para la paginación
                    $records_per_page = 10;
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $records_per_page;

                    // Consulta SQL para obtener los datos de la tabla Usuario, Tipo_Usuarios y Centro_Trabajo con paginación
                    $sql = "SELECT
                                C.ID_Cita, C.Titulo, C.Fch_Cita, C.Hora_Cita, T.Nombre,
                                E.Nombre_Usuario_E, E.Apellido_Paterno_E, E.Apellido_Materno_E,
                                RCDA.ID_RegCitDocAlum
                            FROM
                                Citas C
                            INNER JOIN
                                Estudiante E on C.ID_Estudiante_Citado = E.ID_Usuario_E
                            INNER JOIN
                                Topicos T on C.ID_Topicos = T.ID_Topico
                            LEFT JOIN
                                registrar_cita_doc_alumno RCDA on C.ID_Cita = RCDA.IdCitas
                            LIMIT 
                                $offset, $records_per_page;";
                    
                    // Ejecuta la consulta SQL
                    $query = mysqli_query($conexion, $sql);
                    
                    // Total de registros
                    $sql_total = "SELECT * FROM Citas;";
                    $result_total = mysqli_query($conexion, $sql_total);
                    $total_rows = mysqli_fetch_array($result_total)[0];
                    $total_pages = ceil($total_rows / $records_per_page);

                    // Itera sobre los resultados de la consulta y muestra los datos en una tabla HTML
                    while ($row = mysqli_fetch_array($query)) {
                        $evaluada = !is_null($row['ID_RegCitDocAlum']); // Verificar si la cita ya fue evaluada
                        ?>
                        <tr>
                            <td><?php echo $row['ID_Cita']; ?></td>
                            <td><?php echo $row['Titulo']; ?></td>
                            <td><?php echo $row['Fch_Cita']; ?></td>
                            <td><?php echo $row['Hora_Cita']; ?></td>
                            <td><?php echo $row['Nombre_Usuario_E'] . ' ' . $row['Apellido_Paterno_E'] . ' ' . $row['Apellido_Materno_E']; ?></td>
                            <td><?php echo $row['Nombre']; ?></td>
                            <td>
                                <?php if ($evaluada): ?>
                                    <button class="btn btn-success evalua-cita" data-id-cita="<?php echo $row['ID_Cita']; ?>" data-bs-toggle="modal" data-bs-target="#evaluaModal" disabled>Evaluar Cita</button>
                                <?php else: ?>
                                    <!-- Botón para evaluar la cita, visible si no ha sido evaluada -->
                                    <button class="btn btn-success evalua-cita" data-id-cita="<?php echo $row['ID_Cita']; ?>" data-bs-toggle="modal" data-bs-target="#evaluaModal">Evaluar Cita</button>
                                <?php endif; ?>
                            </td>
                            <td><a class="btn btn-warning" href="UPDATE/Update_Citas.php?id=<?php echo $row['ID_Cita']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>Actualizar</a>
                            </td>
                            <td><a class="btn btn-danger" onclick="return eliminar()" href="../../Controlador/ADMIN/DELETE/Funcion_Delete_Citas.php?id=<?php echo $row['ID_Cita']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16zm-9.489 5.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" stroke-width="0" fill="currentColor" />
                                    <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" />
                                </svg>Eliminar</a>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>

<!-- Modal para Evaluar la Cita -->
<div class="modal fade" id="evaluaModal" tabindex="-1" aria-labelledby="evaluaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evaluaModalLabel">Evaluar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEvalua">
                    <input type="hidden" id="idCita" name="idCita">
                    <div class='mb-3'>
                        <label for='Respuesta' class='form-label'>¿Asistio a la cita?</label>
                        <select class='form-select' id='Respuesta' name='Respuesta' required>
                            <option value='' disabled>Seleccionar</option>
                            <option value='1'>SI</option>
                            <option value='0'>NO</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Observacion" class="form-label">Comentarios:</label>
                        <textarea class="form-control" id="Observacion" name="Observacion" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
    </div>  

<?php include('footer.php'); ?>