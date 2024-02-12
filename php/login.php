<?php
session_start();
 
// Conexión a la base de datos
$db = mysqli_connect('127.0.0.1', 'root', '', 'ahorros_familia');
 
$errors ='Nombre de usuario/contraseña inválidos';

// Si se ha enviado el formulario
if (isset($_POST['login_button'])) {
  $usuario = mysqli_real_escape_string($db, $_POST['usuario']);
  $contraseña = mysqli_real_escape_string($db, $_POST['contraseña']);
 
  // Comprobar si el nombre de usuario es válido
  $query = "select usuario, nombre, contraseña from login where usuario='".$usuario."'";
  $results = mysqli_query($db, $query);
 
  if (mysqli_num_rows($results) == 1) {
    // Nombre de usuario válido, verificar contraseña
    $row = mysqli_fetch_assoc($results);
    if (password_verify($contraseña, $row['contraseña'])) {
      // Inicio de sesión válido
      $_SESSION['usuario'] = $usuario;
	
	
	
			
	
			/* la columna uno corresponde con la columna del nombre completo */
			$nombreusuario = $row['nombre'];
	
			/* Podrías guardarlo como variable de sesión */
			
      $_SESSION['nombreusuario'] = $nombreusuario;
      header('location:../paginas/general.php');
     
    } else {
      // Contraseña inválida
      $errors;
    }
  } else {
    // Nombre de usuario inválido
    $errors;
  }
}
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Inicio de sesion</title>
		<link rel="icon" href="../images/pesos.png">
    <script type="text/javascript" src="jquery.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
body{

  background-color: #EAEDED;
  background-repeat: no-repeat;
    height: 100vh;
    background-size: cover;
}
 
.toast{
 
  margin-left: auto;
    margin-right: auto;
    position: relative;
top: 170px;
 
  border: 1px solid rgba(0,0,0,.1);
  
  box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,.5);
  max-width: 310px;
  height: 95px;
  width: 320px;
  background-color: #ffffff;
  opacity: 1;

}
.toast .toast-header{
 
  height: 50px;
  background-color: #ffffff;
  opacity: 1;
}
 a{
  width: 20px;
  position: relative;
bottom: 13px; left: 44px;

}
small{
  right: 20px;
}



 .btn-close{
 background-color:red;
 height: 20px;
  border: 0;


 
 
}
.toast .toast-body{
  height: 100px;
  text-align: center;
  color: red;
}

</style>

 
	</head>
	<body>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false">
  <div class="toast-header">
    <img src="../images/logo162645.png" width="35px" height="30px" class="rounded me-2" alt="...">
    <strong class="me-auto">Inicio de sesion</strong>
    <small>acceso denegado</small>
   <a href="../index.html" ><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">X</button></a>
  </div>
  <div class="toast-body">
   <?php echo $errors; ?>
  </div>
</div>

<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</body>
	</html>