<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Genera tu nueva contraseña</title>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>

<?php

$t=$_GET["tkn"];

?>
<body>
	<div class="container-1">
		<h1>Portal de Seguimiento para Clientes</h1>
       		<div class="login-container">
				<img class="logo" src="img/salario.png" alt="Logo">
					<h2>Cambio de contraseña</h2>
                <form action="php/comprueba_token.php" method="post">
					<label name="correo">Ingresa el codigo que enviamos a tu correo</label>
					<input type="number" name="token" placeholder="token">
					<input type="hidden" name="url_token" value="<?php echo $t;?>">
                    <button type="submit">Enviar</button>
					<button type="button" onclick="window.location.href='index.html';">Página Principal</button>

                </form>
            </div>
        </div>
	
<script src="js/script.js"></script>

</html>
