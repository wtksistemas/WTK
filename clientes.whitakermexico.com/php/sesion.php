<?php
require_once("funciones.php");
$user=$_POST['username'];
$password=$_POST['password'];
login_user($user,$password);
?>