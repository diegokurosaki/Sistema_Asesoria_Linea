<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="img/logo.png">
</head>
<body>
    <div>
        <h1 class="titulo_1">Sistema Web para la Impartición de Asesorías en Línea</h1>
    </div>
    <form class="needs-validation formulario" novalidate action="Controlador/Login/Validacion.php" method="POST">
        <h4>Iniciar sesión</h4>
        <div class="form-group">
            <label for="validationCustom01" class="form-label">Correo Electrónico</label>
            <input class="campo" type="email" name="correo" id="correo" placeholder="Ingresa tu correo electronico" required>
            <div class="invalid-feedback">
              Por favor, ingresa un correo electrónico válido.
            </div>
          </div>
          <br>
          <div class="form-group">
            <label for="validationCustom02" class="form-label">Contraseña: </label>
            <input class="campo" type="password" name="contrasena" id="contraseña" placeholder="Ingresa tu contraseña" required>
            <div class="invalid-feedback">
              Por favor, ingresa tu contraseña.
            </div>
          </div>
        <button class="boton dos"><span>Iniciar</span></button>
        <p>¿Olvidaste la contraseña?</p>
        <div class="contenedor-botones">
            <button class="boton dos"><span><a href="Recuperar_Contrasena.php">Clic aquí</a></span></button>
        </div>
    </form>
    <!-- Enlace a Bootstrap JS y Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Bootstrap validation script -->
<script src="js/validar_campos.js"></script>
</body>
</html>