<!doctype html>



<html>
	<head>
		<meta charset="utf-8">
		<title>CALCULO DE NOMINA</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="php/calculo.php">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<meta name="viewport" content="width=device-width,initial-scale=1">

	</head>
	<body>
	<?php
error_reporting(0); //eliminacion de notice 
?>

	<div class="container">
		
		 <form class="formulario" action="php/calculo.php" method="post">
			 
			<img class="logo" src="logo.svg" alt="Logo">
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
				<!--<label name="v_factor">Factor de integracion</label>
				<input type="text" placeholder="Ingrese el factor de integracion a considerar" name="factor" value="0.0">
				-->
				
<!--				<label name="v_imss">ISN</label>
				<select id="isn" name="isn">
					 <option value="qwerty">qwerty</option>
					 <option value="QWERTY">QWERTY</option>
				 </select>-->
<!--<?php /*?>				<input disabled type="text" placeholder="0.000" name="v_imss" value= "<?php echo $_GET["vimss"];?>">	
<?php */?>-->			
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
				<!--<input type="" placeholder="Ingrese el valor de prima de riesgo a considerar" name="priesgo" value="0.0">-->
				<!--   setlocale(LC_MONETARY, 'es_MX'); -->
				<label name="v_neto">Neto a pagar</label>
				<input disabled type="text" placeholder="0.000" name="v_neto" value= "<?php echo $_GET["vneto"];?>">
			</div>
			 
			 
			 
			<div class="botones">
				<button class="boton" type="submit">Enviar</button>
				<button class="boton" type="button" onclick="window.location.href='https://nomina.whitakermexico.com'">Borrar</button>
			</div>
			 
		</form>
	</div>
		
<div class="container">	
		<form class="formulario" action="php/calculo.php" method="post">
			<img class="logo" src="logo.svg" alt="Logo">
        	<h2 class="titulo">Cuotas Patronales<br><small>Por el Empleado</small></h2>
<!--			<div class="fila">
				<label name="campo1">Concepto</label>
				<label name="campo2">Valor</label>
			</div>-->
			


			<div class="fila">
				<label name="v_imssp">IMSS</label>
				<input disabled type="text" placeholder="0.000" name="v_imssp" value= "<?php echo $vimss;?>">
			</div>
			<div class="fila">
				<label name="v_infonavit">Infonavit</label>
				<input disabled type="text" placeholder="0.000" name="v_infonavit" value= "<?php echo $_GET['vinfo'];?>">
			</div>
			<div class="fila">
				<label name="v_infonavit">ISN (CDMX)</label>
				<input disabled type="text" placeholder="0.000" name="v_isn" value= "<?php echo $_GET['visn'];?>">
			</div>	
			<div class="fila">
				<label name="v_netop">Total de aportaciones</label>
				<input disabled type="text" placeholder="0.000" name="v_netop" value= "<?php echo $_GET["vcosto"];?>">
			</div>
			
			<!--
			<div class="fila">
				<label name="v_isr">ISR</label>
				<input disabled type="text" placeholder="0.000" name="v_isr" value="<?php echo $_GET["visr"];?>">
			</div>
			<div class="fila">
				<label name="v_imss">Cuota IMSS</label>
				<input disabled type="text" placeholder="0.000" name="v_imss" value= "<?php echo $_GET["vimss"];?>">
			</div>
			<div class="fila">
				<label name="v_neto">Neto a pagar</label>
				<input disabled type="text" placeholder="0.000" name="v_neto" value= "<?php echo $_GET["vneto"];?>">
			</div>
			<div class="botones">
				<button class="boton" type="submit">Enviar</button>
				<button class="boton" type="button" onclick="window.location.href='https://nomina.whitakermexico.com'">Borrar</button>
			</div>
-->
		</form>
		
</div>
		
		
		
	</body>
</html>



















































