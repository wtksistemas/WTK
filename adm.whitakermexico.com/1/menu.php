<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/style.css">
	<script src="../js/script.js"></script>
</head>

<body>
	
	<?php
		session_start();
	
	
	  include "../php/control.php";
	

	
	if ($_SESSION['id'] == '888')
		{
			
		}
		else{
			header("Location:../index.html");
		}
			
	?>

<!--	<header>
		<nav class="top-nav">
			<div class="perfil">
				<button class="btn-perfil">Perfil</button>
				<button class="btn-cerrar">Cerrar Sesión</button>
			</div>
		</nav>
	</header>-->
	   
	
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
		
	 <!-- Menú superior -->
	<div class="menu-superior">
		<div class="opciones">
			<ul class="menu">
				<li><a href="#">Nóminas</a></li>
				<ul>
					<li><a id="submenu" href="nominas/nomina.php">Cotizador</a></li>
					<li><a id="submenu" href="nominas/validacion.php">Validación de cuentas</a></li>
				</ul>
			</ul>
			
			<ul class="menu">
				<li><a href="legal/legal.php">Legal</a></li>
			</ul>
		</div>
        
		<div class="perfil">
			<a href="menu.php">
				<img src="img/home.png" class="img-perfil">
			</a>
			<?php
				echo "<span style='color: white;'>".$_SESSION['username']."</span>";
			?>
			<a href="../php/logout.php"><button type="button">Cerrar sesión</button></a>

		</div>
	</div>
	
	<!-- Buscardor -->
        <!-- Contenido -->
       

    </div>
</body>
</html>