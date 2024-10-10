<?php
  session_start();

  if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK"))
 {
	  
  }
else
{
	
header("Location: https://clientes.whitakermexico.com");

}

?>
