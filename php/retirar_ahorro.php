<?php
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else{
$usuario = $_POST['usuario'];	
$fecha = date("Y-m-d");
$valor_a_ahorrar = $_POST['valor_a_ahorrar'];
$valor_a_retirar = $_POST['valor_a_retirar'];
$concepto = $_POST['concepto'];
$cosulta= mysqli_query($mysqli, "select (sum(valor_a_ahorrar)-sum(valor_a_retirar)) as mtotal from ahorros where usuario='".$usuario."'");
$row = mysqli_fetch_array($cosulta);
$total=$row['mtotal'];
if($total >= $valor_a_retirar ){
 $sql = "INSERT INTO ahorros Values(null, '".$usuario."','".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."')";
 
 
  $mysqli->query($sql);
  echo "los datos fueron ingresados correctamemte  </br>";
}else{
  echo '<script>alert("EL VALOR SOLICITADO ES SUPERIOR A SU SALDO ACTUAL $',number_format($total).'" )</script> ';
		
  echo "<script>location.href='../paginas/movimientos.php'</script>";

}
}

$mysqli->close();
echo"<a href='../paginas/movimientos.php'>VOLVER</a>";
?>