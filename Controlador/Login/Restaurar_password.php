<?php
// Habilitar la visualización de errores de PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar la sesión
session_start();
setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/Mexico_City');

// Importar clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Incluir el archivo de conexión a la base de datos
include('../../Modelo/Conexion.php');

// Incluir las clases necesarias de PHPMailer
require '../../librerias/PHPMailer/src/Exception.php';
require '../../librerias/PHPMailer/src/PHPMailer.php';
require '../../librerias/PHPMailer/src/SMTP.php';

// Obtener la instancia de conexión a la base de datos
$conexion = (new Conectar())->conexion();

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico proporcionado en el formulario
    $Correo_Electronico = $_POST['Correo_Electronico'];

    // Buscar el usuario en la tabla y contraseña
    $Resultado = BuscarUsuario($conexion, $Correo_Electronico);

    // Verificar si se encontró un usuario con el correo electrónico proporcionado
    if ($Resultado != NULL) {
        // Recuperar la contraseña y enviar por correo electrónico
        recuperarContrasena($Correo_Electronico, $conexion, $Resultado);
    } else {
        // Si no se encontró un usuario con el correo electrónico proporcionado, mostrar un mensaje de error en JavaScript
        echo '<script type="text/javascript">';
        echo 'alert("ERROR, No existe Ningun Usuario con ese Correo");';
        echo 'window.location = "../../index.php";';
        echo '</script>';
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();

// Función para generar una contraseña aleatoria combinando "AS3S*R14_" con 5 números aleatorios
function generarContrasenaAleatoria() {
    // Cadena base
    $cadenaBase = "AS3S*R14_";

    // Generar 6 números aleatorios
    $numerosAleatorios = "";
    for ($i = 0; $i < 6; $i++) {
        $numerosAleatorios .= mt_rand(0, 9); // Genera un número aleatorio entre 0 y 9
    }

    // Combinar la cadena base con los números aleatorios
    $contrasenaAleatoria = $cadenaBase . $numerosAleatorios;

    return $contrasenaAleatoria;
}

// Función para buscar el usuario en las tablas y recuperar la contraseña
function BuscarUsuario($conexion, $Correo_Electronico) {
    // Lista de tablas, campos de contraseña y campos de correo para buscar
    $tables = ["Estudiante", "Docente", "Administrador"];
    $ContrasenaCampos = ["Contrasena_E", "Contrasena_D", "Contrasena_A"];
    $CorreoCampos = ["Correo_electronico_E", "Correo_electronico_D", "Correo_electronico_A"];

    // Itera a través de cada tabla
    foreach ($tables as $index => $table) {
        // Consulta SQL para seleccionar la contraseña del usuario
        $SQLSelectUSER = "SELECT " . $ContrasenaCampos[$index] . " AS Contrasena FROM " . $table . " WHERE " . $CorreoCampos[$index] . " = ?;";
        $stmtSelectUSER = $conexion->prepare($SQLSelectUSER);

        // Asocia el parámetro de la consulta con el correo electrónico proporcionado
        $stmtSelectUSER->bind_param("s", $Correo_Electronico);

        // Ejecuta la consulta
        $stmtSelectUSER->execute();

        // Obtiene el resultado de la consulta
        $ResultSelectUSER = $stmtSelectUSER->get_result();

        // Si se encuentra un resultado, retorna el nombre de la tabla y la contraseña
        if ($ResultSelectUSER->num_rows > 0) {
            $row = $ResultSelectUSER->fetch_assoc();
            return ["table" => $table, "Contrasena" => $row['Contrasena'], "CorreoCampo" => $CorreoCampos[$index], "ContrasenaCampo" => $ContrasenaCampos[$index]];
        }
    }

    // Si no se encuentra ningún usuario, retorna null
    return null;
}

// Función para actualizar la contraseña del usuario en la base de datos y enviarla por correo electrónico
function recuperarContrasena($correoElectronico, $conexion, $Resultado) {
    try {
        // Iniciar una transacción
        $conexion->begin_transaction();

        // Generar una nueva contraseña aleatoria
        $nuevaContrasena1 = generarContrasenaAleatoria();

        // Encriptar la contraseña para la base de datos
        $nuevaContrasena = password_hash($nuevaContrasena1, PASSWORD_DEFAULT);

        // Actualizar la contraseña del usuario
        $sqlUpdate = "UPDATE " . $Resultado['table'] . " SET " . $Resultado['ContrasenaCampo'] . " = ? WHERE " . $Resultado['CorreoCampo'] . " = ?;";
        $stmt = $conexion->prepare($sqlUpdate);
        $stmt->bind_param("ss", $nuevaContrasena, $correoElectronico);
        $stmt->execute();

        // Verificar si se actualizó correctamente
        if ($stmt->affected_rows > 0) {
            // Enviar la nueva contraseña por correo electrónico (la contraseña no encriptada)
            enviarCorreo($correoElectronico, $nuevaContrasena1);

            // Confirmar la transacción
            $conexion->commit();

            // Mostrar un mensaje de éxito en JavaScript
            echo '<script type="text/javascript">';
            echo 'alert("Se ha enviado la contraseña a tu correo electrónico.");';
            echo 'window.location = "../../index.php";';
            echo '</script>';
        } else {
            throw new Exception("No se pudo actualizar la contraseña del usuario.");
        }
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollback();
        echo '<script>alert("Error durante la recuperación de contraseña: ' . $e->getMessage() . '");</script>';
    }
}

// Función para enviar correo electrónico con la nueva contraseña
function enviarCorreo($correoElectronico, $nuevaContrasena1) {
    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurar la conexión SMTP para enviar el correo
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'pmdo200586@upemor.edu.mx'; // Dirección de correo electrónico de Gmail
        $mail->Password = 'HeatherMason'; // Contraseña de Gmail o App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el remitente y el destinatario del correo
        $mail->setFrom('pmdo200586@upemor.edu.mx', utf8_decode('Diego Peña Medina')); // Dirección de correo electrónico de Gmail y nombre del remitente
        $mail->addAddress($correoElectronico);

        // Configurar el asunto del correo
        $mail->Subject = utf8_decode('Recuperación de Contraseña');

        // Construir el cuerpo del correo con HTML
        $mensaje = '<html lang="es"><head><meta charset="UTF-8"></head><body>';
        $mensaje .= '<h1 style="color: #3498db;">Asesorias en línea</h1>';
        $mensaje .= '<p>Estimado usuario,</p>';
        $mensaje .= '<p>Tu nueva contraseña es: ' . $nuevaContrasena1 . '</p>';
        $mensaje .= '<img src="https://i.gifer.com/NLdi.gif" alt="Logo de la empresa">';
        $mensaje .= '</body></html>';

        // Establecer el cuerpo del correo
        $mail->Body = $mensaje;
        $mail->AltBody = 'Tu nueva contraseña es: ' . $nuevaContrasena1; // Versión de texto sin formato

        // Enviar el correo
        $mail->send();
        
        return true;
    } catch (Exception $e) {
        // En caso de error al enviar el correo, mostrar un mensaje de error en JavaScript
        echo '<script>alert("Error al enviar el correo: ' . $mail->ErrorInfo . '");</script>';
        return false;
    }
}
?>