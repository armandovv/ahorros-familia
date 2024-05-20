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

$queryuser =mysqli_query ($conn,"select distinct documento from usuarios inner join ahorros on usuarios.documento = ahorros.usuario where usuario= '".$usuario."'");
	$nr= mysqli_num_rows($queryuser);
  if ($nr>0)
  {
    $usuario = $_POST['usuario'];
    $fecha = date("Y-m-d");
  $valor_a_ahorrar = $_POST['valor_a_ahorrar'];
  $valor_a_retirar = $_POST['valor_a_retirar'];
  $concepto = $_POST['concepto'];
    $query =mysqli_query($conn, "INSERT INTO ahorros Values(null,'".$usuario."','".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."')");
   
   
   $fecha = date("Y-m-d");
   $queryuser =mysqli_query ($conn,"select distinct documento, nombres, telefono, email, fecha, valor_a_ahorrar, concepto from usuarios inner join ahorros on usuarios.documento = ahorros.usuario where usuario= '".$usuario."' and fecha = '".$fecha."' order by id_movimiento desc limit 1");
    $mostrar		= mysqli_fetch_array($queryuser); 
  $valor_a_ahorrar = number_format($mostrar['valor_a_ahorrar']);
  $nombres = ucwords($mostrar['nombres']);
  $fecha = $mostrar['fecha'];
  $paraemail = $mostrar['email'];
  $concepto = $mostrar['concepto'];
  $titulo = "Sistema de informacion ahorros familiar";
  $mensaje ="Apreciado(a) $nombres:
             Se ha registrado el siguiente movimiento en su cuenta:
             Clase movimiento: Ahorro
             Valor: $$valor_a_ahorrar
             Concepto: $concepto
             Fecha: $fecha
  ";
  $tucorreo = "From: varelaarmando430@gmail.com";
  (mail($paraemail,$titulo,$mensaje,$tucorreo));
}
else{
  echo '<script>alert("EL NUMERO DE DOCUMENTO INGRESADO NO ESTA REGISTRADO EN NUESTRA BASE DE DATOS")</script> ';
		
  echo "<script>location.href='../paginas/movimientos.php'</script>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movimientos financieros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
.card {
	margin-left: auto;
    margin-right: auto;}

</style>
</head>
<body>
<div class="card" style="width: 18rem;">
  <img src="../images/ezgif.com-animated-gif-maker.gif" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">TRANSACCION EXITOSA</h5>
    <p class="card-text">Usuario <?php echo $mostrar["nombres"];?></p>
    <p class="card-text">  Documento <?php echo $mostrar["documento"];?> </p>
    <p class="card-text">Valor $<?php echo number_format($mostrar["valor_a_ahorrar"]);?></p>
    <p class="card-text">Concepto <?php echo $mostrar["concepto"];?></p>
    <a href="../paginas/movimientos.php" class="btn btn-primary">LISTO</a>

  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>