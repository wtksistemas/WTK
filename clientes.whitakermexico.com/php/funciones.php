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

function verifica_usuario($persona) // funcion para determinar si el usuario que solicita cambio de contraseña esta dentro de la bd 
{
	include_once("dbconnect.php");	
	// estatus de token
	$estado_tkn="Activo";
	$espacio=" ";
	$tipo_token1="URL";
	$tipo_token2="AUTH";
	//Definicion de variables de validacion
	$r9=NULL;
	$tkn=NULL;
	$tkn2=NULL;
	// Seccion de consultas 
	$sql = "select ID,c_usuario from tb_usuarios where c_usuario='".$persona."';";

	// buscamos al usuario que solicita la accion 
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$num_rows = mysqli_num_rows($result);

	// Si el numero de filas obtenidas de la consulta es mayor a 0 guardamos el id y usuario obtenido 
	if($num_rows>0)
		{
			$id_obtenido=$row["ID"];
			$user_msql=$row["c_usuario"];
		}

	// Si la consulta no arroja ningun resultado..
 	if($row == false) 
		{
			$r9="consulta no valida";
		}
	if($num_rows>0 && $persona==$user_msql) // si el numero de filas recibidas por la consulta es mayor a 0 y el usuario es igual al solicitante
		{
			// Generamos token
			$t1=token();
			$t2=token_2();

			// secccion de inserciones 
			$query="insert into tb_token (ID,id_cusuario,c_token,c_tipotoken,c_estado) values('".$espacio."','".$id_obtenido."','".$t1."','".$tipo_token1."','".$estado_tkn."')";
			$query2="insert into tb_token (ID,id_cusuario,c_token,c_tipotoken,c_estado) values('".$espacio."','".$id_obtenido."','".$t2."','".$tipo_token2."','".$estado_tkn."')";

			// insertamos tokens
			$result_t1=mysqli_query($conn,$query);
			$result_t2=mysqli_query($conn,$query2);
			$r9=1;
		}
	else	//si no se encuentra el usuario asigna mensaje de error
		{
			$r9="Usuario no existente"; 
		}	
	
	mysqli_close($conn);	//cierra la conexion de bd 
	return [$t1,$t2];	//retorna los 2 tokens generados
}




function login_user($user1,$password1) // Funcion para inicio de sesion 
{
	require(__DIR__ . '/dbconnect.php'); // cargamos archivo para conectarnos a BD


	// Variables de validacion
	$w=$user1;
	// Seccion de consultas
	$sql = "select c_usuario,cast(aes_decrypt(c_password,'".$llave."')as char) from tb_usuarios where c_usuario='".$user1."';";

	
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_NUM);// almacena la consulta en un arreglo
	
	if($row == false)//si no encuentra al usuario te regresa al incio 
		{
			
			header("Location: ../index.html?v=9");

		}


	$user_msql=$row[0]; //Guardamos usuario obtenido por consulta
	$pass_msql=$row[1]; //Guardamos contraseña obtenida por consulta


	$num_rows = mysqli_num_rows($result); //Comprobacion de la fila del usuario
	echo $num_rows."\n";


	if($user1<>'' || $pass_msql <>'')//si el usuario ingresado esta vacio o la contraseña vacio 
		{
			if($user_msql==$user1) //si el usuario ingresado es identico a la bd 
				{
					if($pass_msql==$password1) //si la contraña ingresada es identica a la bd
						{
							session_start();	//inicia sesion
							$_SESSION['id']='888';	//asigna un valor de id a la sesion
							header("Location: ../1/menu.php");	//envia al menú
						}
					else	//si es contraseña es incorrcto envia al index valor 3
						{
	    					/*    session_destroy(); */
							header("Location: ../index.html?v=3"); 
						}
				}
			else	//si el usuario es incorrecto envia al index con valor 9
				{
					header("Location: ../index.html?v=9");  
				}
		}
}


function com_tkn($tk1,$tk2)	//funcion para comprobar token ingresado para cambiar contraseña
{	
	require(__DIR__ . '/dbconnect.php');	//carga al archivo para conectarse a la bd

	$z=null;
	$token_obtenido2=0;	//Definicion de variables de validacion
	$token_obtenido1=0;
	$row2='0';
	// Seccion de consultas 
	$sql = "select c_token, c_tipotoken, c_estado from tb_token where c_token='".$tk1."'and c_estado = 'activo' and c_tipotoken='AUTH' ;";
	$sql2 = "select c_token, c_tipotoken, c_estado from tb_token where c_token='".$tk2."'and c_estado = 'activo' and c_tipotoken='URL' ;";

	// buscamos el token de 4 digitos y que este activo 
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$num_rows = mysqli_num_rows($result); //numero de fila donde el token existe y esta en  activo
	$token_obtenido1=$row["c_token"];

	// buscamos el token de url y que este activo 
	$result2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
	$num_rows2 = mysqli_num_rows($result2); //numero de fila donde el token existe y esta en  activo
	$token_obtenido2=$row2[0];

	
		//Si en la consulta hay una fila es valido para cambiar contraseña
		if ($num_rows>0 && $num_rows<> NULL && $tk1==$token_obtenido1)
		{
			if($num_rows2>0 && $num_rows2<> NULL && $tk2==$token_obtenido2)
			{
				header("Location: ../confirmacion.html");
				return $z;
			}
			else
			{
				header("Location: ../generacion.php?v=11&tkn=".$tk2."");
				return $z;
	
			}
		}
		else
		{ 		//si en alguna de las consultas no hay un resultado te regresa para volver ingresar el token
			header("Location: ../generacion.php?v=10&tkn=".$tk2."");
			return $z;
		}	
}


?>