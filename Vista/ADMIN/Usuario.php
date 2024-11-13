<?php include('head.php'); ?>

<center><div class="table-responsive">
    <h2 class="mb-4">Usuarios Registrados</h2>
    <!-- Botones -->
    <a class="btn btn-primary" href="INSERT/Insert_Usuario.php">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
            <path d="M16 19h6" />
            <path d="M19 16v6" />
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
        </svg>Nuevo</a>
    <br>
    <br>
    <div class="btn-group mb-4" role="group">
        <a class="btn btn-light" href="?tipo_usuario=Todos">Todos</a>
        <a class="btn btn-secondary" href="?tipo_usuario=Estudiante">Estudiante</a>
        <a class="btn btn-success" href="?tipo_usuario=Docente">Docente</a>
        <a class="btn btn-info" href="?tipo_usuario=Administrador">Administrador</a>
    </div>
    <!-- Tabla para mostrar los registros -->
    <table class="table table-hover table-striped mt-4">
        <thead>
            <tr class="table-primary"> 
                <th scope="col">Nmr.</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Rol</th>
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

                // Obtener el tipo de usuario seleccionado
                $tipo_usuario = isset($_GET['tipo_usuario']) ? $_GET['tipo_usuario'] : 'Todos';

                // Construir la consulta SQL según el tipo de usuario seleccionado
                if ($tipo_usuario == 'Estudiante') {
                    $sql = "SELECT ID_Usuario_E AS ID_Usuario, 
                                Nombre_Usuario_E AS Nombre, 
                                Apellido_Paterno_E AS Apellido_Paterno, 
                                Apellido_Materno_E AS Apellido_Materno, 
                                Correo_electronico_E AS Correo_Electronico, 
                                'Estudiante' AS Rol FROM Estudiante 
                            LIMIT $offset, $records_per_page";
                    $sql_total = "SELECT COUNT(*) FROM Estudiante";
                } elseif ($tipo_usuario == 'Docente') {
                    $sql = "SELECT ID_Usuario_D AS ID_Usuario, 
                                Nombre_Usuario_D AS Nombre, 
                                Apellido_Paterno_D AS Apellido_Paterno, 
                                Apellido_Materno_D AS Apellido_Materno, 
                                Correo_electronico_D AS Correo_Electronico, 
                                'Docente' AS Rol FROM Docente 
                            LIMIT $offset, $records_per_page";
                    $sql_total = "SELECT COUNT(*) FROM Docente";
                } elseif ($tipo_usuario == 'Administrador') {
                    $sql = "SELECT ID_Usuario_A AS ID_Usuario, 
                                Nombre_Usuario_A AS Nombre, 
                                Apellido_Paterno_A AS Apellido_Paterno, 
                                Apellido_Materno_A AS Apellido_Materno, 
                                Correo_electronico_A AS Correo_Electronico, 
                                'Administrador' AS Rol FROM Administrador 
                            LIMIT $offset, $records_per_page";
                    $sql_total = "SELECT COUNT(*) FROM Administrador";
                } else {
                    // Consulta para todos los usuarios (Estudiante, Docente, Administrador)
                    $sql = "
                        SELECT ID_Usuario_E AS ID_Usuario, Nombre_Usuario_E AS Nombre, Apellido_Paterno_E AS Apellido_Paterno, Apellido_Materno_E AS Apellido_Materno, Correo_electronico_E AS Correo_Electronico, 'Estudiante' AS Rol FROM Estudiante
                        UNION ALL
                        SELECT ID_Usuario_D AS ID_Usuario, Nombre_Usuario_D AS Nombre, Apellido_Paterno_D AS Apellido_Paterno, Apellido_Materno_D AS Apellido_Materno, Correo_electronico_D AS Correo_Electronico, 'Docente' AS Rol FROM Docente
                        UNION ALL
                        SELECT ID_Usuario_A AS ID_Usuario, Nombre_Usuario_A AS Nombre, Apellido_Paterno_A AS Apellido_Paterno, Apellido_Materno_A AS Apellido_Materno, Correo_electronico_A AS Correo_Electronico, 'Administrador' AS Rol FROM Administrador
                        LIMIT $offset, $records_per_page
                    ";
                    $sql_total = "
                        SELECT COUNT(*) FROM (
                            SELECT ID_Usuario_E FROM Estudiante
                            UNION ALL
                            SELECT ID_Usuario_D FROM Docente
                            UNION ALL
                            SELECT ID_Usuario_A FROM Administrador
                        ) AS TotalUsuarios
                    ";
                }

                // Ejecuta la consulta SQL
                $query = mysqli_query($conexion, $sql);

                // Total de registros
                $result_total = mysqli_query($conexion, $sql_total);
                $total_rows = mysqli_fetch_array($result_total)[0];
                $total_pages = ceil($total_rows / $records_per_page);

                // Itera sobre los resultados de la consulta y muestra los datos en una tabla HTML
                while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['ID_Usuario']; ?></td>
                        <td><?php echo $row['Nombre']; ?></td>
                        <td><?php echo $row['Apellido_Paterno']; ?></td>
                        <td><?php echo $row['Apellido_Materno']; ?></td>
                        <td><?php echo $row['Correo_Electronico']; ?></td>
                        <td><?php echo $row['Rol']; ?></td>
                        <td><a class="btn btn-warning" href="UPDATE/Update_Usuario_<?php echo htmlspecialchars($row['Rol'], ENT_QUOTES, 'UTF-8'); ?>.php?id=<?php echo urlencode($row['ID_Usuario']); ?>&rol=<?php echo urlencode($row['Rol']); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>Actualizar</a>
                        </td>
                        <td><a class="btn btn-danger" onclick="return eliminar()" href="../../Controlador/ADMIN/DELETE/Funcion_Delete_Usuario.php?id=<?php echo $row['ID_Usuario']; ?>&rol=<?php echo $row['Rol']; ?>">
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
                    <a class="page-link" href="?tipo_usuario=<?php echo $tipo_usuario; ?>&page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?tipo_usuario=<?php echo $tipo_usuario; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?tipo_usuario=<?php echo $tipo_usuario; ?>&page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>  

<?php include('footer.php'); ?>