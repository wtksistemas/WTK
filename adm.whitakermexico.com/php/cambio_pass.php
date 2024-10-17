<?php
session_start();	//inicia sesion

if(isset($_SESSION['token_url']))// 
    {

        $new_pass=$_POST['pass1'];
        echo "Sesion valida: ".$_SESSION['token_url'];
    }
    else
    {
    echo"Sesion invalida";
    }
?>