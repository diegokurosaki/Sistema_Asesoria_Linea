<?php include('head.php'); ?>

<center><div class="table-responsive">
        <h2 class="mb-4">Documento Registrados</h2>
            <!-- Botones -->
            <a class="btn btn-primary" href="INSERT/Insert_Documento.php">
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
                    <th scope="col">Tema</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Fecha de Subida</th>
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
                                DO.ID_Documento, DO.Titulo, DO.Tema, DO.Fch_subida, 
                                DO.ID_Docente_Subio, D.Nombre_Usuario_D, D.Apellido_Paterno_D, 
                                D.Apellido_Materno_D, COUNT(CR.ID_Compartir_Recurso) AS TotalCompartido, 
                                COUNT(EM.ID_Evaluacion) AS TotalEvaluado
                            FROM
                                Docente D
                            INNER JOIN
                                Documentos DO ON D.ID_Usuario_D = DO.ID_Docente_Subio
                            LEFT JOIN
                                Compartir_Recursos CR ON CR.ID_Documento_Com = DO.ID_Documento
                            LEFT JOIN
                                Evaluacion_Material EM ON EM.ID_Compartir_Recursos = CR.ID_Compartir_Recurso
                            GROUP BY
                                DO.ID_Documento
                            LIMIT 
                                $offset, $records_per_page;";
                    
                    // Ejecuta la consulta SQL
                    $query = mysqli_query($conexion, $sql);
                    
                    // Total de registros
                    $sql_total = "SELECT * FROM Documentos;";
                    $result_total = mysqli_query($conexion, $sql_total);
                    $total_rows = mysqli_fetch_array($result_total)[0];
                    $total_pages = ceil($total_rows / $records_per_page);

                    // Itera sobre los resultados de la consulta y muestra los datos en una tabla HTML
                    while ($row = mysqli_fetch_array($query)) {
                        $tieneRegistros = $row['TotalCompartido'] || $row['TotalEvaluado'];                        
                        ?>
                        <tr>
                            <td><?php echo $row['ID_Documento']; ?></td>
                            <td><?php echo $row['Titulo']; ?></td>
                            <td><?php echo $row['Tema']; ?></td>
                            <td><?php echo $row['Nombre_Usuario_D'] . ' ' . $row['Apellido_Paterno_D'] . ' ' . $row['Apellido_Materno_D']; ?></td>
                            <td><?php echo $row['Fch_subida']; ?></td>
                            <td><a class="btn btn-warning" href="UPDATE/Update_Documento.php?id=<?php echo $row['ID_Documento']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>Actualizar</a>
                            </td>
                            <td><a class="btn btn-success" href="INSERT/Compartir_Documento.php?id=<?php echo $row['ID_Documento']; ?>&IdD=<?php echo $row['ID_Docente_Subio']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-folder-share" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M13 19h-8a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v4" />
                                    <path d="M16 22l5 -5" />
                                    <path d="M21 21.5v-4.5h-4.5" />
                                </svg>Compartir</a>
                            </td>
                            <td><a class="btn btn-danger <?php echo $tieneRegistros ? 'disabled' : ''; ?>" href="../../Controlador/ADMIN/DELETE/Funcion_Delete_Documento.php?id=<?php echo $row['ID_Documento']; ?>" onclick="return <?php echo $tieneRegistros ? 'false' : 'eliminar()'; ?>">
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