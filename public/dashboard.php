<?php
/**
 * Panel de Control / Menú Principal (Dashboard)
 * Ubicación: WTK/public/dashboard.php
 */
session_start();
// 1. CONTROL DE ACCESO: Si no está logueado, al login de inmediato
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
{
	header("Location: login.php?v=sesion_invalida");
	exit;
}
// 2. Opcional: Traer la conexión por si necesitas mostrar datos del usuario
require_once __DIR__ . '/../config/database.php';
// Capturamos el nombre del usuario logueado para darle la bienvenida
$nombre_usuario = $_SESSION['nombre'] ?? 'Usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
	<link rel="shortcut icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/dashboard.css">
	<script src="assets/js/dashboard.js"></script>
</head>
<body>
<header>
	<nav class="top-nav">
		<div class="perfil">
			<button class="btn-perfil">Perfil</button>
			<button class="btn-cerrar">Cerrar Sesión</button>
		</div>
	</nav>
</header>
<!-- Contenedor principal -->
	<div class="contenedor-principal">
		<!-- Menú superior -->
		<div class="menu-superior">
			<!-- Opciones del menú -->
			<div class="opciones">
				<ul class="menu">
					<li class="dropdown">
						<a id="submenu" href="checador.php">Checador</a>
					</li>
				</ul>
				<ul class="menu">
					<li><a href="notificaciones.php">Notificaciones</a></li>
				</ul>
				<ul class="menu">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">Nóminas</a>
						<ul class="submenu">
							<li><a id="submenu" href="../Modulo_Nominas/nomina.php">Cotizador</a></li>
							<li><a id="submenu" href="../Modulo_Nominas/validacion.php">Validación de cuentas</a></li>
						</ul>
					</li>
				</ul>
				<ul class="menu">
					<li><a href="../Modulo_Legal/legal.php">Legal</a></li>
				</ul>
			</div>
			<div class="perfil">
  				<!-- Formulario bajo el mini reloj -->
				<div id="formulario-reloj" class="formulario-reloj" style="display: none;">
  					<button class="boton-checar" id="boton-checar1">Checar</button>
				</div>
				<div class="mini-reloj" id="reloj" role="button" tabindex="0">
					<div class="hora-con-icono">
    					<div class="icono" id="icono-dia-noche1"></div>
    					<div class="hora" id="hora-actual"></div>
  					</div>
				</div>
				<a href="dashboard.php">
					<img src="assets/img/home_blanco.png" class="img-perfil">
				</a>
				<?php
					echo "<span style='color: white;'>".$nombre_usuario."</span>";
				?>
				<a href="../../src/auth/logout.php"><button type="button">Cerrar sesión</button></a>
			</div>
		</div>
</body>
</html>