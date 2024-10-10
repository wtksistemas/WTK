<?php
require_once("php/dbconect.php");
require_once("php/funciones.php");
function verifica_usuario($persona)
{
	//include("php/dbconnect.php");
	//include("php/funciones.php"); 
	$r9=NULL;
	$sql = "select ID,c_usuario from tb_usuarios where c_usuario='".$persona."';";
	$result = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$id=$row["ID"];
	$user_msql=$row["c_usuario"];
 	if($row == false) 
		{
			$r9="consulta_no valida";
		}
	$num_rows = mysqli_num_rows($result);
	if($num_rows>0 && $persona==$user_msql)
		{
  			//$r9="valido";
			$a1=token();
			$a2=token_2();
			$r9="Tokens Generados".$a1." - ".$a2;
			//insertar_tkn($persona,$a1,$a2);
		}
	else
		{
			$r9="no";
		}	
	mysqli_close($conn);
return $r9;
}

$aa=verifica_usuario('sistemas@whitakermexico.com');

echo $aa;




?>