


<div id='cualquier'>
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

$fecha = $_POST['fecha'];
$sql = "select *from ahorros_alejandro where year(fecha)>= 2022 and month(fecha)='".$fecha."'";
$result=mysqli_query($mysqli, $sql);  
if($result->num_rows > 0){
{
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
 //else
}echo "</table>";  } //echo "NO HAY MOVIVMIENTOS";
          
 else { echo' <script>alert("NO HAY MOVIMIENTOS PARA EL MES '.$fecha.'")</script> ';
	echo "<script>location.href='../paginas/ahorro_alejandro.html'</script>";
}
}

echo"<center><a href='../paginas/ahorro_alejandro.html'>VOLVER</a></center>";

?>
</div>
<center><button type="input"><a href="javascript:imprSelec('cualquier')">IMPRIMIR</a></button>
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
	
	/*function viewmonth(){
var mes= $fecha;
if(mes='1'){
	document.getElementById('mes').value='ENERO';
}if(mes='2'){
	document.getElementById('mes').value='FEBRERO';
}if(mes='3'){
	document.getElementById('mes').value='MARZO';
} if(mes='4'){
	document.getElementById('mes').value='ABRIL';
}if(mes='5'){
	document.getElementById('mes').value='MAYO';
} if(mes='6'){
	document.getElementById('mes').value='JUNIO';
} if(mes='7'){
	document.getElementById('mes').value='JULIO';
} if(mes='8'){
	document.getElementById('mes').value='AGOSTO';
} if(mes='9'){
	document.getElementById('mes').value='SEPTIEMBRE';
} if(mes='10'){
	document.getElementById('mes').value='OCTUBRE';
} if(mes='11'){
	document.getElementById('mes').value='NOVIENBRE';
} if(mes='12'){
	document.getElementById('mes').value='DICIEMBRE';
} else{
	document.getElementById('mes').value='';
}



	}
return viewmonth();


	</script>	</center>*/

