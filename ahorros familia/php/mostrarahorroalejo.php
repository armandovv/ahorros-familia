<link rel="icon" href="../images/pesos.png">
<CENTER><H1>MOVIMIENTOS REGISTRADOS</H1></center>
<center><table border=1>
<th width=200 bgcolor="blue">ID MOVIMIENTO</th>
<th width=200 bgcolor="blue">FECHA</th>
<th width=200 bgcolor="blue">VALOR A AHORRAR</th>
<th width=200 bgcolor="blue">VALOR A RETIRAR</th>
<th width=200 bgcolor="blue">CONCEPTO</th>

</table><center>
    
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


$sql = "SELECT *FROM ahorros_alejandro";
$result=mysqli_query($mysqli, $sql);  


while ($mostrar=mysqli_fetch_array($result))
{
	
echo "<table border=1>";  
 
    echo "<td width=200>",$mostrar['id_movimiento']."</td>";  
    echo "<td width=200>",$mostrar['fecha']."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_ahorrar'])."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_retirar'])."</td>";  
    echo "<td width=200>",$mostrar['concepto']."</td>"; 
}  
echo "</table>"; 


}
echo "<table border=1>";  
 echo "<td width=100>TOTAL RETIRADO</td>";  
echo "<td width=100>TOTAL AHORRADO</td>"; 
echo "</table>"; 
$sql = "SELECT sum(valor_a_retirar), sum(valor_a_ahorrar)-sum(valor_a_retirar) from ahorros_alejandro";
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result))
{ 
echo "<table border=1>";  
 
    echo "<td width=100>",number_format($mostrar['sum(valor_a_retirar)'])."</td>";  
    echo "<td width=100>",number_format($mostrar['sum(valor_a_ahorrar)-sum(valor_a_retirar)'])."</td>";  
	
}  
echo "</table>"; 
echo"<center><a href='../paginas/ahorro_alejandro.html'>VOLVER</a></center>";
php?>

