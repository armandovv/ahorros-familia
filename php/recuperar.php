<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$usuario = $_POST['usuario'];
$length = (int)$_POST['chars'];
$queryusuario 	= mysqli_query($conn,"SELECT * FROM login WHERE usuario = '$usuario'");
$nr 			= mysqli_num_rows($queryusuario); 

if ($nr == 1)
{

$mostrar		= mysqli_fetch_array($queryusuario); 
function generatePassword($length)
{
	$key = "";
	$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
	//$pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ.-_*/=[]{}#@|~¬&()?¿";
	$max = strlen($pattern)-1;
	for($i = 0; $i < $length; $i++){
		$key .= substr($pattern, mt_rand(0,$max), 1);
	}
	return $key;
}
$enviarpass 	= generatePassword($length);

$paracorreo 		= $usuario;
$titulo				= "Recuperar contraseña";
$mensaje			= "La clave asociada a su cuenta es: $enviarpass, es necesario cambiarla";
$tucorreo			= "From: varelaarmando430@gmail.com";

(mail($paracorreo,$titulo,$mensaje,$tucorreo));

	$queryusuario =mysqli_query($conn,"update login set enviarpass='".$enviarpass."'");

	echo "<script> alert('Se envio codigo de recuperacion al correo ".$usuario."') </script>";
	
}else
{
	echo "<script> alert('El correo ingresado no se encuentra en nuestra base de datos');window.location= '../index.html' </script>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RECUPERAR CONTRASEÑA</title>
</head>
<body>
	<table>
<form action="update_pass.php" method="POST">
	<tr><td>ingrese el codigo enviado a su correo</td></tr>
	   <tr><td><input type="text" name="enviarpass"></td></tr>
	   <tr><td>ingrese una contraseña nueva</td></tr>
	   <tr><td><input type="password" name="contraseña"></td></tr> 
	   <tr><td>confirme contraseña</td></tr>
	   <tr><td><input type="password" name="confirm"></td></tr>
	   
	  <tr><td><input type="submit" value="CAMBIAR"></td></tr>
</form>


	</table>
</body>
</html>
