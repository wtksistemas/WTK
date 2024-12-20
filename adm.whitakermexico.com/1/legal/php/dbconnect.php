<?php
require_once("config.php");
$conn1 = mysqli_connect($host, $usr, $psr,$data_base)
or die('Error: Database to host connection clientes: '.mysqli_error());

$conn_arch = mysqli_connect($host, $usr, $psr,$data_base_archivo)
or die('Error: Database to host connection archivo: '.mysqli_error());

$conn1_arch = mysqli_connect($host, $usr, $psr,$data_base_archivo)
or die('Error: Database to host connection archivo: '.mysqli_error());

$conn_muni = mysqli_connect($host, $usr, $psr,$data_base_municipios)
or die('Error: Database to host connection municipios: '.mysqli_error());

$conn1_muni = mysqli_connect($host, $usr, $psr,$data_base_municipios)
or die('Error: Database to host connection municipios: '.mysqli_error());
	



?>
