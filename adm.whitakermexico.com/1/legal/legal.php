<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel division Legal</title>
    <link rel="stylesheet" href="../css/style.css">
	<script src="js/legal.js"></script>
	<script src="../../js/script.js"></script>
</head>
<body>
	<?php
		session_start();
	  	include "../../php/control.php";
		if ($_SESSION['id'] == '888')
		{}
		else
		{
		header("Location: ../../index.html");
		}	
	?>	
    <!-- Contenedor principal -->
    <div class="contenedor-principal">	
	 <!-- Menú superior -->
		<div class="menu-superior">
			<div class="opciones">
				<ul class="menu">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle">Nóminas</a>
							<ul class="submenu">
								<li><a id="submenu" href="../nominas/nomina.php">Cotizador</a></li>
								<li><a id="submenu" href="../nominas/validacion.php">Validación de cuentas</a></li>
							</ul>
						</li>
					</ul>
				
					<ul class="menu">
						<li><a href="../legal/legal.php">Legal</a></li>
					</ul>
			</div>
			<div class="perfil">
				<a href="../menu.php">
					<img src="../img/home.png" class="img-perfil">
				</a>
				<?php echo "<span style='color: white;'>".$_SESSION['username']."</span>"; ?>
				<a href="../../php/logout.php"><button type="button" class="btn">Cerrar sesion</button></a>
			</div>
		</div>
		<!-- Buscardor -->
    	<!-- Contenido -->
    	<div class="contenido" id="contenido">
    	<!-- Barra de búsqueda -->
    		<div class="barra-busqueda">
				<label for="f_busqueda">Filtros de busqueda:</label>
				<input type="text" id="busqueda" placeholder="Nombre de empresa, N° Escritura, Intrumento legal, Tipo... " oninput= "agregarfilas()">				
				<button class="btn" type="button" onclick="window.location.href='altainstrumentos.php'">Nuevo registro</button>
        	</div>
       		<!-- Lista de expedientes -->
			<div class="contenido" id="contenido_expedientes">
	        	<div class="expediente">
    	        	<span>Expediente 1</span>
                	<div>
                   		<button>Ver</button>
                    	<button>Reservar</button>
                    	<button>Histórico</button>
                    	<button>Detalles</button>
                	</div>
            	</div>
            	<div class="expediente">
                	<span>Expediente 2</span>
                	<div>
                    	<button>Ver</button>
                    	<button>Reservar</button>
                    	<button>Histórico</button>
                    	<button>Detalles</button>
                	</div>
            	</div>
            	<!-- Puedes agregar más expedientes aquí -->
			</div>
    	</div>
	</div>
</body>
</html>