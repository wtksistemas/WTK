<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Portal de seguimiento</title>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">

</head>

<body>
<?php

require_once("dbconnect.php");

$conn = mysqli_connect($host, $usr, $psr,$data_base);
$nombre_cliente=$_POST['username'];
$mail=$_POST['email'];
$contrasena=$_POST['password'];
$telefono=$_POST['fon'];
$espacio=" ";


	
$query="insert into tb_usuarios (ID,c_nombre,c_usuario,c_password,c_telefono) values
		('".$espacio."','".$nombre_cliente."','".$mail."',aes_encrypt('".$contrasena."','".$llave."'),'".$telefono."')";


 echo "Pagina php para Registrar usuario: <br><br>".$query.""; 

if ($conn->ping()) {
	
    echo ("\n ¡La conexión está bien!\n");
	echo "la base de datos es".$data_base."";
	
	$result=mysqli_query($conn,$query);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	


} 
	else 
	{
    printf ("Error: %s\n", $mysqli->error);
	}






if ($result!=1)
		{

			sleep(5);
			 /* header("Location:https://clientes.whitakermexico.com/registro.html?v=0"); */
	
	echo "\n si ".mysqli_error($conn)."";
	
		} 
	else
		{
	
			sleep(3);
		echo "\n no";
	
			header("Location:../index.html?v=1"); 

		}






?>
	
	</body>
</html>