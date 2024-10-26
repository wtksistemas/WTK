<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<script src="../js/script.js"></script>

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

    <!-- Contenedor principal -->
    <div class="contenedor-principal">		
		 <!-- Menú superior -->
		<div class="menu-superior">

			<div class="opciones">
				<a href="nomina.php">Nómina</a>
			</div>
        
			<div class="perfil">

  				  <?php
  				      echo "<span style='color: white;'>".$_SESSION['username']."</span>";
  				  ?>
    
  				  <a href="../php/logout.php"><button type="button">Cerrar sesión</button></a>
			</div>
		</div>
	

        <div class="formularios-contenedor">

			<div class="formulario-izquierda">
				<form class="formulario" action="php/calculo.php" method="post">

					<h2 class="titulo">Calculo de Nomina<br><small>Del Empleado</small></h2>
			
					<div class="fila">
						<label name="piramidacion">Piramidación</label>
						
							<select id="piramida" name="piramida" onchange="netoaobjetivo()">
								<option value="Base Mensual">	--	</option>
								<option value="Bruto Mensual Objetivo">Bruto objetivo</option>
								<option value="Neto Mensual objetivo">Neto objetivo</option>
							</select>
				
						<label name="v_isr">ISR Determinado</label>
						<input disabled type="text" placeholder="0.000" name="v_isr" value="<?php echo $_GET["visr"];?>">	
					</div>
			 
					<div class="fila">
						<label name="v_mensual" id="v_mensual">Base Mensual</label>
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
						<label name="v_neto" id="v_neto">Neto a pagar</label>
						<input disabled type="text" placeholder="0.000" name="v_neto" value= "<?php echo $_GET["vneto"];?>">
					</div>
		
					<div class="botones">
						<button class="boton" id="b1" type="submit">Enviar</button>
						<button class="boton" id="b2"type="button" onclick="window.location.href='nomina.php'">Borrar</button>
					</div>
			 
				</form>
			</div>
			
			
			<div class="formulario-derecha">	
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

        </div>

    </div>
</body>
</html>