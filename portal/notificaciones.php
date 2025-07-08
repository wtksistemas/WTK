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
	</header>
	

	-->
	   
	
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

	
		<!-- 		<ul class="menu" id="reloj-menu">
				<li>
					<div class="mini-reloj" id="reloj" role = "button" tabindex="0"> 
						<div class="hora" id="hora-actual"></div>
						<div class="icono" id="icono-dia-noche"></div>
					</div>
				</li>
			</ul>-->

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
			<div id="formulario-reloj" class="formulario-reloj" style ="display: none;">
  				<button class="boton-checar" id="boton-checar">Checar</button>
			</div>
	</div>

	<!-- Módulo de Notificaciones  -->
	<div class="modulo-vacaciones">
    	<h1 class="titulo-vacaciones">Notificaciones</h1>

    </div>

	<div class="modulo-notificaciones">
		
		<div class="grid-areas">

    	<div class="area-tarjeta" onclick="mostrarNotificaciones('vacaciones')">
    		<span class="badge" id="badge-vacaciones"></span>     		
			<img src="img/vacaciones.png" alt="Vacaciones">		        
			<p>Vacaciones</p>
		</div>
    
   		<div class="area-tarjeta" onclick="mostrarNotificaciones('facturas')">
        	<span class="badge" id="badge-facturas"></span>  
			<img src="img/factura.png" alt="Facturas">
        	<p>Facturas</p>
    	</div>
    
    	<div class="area-tarjeta" onclick="mostrarNotificaciones('rh')">
        	<span class="badge" id="badge-rh"></span>
        	<img src="img/rh.png" alt="Recursos Humanos">
        	<p>RH</p>
    	</div>
    
    	<div class="area-tarjeta" onclick="mostrarNotificaciones('ti')">
        	<span class="badge" id="badge-ti"></span>
        	<img src="img/ti.png" alt="TI">
        	<p>TI</p>
    	</div>
    
   		 <div class="area-tarjeta" onclick="mostrarNotificaciones('legal')">
       		<span class="badge" id="badge-legal"></span>
        	<img src="img/legal.png" alt="Legal">
        	<p>Legal</p>
    	</div>
    
    	<div class="area-tarjeta" onclick="mostrarNotificaciones('contabilidad')">
        	<span class="badge" id="badge-contabilidad"></span>
        	<img src="img/contabilidad.png" alt="Contabilidad">
        	<p>Contabilidad</p>
    	</div>
    
    	<div class="area-tarjeta" onclick="mostrarNotificaciones('gastos')">
        	<span class="badge" id="badge-gastos"></span>
        	<img src="img/gastos.png" alt="Gastos">
        	<p>Gastos</p>
    	</div>
    
    	<div class="area-tarjeta" onclick="mostrarNotificaciones('permisos')">
        	<span class="badge" id="badge-permisos"></span>
        	<img src="img/permisos.png" alt="Permisos">
        	<p>Permisos</p>
    	</div>
</div>


</div>

<div id="contenedor-notificaciones" class="contenedor-notificaciones"></div>

</div>

</div>


    </div>



<script src="js/script.js"></script>
</body>
</html>