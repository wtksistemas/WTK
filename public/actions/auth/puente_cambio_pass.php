<?php
/**
 * PUENTE PÚBLICO: Procesar Cambio de Contraseña
 * Ubicación: WTK/public/actions/auth/cambio_pass.php
 */

// 1. Configuración de entorno
date_default_timezone_set('America/Mexico_City');
//session_start();

// 2. Seguridad: Solo permitir peticiones POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../index.php?v=no_autorizado");
    exit;
}

// 3. Opcional: Validaciones rápidas (campos vacíos)
if (empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: ../../index.php?v=campos_vacios");
    exit;
}

// 4. EL SALTO: Llamar a la lógica privada en src
// Subimos 3 niveles: auth -> actions -> public -> (raíz) y entramos a src
require_once __DIR__ . '/../../../src/auth/cambio_pass_process.php';
?>