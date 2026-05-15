<?php
/* Envio de mail para reestablecimiento
/* Mostrar errores PHP (Desactivar en producción) */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
// Incluir la libreria PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';
/**
 * Lógica para generar token de recuperación
 * Ubicación: WTK/src/auth/recuperar_process.php
 */
require_once __DIR__ . '/../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $user_input = trim($_POST['username'] ?? '');
    // 1. Verificar si el usuario existe
    $stmt = $conexion->prepare("SELECT id FROM tb_usuarios WHERE c_usuario = ?");
    $stmt->execute([$user_input]);
    $user = $stmt->fetch();
    $usuario_id = $user['id'] ?? null;
    // Si el usuario existe, procedemos a generar el token
    if ($user)
    {
        // 2. Generar un Token seguro y una expiración (5 mintuos)
        $token = bin2hex(random_bytes(32)); // Genera algo como '4f2e...'
        // 3. Guardar en la base de datos
        $insercion = $conexion->prepare("INSERT INTO tb_token (id_cusuario, c_token, c_tipotoken, c_estado) VALUES (?, ?, 'URL', 'Activo')");
        $insercion->execute([$usuario_id, $token]);
        // 4. Enviar el correo con el enlace de restablecimiento (usando PHPMailer)
        // Inicio
        $mail = new PHPMailer(true);
        try
        {
            $cuenta_mail = 'notificaciones_wtk@zohomail.com';
            // Configuracion SMTP
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                // Mostrar salida (Desactivar en producción)
            $mail->isSMTP();                                                         // Activar envio SMTP
            $mail->Host  = 'smtp.zoho.com';                                         // Servidor SMTP
            $mail->SMTPAuth  = true;                                                 // Identificacion SMTP
            $mail->Username  = 'notificaciones_wtk@zohomail.com';                       // Usuario SMTP
            $mail->Password  = 'yG0mGFmh8yWf';	                                     // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port  = 587;

            $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ));

            $mail->setFrom($cuenta_mail, 'Restablece tu cuenta');   // Remitente del correo
            // Destinatarios
            $mail->addAddress($user_input, 'Usuario');  									 // Email y nombre del destinatario
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de restablecimiento de cuenta';
            $link="http://adm.whitakermexico.com/reset_password.php?tkn=$token";
            $mail->Body  = "<br>Entra al siguiente <a href='$link'>enlace</a> <br>
            <p>Este codigo es valido por 5 minutos.</p>";
            $mail->send();
            header("Location: ../../index.php?v=correo_enviado");
            //echo 'El mensaje se ha enviado. Revisa tu correo para restablecer tu cuenta.';
        }
        catch (Exception $e)
        {
           //echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
            header("Location: ../../index.php?v=error_mail");
        }        
    }
    else
    {  
        echo "Usuario no encontrado. Por favor, verifica tu entrada.";
        header("Location: ../../index.php?error=UsuarioNoEncontrado");
        exit;
    }
}
else
{
    // Si alguien intenta entrar a este archivo por URL sin POST, lo mandamos al login
    header("Location: ../../index.php?v=No_autorizado");
    exit;
}
?>