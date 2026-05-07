<?php
/**
* Configuración de la conexión a la base de datos
 * Ubicación: WTK/config/database.php
 */
// 1. Definición de credenciales
define('DB_HOST', 'localhost');
define('DB_NAME', 'whitaker_usuarios'); // Nombre de la base de datos
define('DB_USER', 'whitaker_sistemas');             // Usuario de MySQL
define('DB_PASS', 'WTK$cuesta01');                 //Contraseña de MySQL
define('DB_CHARSET', 'utf8mb4');       // Codificación para soporte de acentos y emojis
try 
{
    // 2. Configuración del DSN (Data Source Name)
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    // 3. Opciones de configuración de PDO
    $options=
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza errores si algo falla
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve los datos como arreglos asociativos
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa sentencias preparadas reales
    ];
    // 4. Creación de la instancia de conexión
    $conexion = new PDO($dsn, DB_USER, DB_PASS, $options);
// ESTA LÍNEA ES CLAVE: Fuerza a MySQL a usar la zona horaria de México (-06:00)
    $conexion->exec("SET time_zone = '-06:00'");

}
catch (PDOException $e)
{
    // 5. Gestión de errores de conexión
    // En producción, es mejor guardar esto en un log y no mostrarlo al usuario
    die("Error crítico de conexión: " . $e->getMessage());
}
?> 