<?php
require_once("dbconnect.php");

//Variables de formulario
$nombre=$_POST['nombre'];
$pagadadora=$_POST['empresa'];
$division=$_POST['div'];
$mail=$_POST['email'];
$contrasena=$_POST['password'];
$telefono=$_POST['fon'];
$espacio=" ";

//echo "pagadora: ".$pagadadora."";


// Seccion de consultas e inserciones 	
$query="insert into tb_usuarios (ID,c_empresa,c_nombre,c_usuario,c_password,c_telefono,c_division) values ('".$espacio."','".$pagadadora."','".$nombre."','".$mail."',aes_encrypt('".$contrasena."','".$llave."'),'".$telefono."','".$division."')";
$query2=" Select c_usuario from tb_usuarios where c_usuario='".$mail."'";

//Realizamos consulta para saber si exite ya el usuario registrado
$resultado=mysqli_query($conn,$query2);
$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
$num_rows=mysqli_num_rows($resultado);

if($num_rows==null || $num_rows='' || $num_rows=0)
{

	$nuevo_registro=mysqli_query($conn,$query);
	header("Location:../index.html?v=21"); 
}
else
{
	header("Location:../index.html?v=20"); 

}
mysqli_close($conn);

?>