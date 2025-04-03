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
    usuarios.documento, usuarios.nombres, usuarios.email, usuarios.telefono;





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
    text-align:center;
}
th #sortButton{
    border: none;
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
            resize: both;
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
    <script src="../js/script.js" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" id="buscador" placeholder="Buscar" aria-label="Search">
     <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
    </form>
  </div>
</nav>

    <table id="tablaDatos">
        <thead>
            <tr>
                <th>Documento<div class="resizer"></div></th>
                <th>Nombres<div class="resizer"></div></th>
                <th>Correo<div class="resizer"></div></th>
                <th>telefono<div class="resizer"></div></th>
                <th>Fecha de ingreso<div class="resizer"></div></th>
                <th>Total ahorrado <button id="sortButton" onclick="sortTable()">⇅</button>
                <div class="resizer"></div></th>
                <th colspan="2">Acciones<div class="resizer"></div></th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Aquí se insertarán los registros desde PHP -->
            <?php
           if ($result->num_rows > 0) {  while($row = $result->fetch_assoc())
             { echo "<tr>"; 
               echo "<td>" . $row["documento"] . "</td>"; 
               echo "<td>" .ucwords($row["nombres"]) . "</td>";
               echo "<td>" . $row["email"] . "</td>";
               echo "<td>" . $row["telefono"] . "</td>";
               echo "<td>" . $row["fecha_de_ingreso"] . "</td>";
                echo "<td>".'$'. number_format($row["total_ahorrado"]) . "</td>";
               echo "<td><a href='javascript:void(0)' onclick='confirmarEliminacion(" . $row["documento"] . ")'><img src='../images/trash-can_115312.png'></a></td>";
               
               echo "<td><a href='javascript:void(0)' onclick='copiarAlPortapapeles(" . $row["documento"] . ")'><img src='../images/copy-content_icon-icons.com_72793.png'></a></td>";
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
                if (newWidth > 1) { // Límite mínimo para evitar columnas muy pequeñas
                    resizer.parentElement.style.width = `${newWidth}px`;
                }
            }

            function stopResize() {
                document.removeEventListener("mousemove", resizeColumn);
                document.removeEventListener("mouseup", stopResize);
            }
        });

    </script>
     <script src="../js/busqueda.js"></script>

</body>
</html>

