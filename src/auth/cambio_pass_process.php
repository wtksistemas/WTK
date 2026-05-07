<?php
/**
 * Proceso final para guardar la nueva contraseña
 * Ubicación: WTK/src/auth/cambiar_clave_process.php
 */
require_once __DIR__ . '/../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // 1. Capturamos los datos del formulario
    $token = $_POST['token'] ?? '';
    $nueva_pass = $_POST['pass1'] ?? '';
    $confirmar_pass = $_POST['pass2'] ?? '';
    // 2. Validaciones de seguridad
    if (empty($nueva_pass) || $nueva_pass !== $confirmar_pass)
    {
        header("Location: ../../public/index.php?v=pass_no_coincide");
        exit;
    }
    if (strlen($nueva_pass) < 8)
    {
        header("Location: ../../public/reset_password.php?v=pass_invalido");
        exit;
    }
    try
    {
        // 3. Verificamos que el token siga siendo válido en tb_token
        // Importante: expiracion > NOW() asegura que no haya caducado (-6 zona horaria)
        $stmt = $conexion->prepare("SELECT id_cusuario FROM tb_token WHERE c_token = ? AND c_estado='Activo' LIMIT 1");
        $stmt->execute([$token]);
        $res = $stmt->fetch();
        if ($res)
        {
            $id_usuario = $res['id_cusuario'];
            // 4. HASHEAMOS la nueva contraseña
            $password_segura = password_hash($nueva_pass, PASSWORD_DEFAULT);
            // 5. Actualizamos la base de datos (Transacción)
            $conexion->beginTransaction();
            // Paso A: Actualizar contraseña en tb_usuarios
            $update = $conexion->prepare("UPDATE tb_usuarios SET c_password = ? WHERE ID = ?");
            $update->execute([$password_segura, $id_usuario]);
            // Paso B: Eliminar el token usado para que quede invalidado
            $delete = $conexion->prepare("DELETE FROM tb_token WHERE c_token = ?");
            $delete->execute([$token]);
            $conexion->commit();
            // Éxito: Mandamos al usuario al login
            header("Location: ../../public/login.php?v=pass_cambiada");
            exit;
        }
        else
        {
            // Token inválido o expirado
            header("Location: ../../public/login.php?v=token_invalido");
            exit;
        }
    }
    catch (PDOException $e)
    {
        if ($conexion->inTransaction())
        {
            $conexion->rollBack();
        }
        header("Location: ../../public/index.php?v=error_tecnico");
    }
}
else
{
    // Si alguien intenta entrar a este archivo por URL sin POST, lo mandamos al login
    header("Location: ../../public/index.php?v=no_autorizado");
    exit;
}
?>