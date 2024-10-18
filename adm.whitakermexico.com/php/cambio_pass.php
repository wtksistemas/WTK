<?php

require 'funciones.php';

session_start();	//inicia sesion

if(isset($_SESSION['token_url']))// 
    {

        $new_pass=$_POST['pass1'];


    // Llama a la función para cambiar la contraseña
    cmb_pass($_SESSION['token_url'], $new_pass);


        echo "Sesion valida: ".$_SESSION['token_url'];
    }
    else
    {
    echo"Sesion invalida";
    }
?>