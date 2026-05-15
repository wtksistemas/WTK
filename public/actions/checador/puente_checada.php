<?php
/**
 * Puente de Asistencia
 * Ubicación: WTK/public/actions/checador/puente_checada.php
 */
// 1. Configuración de entorno
date_default_timezone_set('America/Mexico_City');
session_start();
// 2. Seguridad: Solo permitir peticiones POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    header("Location: ../../index.php?v=no_autorizado");
    exit;
}
// 3. Opcional: Validaciones rápidas (sesion activa).
if (!isset($_SESSION['user_id']))
{
    header("Location: ../../index.php?v=sesion_expirada");
    exit;
}
require_once __DIR__ . '/../../../src/checador/registro_asistencia.php';
?>