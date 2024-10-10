<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Genera tu nueva contraseña</title>
	<link rel="stylesheet" href="../css/styles.css">
	<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
</head>

	
<body>
	<div class="container-1">
		<h1>Portal de Seguimiento para Clientes</h1>
       		<div class="login-container">
				<img class="logo" src="../img/salario.png" alt="Logo">
					<h2>Cambio de contraseña</h2>
                <form action="php/restablece.php" method="post">
					<label name="correo">Ingresa el codigo que enviamos a tu correo</label>
					<input type="number" name="token" placeholder="token">
                    <button type="submit">Enviar</button>
					<button type="button" onclick="window.location.href='https://clientes.whitakermexico.com/index.php';">Página Principal</button>

                </form>
            </div>
        </div>
	
<script src="js/script.js"></script>

</html>
