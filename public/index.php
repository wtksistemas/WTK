<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Inicio de sesion</title>
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
	<script src="assets/js/script.js"></script>
</head>
<body>
	<div class="container-1">
		<h1>Portal de administración</h1>
       		<div class="login-container">
				<img class="logo" src="assets/img/inicio_sesion.png" alt="Logo">
					<h2>Inicia Sesión</h2>
                <form action="../src/auth/login_process.php" method="post">
					<input type="email" name="username" placeholder="Correo electrónico">
					<input type="password" name="password" placeholder="Contraseña">
				<div class="links">
					<a href="restablecer.php">¿Olvidaste tu contraseña? / </a>
					<a href="registro.php">Registrate en nuestro portal</a>					
				</div>
                    <button type="submit">Inicia Sesión</button>
                </form>
            </div>
        </div>
</body>
</html>