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

	$contraseña=$_POST['contraseña'];
	$nombre=$_POST['nombre'];
	

	
	$query =mysqli_query ($conn,"select *from login where nombre='".$nombre."'");
	$nr= mysqli_num_rows($query);
	$mostrar = mysqli_fetch_array($query);
	 password_verify($contraseña,$mostrar['contraseña']);
	if ($nr!=1)
	{ echo '<script>alert("LA CONTRASEÑA ACTUAL INGRESADA NO CORRESPONDE A SU CLAVE ACTUAL")</script> ';
		
        echo "<script>location.href='../paginas/actualizarpass.php'</script>";
		
		}
			
			
			
		
		
	


	
		else {
			$contraseña=$_POST['nueva'];
			$contraseña = password_hash($contraseña,PASSWORD_DEFAULT);
			
            $query =mysqli_query($conn,"update login set contraseña='".$contraseña."'");
            
			
			echo '<center><h3>SE CAMBIO EXITOSAMENTE LA CONTRASEÑA</h3><center><br> ';
			echo'<center><img src="../images/ezgif.com-animated-gif-maker.gif" width="350" height="350"></center>';
			echo"<a href='../paginas/general.php'>VOLVER</a>";
			

		}
	
        

?>