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
  $msj ="Apreciado(a) $nombres:
             Se ha registrado el siguiente movimiento en su cuenta:
             Clase movimiento: Ahorro
             Valor: $$valor_a_ahorrar
             Concepto: $concepto
             Fecha: $fecha
  ";
  $tucorreo = "From: varelaarmando430@gmail.com";
  (mail($paraemail,$titulo,$msj,$tucorreo));
  
  $usuario = $_POST['usuario'];
   $query1 =mysqli_query ($conn,"select distinct  nombres as n,  valor_a_ahorrar as saldo, concepto as c from usuarios inner join ahorros on usuarios.documento = ahorros.usuario where usuario= '".$usuario."' and fecha = '".$fecha."' order by id_movimiento desc limit 1");
    $mostrar1		= mysqli_fetch_array($query1); 
    $n = ucwords($mostrar1['n']);
    $saldo =  number_format($mostrar1['saldo']);
    $c = $mostrar1['c'];
$mensaje = "<div style='text-align: center;'>";
$mensaje .="<img src='../images/ezgif.com-animated-gif-maker.gif'  alt='...' style='max-width: 100%; height: 100px; margin-bottom: 2px;'>";
$mensaje .="<h5>TRANSACCION EXITOSA</h5>";
$mensaje .="<p> Usuario $n </p>";
$mensaje .= "<p>  Documento $usuario</p>";
$mensaje .="<p>Valor $$saldo</p>";
$mensaje .="<p>Concepto  $c</p>";
$mensaje .="</div>";


  }
else{
  $mensaje = "<div style='text-align: center;'>";
  $mensaje .= "<h2>Error</h2>";
  $mensaje .= "<p>Numero de documento no existe. Verifica que existan en la base de datos.</p>";
  $mensaje .= "</div>";
}
echo $mensaje;
exit;
?>
