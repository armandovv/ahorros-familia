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
$fecha = date("Y-m-d");
$valor_a_ahorrar = $_POST['valor_a_ahorrar'];
$valor_a_retirar = $_POST['valor_a_retirar'];
$concepto = $_POST['concepto'];
$queryuser =mysqli_query ($conn,"select distinct documento, nombres, telefono, email from usuarios inner join ahorros on usuarios.documento = ahorros.usuario where usuario= '".$usuario."'");
	$nr= mysqli_num_rows($queryuser);
  if ($nr=0)
  { echo '<script>alert("EL NUMERO DE DOCUMENTO INGRESADO NO ESTA REGISTRADO EN NUESTRA BASE DE DATOS")</script> ';
		
    echo "<script>location.href='../paginas/movimientos.php'</script>";

}
else{
  $query =mysqli_query($conn, "INSERT INTO ahorros Values(null,'".$usuario."','".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."')");
 
  echo "los datos fueron ingresados correctamemte  </br>";
 echo"<a href='../paginas/movimientos.php'>VOLVER</a>";
 $fecha = date("Y-m-d");
 $queryuser =mysqli_query ($conn,"select distinct documento, nombres, telefono, email, fecha, valor_a_ahorrar, concepto from usuarios inner join ahorros on usuarios.documento = ahorros.usuario where usuario= '".$usuario."' and fecha = '".$fecha."' order by id_movimiento desc limit 1");
  $mostrar		= mysqli_fetch_array($queryuser); 
$valor_a_ahorrar = $mostrar['valor_a_ahorrar'];
$nombres = $mostrar['nombres'];
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
?>