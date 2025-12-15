
	<?php
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
        $sql="SELECT c_fecha, c_horaregistro, c_tiporegistro FROM tb_checador WHERE c_idusuario=? and c_fecha>=? ORDER BY c_fecha desc, c_horaregistro desc LIMIT 10";

        $stmt = $conn->prepare($sql);
	    // Si la consulta no se prepara correctamente
	    if(!$stmt)
	{
		header("Location: ../index.html?v=0");
		exit();
	}
	$stmt->bind_param("is",$id,$hoy);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
    $num_rows = $result->num_rows;

    $i=0;
    //$registros_checador=[];
    // Guardamos los datos del usuario
    
    while($row = $result->fetch_assoc()){
       $registros_checador[] = $row["c_tiporegistro"]."/".$row["c_horaregistro"];

        
        echo $registros_checador[$i]."<br>";
        $i=$i+1;
    }

 	$arreglo_entradas=json_encode($registros_checador);



?>
