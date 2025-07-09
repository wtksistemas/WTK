<?php
require_once('funciones.php');
$token_usr=$_POST['token'];
$r=$_POST["url_token"];
$resultado=com_tkn($token_usr,$r);
?>