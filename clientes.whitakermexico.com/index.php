<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Portal de seguimiento</title>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>
	<div class="container-1">
		<h1>Portal de Seguimiento para Clientes</h1>
       		<div class="login-container">
				<img class="logo" src="img/salario.png" alt="Logo">
					<h2>Inicia Sesion</h2>
                <form action="php/sesion.php" method="post">
					<input type="text" name="username" placeholder="Correo electronico" value="<?php echo $_GET["username"];?>">
					<input type="password" name="password" placeholder="Contraseña">
				<div class="links">
					<a href="restablecer.html">¿Olvidaste tu contraseña?<br> </a>
					<a href="registro.html">Registrate en nuestro portal</a>	
				</div>
                    <button type="submit">Inicia Sesion</button>
                </form>
            </div>
        </div>
	
<script src="js/script.js"></script>
</body>
</html>











