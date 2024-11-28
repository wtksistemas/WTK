<?php
require_once("dbconnect.php");

//Variables de formulario
$cliente=$_POST['ncliente'];
$rfc=$_POST['rfc'];
$regimen=$_POST['rf'];
$calle=$_POST['calle'];
$nexterior=$_POST['exterior'];
$ninterior=$_POST['interior'];
$cp=$_POST['cp']

//echo "pagadora: ".$pagadadora."";


// Seccion de consultas e inserciones 	
$query="insert into tb_clientes (ID,c_razonsocial,c_rfc,c_regimen,c_calle,c_nexterior,c_ninterior,c_cp,c_estatus) values ('".$espacio."','".$cliente."','".$rfc."','".$regimen."','".$calle."','".$nexterior."','".$ninterior."'".$cp."','".$estatus."')";
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