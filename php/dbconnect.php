<?php

require_once("config.php");

$connn="hola ";
$conn = mysqli_connect($host, $usr, $psr,$data_base)
or die('Error: Database to host connection: '.mysqli_error());
$sql2="SET time_zone = '-06:00';";
	$stmt2 = $conn->prepare($sql2);
	$stmt2->execute();
	$stmt2->close();

$conn1 = mysqli_connect($host, $usr, $psr,$data_base)
or die('Error: Database to host connection: '.mysqli_error());
?>
