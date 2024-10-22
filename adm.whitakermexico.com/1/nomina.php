<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="php/calculo.php">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">

</head>
<body>
	
	<?php
		session_start();
	
	
	  include "../php/control.php";
	
error_reporting(0);
	
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
	
    <!-- Menú lateral izquierdo -->
    <div class="menu-lateral">
        <a href="menu.php"><img src="img/logo.svg" alt="Imagen superior"></a>

		
		<!--AGREGAR COMO LISTA-->
		<ul class="nav">
			<li><a href="#">Calculo de nomina</a></li>
            <li><a href="#">Recibos de nomina</a></li>
            <li><a href="#">Datos de empleado</a></li>
		</ul>

    </div>
	
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
		
	 <!-- Menú superior -->
	<div class="menu-superior">
		<div class="opciones">
			<a href="nomina.php">Nómina</a>
			<a href="legal.php">Legal</a>
			<a href="rh.php">RH</a>

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
	<div></
	

        <div class="contenido">
            <!-- Barra de búsqueda -->
		
			
	<div class="container">
		<form class="formulario" action="php/calculo.php" method="post">
				<h2 class="titulo">Calculo de Nomina<br><small>Del Empleado</small></h2>
			
			<div class="fila">
				
				<label name="piramidacion">Piramidación</label>
				<select id="piramidacion" name="piramidacion">
					<option value="qwerty">	--	</option>
					<option value="qwerty">Bruto objetivo</option>
					<option value="QWERTY">Neto objetivo</option>
				</select>
				
				<label name="v_isr">ISR Determinado</label>
				<input disabled type="text" placeholder="0.000" name="v_isr" value="<?php echo $_GET["visr"];?>">	
			</div>
			 
			 <div class="fila">
				<label name="v_mensual">Base Mensual</label>
				<input type="text" placeholder="Ingrese un número" name="salario" value="<?php echo $_GET["sbase"];?>">
				 
				<label name="v_sub">Subsidio al empleo</label>
				<input disabled type="text" placeholder="0.000" name="v_sub" value= "<?php echo $_GET["vsub"];?>">	 
			</div>		
	
			<div class="fila">
				<label name="v_priesgo">Prima de riesgo</label>
				<input type="text" placeholder="Ingrese el valor de prima de riesgo a considerar" name="priesgo" value= "<?php echo $_GET["vprima"];?>">
				<label name="v_isrr">ISR Retenido</label>
				<input disabled type="text" placeholder="0.000" name="v_isrr" value= "<?php echo $_GET["visrr"];?>">
			 </div>


			<div class="fila">
				<label name="vacio"></label>
				<label name="vacio"></label>
				<label name="v_imss">Cuota Imss</label>
				<input disabled type="text" placeholder="0.000" name="v_imss" value= "<?php echo $_GET["vimss"];?>">
			</div>
			 
			<div class="fila">
				<label name="vacio"></label>
				<label name="vacio"></label>
				<label name="v_neto">Neto a pagar</label>
				<input disabled type="text" placeholder="0.000" name="v_neto" value= "<?php echo $_GET["vneto"];?>">
			</div>
		
			<div class="botones">
				<button class="boton" type="submit">Enviar</button>
				<button class="boton" type="button" onclick="window.location.href='nomina.php'">Borrar</button>
			</div>
			 
		</form>
	</div>
			
			
<div class="container">	
		<form class="formulario" action="php/calculo.php" method="post">
        	<h2 class="titulo">Cuotas Patronales<br><small>Por el Empleado</small></h2>
			
			<div class="fila">
				<label name="v_imssp">IMSS</label>
				<input disabled type="text" placeholder="0.000" name="v_imssp" value= "<?php echo $_GET["vimssp"];?>">
			</div>
			<div class="fila">
				<label name="v_infonavit">Infonavit</label>
				<input disabled type="text" placeholder="0.000" name="v_infonavit" value= "<?php echo $_GET["vinfo"];?>">
			</div>
			<div class="fila">
				<label name="v_infonavit">ISN (CDMX)</label>
				<input disabled type="text" placeholder="0.000" name="v_isn" value= "<?php echo $_GET["visn"];?>">
			</div>	
			<div class="fila">
				<label name="v_netop">Total de aportaciones</label>
				<input disabled type="text" placeholder="0.000" name="v_netop" value= "<?php echo $_GET["vcosto"];?>">
			</div>

		</form>
		
</div>			
			
			
			
			
			
            <!-- Lista de expedientes -->
<!--            <div class="expediente">
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


