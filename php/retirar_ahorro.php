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
	exit;
}
else{
$usuario = $_POST['usuario'];	
$fecha = date("Y-m-d");
$valor_a_ahorrar = $_POST['valor_a_ahorrar'];
$valor_a_retirar = $_POST['valor_a_retirar'];
$concepto = $_POST['concepto'];
$cosulta= mysqli_query($conn, "select (sum(valor_a_ahorrar)-sum(valor_a_retirar)) as mtotal from ahorros where usuario='".$usuario."'");
$row = mysqli_fetch_array($cosulta);
$total=$row['mtotal'];
if($total >= $valor_a_retirar ){
  $query =mysqli_query($conn, "INSERT INTO ahorros Values(null, '".$usuario."','".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."')");
 
 
  
  echo "los datos fueron ingresados correctamemte  </br>";
}else{
  echo '<script>alert("EL VALOR SOLICITADO ES SUPERIOR A SU SALDO ACTUAL $',number_format($total).'" )</script> ';
		
  echo "<script>location.href='../paginas/movimientos.php'</script>";

}
}
$fecha = date("Y-m-d");
$queryuser =mysqli_query ($conn,"select distinct documento, nombres, telefono, email, fecha, valor_a_retirar, concepto from usuarios inner join ahorros on usuarios.documento = ahorros.usuario where usuario= '".$usuario."' and fecha = '".$fecha."'  order by id_movimiento desc limit 1");
 $mostrar		= mysqli_fetch_array($queryuser); 
$valor_a_retirar = $mostrar['valor_a_retirar'];
$nombres = ucwords($mostrar['nombres']);
$fecha = $mostrar['fecha'];
$paraemail = $mostrar['email'];
$concepto = $mostrar['concepto'];
$titulo = "Sistema de informacion ahorros familiar";
$mensaje ="Apreciado(a) $nombres:
          Se ha registrado el siguiente movimiento en su cuenta:
          Clase movimiento: retiro
          Valor: $$valor_a_retirar
          Concepto: $concepto
          Fecha: $fecha
";
$tucorreo = "From: varelaarmando430@gmail.com";
(mail($paraemail,$titulo,$mensaje,$tucorreo));

echo"<a href='../paginas/movimientos.php'>VOLVER</a>";
?>