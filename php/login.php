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
			$nombreusuario = $fila[3];
	
			/* Podrías guardarlo como variable de sesión */
			$_SESSION['nombreusuario'] = $nombreusuario;
	
			/* liberar el conjunto de resultados */
			echo'<center>';
			echo'<div style=" border-color: gray; border-style: solid; border-radius:5px;
			border-width: 1px; width:500; height:370;
			-webkit-box-shadow: -1px 1px 7px 1px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 1px 7px 1px rgba(0,0,0,0.75);
box-shadow: -1px 1px 7px 1px rgba(0,0,0,0.75);">';
			
			echo '<h3>BIENVENIDO ',strtoupper($nombreusuario),' </h3>';
			
			echo'<img src="../images/7efs.gif" width="350" height="280">';
			
			echo"<a href='../paginas/general.php'><button style='border-width: 6px; border-radius:14%; background-color: #3C66F4; border-color:#F5F7F9; border-style:double;width:90; height:36; color:white'>aceptar</button></a>";
			
			echo'</div>';
			echo'</center>';

		}
			
			
			
		
		
	


	
		else {
			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='../index.html'</script>";
		}
	
	
	

?>