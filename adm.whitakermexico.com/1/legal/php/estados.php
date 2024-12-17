<?php
header('Content-type: text/html; charset=utf-8');
require_once("dbconnect.php");
$sql = "select ID,c_estado from tb_estados;";
        $result = mysqli_query($conn_muni,$sql);
        $num_rows = mysqli_num_rows($result);
        $id= array();
        $estado= array();
        while($row= mysqli_fetch_assoc($result))
        {
            $estado[]=$row;
        }
        $json_estado=json_encode($estado);
        mysqli_close($conn1_muni);

// Enviar los estados como JSON
header('Content-Type: application/json');
echo $json_estado;
?>