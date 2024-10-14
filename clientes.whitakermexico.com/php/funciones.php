<?php
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

/*Insercion de token a BD 
function insertar_tkn($solicitante,$t1,$t2)
{

	require_once (__DIR__ . "/dbconnect.php");
	$r5=0;


	// estatus de token
	$estado_tkn="Activo";
	$espacio=" ";
	$tipo_token1="URL";
	$tipo_token2="AUTH";


	// consultas de insersion 
	$query="insert into tb_token (ID,id_cusuario,c_token,c_tipotoken,c_estado) values('".$espacio."','12','".$t1."','".$tipo_token1."','".$estado_tkn."')";
	$query2="insert into tb_token (ID,id_cusuario,c_token,c_tipotoken,c_estado) values('".$espacio."','12','".$t2."','".$tipo_token2."','".$estado_tkn."')";
	
	if ($conn->ping()) // si la conexion a bd es exitosa se instertan los tokens
		{
			$r5=1;
			$result=mysqli_query($connn,$query);
			$result2=mysqli_query($connn,$query2);
			//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		}
		mysqli_close($conn);

return $r5;

}
*/
function verifica_usuario($persona) // funcion para determinar si el usuario que solicita cambio de contraseña esta dentro de la bd 
{
	include_once("dbconnect.php");	
	// estatus de token
	$estado_tkn="Activo";
	$espacio=" ";
	$tipo_token1="URL";
	$tipo_token2="AUTH";

	$r9=NULL;

	// Generamos token
	$t1=token();
	$t2=token_2();



	// Seccion de consultas 
	$sql = "select ID,c_usuario from tb_usuarios where c_usuario='".$persona."';";

	// buscamos al usuario que solicita la accion 
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$id_obtenido=$row["ID"];
	$user_msql=$row["c_usuario"];
	$num_rows = mysqli_num_rows($result);


	// secccion de inserciones 
	$query="insert into tb_token (ID,id_cusuario,c_token,c_tipotoken,c_estado) values('".$espacio."','".$id_obtenido."','".$t1."','".$tipo_token1."','".$estado_tkn."')";
	$query2="insert into tb_token (ID,id_cusuario,c_token,c_tipotoken,c_estado) values('".$espacio."','".$id_obtenido."','".$t2."','".$tipo_token2."','".$estado_tkn."')";
	
 	if($row == false) 
		{
			$r9="consulta no valida";
		}
	if($num_rows>0 && $persona==$user_msql) // si el numero de filas recibidas por la consulta es mayor a 0 y el usuario es igual al solicitante
		{

			// insertamos tokens
			$result_t1=mysqli_query($conn,$query);
			$result_t2=mysqli_query($conn,$query2);
			$r9=1;
		}
	else
		{
			$r9="Usuario no existente";
		}	
	mysqli_close($conn);
return $t1;
}

?>