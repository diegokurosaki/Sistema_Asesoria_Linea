<?php
// Inicia la sesión PHP
session_start();

// Configura la localización a español
setlocale(LC_ALL, 'es_ES');

// Configura la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');

// Incluye el archivo de conexión a la base de datos
include('../../../Modelo/Conexion.php');

// Incluye las clases necesarias de PHPMailer
require '../../../librerias/PHPMailer/src/Exception.php';
require '../../../librerias/PHPMailer/src/PHPMailer.php';
require '../../../librerias/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Obtiene la conexión a la base de datos
$conexion = (new Conectar())->conexion();

function deleteCita($conexion, $id) {
    // Desactivar temporalmente la verificación de claves foráneas
    $conexion->query("SET FOREIGN_KEY_CHECKS = 0;");

    // Ejecutar la eliminación
    $stmt = $conexion->prepare("DELETE FROM Citas WHERE ID_Cita = ?;");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    // Reactivar la verificación de claves foráneas
    $conexion->query("SET FOREIGN_KEY_CHECKS = 1;");

    // Cerrar la declaración preparada
    $stmt->close();
}

function buscarIDEstudianteCita($conexion, $id){
    $stmt = $conexion->prepare("SELECT Titulo, Fch_Cita, Hora_Cita, ID_Estudiante_Citado FROM Citas WHERE ID_Cita = ?;");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($titulo, $fechaCita, $horaCita, $idEstudiante);
    $stmt->fetch();
    $stmt->close();
    return [
        'titulo' => $titulo,
        'fechaCita' => $fechaCita,
        'horaCita' => $horaCita,
        'idEstudiante' => $idEstudiante
    ];
}

function BuscarCorreoEstudiante($conexion, $ID_Estudiante){
    $stmt = $conexion->prepare("SELECT Correo_electronico_E FROM Estudiante WHERE ID_Usuario_E = ?");
    $stmt->bind_param('i', $ID_Estudiante);
    $stmt->execute();
    $stmt->bind_result($correoEstudiante);
    $stmt->fetch();
    $stmt->close();
    return $correoEstudiante;
}

function enviarCorreo($Correo_Estudiante, $datosCita) {
    try {
        // Configurar PHPMailer para enviar correo
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        // Dirección de correo electrónico de Gmail
        $mail->Username = 'pmdo200586@upemor.edu.mx';
        // Contraseña de Gmail o App Password
        $mail->Password = 'HeatherMason'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el remitente y el destinatario del correo
        $mail->setFrom('pmdo200586@upemor.edu.mx', 'Diego Peña Medina');
        $mail->addAddress($Correo_Estudiante);
        $mail->isHTML(true);

        // Configurar el asunto del correo
        $mail->Subject = 'Cancelación de Cita: ' . $datosCita['titulo'];
        
        // Construir el cuerpo del correo con HTML
        $mensaje = "
            <p>Estimado estudiante,</p>
            <p>Le informamos que la cita sobre el tema <strong>{$datosCita['titulo']}</strong> ha sido cancelada.</p>
            <p><strong>Fecha:</strong> {$datosCita['fechaCita']}<br>
            <strong>Hora:</strong> {$datosCita['horaCita']}</p>
            <p>Le rogamos que esté pendiente para agendar una nueva fecha si es necesario.</p>
            <p>Saludos cordiales.</p>
        ";
        
        // Establecer el cuerpo del correo
        $mail->Body = $mensaje;
        $mail->AltBody = 'La cita sobre el tema ' . $datosCita['titulo'] . ' ha sido cancelada. Fecha: ' . $datosCita['fechaCita'] . ', Hora: ' . $datosCita['horaCita'];
        
        // Enviar el correo
        $mail->send();

        return true;
    } catch (Exception $e) {
        return ["success" => false, "message" => $e->getMessage()];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $conexion = (new Conectar())->conexion();

    try {
        $conexion->begin_transaction();

        $datosCita = buscarIDEstudianteCita($conexion, $id);
        $Correo_Estudiante = BuscarCorreoEstudiante($conexion, $datosCita['idEstudiante']);

        deleteCita($conexion, $id);

        enviarCorreo($Correo_Estudiante, $datosCita);

        $conexion->commit();

        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("¡La eliminación fue exitosa!");';
        echo 'window.location = "../../../Vista/ADMIN/Citas.php";'; // Reemplazar con la ruta de redirección deseada
        echo '</script>';
        exit();

    } catch (Exception $e) {
        $conexion->rollback();
        // Éxito: mostrar un mensaje y redirigir
        echo '<script type="text/javascript">';
        echo 'alert("ERROR: ' . $e->getMessage() . '");';
        echo 'window.location = "../../../Vista/ADMIN/Citas.php";'; // Reemplazar con la ruta de redirección deseada
        echo '</script>';
        exit();
    }

    $conexion->close();
}
?>