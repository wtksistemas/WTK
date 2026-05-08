<?php
/**
 * Procesamiento de inicio de sesión
 * Ubicación: WTK/src/auth/login_process.php
 */

session_start(); // Iniciamos la sesión para guardar los datos del usuario
require_once __DIR__ . '/../../config/database.php'; // Traemos la conexión $conexion

if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        //echo "enregando datos..."; // Debug: Ver que se reciben los datos
        // 1. Limpieza básica de entradas
        $user_input = trim($_POST['username'] ?? '');
        $pass_input = trim($_POST['password'] ?? '');
        if (empty($user_input) || empty($pass_input))
            {
                header("Location: ../../public/index.php?v=campos_vacios");
                exit;
            }
        try
            {
                // 2. Sentencia preparada (Evita Inyección SQL)
                // El signo de interrogación '?' es un marcador de posición
                $sql = "SELECT id, c_usuario,c_nombre, c_password FROM tb_usuarios WHERE c_usuario = ? LIMIT 1";
                $stmt = $conexion->prepare($sql);
                $stmt->execute([$user_input]);
                $usuario = $stmt->fetch();
                // 3. Verificación de la contraseña
                // Importante: En la BD la contraseña debe estar encriptada con password_hash()
                if ($usuario && password_verify($pass_input, $usuario['c_password']))
                    {
                        // Regeneramos el ID de sesión por seguridad (evita fijación de sesión)
                        session_regenerate_id(true);
                        // Guardamos datos útiles en la sesión
                        $_SESSION['user_id']   = $usuario['id'];
                        $_SESSION['username']  = $usuario['c_usuario'];
                        $_SESSION['nombre']    = $usuario['c_nombre'];
                        $_SESSION['logged_in'] = true;
                        //echo "Usuario autenticado correctamente.";
                        // Redirigimos al área privada
                        header("Location: ../../dashboard.php");
                        exit;
                    }
                else
                {
                    // Error de credenciales
                  echo "Usuario o contraseña incorrectos.";
                  header("Location: ../../index.php?v=login_fallido");
                    exit;
                }
            }
            catch (PDOException $e)
                {
                    // Error de base de datos
                    error_log("Error en login: " . $e->getMessage()); // Guardamos el error en un log oculto
                    //echo "Ocurrió un error técnico. Intenta de nuevo más tarde.";
                    echo $e->getMessage();
                    //header("Location: ../../index.php?v=error_tecnico");
                    exit;
                }
    }
    else
        {
            // Si alguien intenta entrar a este archivo por URL sin POST, lo mandamos al login
            //echo "Acceso no autorizado.";
            header("Location: ../../index.php?v=no_autorizado");
            exit;
        }
?>