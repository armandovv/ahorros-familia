<?php
 session_start();
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else if
(!empty($_SESSION['nombreusuario']))
{ 
 $sql= "select *from login where usuario= '".$_SESSION['nombreusuario']."'";

$mysqli->query($sql);
}else {
  echo '<script>alert("SE CERRO LA SESION DE FORMA INESPERADA")</script> ';

  echo "<script>location.href='../index.html'</script>";
}
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFIGURACION DE SEGURIDAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
      #viewPassword{
        cursor:pointer;
      }

    </style>
<script language="Javascript"  type="text/javascript">
  function validar(){
  var pasActual=document.getElementById("contraseña").value;
  var pasNew1=document.getElementById("nueva").value;
  var pasNew2=document.getElementById("confirm").value;
if(pasActual.length=="0"){
  alert("INGRESE SU CLAVE ACTUAL");
  document.getElementById("contraseña").focus();
  return false;
}
if(pasNew1!= pasNew2){
alert("CAMPO CONTRASEÑA NUEVA Y CAMPO CONFIRMACION NO COINCIDEN");
document.getElementById("nueva").focus();
return false;
} else{
  
  return true;
}

}


</script>

</head>
<body>
  <nav class="navbar navbar-expand-lg"  style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="./general.php"><img src="../images/pngegg (1).png" width="55" height="55"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../images/pngegg (4).png" width="47" height="47">
            </a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../php/consulta_usuarios.php">consultar usuarios</a></li>
            <li><a class="dropdown-item" href="./create_user.php">crear usuario</a></li>
            <li><a class="dropdown-item" href="./create_document.php">generar certificado</a></li>
             
            </ul>
          </li>
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../images/pngegg (2).png" width="47" height="47">
            </a>
            <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../php/vew-user.php">editar perfil</a></li>
        <li><a class="dropdown-item" href="./actualizarpass.php">Cambiar contraseña</a></li>
              <li><a class="dropdown-item" href="../php/logout.php">Cerrar Sesion</a></li>
            
            </ul>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../images/png-clipart-market-market-text-investment.png" width="47" height="47" border="1">
          </a>
          <ul class="dropdown-menu">
         <li><a class="dropdown-item" href="./movimientos.php">Movimientos financieros</a></li>
         <li><a class="dropdown-item" href="./mostrar_estado.php">Mostrar estados de cuentas</a></li>
         </ul>
        </li>

          <li class="nav-item">
            <h6><?php echo
  $_SESSION["nombreusuario"];?></h6>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  <center> <table border="3"><form action="../php/actualizar_pass.php" onsubmit="return validar()" method="post">
<tr><td>INGRESE CONTRASEÑA ACTUAL </td><td><input type="password" id="contraseña" name="contraseña"></td>

</tr>


<tr><td>INGRESE CONTRASEÑA NUEVA</td><td><input type="password" id="nueva" name="nueva" required="required" pattern=".{6,}" title="Su contraseña debe tener 6 o mas caracteres, puede incluir letras y numeros"></td>


</tr>
<tr><td>CONFIRME SU NUEVA CONTRASEÑA</td><td><input type="password" id="confirm" name="confirm" required ></td>


</tr>

<tr><td><input type="submit" value="CAMBIAR"></td></tr>





</form>
   </table> </center>
   <br>
   <center><h5>Su clave debe tener 6 o mas digitos los cuales pueden contener letras y numeros</h5></center>
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
</body>
</html>