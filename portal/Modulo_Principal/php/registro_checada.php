<?php
session_start();
		if(!isset($_SESSION['logeado']) || $_SESSION['logeado'] !== true)
			{
				session_unset();
    			session_destroy();
				header("Location: ../../index.html?v=28");
				exit;
			}
	    //include "../../../php/dbconnect.php";
        include "../../../php/funciones.php";
        $mail=$_SESSION['username'];
        $id=$_SESSION['user_id'];
        registra_checada(16);

/*
session_start();
		if(!isset($_SESSION['logeado']) || $_SESSION['logeado'] !== true)
			{
				session_unset();
    			session_destroy();
				header("Location: ../../index.html?v=28");
				exit;
			}
	    include "../../php/dbconnect.php";
        $mail=$_SESSION['username'];
        $id=$_SESSION['user_id'];
        $hoy=date("Y-m-d");
        $sql="SELECT c_fecha, c_horaregistro, c_tiporegistro FROM tb_checador WHERE c_idusuario=? and c_fecha=? ORDER BY c_fecha DESC, c_horaregistro DESC LIMIT 30";

*/
?>
