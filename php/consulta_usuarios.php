<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

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
 $sql2= "select *from usuarios";
$mysqli->query($sql);
$result=mysqli_query($mysqli, $sql2);
}else {
  echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';

  echo "<script>location.href='../index.html'</script>";
}
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Registros</title>
    <style>
        table {
            width: 85%;
            border-collapse: collapse;
            margin: 50px auto;
            
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color:rgb(160, 158, 158);
            cursor: pointer;
        }
        .edit-button, .delete-button {
            color: white;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
       
        .delete-button {
            background-color: #f44336;
        }
    </style>
 <script> function confirmarEliminacion(documento) {
    if (confirm("¿Estás seguro de que deseas eliminar este registro?")) 
    { window.location.href = "eliminar.php?documento=" + documento; } }
 </script>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th>telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se insertarán los registros desde PHP -->
            <?php
           if ($result->num_rows > 0) {  while($row = $result->fetch_assoc())
             { echo "<tr>"; 
               echo "<td>" . $row["documento"] . "</td>"; 
               echo "<td>" .ucwords($row["nombres"]) . "</td>";
               echo "<td>" . $row["email"] . "</td>";
               echo "<td>" . $row["telefono"] . "</td>";
               echo "<td><a class='delete-button'  href='javascript:void(0)' onclick='confirmarEliminacion(" . $row["documento"] . ")'>Eliminar</a></td>";
             } }
                else { echo "<tr><td colspan='3'>No hay registros</td></tr>"; 
                } 
            ?>
        </tbody>
    </table>
    <a href='../paginas/general.php'>VOLVER</a>
</body>
</html>

