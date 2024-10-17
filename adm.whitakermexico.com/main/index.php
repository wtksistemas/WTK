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

	
	<header>
		<nav class="top-nav">
			
			
		
		</nav>
	</header>
	
	
	
	
	
	
	
	
	
	
	
    <header>
        <div class="container">
            <nav>
                <ul class="menu">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Contabilidad</a></li>
                    <li><a href="#">Nóminas</a></li>
                    <li><a href="#">Legal</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </nav>
            <div class="profile">
                <a href="#">Perfil</a>
				<P>BIENVENIDO	<?php
		echo"".$_SESSION['username']."" ;
	?></P>
				<a href="../php/logout.php"><button type="button">Cerrar sesion</button></a>


            </div>
        </div>
    </header>

    <div class="container">
        <!-- Contenido de la página -->
    </div>

    <footer>
        <!-- Pie de página -->
    </footer>
</body>
</html>