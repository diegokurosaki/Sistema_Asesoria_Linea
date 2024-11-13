<?php include('head.php'); ?>

<?php
include('../../../Modelo/Conexion.php');

// Verifica si las variables $_GET['id'] y $_GET['rol'] están definidas y no son nulas
if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['rol']) && !empty($_GET['rol'])) {
    $id_empleado = $_GET['id'];
    $rol = $_GET['rol'];
    
    // Crear la conexión
    $conexion = (new Conectar())->conexion();

    $consulta = $conexion->prepare("SELECT A.Nombre_Usuario_A AS nombre_usuario, 
            A.Apellido_Paterno_A AS apellido_paterno, 
            A.Apellido_Materno_A AS apellido_materno, 
            A.Telefono_A AS telefono, 
            A.Fecha_Nacimiento_A AS fecha_nacimiento, 
            A.Genero_A AS genero, 
            A.Correo_electronico_A AS correo_electronico, 
            A.Contrasena_A AS contrasena
            FROM 
                Administrador A 
            WHERE 
                A.ID_Usuario_A = ?;");

    $consulta->bind_param("i", $id_empleado);
    $consulta->execute();
    $resultado = $consulta->get_result();

    // Verifica si se encontraron resultados
    if ($row = $resultado->fetch_assoc()) {
        // Ahora, $row contiene la información del empleado que puedes usar en el formulario
    } else {
        // No se encontró ningún empleado con la ID proporcionada
        echo "No se encontró ningún empleado con la ID proporcionada.";
        exit;
    }

    // Cierra la consulta y libera recursos
    $consulta->close();
    } else {
        // Maneja el caso en que la consulta no pudo ser preparada
        echo "Error al preparar la consulta.";
        exit;
    }

    // Cierra la conexión
    $conexion->close();
?>

<div class="container mt-5">
    <h2>Formulario de Usuario</h2>
        <form action="../../../Controlador/ADMIN/UPDATE/Funcion_Update_Usuario.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $id_empleado; ?>">
        <input type="hidden" id="tipo_usuario" name="tipo_usuario" value="<?php echo $rol; ?>">
            <div class="form-group">
                <label for="nombre_usuario_e">Nombre:</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $row['nombre_usuario']; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_materno_e">Apellido Materno:</label>
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="<?php echo $row['apellido_materno']; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_paterno_e">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="<?php echo $row['apellido_paterno']; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="telefono_e">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento_e">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="genero_e">Género</label>
                <select class="form-control" id="genero" name="genero" required>
                    <option value="" selected disabled>-- Salecciona Opción--</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="correo_electronico_e">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?php echo $row['correo_electronico']; ?>" required>
                <div class="invalid-feedback">
                    Por favor, ingresa tu Nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa la contraseña" value="<?php echo $row['contrasena']; ?>" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <!-- SVG Icon -->
                            <svg viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="20" height="20">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M94.433 536.378c49.818-67.226 110.761-124.854 180.172-166.808 35.333-21.356 62.64-33.686 99.016-45.698 17.076-5.638 34.511-10.135 52.088-13.898 23.033-4.932 28.596-5.483 49.577-7.228 76.233-6.333 138.449 4.648 210.869 33.643 3.581 1.435 10.361 4.513 18.987 8.594 8.488 4.013 16.816 8.358 25.086 12.801 18.349 9.861 36.004 20.974 53.173 32.756 31.245 21.442 62.37 49.184 91.227 79.147 20.218 20.991 39.395 43.706 56.427 66.689 14.436 19.479 38.301 29.282 60.985 15.991 19.248-11.276 30.491-41.417 15.991-60.984-101.194-136.555-243.302-247.3-415.205-272.778-165.834-24.575-325.153 31.855-452.148 138.262-46.849 39.252-86.915 85.525-123.221 134.518-14.5 19.567-3.258 49.708 15.991 60.984 22.685 13.291 46.549 3.488 60.985-15.991z" fill="#4A5699"></path>
                                    <path d="M931.055 491.378c-49.817 67.228-110.761 124.856-180.173 166.811-35.332 21.354-62.639 33.684-99.015 45.694-17.076 5.641-34.512 10.137-52.09 13.902-23.032 4.931-28.593 5.48-49.576 7.225-76.233 6.336-138.449-4.648-210.869-33.642-3.582-1.436-10.362-4.514-18.987-8.595-8.488-4.015-16.816-8.357-25.087-12.801-18.348-9.862-36.003-20.974-53.172-32.755-31.245-21.443-62.37-49.184-91.227-79.149-20.218-20.99-39.395-43.705-56.427-66.69-14.436-19.479-38.3-29.279-60.985-15.991-19.249 11.276-30.491 41.419-15.991 60.984C118.65 672.929 260.76 783.677 432.661 809.15c165.834 24.578 325.152-31.854 452.148-138.259 46.85-39.256 86.915-85.528 123.222-134.521 14.5-19.564 3.257-49.708-15.991-60.984-22.685-13.287-46.55-3.487-60.985 15.992z" fill="#C45FA0"></path>
                                    <path d="M594.746 519.234c0.03 46.266-34.587 83.401-80.113 85.188-46.243 1.814-83.453-35.93-85.188-80.11-0.953-24.271-19.555-44.574-44.574-44.574-23.577 0-45.527 20.281-44.573 44.574 3.705 94.378 79.154 169.32 174.334 169.258 94.457-0.063 169.321-81.897 169.261-174.335-0.039-57.486-89.184-57.49-89.147-0.001z" fill="#F39A2B"></path>
                                    <path d="M430.688 514.818c0.876-45.416 37.262-81.797 82.677-82.672 45.438-0.875 81.824 38.571 82.673 82.672 1.105 57.413 90.256 57.521 89.147 0-1.827-94.791-77.028-169.994-171.82-171.82-94.787-1.827-170.049 79.785-171.824 171.82-1.108 57.522 88.04 57.413 89.147 0z" fill="#E5594F"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class="invalid-feedback">
                        Por favor, ingresa tu Contraseña.
                    </div>
                </div>
                <ul class="requirements mt-2">
                    <li id="length">Mínimo 8 caracteres</li>
                    <li id="uppercase">Una letra mayúscula</li>
                    <li id="lowercase">Letras minúsculas</li>
                    <li id="number">Números</li>
                    <li id="special">Símbolos</li>
                </ul>
            </div>
            <!-- Repetir Contraseña -->
            <div class="form-group">
                <label for="valcontrasena" class="form-label">Repetir contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="valcontrasena" name="valcontrasena" value="<?php echo $row['contrasena']; ?>" placeholder="Ingresa la contraseña" required>
                    <div class="invalid-feedback">
                        Las contraseñas no coinciden.
                    </div>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-warning" href="../Usuario.php">Regresar</a>
    </form>
</div>

<?php include('footer.php'); ?>