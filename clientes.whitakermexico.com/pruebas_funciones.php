<?php

//$tk=$_POST['token'];
function com_tkn($tk1)
{	
	require_once('php/dbconnect.php');
	require(__DIR__ . '/php/funciones.php');

	$z=null;


list($a,$b)=verifica_usuario('sistemas@whitakermexico.com');

	$sql = "select c_token, c_estado from tb_token where c_token='".$tk1."'and c_estado = 'activo' ;";
	// buscamos al usuario que solicita la accion 
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$num_rows = mysqli_num_rows($result);

	if ($num_rows>0){
		$z="verdadero";
		return $z;
	}else{
		$z="falso";
		return $z;
	}
}





$y=com_tkn(1);
echo $y;
?>