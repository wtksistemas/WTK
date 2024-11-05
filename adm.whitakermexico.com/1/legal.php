<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	
	<?php
		session_start();
	
	
	  include "../php/control.php";
	

	
	if ($_SESSION['id'] == '888')
		{
			
		}
		else{
			header("Location: ../index.html");
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
			<a href="nomina.php">Nómina</a>
			<a href="legal.php">Legal</a>
		</div>
        
		<div class="perfil">
			<a href="menu.php">
				<img src="img/home.png" class="img-perfil">
			</a>

			<?php
				echo "<span style='color: white;'>".$_SESSION['username']."</span>";
			?></P>
	<a href="../php/logout.php"><button type="button">Cerrar sesion</button></a>
		</div>


		
	</div>
	
	<!-- Buscardor -->
        <!-- Contenido -->
        <div class="contenido">
            <!-- Barra de búsqueda -->
            <div class="barra-busqueda">
				<label for="f_busqueda">Filtros de busqueda:</label>
				<input type="text" placeholder="Nombre de empresa, N° Escritura, Intrumento legal, Tipo... ">				
            </div>

            <!-- Lista de expedientes -->
            <div class="expediente">
                <span>Expediente 1</span>
                <div>
                    <button>Ver</button>
                    <button>Reservar</button>
                    <button>Histórico</button>
                    <button>Expediente Virtual</button>
                </div>
            </div>

            <div class="expediente">
                <span>Expediente 2</span>
                <div>
                    <button>Ver</button>
                    <button>Reservar</button>
                    <button>Histórico</button>
                    <button>Expediente Virtual</button>
                </div>
            </div>

            <!-- Puedes agregar más expedientes aquí -->

        </div>

    </div>
</body>
</html>