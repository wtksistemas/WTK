<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Confirmacion</title>
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<div class="container-1">
		<div class="login-container">		
			<img class="logo" src="assets/img/contraseña.png" alt="Logo">
			<h2>Contraseña</h2>
			<form action="actions/auth/puente_cambio_pass.php" method="post">
				<input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['tkn'] ?? ''); ?>">
				<script src="assets/js/script.js"></script>
				<input type="password" name="pass1" id="contrasena1" placeholder="Nueva contraseña">
				<input type="password" name="pass2" id="contrasena2" placeholder="Confirmacion tu nueva contraseña" >
				<label id="mensaje">Ingresa tu contraseña</label>
				<button id="btn" type="submit" >Cambiar contraseña</button>
            </form>
        </div>
    </div>
</body>
</html>
<!-- REVISAR EL SCRIPT PARA VALIDAR QUE LAS CONTRASEÑAS COINCIDAN Y HABILITAR EL BOTON SOLO CUANDO SE CUMPLA ESA CONDICION, ADEMAS DE QUE NO SE PUEDA ENVIAR EL FORMULARIO SI LAS CONTRASEÑAS NO COINCIDEN O ESTEN VACIAS -->