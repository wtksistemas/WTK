<?php
require_once("dbconnect.php");

//Variables de formulario
$nombre     = trim($_POST['nombre'] ?? '');
$mail       = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$contrasena = $_POST['cfpassword'] ?? '';
$telefono   = trim($_POST['fon'] ?? '');
$rfc        = trim($_POST['rfc'] ?? '');



$espacio=" ";
// verificamos todos los campos, si alguno esta vacio regresamos al formulario


if (!$nombre || !$mail  || !$contrasena || !$telefono || !$rfc) {
    header("Location:../index.html?v=22"); // Datos incompletos
    exit;
}

// verificamos si el usuario ya existe en la BD

$stmt = $conn->prepare("SELECT c_rfc FROM tb_usuarios WHERE c_rfc = ?");
$stmt->bind_param("s", $rfc);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    header("Location:../index.html?v=20"); // rfc ya existe
    exit;
}

$stmt = $conn->prepare("SELECT c_rfc FROM tb_usuarios WHERE c_nombre = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    header("Location:../index.html?v=20"); // nombre ya existe
    exit;
}

$stmt = $conn->prepare("SELECT c_rfc FROM tb_usuarios WHERE c_usuario = ?");
$stmt->bind_param("s", $mail);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    header("Location:../index.html?v=20"); // mail ya existe
    exit;
}


$stmt = $conn->prepare("SELECT c_rfc FROM tb_usuarios WHERE c_telefono = ?");
$stmt->bind_param("s", $telefono);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    header("Location:../index.html?v=20"); // telefono ya existe
    exit;
}


$stmt->close(); 


// Hash de la contraseña
$hash = password_hash($contrasena, PASSWORD_DEFAULT);


// Insertar nuevo usuario
$stmt = $conn->prepare("INSERT INTO tb_usuarios (c_nombre, c_usuario, c_password,c_telefono, c_rfc) VALUES (?, ?, ?, ?,? )");
$stmt->bind_param("sssss", $nombre, $mail, $hash, $telefono, $rfc);

if ($stmt->execute()) {
    header("Location:../index.html?v=21"); // Registro exitoso
} else {
    header("Location:../index.html?v=23"); // Error en el registro
}
$stmt->close();
$conn->close();
?>