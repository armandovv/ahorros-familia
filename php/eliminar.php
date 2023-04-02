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

$documento = $_POST['documento'];	


$query =mysqli_query ($conn,"select distinct documento from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where ahorros.usuario=  '".$usuario."'");
 $nr= mysqli_num_rows($query);
  if ($nr=0)
  { echo '<script>alert("EL NUMERO DE DOCUMENTO INGRESADO NO SE ENCUENTRA REGISTRADO EN NUESTRA BASE DE DATOS")</script> ';
		
    echo "<script>location.href='./php/consulta_usuarios.php'</script>";

}
  else{
    $query =mysqli_query($conn, "delete from usuarios where documento='".$documento."' ");
   
  
  }
  echo'<script>alert("se elimino usuario " '.$documento.'"del sistema ")</script>';

 
		
  echo "<script>location.href='../php/consulta_usuarios.php'</script>";




$mysqli->close();
echo"<a href='../paginas/movimientos.php'>VOLVER</a>";