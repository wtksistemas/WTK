<?php
// 1. FORZAR ZONA HORARIA EN PHP (México/Centroamérica)
date_default_timezone_set('America/Mexico_City');
/**
 * 
 * Ubicación: WTK/src/checador/registro_registro_asistencia.php
 */
session_start();
// Control de acceso rápido antes de procesar nada
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../index.php?v=sesion_invalida");
    exit;
}

// Como es un archivo que se carga de forma interna, asumimos que la sesión ya inició
require_once __DIR__ . '/../../config/database.php';

$id_usuario = $_SESSION['user_id'] ?? 0;
$fecha_hoy  = date('Y-m-d');
$hora_ahora = date('H:i:s');


if ($id_usuario === 0) {
    header("Location: ../../index.php?error=usuario_invalido");
    exit;
}

try {
    // 1. Determinar el tipo de checada contando las marcas de hoy
    $sql_conteo = "SELECT COUNT(*) FROM tb_checador WHERE c_idusuario = ? AND c_fecha = ?";
    $stmt_conteo = $conexion->prepare($sql_conteo);
    $stmt_conteo->execute([$id_usuario, $fecha_hoy]);
    $numero_checadas = $stmt_conteo->fetchColumn();

    // Lógica automática de turnos
    if ($numero_checadas % 2    ==  0) {
        $tipo_checada = 'entrada';
    }
    else {
        $tipo_checada = 'salida'; 
    }

    // 2. Insertar en la base de datos
    $sql_insert = "INSERT INTO tb_checador (c_idusuario, c_fecha, c_horaregistro, c_tiporegistro,c_dispositivochecada,c_ubicacion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $stmt_insert->execute([$id_usuario, $fecha_hoy, $hora_ahora, $tipo_checada, 'WEB', 'PISO 12']);

    // Éxito: Redirigimos de vuelta al cehcador con un mensaje de éxito y el tipo de checada
    header("Location: ../../checador.php?status=success&tipo=" . $tipo_checada);
    exit;

} catch (PDOException $e) {
    echo "Error al registrar checada: " . $e->getMessage();
    header("Location: ../../checador.php?status=error");
    exit;
}

?>