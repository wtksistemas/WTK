<?php
require_once("dbconnect.php");

//Variables de formulario
$nombre     = trim($_POST['nombre'] ?? '');
$pagadadora = trim($_POST['empresa'] ?? '');
$division   = trim($_POST['div'] ?? '');
$mail       = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$contrasena = $_POST['password'] ?? '';
$telefono   = trim($_POST['fon'] ?? '');


$espacio=" ";
// verificamos todos los campos, si alguno esta vacio regresamos al formulario

if (!$nombre || !$pagadadora || !$division || !$mail || !$contrasena) {
    header("Location:../index.html?v=22"); // Datos incompletos
    exit;
}

// verificamos si el usuario ya existe en la BD

$stmt = $conn->prepare("SELECT c_usuario FROM tb_usuarios WHERE c_usuario = ?");
$stmt->bind_param("s", $mail);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    header("Location:../index.html?v=20"); // Usuario ya existe
    exit;
}
$stmt->close();


// Hash de la contraseña
$hash = password_hash($contrasena, PASSWORD_DEFAULT);


// Insertar nuevo usuario
$stmt = $conn->prepare("INSERT INTO tb_usuarios (c_empresa, c_nombre, c_usuario, c_password, c_telefono, c_division) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $pagadadora, $nombre, $mail, $hash, $telefono, $division);

if ($stmt->execute()) {
    header("Location:../index.html?v=21"); // Registro exitoso
} else {
    header("Location:../index.html?v=23"); // Error en el registro
}
$stmt->close();
$conn->close();
?>


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