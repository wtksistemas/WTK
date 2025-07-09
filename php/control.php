<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión solo si no está iniciada
}

if (!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
    // Si no hay sesión o el login no es OK, puedes redirigir o mostrar un mensaje
} else {
    header("Location: ../index.html");
    exit(); // Asegúrate de detener la ejecución después de redirigir
}


//session_status() === PHP_SESSION_NONE Condicional asegura que session_start() solo se llame 
//si no se ha iniciado ya una sesión.   
?>