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
$titulo				= "Recuperar clave de acceso";
$mensaje			= "Ingresa con el codigo $enviarpass y procede a crear clave nueva.
                        cordialmente
						Sistema de informacion ahorro familiar";
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<style>
.mb-3{

width: 500px;
padding-left: 200px;
}
.col-auto{
	width: 500px;
padding-left: 200px;

}
.col-auto .btn-primary{
	width: 300px;
padding-left: 200px;

}



	</style>
</head>
<body>
	<table>
<form action="update_pass.php" method="POST" onsubmit="return validar()">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Ingrese el codigo enviado a su correo</label>
  <input type="text" class="form-control" name="enviarpass" id="exampleFormControlInput1" required>

</div>
<div class="mb-3">
<label for="inputPassword5" class="form-label">ingrese una contraseña nueva</label>
<input type="password" id="inputPassword" class="form-control" name="contraseña" aria-describedby="passwordHelpBlock" required  pattern=".{6,}" title="Su contraseña debe tener 6 o mas caracteres, puede incluir letras y numeros">
<div id="passwordHelpBlock" class="form-text">
 Su contraseña debe tener 6 o mas caracteres, puede incluir letras y numeros, no pueden haber espacios.
</div>
</div>
<div class="mb-3">
<label for="inputPassword5" class="form-label">confirme su contraseña</label>
<input type="password" id="inputPassword5" class="form-control" name="confirm" aria-describedby="passwordHelpBlock" required >
</div>
<div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Cambiar</button>
  </div>
</form>


	</table>
	<script src="../js/comparepass.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
</body>
</html>
