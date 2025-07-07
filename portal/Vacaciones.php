<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/style.css">
	<script src="js/script.js"></script>
</head>

<body>
	
	<?php
	//	session_start();
	  //include "../php/control.php";
	//if (/$_SESSION['id'] == '888')
	//	{
	//	}
	//	else{
	//		header("Location:../index.html");
	//	}	
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
		<!-- Opciones del menú -->
		<div class="opciones">


			<ul class="menu">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">Checador</a>
					<ul class="submenu">
						<li><a id="submenu" href="checador.php">Ver Checador</a></li>
						<li><a id="submenu" href="vacaciones.php">Vacaciones</a></li>
					</ul>
				</li>
			</ul>
			
			<ul class="menu">
				<li><a href="notificaciones.php">Notificaciones</a></li>
			</ul>

			<ul class="menu">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">Nóminas</a>
					<ul class="submenu">
						<li><a id="submenu" href="nominas/nomina.php">Cotizador</a></li>
						<li><a id="submenu" href="nominas/validacion.php">Validación de cuentas</a></li>
					</ul>
				</li>
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
				//echo "<span style='color: white;'>".$_SESSION['username']."</span>";
			?>
			<a href="../php/logout.php"><button type="button">Cerrar sesión</button></a>

		</div>
	</div>

	<!-- Módulo de Vacaciones -->
	<div class="modulo-vacaciones">
    	<h1 class="titulo-vacaciones">Vacaciones</h1>

	    <div class="contenido-vacaciones">
    	    <!-- Panel Izquierdo -->
        	<div class="panel-izquierdo">
            	
				<div class="info-empleado">
                	<p><strong>ID del empleado:</strong> 12345</p>
                	<p><strong>Vacaciones disponibles:</strong> 10 días</p>
                	<p><strong>Vacaciones tomadas:</strong> 5 días</p>
					<p><strong>Nuevo saldo:</strong> 2 días</p>
            	</div>

            	<form class="formulario-vacaciones">
             	   <h2>Solicitar Vacaciones</h2>
              	  <label for="fechaInicio">Inicio:</label>
              	  <input type="date" id="fechaInicio" name="fechaInicio" required>

             	   <label for="fechaFin">Fin:</label>
              	  <input type="date" id="fechaFin" name="fechaFin" required>

             	   <label for="motivo">Motivo:</label>
              	  <textarea id="motivo" name="motivo" rows="3" placeholder="Escribe el motivo..." required></textarea>

             	   <button type="submit">Solicitar</button>
          	  </form>
       	 </div>

   	     <!-- Panel Derecho -->
       	<div class="panel-derecho">
            <iframe src="https://calendar.google.com/calendar/embed?src=es.mexican%23holiday%40group.v.calendar.google.com&ctz=America%2FMexico_City" 
                    style="border: 0" 
                    width="100%" 
                    height="400" 
                    frameborder="0" 
                    scrolling="no">
            </iframe>
        </div>
    </div>
</div>


    </div>
</body>
</html>