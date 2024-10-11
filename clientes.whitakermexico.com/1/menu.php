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
        <a href="/menu.php"><img src="img/logo.svg" alt="Imagen superior"></a>
	
		
		
		<!--AGREGAR COMO LISTA-->
		<ul class="nav">
			<li><a href="#">Eventos</a></li>
            <li><a href="#">Facturas</a></li>
            <li><a href="#">Extra</a></li>
		</ul>

    </div>
	
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
		
	 <!-- Menú superior -->
	<div class="menu-superior">
		<div class="opciones">
			<a href="/nomina.php">Nómina</a>
			<a href="/legal.php">Legal</a>
			<a href="/rh.php">RH</a>
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
					
			
			<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FMexico_City&bgcolor=%23EF6C00&title=MI%20CALENDARIO&src=c2lzdGVtYXNAd2hpdGFrZXJtZXhpY28uY29t&color=%23039BE5" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>

            <!-- Barra de búsqueda 
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
 -->
            <!-- Lista de expedientes 
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
            </div>-->

            <!-- Puedes agregar más expedientes aquí -->

        </div>

    </div>
</body>
</html>