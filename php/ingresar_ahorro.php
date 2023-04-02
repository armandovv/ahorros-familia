<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn)
  {echo " LO SENTIMOS, ESTE SITIO WEB ESTA EXPERIMENTANDO PROBLEMAS  <BR>";
	echo "error: Fallo al conectarse a mysql debido a : <br>";
		echo"errno: " . $mysqli->connect_errno . "<br>";
	exit;}

$usuario = $_POST['usuario'];	
$fecha = $_POST['fecha'];
$valor_a_ahorrar = $_POST['valor_a_ahorrar'];
$valor_a_retirar = $_POST['valor_a_retirar'];
$concepto = $_POST['concepto'];
$query =mysqli_query ($conn,"select *from ahorros where usuario= '".$usuario."'");
	$nr= mysqli_num_rows($query);
  if ($nr==0)
  { echo '<script>alert("EL NUMERO DE DOCUMENTO INGRESADO NO SE ENCUENTRA REGISTRADO EN NUESTRA BASE DE DATOS")</script> ';
		
    echo "<script>location.href='../paginas/movimientos.php'</script>";

}
else{
  $query =mysqli_query($conn, "INSERT INTO ahorros Values(null,'".$usuario."','".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."')");
 

  echo "los datos fueron ingresados correctamemte  </br>";

echo"<a href='../paginas/movimientos.php'>VOLVER</a>";
}
?>