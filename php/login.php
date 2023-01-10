<?php
//include("connect_db.php");

//$miconexion = new connect_db;


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

	$usuario=$_POST['usuario'];
	$contraseña=$_POST['contraseña'];


	//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
	$query =mysqli_query ($conn,"select *from login where usuario='".$usuario."' and contraseña = '".$contraseña."'");
	$nr= mysqli_num_rows($query);
	if ($nr==1)
	{ 
		session_start();
		$_SESSION['usuario'] = $usuario;
	
	
	
			$fila = $query->fetch_row();
	
			/* la columna cuatro corresponde con la columna del nombre completo */
			$nombreusuario = $fila[0];
	
			/* Podrías guardarlo como variable de sesión */
			$_SESSION['nombreusuario'] = $nombreusuario;
	
			/* liberar el conjunto de resultados */
			
			echo '<script>alert("BIENVENIDO USUARIO")</script> ';
			header("Location:../paginas/general.html");
			

		}
			
			
			
		
		
	


	
		else {
			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='../index.html'</script>";
		}
	
	
	

?>