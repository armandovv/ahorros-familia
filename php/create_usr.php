<?php
 session_start();
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else if
(!empty($_SESSION['nombreusuario']))
{ 
 $sql= "select *from login where usuario= '".$_SESSION['nombreusuario']."'";

$mysqli->query($sql);
}else {
  echo '<script>alert("SE CERRO LA SESION DE FORMA INESPERADA")</script> ';

  echo "<script>location.href='../index.html'</script>";
}
$mysqli->close();
?>
<h4><?php echo
      $_SESSION["nombreusuario"];?></h4>
<?php
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else{
$documento = $_POST['documento'];	
$nombres = $_POST['nombres'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];


 $sql = "INSERT INTO usuarios Values('".$documento."','".$nombres."','".$email."','".$telefono."')";
 
  $mysqli->query($sql);
  echo "se ha creado el usuario satisfactoriamente  </br>";
}
$mysqli->close();
echo"<a href='../paginas/movimientos.php'>VOLVER</a>";
?>