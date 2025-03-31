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
 $sql2= "SELECT 
    usuarios.documento,
    usuarios.nombres,
    usuarios.email,
    usuarios.telefono,
    min(ahorros.fecha) as fecha_de_ingreso,
    SUM(ahorros.valor_a_ahorrar) - SUM(ahorros.valor_a_retirar) AS total_ahorrado
FROM 
    usuarios
INNER JOIN 
    ahorros
ON 
    usuarios.documento = ahorros.usuario
GROUP BY 
    usuarios.documento, usuarios.nombres, usuarios.email, usuarios.telefono
ORDER BY 
    usuarios.documento;




";
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
            width: 100%;
            border-collapse: collapse;

            
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            position: relative;
        }

        tr:hover {
            background-color:rgb(208, 191, 191);
            cursor: pointer;
        }
        th {
  background-color: #f2f2f2;
  cursor: col-resize; /* Cambia el cursor cuando pasas sobre la cabecera */
}
.resizer {
            position: absolute;
            top: 0;
            right: 0;
            width: 10px; /* Aumentamos el ancho para que sea más fácil de capturar */
            height: 100%;
            cursor: col-resize;
            user-select: none;
            z-index: 1; /* Asegura que el área esté por encima del contenido */
        }

 </style>
 <script> function confirmarEliminacion(documento) {
    if (confirm("¿Estás seguro de que deseas eliminar este registro?")) 
    { window.location.href = "eliminar.php?documento=" + documento; } }
 </script>
    <script> function copiarAlPortapapeles(documento) {
        var aux = document.createElement("input");
        aux.setAttribute("value", documento);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
        alert("Documento copiado al portapapeles: " + documento);
    }
    </script>
    
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Documento<div class="resizer"></div></th>
                <th>Nombres<div class="resizer"></div></th>
                <th>Correo<div class="resizer"></div></th>
                <th>telefono<div class="resizer"></div></th>
                <th>Fecha de ingreso<div class="resizer"></div></th>
                <th>Total ahorrado<div class="resizer"></div></th>
                <th>Acciones<div class="resizer"></div></th>
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
               echo "<td>" . $row["fecha_de_ingreso"] . "</td>";
                echo "<td>" . number_format($row["total_ahorrado"]) . "</td>";
               echo "<td><a href='javascript:void(0)' onclick='confirmarEliminacion(" . $row["documento"] . ")'><img src='../images/delete.png'></a>";
               echo "<a href='javascript:void(0)' onclick='copiarAlPortapapeles(" . $row["documento"] . ")'><img src='../images/archivos.png'></a></td>";
               echo "</tr>";
             } }
                else { echo "<tr><td colspan='3'>No hay registros</td></tr>"; 
                } 
            ?>
        </tbody>
    </table>
    <a class='ref' href='../paginas/general.php'>VOLVER</a>
    <script>
        const resizers = document.querySelectorAll(".resizer");
        resizers.forEach(resizer => {
            let startX, startWidth;

            // Detecta el evento inicial al presionar el mouse
            resizer.addEventListener("mousedown", (e) => {
                startX = e.pageX;
                startWidth = resizer.parentElement.offsetWidth;

                // Agrega listeners para mover y detener el redimensionamiento
                document.addEventListener("mousemove", resizeColumn);
                document.addEventListener("mouseup", stopResize);
            });
            function resizeColumn(e) {
                const newWidth = startWidth + (e.pageX - startX);
                if (newWidth > 50) { // Límite mínimo para evitar columnas muy pequeñas
                    resizer.parentElement.style.width = `${newWidth}px`;
                }
            }

            function stopResize() {
                document.removeEventListener("mousemove", resizeColumn);
                document.removeEventListener("mouseup", stopResize);
            }
        });

    </script>
</body>
</html>

