<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="css/recuperar_contrasena.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo.png">
</head>
<body>
    <section class="formulario">
        <h4>Recuperación de Contraseña</h4>
        <form class="needs-validation" novalidate action="Controlador/Login/Restaurar_password.php" method="POST">
                            <div class="form-group">
                                <label for="correoElectronico">Correo Electrónico:</label>
                                <input type="email" class="campo" name="Correo_Electronico" placeholder="Ingresa tu Correo Electronico" required>
                                <div class="invalid-feedback">
                                    Por favor, coloca tu correo electrónico.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Recuperar Contraseña</button>
                        </form>
        <p>¿Regresar a inicio?</p>
        <div class="contenedor-botones">
            <button class="boton dos"><span><a href="index.php">Regresar</a></span></button>
        </div>
    </section>
</body>
 <!-- Agrega el enlace al archivo JS de Bootstrap y Popper.js -->
 <script src="js/validar_campos.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>