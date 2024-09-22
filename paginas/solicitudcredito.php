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
 $sql1 = "select distinct documento from usuarios";
$result=mysqli_query($mysqli, $sql1);  


$mysqli->query($sql);
}else {
  echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';

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
    <title>movimientos financieros</title>
	<link rel="icon" href="../images/pesos.png">
	<link rel= "stylesheet"  href="../css/userlog.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
.mb-3{
max-width: 400px;
}
form .btn-primary{
 font-size: small;
   
    background-color: #3144c1;
    border: 0;
    text-transform: uppercase;
    padding: 1em;
  
    letter-spacing: .1em;
    border-radius: 25px;
}
</style>
    </head>

<body>
<div class="card">
  <div class="card-header">
    SOLICITUD INDIVIDUAL DE CREDITO
  </div>
  <div class="card-body">
  <h2>formato para solicitud de credito</h2>
<form action="../php/prestamos.php" method="post"  onsubmit="return validar()">
<div class="mb-3 row">
<select class="form-select"  id="inputGroupSelect02" name="id_deudor">
 <?php echo'<option selected="selected">----seleccione N. de documento----</option>';
      while ($row = $result->fetch_array()) {
      echo '<option  style="width:200px; height:30px">'.$row["documento"];
      }
      $result->free_result();
     ?> 
      

</select>

  <div class="mb-3">
  
  
  <div class="form-text" id="basic-addon4">ingrese el monto del credito</div>
</div>

<div class="input-group mb-3">
  <span class="input-group-text">$</span>
  <input type="text" name="valor_prestamo"  class="form-control" aria-label="Amount (to the nearest dollar)">
  <span class="input-group-text">.00</span>
  </div>
  <div class="mb-3">
<input class="form-control" type="date" placeholder="ingrese la fecha" aria-label="readonly input example" name="fecha" readonly>
</div>
  <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">concepto</span>
  <input type="text" class="form-control" placeholder="descripcion" aria-label="Username" aria-describedby="basic-addon1" name="concepto">
</div>

   </div>
   <div class="input-group mb-3">
  <select class="form-select" id="inputGroupSelect02" name="n_cuotas">
    <option selected>Seleccione...</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="24">24</option>
    <option value="36">36</option>
    <option value="48">48</option>
   
  </select>
  <label class="input-group-text" for="inputGroupSelect02">plazo meses</label>
</div>
   <div>
   <button type="submit" class="btn btn-primary">SOLICITAR</button>
</div>
</form>
  </div>
</div>
</body>
</html>