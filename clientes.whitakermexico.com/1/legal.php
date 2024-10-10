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
			header("Location: https://clientes.whitakermexico.com");
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
	
	

	
	
    <!-- Menú lateral izquierdo -->
    <div class="menu-lateral">
        <a href="https://clientes.whitakermexico.com/1/menu.php"><img src="img/logo.svg" alt="Imagen superior"></a>
		
		
		
		<!--AGREGAR COMO LISTA-->
		<ul class="nav">
			<li><a href="#">Coorporativo</a></li>
            <li><a href="#">Archivo</a></li>
            <li><a href="#">Expediente Virtual</a></li>
		</ul>

    </div>
	
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
		
	 <!-- Menú superior -->
	<div class="menu-superior">
		<div class="opciones">
			<a href="https://clientes.whitakermexico.com/1/nomina.php">Nómina</a>
			<a href="https://clientes.whitakermexico.com/1/legal.php">Legal</a>
			<a href="https://clientes.whitakermexico.com/1/rh.php">RH</a>
		</div>
        
		<div class="perfil">
			<button>Perfil</button>
			
	<?php
		echo"".$_SESSION['username']."" ;
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
				
				<select name="f_busqueda" id="f_busqueda">
					<option value="cliente">Cliente</option>
					<option value="n_escritura">N° de  Escritura</option>
					<option value="fecha">Fecha</option>
					<option value="nombre">Nombre</option>
				</select>
				
				<input type="text" placeholder="Informacion">				
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