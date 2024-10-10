<?php


require_once("dbconect.php");

$usuario=$_POST['username'];
$pass=$_POST['password'];
	


echo "Pagina php para iniciar sesion: <br><br>".$usuario." ".$pass."";


$query="select * form tb_usuarios where c_usuario=".$usuario.";";

$result=mysqli_query($conn,$query);
$row= mysqli_fetch_array($result, MYSQLI_ASSOC);


$id=$row["ID"];
$usuario2=$row["c_usuario"];
$pass2=$row["password"];






?>