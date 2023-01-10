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
$cosulta= mysqli_query($mysqli, "select (sum(valor_a_ahorrar)-sum(valor_a_retirar)) as mtotal from ahorros_alejandro");
$row = mysqli_fetch_array($cosulta);
$total=$row['mtotal'];

if($total > $valor_a_retirar ){
  $sql = "INSERT INTO ahorros_alejandro Values(null,'".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."')";
 
  $mysqli->query($sql);
  echo "los datos fueron ingresados correctamente";
  
}else{
 echo '<script>alert("EL VALOR SOLICITADO ES SUPERIOR A SU SALDO ACTUAL $',number_format($total).'" )</script> ';
		
  echo "<script>location.href='../paginas/ahorro_alejandro.html'</script>";

 
}
  }
$mysqli->close();
echo"<a href='../paginas/ahorro_alejandro.html'>VOLVER</a>";
?>