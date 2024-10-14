<?php
$user=$_POST['username'];
/* Envio de mail para reestablecimiento
/* Mostrar errores PHP (Desactivar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
// Incluir la libreria PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require 'funciones.php';
// Inicio
$mail = new PHPMailer(true);

try {
    // Configuracion SMTP
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                // Mostrar salida (Desactivar en producción)
    $mail->isSMTP();                                                         // Activar envio SMTP
    $mail->Host  = 'smtp.gmail.com';                                         // Servidor SMTP
    $mail->SMTPAuth  = true;                                                 // Identificacion SMTP
    $mail->Username  = 'sistemas@whitakermexico.com';                        // Usuario SMTP
    $mail->Password  = 'WTK$cuesta01';	                                     // Contraseña SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port  = 587;
    $mail->setFrom('sistemas@whitakermexico.com', 'Restablece tu cuenta');   // Remitente del correo

    // Destinatarios
    $mail->addAddress($user, 'Usuario');  									 // Email y nombre del destinatario

	/*$tkn= token();
	$tkn2= token_2();
	
	insertar_tkn($user,$tkn,$tkn2); */

    verifica_usuario($user);
	
    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Solicitud de restablecimiento de cuenta';
    $mail->Body  = '<br> Usa el siguiente codigo de verificacion: <br> '.$tkn2.'<p> Para restablecer tu cuenta entra al siguiente <a href="https://www.clientes.whitakermexico.com/generacion.php?tkn='.$tkn.'"> enlace </a> <br>
	<p>Este codigo tiene validez de 5 minutos.</p>';
    $mail->AltBody = 'Contenido del correo en texto plano para los clientes de correo que no soporten HTML';
    $mail->send();
    echo 'El mensaje se ha enviado';
} catch (Exception $e) {
    echo "El mensaje no se ha enviado. Mailer Error: ".$mail->ErrorInfo."";
}
header("Location: https://clientes.whitakermexico.com?v=4");
?>