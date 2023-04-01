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
$sql= "select distinct nombres, usuario from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where ahorros.usuario= '".$usuario."'";
$result=mysqli_query($mysqli, $sql);
if($result->num_rows > 0){
while ($mostrar=mysqli_fetch_array($result)){
echo"<center><table>";
echo'<h3>SISTEMA DE AHORROS FAMILIAR</h3>';
echo'<h3>certifica</h3>';
echo"<tr><td><h4>",'Por medio de la presente, hacemos constar que el señor(a) ',$mostrar['nombres'].' con documento ',$mostrar['usuario'].':'."</h4></td></tr>" ; }

$sql="select min(fecha)from ahorros where usuario= '".$usuario."'";
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result)){
echo "<tr><td><h4>",'posee sus ahorros en nuestro sistema desde la fecha ' ,$mostrar['min(fecha)']."</h4></td></tr>"; }
$sql = "SELECT sum(valor_a_retirar), sum(valor_a_ahorrar)-sum(valor_a_retirar) from ahorros where usuario='".$usuario."'";
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result)){
 echo "<tr><td><h4>",'saldo a la fecha $' ,number_format($mostrar['sum(valor_a_ahorrar)-sum(valor_a_retirar)']).' pesos MCTE'."</h4><td></td><td width=50></td></tr>" ;  
} 

setlocale(LC_TIME, "spanish");
echo "<tr><td><h4>" ,"Se expide este certificado a solicitud del interesado el dia ",utf8_encode(strftime("%A %d de %B del %Y")),"</h4></td></tr>"; 


echo"<tr height= 90></tr>";
echo "<tr><td><h4>Cordialmente</h4></td></tr>"; 
echo "<tr><td><img src=../images/firma.jpeg width=190 height=85></td></tr>";
echo "<tr><td>Jorge Armando Varela</td></tr>";  
echo "<tr><td>Administrador financiero</td></tr>"; 
echo "</table></center>";




  
     
       
     
     
       
       
 
    


 





}
else { echo' <script>alert("USUARIO NO EXISTE EN LA BASE DE DATOS")</script> ';
	echo "<script>location.href='../paginas/create_document.php'</script>";
}
  }



?>
</div>
<center><button type="input"><a href="javascript:imprSelec('cualquier')">IMPRIMIR</a></button><br>
<a href='../paginas/movimientos.php'>VOLVER</a>
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


