<link rel="icon" href="../images/pesos.png">
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
error_reporting(0);

$mysqli = new mysqli('127.0.0.1','root','','ahorros_familia');

if ($mysqli->connect_errno) {
	echo " LO SENTIMOS, ESTE SITIO WEB ESTA EXPERIMENTANDO PROBLEMAS  <BR>";
echo "error: Fallo al conectarse a mysql debido a : <br>";
    echo"errno: " . $mysqli->connect_errno . "<br>";
exit;
}
else
{
//echo "la coneccion fue exitosa";


$sql = "SELECT *FROM login";
$result=mysqli_query($mysqli, $sql);  
while ($mostrar=mysqli_fetch_array($result))
{
	echo'<center>';
echo "<table border=1>";  
 
echo '<tr><td><h4>nombre </td><td>  ',$mostrar['nombre'].' </h4></td></tr>';
echo 
'<tr><td><h4>telefono </td><td> ' ,$mostrar['telefono'].  '</td><td>  <a href="../paginas/actualizar_datos.php">  <img src="../images/editar.png" width="20" height="20">'.'</a></h4></td></tr>';
echo '<tr><td><h4>email </td><td> ' ,$mostrar['usuario'].' </td><td> <a href="../paginas/actualizar_datos.php">  <img src="../images/editar.png" width="20" height="20">'.'</h4></td></tr>';
}  
echo "</table>";
echo'</center>';


}

echo"<center><a href='../paginas/general.php'>VOLVER</a></center>";
?>
