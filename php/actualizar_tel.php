<?php
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else{
	
$telefono = $_POST['telefono'];


 $sql = "update login set telefono= '".$telefono."'";
 
  $mysqli->query($sql);
  echo "se cambio el numero de telefono  </br>";
}
$mysqli->close();
echo"<a href='./vew-user.php'>VOLVER</a>";
?>