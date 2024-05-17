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
    echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
  
    echo "<script>location.href='../index.html'</script>";
  }
  $mysqli->close();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movimientos financieros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
</head>
<body>
<?php echo
      $_SESSION["nombreusuario"]; ?>
      <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
      </svg>
     
<div class="alert alert-danger d-flex align-items-center" role="alert">
<svg class="bi flex-shrink-0 me-2" role="img" height="30px" width="30px" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
<div>

   El valor solicitado  para el usuario <?php echo $_GET['user']; ?> es superior a su saldo actual:  $<?php echo number_format($_GET['saldo'],2); ?> pesos M/CTE
  </div>
</div>
<a href="../paginas/movimientos.php" class="btn btn-primary">VOLVER</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>