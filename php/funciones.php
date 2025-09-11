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
	$t1=null;
	$t2=null;

	//Definicion de variables de validacion
	$r9=NULL;
	$tkn=NULL;
	$tkn2=NULL;


	// Seccion de consultas 
	$stmt=$conn->prepare("SELECT id, c_usuario FROM tb_usuarios WHERE c_usuario= ?");
	$stmt->bind_param("s",$persona);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();


	// Si el numero de filas obtenidas de la consulta es mayor a 0 guardamos el id y usuario obtenido 
	if($row)
		{
			$id_obtenido=$row["id"];
			$user_msql=$row["c_usuario"];
		// Generamos token
			$t1=token();
			$t2=token_2();


			// Insertar tokens
        $stmt1 = $conn->prepare("INSERT INTO tb_token (id_cusuario, c_token, c_tipotoken, c_estado) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("isss", $id_obtenido, $t1, $tipo_token1, $estado_tkn);
        $stmt1->execute();

        $stmt2 = $conn->prepare("INSERT INTO tb_token (id_cusuario, c_token, c_tipotoken, c_estado) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("isss", $id_obtenido, $t2, $tipo_token2, $estado_tkn);
        $stmt2->execute();

        $stmt1->close();
        $stmt2->close();
		}
	else	//si no se encuentra el usuario asigna mensaje de error
		{
			$conn->close();
			return[null,  null];
		}	
	
	$stmt->close();	
	$conn->close(); //cierra la conexion de bd 
	return [$t1,$t2];	//retorna los 2 tokens generados
}




function login_user($user1,$password1) // Funcion para inicio de sesion 
{
	require(__DIR__ . '/dbconnect.php'); // cargamos archivo para conectarnos a BD


	// Variables de validacion
	$w=$user1;
	// Seccion de consultas
	$sql = "select c_nombre,c_usuario,cast(aes_decrypt(c_password,'".$llave."')as char) from tb_usuarios where c_usuario='".$user1."';";

	
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_NUM);// almacena la consulta en un arreglo
	
	if($row == false)//si no encuentra al usuario te regresa al incio 
		{
			
			header("Location: ../index.html?v=9");

		}

	$user_nombre=$row[0];// Guardamos el nombre del usuario obtenido por la consulta
	$user_msql=$row[1]; //Guardamos usuario obtenido por consulta
	$pass_msql=$row[2]; //Guardamos contraseña obtenida por consulta


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
							$_SESSION['username']=$user_nombre;
							$_SESSION['mail']=$user_msql;
							header("Location: ../portal/Modulo_Principal/menu.php");	//envia al menú
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
				
				//actualizar el estado de los tokens a "Validado"
				$update_sqli = "UPDATE tb_token SET c_estado = 'Validado' WHERE c_token='" . $tk1 . "' AND c_tipotoken='AUTH';";
				$update_sql2 = "UPDATE tb_token SET c_estado = 'Validado' WHERE c_token='" . $tk2 . "' AND c_tipotoken='URL';";


				mysqli_query($conn,$update_sqli);
				mysqli_query($conn, $update_sql2);

				session_start();	//inicia sesion
				$_SESSION['token_url']=$token_obtenido2;	//asigna un valor de id a la sesion
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

//cambio de contraseña
function cmb_pass($token_url,$newpass)
{
	session_start();
	require(__DIR__ . '/dbconnect.php');//conexión de base de datos

	$pass_encri="AES_ENCRYPT('" . $newpass . "','" . $llave . "')";//incriptacion

	$sql_buscar_user =  "SELECT id_cusuario FROM tb_token WHERE c_token='" . $token_url . "' AND c_tipotoken='URL' AND c_estado='Validado';"; //Búsqueda del usuario asociado al token:

	$resultado = mysqli_query($conn,$sql_buscar_user); //consulta
	$row= mysqli_fetch_array($resultado,MYSQLI_ASSOC);

	if($row)
	{	
		$id_user=$row['id_cusuario'];
		$update_sql = "UPDATE tb_usuarios SET c_password = " . $pass_encri . " WHERE ID = '" . $id_user . "';";

		if(mysqli_query($conn,$update_sql))
		{

			echo "Contraseña cambiado exitoso";
			header("Location: ../index.html");
			session_destroy();

		} else
			{
				echo "Error al cambiar la contraseña" . mysqli_error($conn);			
			}
	}
	else {
		echo "Token inválidado o usuarios no encontrados";
	}
	mysqli_close($conn);	//cierra la conexion de bd 

	

}

?>