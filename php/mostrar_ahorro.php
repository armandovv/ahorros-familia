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
$sql= "select distinct nombres from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where ahorros.usuario= '".$usuario."'";
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result)){
echo"<table>";
echo'<h3>Apreciado Cliente</h3>';
echo"<td><h4>",$mostrar['nombres']."</h4></td>";
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
echo'<CENTER><H4>MOVIMIENTOS REGISTRADOS</H4></center>';
echo'<center><table border=1>';
echo'<th width=200 bgcolor="blue">ID MOVIMIENTO</th>';
echo'<th width=200 bgcolor="blue">FECHA</th>';
echo'<th width=200 bgcolor="blue">VALOR A AHORRAR</th>';
echo'<th width=200 bgcolor="blue">VALOR A RETIRAR</th>';
echo'<th width=200 bgcolor="blue">CONCEPTO</th>';
echo "</table>";
$sql= "select id_movimiento, fecha, valor_a_ahorrar, valor_a_retirar, concepto, nombres from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where ahorros.usuario= '".$usuario."'";



  
$result=mysqli_query($mysqli, $sql); 

   
if($result->num_rows > 0){
  
     
       
     
     
       
       
 
    


 

while ($mostrar=mysqli_fetch_array($result))
 
{
      
     
echo "<table border=1>";  
 
    echo "<td width=200>",$mostrar['id_movimiento']."</td>";  
    echo "<td width=200 align='center'>",$mostrar['fecha']."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_ahorrar'])."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_retirar'])."</td>";  
    echo "<td width=200 align='center'>",$mostrar['concepto']."</td>"; 
}  
echo "</table>"; 




}
else { echo' <script>alert("USUARIO NO EXISTE EN LA BASE DE DATOS")</script> ';
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


