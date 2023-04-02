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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <center><table>
    <form action="../php/actualizar_tel.php" method="post">
    <tr>
        <td>nuevo numero</td><td><input type="text" name="telefono" required></td>
    </tr>
<tr><td><input type="submit" value="CAMBIAR"></td></tr>



</form>
 </table> 
 <table>
    <form action="../php/actualizar_email.php" method="post">
    <tr>
        <td>nuevo email</td><td><input type="text" name="usuario" required></td>
    </tr>
<tr><td><input type="submit" value="CAMBIAR"></td></tr>



</form>
 </table> 
</center>  
</body>
</html>