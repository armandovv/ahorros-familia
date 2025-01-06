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
 if ($stmt->execute() === TRUE) { echo "Registro eliminado exitosamente"; }
  else { echo "Error al eliminar el registro: " . $conn->error; } 
  // Cerrar la conexión 
  $stmt->close(); 
  $conn->close();
 ?>



