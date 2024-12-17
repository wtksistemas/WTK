<?php
header('Content-type: text/html; charset=utf-8');
require_once("dbconnect.php");

$sql = "select ID,c_razonsocial from tb_clientes;";
        $result = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($result);
        $id= array();
        $razonsocial= array();
        while($row= mysqli_fetch_assoc($result))
        {
            $cliente[]=$row;
        }
        $json_cliente=json_encode($cliente);
        mysqli_close($conn);

// Enviar los estados como JSON
header('Content-Type: application/json');
echo $json_cliente;
?>