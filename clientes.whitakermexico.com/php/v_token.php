<?php



require_once("dbconnect.php");



$sql = "select c_usuario,cast(aes_decrypt(c_password,'".$llave."')as char) from tb_usuarios where c_usuario='".$user."';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$user_msql=$row["c_usuario"];
$pass_msql=$row["cast(aes_decrypt(c_password,'".$llave."') as char)"];





?>