<?php

//$user=$_POST['username'];
//$password=$_POST['password'];

function login_user($user1, $password1)
{
    require_once("php/dbconnect.php"); // Usamos la conexión global a la base de datos

$w=$user1;
$sql = "select c_usuario,cast(aes_decrypt(c_password,'".$llave."')as char) from tb_usuarios where c_usuario='".$w."';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$user_msql=$row["c_usuario"]; //verifica usuario 
$pass_msql=$row["cast(aes_decrypt(c_password,'".$llave."') as char)"]; //verifica contraseña




$num_rows = mysqli_num_rows($result);


echo $num_rows."\n";

if($user_msql==$user1)
{
	if($pass_msql==$password1)
		{
			session_start();
			/* header("Location: https://clientes.whitakermexico.com/1/menu.php"); */
			header("Location: 1/menu.php");
		}
		else
		{
	    	/*    session_destroy();
			header("Location: https://clientes.whitakermexico.com/"); */
	 		echo "hola ".$pass_msql." n ".$password1;
		}
}
else
{
	echo "USUARIO NO EXISTE";	
}
}


$a = login_user('sistemas@whitakermexico.com','WTK$cuesta01');


?>