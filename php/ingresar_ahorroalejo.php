<?php
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else{
	
$fecha = $_POST['fecha'];
$valor_a_ahorrar = $_POST['valor_a_ahorrar'];
$valor_a_retirar = $_POST['valor_a_retirar'];
$concepto = $_POST['concepto'];

 $sql = "INSERT INTO ahorros_alejandro Values(null,'".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."')";
 
  $mysqli->query($sql);
  echo "los datos fueron ingresados correctamemte  </br>";
}
$mysqli->close();
echo"<a href='../paginas/ahorro_alejandro.php'>VOLVER</a>";
?>