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
$fecha = $_POST['fecha'];
$usuario = $_POST['usuario'];
$valor_a_ahorrar = $_POST['capital'];
$valor_a_retirar = $_POST['retirado'];
$sql="SELECT sum(valor_a_ahorrar) as ahorrado, sum(valor_a_retirar) as retirado  from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where ahorros.usuario= '".$usuario."' and year(fecha)>=2024 and month(fecha)= '".$fecha."'";
$result=mysqli_query($mysqli, $sql);
if($result->num_rows > 0){
while ($mostrar=mysqli_fetch_array($result)){
$ingresos  =$mostrar['ahorrado'];
$egresos = $mostrar['retirado'];
setlocale(LC_ALL, 'spanish');
$monthNum  = $_POST['fecha'];
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());



$transac =  [$ingresos];
$transac1 = [$egresos];
$etiquetas = [$monthName];


}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comportamiento financiero</title>
<style>
.container{
width: 800px !important;
height: 700px;


}
.container .btn-primary{

    border-radius: 30px;
}





</style>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Importar chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>
<h6><?php echo
$_SESSION["nombreusuario"];?></h6>

    <div class="container">
    <h6>Ingresos y gastos usuario <?php echo $_POST['usuario'];?></h6>
    <canvas id="grafica"></canvas>
    <script type="text/javascript">
        // Obtener una referencia al elemento canvas del DOM
        const $grafica = document.querySelector("#grafica");
        // Pasaamos las etiquetas desde PHP
        const etiquetas = <?php echo json_encode($etiquetas) ?>;
        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const ahorrado = {
    label: "ahorros",
    data: <?php echo json_encode($transac) ?>, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: 'rgba(82, 210, 128, 0.6)', // Color de fondo
    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
    borderWidth: 1,// Ancho del borde
};
const gastado = {
    label: "retiros",
    data: <?php echo json_encode($transac1) ?>, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: 'rgba(255, 159, 64, 0.2)',// Color de fondo
    borderColor: 'rgba(255, 159, 64, 1)',// Color del borde
    borderWidth: 1,// Anc
};
        new Chart($grafica, {
            type: 'bar', // Tipo de gráfica
            data: {
                labels: etiquetas,
                datasets: [
                          ahorrado,
                          gastado,
                    // Aquí más datos...
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });
    </script>
   
   
    
   
   
     <a href='../paginas/mostrar_estado.php'> <button class="btn btn-sm btn-outline-secondary" type="button">VOLVER A ESTADOS DE CUENTA</button></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
</body>

</html>
    