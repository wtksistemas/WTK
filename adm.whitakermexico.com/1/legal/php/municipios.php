<?php
header('Content-type: text/html; charset=utf-8');
require_once("dbconnect.php");

$estado_id=$_GET['estado'];
$sql = "select ID,c_municipio from tb_municipios where c_idestado=".$estado_id.";";
        $result = mysqli_query($conn_muni,$sql);
        $num_rows = mysqli_num_rows($result);
        $id= array();
        $municipio= array();
        while($row= mysqli_fetch_assoc($result))
        {
            $municipio[]=$row;
        }
        $json_municipio=json_encode($municipio);
        mysqli_close($conn1_muni);

echo $json_municipio;
?>