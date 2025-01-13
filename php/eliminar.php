<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) { die("Conexión fallida: " . $conn->connect_error); } 
// ID del registro a eliminar 
$documento = $_GET['documento']; 
// Consulta para eliminar el registro 
$sql = "DELETE FROM usuarios WHERE documento = ?"; 
// Preparar la consulta
 $stmt = $conn->prepare($sql); $stmt->bind_param("i", $documento); 
 // Ejecutar la consulta 
 if ($stmt->execute() === TRUE) {
   
}
  else { echo "Error al eliminar el registro: " . $conn->error; } 
  // Cerrar la conexión 
  $stmt->close(); 
  $conn->close();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card {
            margin-left: auto;
margin-right: auto;
position: relative;
top: 100px;
        }
    </style>
</head>
<body>
<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="../images/ezgif.com-animated-gif-maker (2).gif" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Eliminacion de registro</h5>
          <p class="card-text">Usuario  <?php echo "$documento";?>  eliminado exitosamente</p>
          <a class="card-text" href="consulta_usuarios.php"><small class="text-body-secondary">volver</small></p>
    </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


