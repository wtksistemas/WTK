<?php
session_start();
		if(!isset($_SESSION['logeado']) || $_SESSION['logeado'] !== true)
			{
				session_unset();
    			session_destroy();
				header("Location: ../../index.html?v=28");
				exit;
			}
	    include "../../../php/dbconnect.php";
        include "../../../php/funciones.php";
        $mail=$_SESSION['username'];
        $id=$_SESSION['user_id'];
        registra_checada($id);




?>
