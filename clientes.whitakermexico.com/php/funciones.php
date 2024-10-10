<?php

//require_once("dbconect.php");



/* Generacion de token para paso de url */
function token(){
    $r1 = bin2hex(random_bytes(10));
    
    $token = $r1;

    return $token;
}



/* Generacion de token para validar actividad de usuario */
function token_2(){
  
   $r2= random_int(1000,9999);
    $token2 = $r2;

    return $token2;
}


// Insercion de token a BD 
function insertar_tkn($solicitante,$t1,$t2)
{
//include("dbconnect.php");
	$r5=0;
	$estado_tkn="Activo";
	$espacio=" ";
	$tipo_token1="URL";
	$tipo_token2="AUTH";
	$query="insert into tb_token (ID,id_cusuario,c_token,c_tipotoken,c_estado) values('".$espacio."','12','".$t1."','".$tipo_token1."','".$estado_tkn."')";
	
	$query2="insert into tb_token (ID,id_cusuario,c_token,c_tipotoken,c_estado) values('".$espacio."','12','".$t2."','".$tipo_token2."','".$estado_tkn."')";

	
	if ($conn->ping())
		{
			$r5=1;
			$result=mysqli_query($conn,$query);
			$result2=mysqli_query($conn,$query2);
			//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		

		}
		mysqli_close($conn);

return $r5;

}
?>