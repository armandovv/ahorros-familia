<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$usuario = $_POST['usuario'];

$queryusuario 	= mysqli_query($conn,"SELECT * FROM login WHERE usuario = '$usuario'");
$nr 			= mysqli_num_rows($queryusuario); 

if ($nr == 1)
{

$mostrar		= mysqli_fetch_array($queryusuario); 
$enviarpass 	= $mostrar['contraseña'];

$paracorreo 		= $usuario;
$titulo				= "Recuperar contraseña";
$mensaje			= $enviarpass;
$tucorreo			= "From: varelaarmando430@gmail.com";

(mail($paracorreo,$titulo,$mensaje,$tucorreo));

	echo "<script> alert('Contraseña enviado');window.location= '../index.html' </script>";
}else
{
	echo "<script> alert('El correo ingresado no se encuentra en nuestra base de datos');window.location= '../index.html' </script>";
}


?>