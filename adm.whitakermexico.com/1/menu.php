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
			<a href="nominas/nomina.php">Nómina</a>
			<a href="legal.php">Legal</a>
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