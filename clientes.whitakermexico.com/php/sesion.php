

<?php
	
require_once("dbconnect.php");
	

$user=$_POST['username'];
$password=$_POST['password'];
	
	

	
$sql = "select c_usuario,cast(aes_decrypt(c_password,'".$llave."')as char) from tb_usuarios where c_usuario='".$user."';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$user_msql=$row["c_usuario"];
$pass_msql=$row["cast(aes_decrypt(c_password,'".$llave."') as char)"];


	
 if($row == false) {
  /* echo '<a href="../index.php">Error: cannot execute query</a>'; */
	 echo " problema";
  exit;
}

$num_rows = mysqli_num_rows($result);

echo $num_rows."\n";
if($num_rows="1") {
  
	  session_start();

	$_SESSION['id']='888';
	 header("Location: https://clientes.whitakermexico.com/1/menu.php");

}
else
{
	        session_destroy();
	/* header("Location: https://clientes.whitakermexico.com/"); */
}



?>
	






