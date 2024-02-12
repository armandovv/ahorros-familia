<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

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
  echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';

  echo "<script>location.href='../index.html'</script>";
}
$mysqli->close();
?>
<h4><?php echo
      $_SESSION["nombreusuario"];?></h4>
<CENTER><H2>USUARIOS REGISTRADOS</H2></center>
<center><table border=1>
<th width=300 bgcolor="blue">N. DOCUMENTO</th>
<th width=300 bgcolor="blue">NOMBRE COMPLETO</th>
<th width=300 bgcolor="blue">CORREO</th>
<th width=300 bgcolor="blue">TELEFONO</th>
<th width=30 style='border-width:0px'color:white></th>

</table><center>
  

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


$sql = "select *from usuarios";
$result=mysqli_query($mysqli, $sql);  
while ($mostrar=mysqli_fetch_array($result))
{
	
echo "<table border=1>";  
 
    echo "<td width=300>",$mostrar['documento']."</td>";  
    echo "<td width=300>",$mostrar['nombres']."</td>";  
	echo "<td width=300>" ,$mostrar['email']."</td>";  
	echo "<td width=300>",$mostrar['telefono']."</td>"; 
  echo "<td width=30>".'<a href="../paginas/borrar.php"><img src="../images/eliminar.png" width="20" height="20">'.'</a>'."</td>";
     
}  
echo "</table>"; 

echo "<p>";
    

}


?>
<a href='../paginas/general.php'>VOLVER</a>