<?php
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else{
	
$usuario = $_POST['usuario'];


 $sql = "update login set usuario= '".$usuario."'";
 
  $mysqli->query($sql);
  echo "usuario nuevo asignado  </br>";
}
$mysqli->close();
echo"<a href='./vew-user.php'>VOLVER</a>";
?>