<link rel="icon" href="../images/pesos.png">
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
  echo '<script>alert("SE CERRO LA SESION DE FORMA INESPERADA")</script> ';

  echo "<script>location.href='../index.html'</script>";
}
$mysqli->close();
?>
<h4><?php echo
      $_SESSION["nombreusuario"];?></h4>
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

echo'<table><center>';
echo'<form name="eliminar" method="POST"  action="../php/eliminar.php">';
   echo'<h2>SELECCIONE DOCUMENTO DE USUARIO</h2><br>';
    
      //Creamos la sentencia SQL y la ejecutamos
      $sql="select distinct documento from usuarios ";
      $result=mysqli_query($mysqli, $sql); 
      echo '<select name="documento" id="documento" style="width:230px; height:30px">';
      //Mostramos los registros en forma de menú desplegable
      echo'<option selected="selected">----seleccione N. de documento----</option>';
      while ($row = $result->fetch_array()) {
      echo '<option  style="width:200px; height:30px">'.$row["documento"];
      }
      $result->free_result();
  
   echo' </select>';
    echo'<br><br>';
   echo' <input TYPE="submit" value="Borrar Usuario"  style="width:200px; height:30px"  onclick="confirmar();"/>';
echo'</form>';
echo'</center></table>';
echo'<br>';
}

echo"<center><a href='../php/consulta_usuarios.php'>VOLVER</a></center>";
?>
<script type="text/javascript" language="javascript"> 

function confirmar(){
			var usr= document.getElementById('documento').value;
         if( document.getElementById('documento').value=="----seleccione N. de documento----"){
   alert("DEBE ESCOGER UN NUMERO DE DOCUMENTO DE USUARIO");
   return false;
}else {if (confirm("ELIMINAR USUARIO " +usr+ "?" )){
			   document.eliminar.submit()
			}else{
        document.getElementById('documento').value="";	
				
			}
    }
   }
  
</script>