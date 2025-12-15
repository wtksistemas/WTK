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

// funcion para determinar si el usuario que solicita cambio de contraseña esta dentro de la bd
function verifica_usuario($persona)  
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
	// Validar entrada de datos
	if(empty($user1) || empty($password1))
	{
		Header("Location: ../index.html?v=1"); // si algun campo esta vacio regresa al index
		exit();
	}
	// preparacion de consulta para buscar usuario
	$sql="SELECT ID, c_usuario, CAST(AES_DECRYPT(c_password, ?) as char)as c_password FROM tb_usuarios WHERE c_usuario=?";
	$stmt = $conn->prepare($sql);
	// Si la consulta no se prepara correctamente
	if(!$stmt)
	{
		header("Location: ../index.html?v=0");
		exit();
	}
	$stmt->bind_param("ss",$llave,$user1);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if(!$row)
	{
		$stmt->close();
		$conn->close();
		header("Location: ../index.html?v=9");
		exit();
	}
 	// Guardamos los datos del usuario
 	$id=$row['ID'];
 	$user_msql=$row['c_usuario'];
	$pass_msql=$row['c_password'];
 	// comparamos contraseñas
 	if($user_msql === $user1 && $pass_msql === $password1)
 	{
		// Iniciamos variables globales de sesion PHP
		session_start();
		session_regenerate_id(true);
		$_SESSION['logeado'] = true;
    	$_SESSION['user_id'] = $id;
    	$_SESSION['username'] = $user_msql;
		$stmt->close();
		$conn->close();
		header("Location: /portal/Modulo_Principal/menu.php");
        exit();
 	}
 	// si el usuario o la contraseña no coincide
 	else
	{
		$stmt->close ();
		$conn->close();
		header("Location: ../index.html?v=3");
		exit();
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



function registra_checada($id_usuario) // Funcion para registrar checada
{
	require(__DIR__ . '/dbconnect.php'); // cargamos archivo para conectarnos a BD
	$fecha_actual = new DateTime(); // obtenemos fecha actual
	$fecha_actual->setTimezone(new DateTimeZone('UTC')); // establecemos zona horaria UTC
	$fecha_para_mysql_utc = $fecha_actual->format('Y-m-d'); // formateamos fecha para mysql


	$hora_actual = new DateTime(); // obtenemos hora actual
	$hora_actual->setTimezone(new DateTimeZone('america/Mexico_City')); // establecemos zona horaria UTC
	$hora_para_mysql_utc = $hora_actual->format('H:i:s'); // formateamos hora para mysql

 	// Verificamos si la última checada fue de entrada o salida
	$sql_verifica="SELECT c_tiporegistro FROM tb_checador WHERE c_idusuario=? ORDER BY c_fecha DESC, c_horaregistro DESC LIMIT 1";
	$stmt_verifica = $conn->prepare($sql_verifica);
	$stmt_verifica->bind_param("i",$id_usuario);
	$stmt_verifica->execute();
	$result_verifica = $stmt_verifica->get_result();
	$row_verifica = $result_verifica->fetch_assoc();
	$tipo_ultima_checada = $row_verifica['c_tiporegistro'];
	$stmt_verifica->close();
	// Determinamos el tipo de checada a registrar
	if ($tipo_ultima_checada === "salida" || $tipo_ultima_checada === null || $tipo_ultima_checada === "") {
	    $tipo_registro = "entrada";
	} else {
	    $tipo_registro = "salida";
	}




	// preparacion de consulta para insertar checada
	$sql="INSERT INTO tb_checador (c_idusuario, c_fecha,c_horaregistro,c_tiporegistro) VALUES (?,?, ?, ?)";
	$stmt = $conn->prepare($sql);
	// Si la consulta no se prepara correctamente
	if(!$stmt)
	{
		header("Location: ../../index.html?v=0");
		exit();
	}
	$stmt->bind_param("isss",$id_usuario,$fecha_para_mysql_utc,$hora_para_mysql_utc, $tipo_registro);
	$stmt->execute();
	
	$stmt->close();
	$conn->close();
	header("Location: /portal/Modulo_Principal/checador.php");
	exit();
}
	
?>