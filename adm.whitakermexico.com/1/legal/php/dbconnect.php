<?php



require_once("config.php");

$connn="hola ";
$conn = mysqli_connect($host, $usr, $psr,$data_base)
or die('Error: Database to host connection: '.mysqli_error());

$conn1 = mysqli_connect($host, $usr, $psr,$data_base)
or die('Error: Database to host connection: '.mysqli_error());

$conn_arch = mysqli_connect($host, $usr, $psr,$data_base_archivo)
or die('Error: Database to host connection: '.mysqli_error());

$conn1_arch = mysqli_connect($host, $usr, $psr,$data_base_archivo)
or die('Error: Database to host connection: '.mysqli_error());

	



?>
