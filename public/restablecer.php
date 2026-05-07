<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>¿Olvidaste tu contraseña?</title>
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="assets/js/script.js"></script>
</head>
<body>
	<div class="container-1">
    	<div class="login-container">
			<img class="logo" src="assets/img/recuperar_cuenta.png" alt="Logo">
			<h2>Recupera tu cuenta</h2>
            <form action="../src/auth/restablecer_process.php" method="post">
				<label name="correo">Ingresa tu correo electrónico</label>
				<input type="email" name="username" placeholder="Correo electrónico">
                <button type="submit">Restablecer mi contraseña</button>
				<button type="button" onclick="window.location.href='index.php';">Regresar a menu principal</button>
            </form>
        </div>
    </div>
</body>
</html>