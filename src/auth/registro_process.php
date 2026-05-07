<?php
/**
 * Procesamiento de registro de nuevos usuarios
 * Ubicación: WTK/src/auth/registro_process.php
 */
require_once __DIR__ . '/../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $user_nombre = trim($_POST['nombre'] ?? '');
    $user_apellido = trim($_POST['apellido'] ?? '');
    $user_rfc = trim($_POST['rfc'] ?? '');
    $user_email = trim($_POST['email'] ?? '');
    $user_telefono = trim($_POST['fon'] ?? '');
    $pass_input = trim($_POST['password'] ?? '');
    if (empty($pass_input) || empty($user_nombre) || empty($user_apellido) || empty($user_rfc) || empty($user_email) || empty($user_telefono))
    {
        die("Todos los campos son obligatorios.");
    }
    $nombre_completo = $user_nombre . ' ' . $user_apellido;
    try
    {
        // 1. Verificar si el usuario ya existe para evitar duplicados
        $check = $conexion->prepare("SELECT id FROM tb_usuarios WHERE c_usuario = ? or c_telefono = ? or c_rfc = ? or c_nombre = ?");
        $check->execute([$user_email, $user_telefono, $user_rfc, $nombre_completo]);
        if ($check->fetch())
        {
            header("Location: ../../public/registro.php?v=datos_duplicados" );
            exit;
        }
        // 2. HASHEAR la contraseña
        // PASSWORD_DEFAULT utiliza actualmente el algoritmo bcrypt, que es muy seguro.
        $password_segura = password_hash($pass_input, PASSWORD_DEFAULT);
        // 3. Insertar en la base de datos
        $sql = "INSERT INTO tb_usuarios (c_nombre, c_rfc, c_usuario, c_telefono, c_password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        if ($stmt->execute([$nombre_completo, $user_rfc, $user_email, $user_telefono, $password_segura]))
        {
            // Registro exitoso, lo enviamos al login
            header("Location: ../../public/index.php?v=registro_exitoso");
            exit;
        }
    }
    catch (PDOException $e)
    {
        error_log("Error en registro: " . $e->getMessage());
       header("Location: ../../public/registro.php?v=error_tecnico");
        exit;
    }
}
else
{
    // Si alguien intenta entrar a este archivo por URL sin POST, lo mandamos al registro
    header("Location: ../../public/registro.php?v=no_autorizado");
    exit;
}
?>