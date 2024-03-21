<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<div id='cualquier'>



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
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result)){
echo'<div class="bx1" align="center">';
echo'<img src="../images/logo162645.png" width="300" height="160">';
echo'</div>';
echo"<table>";
echo'<h6>Apreciado Cliente</h6>';
echo"<tr><td><h6>",strtoupper($mostrar['nombres']),"</h6></td></tr>";
echo"<tr><td><h6>" ,'Documento ',$mostrar['usuario']."</h6></td></tr>";
echo"</table>"; } 
echo "<table border=1>";  
 echo "<td width=100>TOTAL RETIRADO</td>";  
echo "<td width=100>TOTAL AHORRADO</td>"; 
echo "</table>"; 
$sql = "SELECT sum(valor_a_retirar), sum(valor_a_ahorrar)-sum(valor_a_retirar) from ahorros where usuario='".$usuario."'";
$result=mysqli_query($mysqli, $sql);

while ($mostrar=mysqli_fetch_array($result))
{ 
echo "<table border=1>";  
 
    echo "<td width=100>",number_format($mostrar['sum(valor_a_retirar)'])."</td>";  
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
    echo "<td width=200 align='center'>",$mostrar['fecha']."</td>";  
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
   }


?>
</div>
<center><button type="input"><a href="javascript:imprSelec('cualquier')">IMPRIMIR</a></button><br>
<a href='../paginas/mostrar_estado.php'>VOLVER</a>
	<script language="Javascript">
	function imprSelec (cualquier)
	{ 
	var ficha=document.getElementById(cualquier);
	var ventimp=window.open('','popimpr');
	ventimp.document.write( ficha.innerHTML );
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
	}
	</script>	</center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
