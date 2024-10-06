
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">




<?php
error_reporting(0);

$mysqli = new mysqli('127.0.0.1','root','','ahorros_familia');

if ($mysqli->connect_errno) {
	echo " LO SENTIMOS, ESTE SITIO WEB ESTA EXPERIMENTANDO PROBLEMAS  <BR>";
echo "error: Fallo al conectarse a mysql debido a : <br>";
    echo"errno: " . $mysqli->connect_errno . "<br>";
exit;
}
else
{
//echo "la coneccion fue exitosa";
$usuario = $_POST['usuario'];
$fecha = date("Y-m-d");
$sql= "select distinct nombres, usuario from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where ahorros.usuario= '".$usuario."'";
$fecha = $_POST['fecha'];
$result=mysqli_query($mysqli, $sql);
$sql= "select concepto, sum(valor_a_ahorrar) as capital, sum(valor_a_retirar) as retirado from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where ahorros.usuario= '".$usuario."' and year(fecha)>= 2024 and month(fecha)='".$fecha."'";
$results=mysqli_query($mysqli, $sql);
if($results->num_rows > 0){
while($mostrar2 	= mysqli_fetch_array($results)){
$capital =$mostrar2['capital'];
$retirado = $mostrar2['retirado'];
$concepto = $mostrar2['concepto'];
setlocale(LC_ALL, 'spanish');
$monthN  = $fecha;
$dateObj   = DateTime::createFromFormat('!m', $monthN);
$monthName = strftime('%B', $dateObj->getTimestamp());
}}


echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">';
 echo' <div class="container-fluid">';
  echo'  <a class="navbar-brand" href="../paginas/mostrar_estado.php">VOLVER</a>';
    echo'<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">';
     echo' <span class="navbar-toggler-icon"></span>';
    echo'</button>';
   echo' <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">';
     echo' <ul class="navbar-nav">';
       echo' <li class="nav-item dropdown">';
         echo' <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
           echo' DESCARGAR EXTRACTO DEL MES';
         echo' </button>';
         echo' <ul class="dropdown-menu dropdown-menu-ark">';
           echo' <li><button class="dropdown-item"';
          echo' onclick="createPDF();">';
          echo'Como aparece en la pantalla';
           echo'</button>';
           echo'</li>';
            echo'<li><a class="dropdown-item" href="extracto_m.php?usuario='.$usuario. '&fecha='.$fecha.'">';
            echo'PDF';
            echo'</a></li>';
            
         echo' </ul>';
       echo' </li>';
      echo'</ul>';
    echo'</div>';
  echo'</div>';
 
echo'</nav>';
echo'<br>';

  echo"<div class='doc' id='content'>";
 
echo'<div class="bx1" align="center">';
echo'<img src="../images/logo corp1.png">';
echo'</div>';
echo"<table>";
$sql= "select distinct nombres, usuario from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where ahorros.usuario= '".$usuario."'";
$result=mysqli_query($mysqli, $sql);
$mostrar=mysqli_fetch_array($result);
echo"<tr><td><h6>",strtoupper($mostrar['nombres']),"</h6></td></tr>";
echo"<tr><td><h6>" ,'Documento ',$mostrar['usuario']."</h6></td></tr>";
echo"</table>"; } 
echo "<table border=1>";  
 echo "<td width=120>TOTAL RETIRADO MES</td>";  
echo "<td width=100>TOTAL AHORRADO</td>"; 
echo "</table>";
$fecha = $_POST['fecha']; 
$sql = "SELECT sum(valor_a_retirar) from ahorros where usuario='".$usuario."' and year(fecha)>= 2024 and month(fecha)='".$fecha."'";
$result=mysqli_query($mysqli, $sql);
$mostrar1=mysqli_fetch_array($result);
$sql = "SELECT  sum(valor_a_ahorrar)-sum(valor_a_retirar) from ahorros where usuario='".$usuario."'";
$result=mysqli_query($mysqli, $sql);

while ($mostrar=mysqli_fetch_array($result))
{ 
echo "<table border=1>";  
 
    echo "<td width=120>",number_format($mostrar1['sum(valor_a_retirar)'])."</td>";  
    echo "<td width=100>",number_format($mostrar['sum(valor_a_ahorrar)-sum(valor_a_retirar)'])."</td>";  
	
} 

echo "</table>";
$fecha = $_POST['fecha'];
$sql = "select *from ahorros where year(fecha)>= 2023 and month(fecha)='".$fecha."' and usuario='".$usuario."'";
setlocale(LC_ALL, 'spanish');
$monthNum  = $fecha;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());
echo"<CENTER><H5>",'MOVIMIENTOS ' ,strtoupper($monthName)."</H5></center>";
echo'<center><table>';
echo'<th width=200 bgcolor="blue">ID MOVIMIENTO</th>';
echo'<th width=200 bgcolor="blue">FECHA</th>';
echo'<th width=200 bgcolor="blue">VALOR A AHORRAR</th>';
echo'<th width=200 bgcolor="blue">VALOR A RETIRAR</th>';
echo'<th width=200 bgcolor="blue">CONCEPTO</th>';
$sql = "select *from ahorros where year(fecha)>= 2024 and month(fecha)='".$fecha."' and usuario='".$usuario."'";


$result=mysqli_query($mysqli, $sql);  
if($result->num_rows > 0){
{
while ($mostrar=mysqli_fetch_array($result))
{
	
echo "<table>";  
 
    echo "<td width=200>",$mostrar['id_movimiento']."</td>";  
    echo "<td width=200>",$mostrar['fecha']."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_ahorrar'])."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_retirar'])."</td>";  
    echo "<td width=200 align='center'>",$mostrar['concepto']."</td>"; 
}  
echo "</table>"; 


}
 }
else { echo' <script>alert("NO HAY MOVIMIENTOS PARA EL MES ' ,strtoupper($monthName).'")</script> ';
	echo "<script>location.href='../paginas/mostrar_estado.php'</script>";
}



?>
</div>
<br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<form method="post" action="dat.php">
<input type="hidden" name="usuario" value="<?php echo $usuario; ?>" />
<input type="hidden" name="fecha" value="<?php echo $fecha; ?>" />
<input type="hidden" name="capital" value="<?php echo $capital; ?>"/>
<input type="hidden" name="retirado" value="<?php echo $retirado; ?>"/>
<input type="submit" value="ver comportamiento financiero">
</form>
<script>
    function createPDF() {
      var element = document.getElementById('content');
var opt = {
  margin:       1,
  filename:     'extracto.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'Landscape' },
  download: false
};

// New Promise-based usage:
html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
                const pdfUrl = pdf.output('bloburl'); // Genera una URL de blob
                          window.open(pdfUrl, '_blank');
                        });
                      }

</script>	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  

