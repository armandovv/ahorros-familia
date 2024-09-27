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
  echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';

  echo "<script>location.href='../index.html'</script>";
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>movimientos financieros</title>
	<link rel="icon" href="../images/pesos.png">
	<link rel= "stylesheet"  href="../css/userlog.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 
  <script type="text/javascript" language="javascript">
  function confirmar(){
			var num= document.getElementById('ret').value;
      
      var user= document.getElementById('usuario').value;
			if (confirm("¿RETIRAR VALOR $" + new Intl.NumberFormat().format(num)+ " PARA EL USUARIO " + user + "?" )){
			   document.retirar.submit()
			}else{
        document.getElementById('usuario').value="";	
				document.getElementById('date').value="";		
         document.getElementByClassName('ret').value="";
         document.getElementById('concept').value="";
			}
    }
		</script>	
    <style>
        /* Estilos del spinner */
        .spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            background-color: rgba(0, 0, 0, 0.7);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #miModal {
            display: none; /* Oculto por defecto */
            position: fixed; /* Fijo en la pantalla */
            z-index: 1000; /* Encima de otros contenidos */
            left: 0;
            top: 0;
            width: 100%; /* Ancho completo */
            height: 100%; /* Alto completo */
            overflow: auto; /* Desplazamiento si es necesario */
            background-color: rgba(0, 0, 0, 0.7); /* Fondo semi-transparente */
        }

        /* Contenedor del contenido del modal */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% desde la parte superior y centrado */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Ancho del modal */
            max-width: 600px; /* Ancho máximo del modal */
            border-radius: 5px; /* Bordes redondeados */
        }

        /* Estilos del botón de cerrar */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
    </style>
</head>

<body>
 
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container-fluid">
          <a class="navbar-brand" href="./general.php"><img src="../images/pngegg (1).png" width="55" height="55"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../images/pngegg (4).png" width="47" height="47">
                </a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../php/consulta_usuarios.php">consultar usuarios</a></li>
                <li><a class="dropdown-item" href="./create_user.php">crear usuario</a></li>
                <li><a class="dropdown-item" href="./create_document.php">generar certificado</a></li>
                 
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../images/pngegg (2).png" width="47" height="47">
                </a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../php/vew-user.php">editar perfil</a></li>
            <li><a class="dropdown-item" href="./actualizarpass.php">Cambiar contraseña</a></li>
                  <li><a class="dropdown-item" href="../php/logout.php" onclick=" return logout()">Cerrar Sesion</a></li>
                
                </ul>
              </li>
              <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../images/png-clipart-market-market-text-investment.png" width="47" height="47" border="1">
          </a>
          <ul class="dropdown-menu">
         <li><a class="dropdown-item" href="./movimientos.php">Movimientos financieros</a></li>
         <li><a class="dropdown-item" href="./mostrar_estado.php">Mostrar estados de cuentas</a></li>
         </ul>
        </li>
              <li class="nav-item">
                <h6><?php echo
      $_SESSION["nombreusuario"]; ?></h6>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class= "div-1">
        <h2> REGISTRAR MOVIMIENTOS </h2><a href="solicitudcredito.php"> <button type="submit" style="align-items: end;" class="btn btn-primary">SOLICITUD DE CREDITO</button></a>
            <center><table class="shape" border="1"><h2 class="enum"><img src="../images/descarga.png" width="55" height="55" border="2" style="border-radius:50%">CONSIGNACIONES</h2>
               
                <form id="ingresar" class="mov" action="../php/ingresar_ahorro.php"  method="post">
                    <tr><td><h4>documento usuario</h4></td><td><input type="text" id="user"  name="usuario" required/></td></tr>
               
            <tr><td><h4>ingrese valor a ahorrar</h4></td><td><input type="text" id="val" name="valor_a_ahorrar" class="number"  required /></td>
            </tr>
            <tr><td></td><td><input type="hidden" name="valor_a_retirar"/></td>
            </tr>
            <tr><td><h4>concepto</h4></td><td><input type="text"  id="valp" name="concepto"  required /></td>
            </tr>
            <tr><td><input type="submit" id="sub"  class="btn btn-primary" value="ingresar ahorro" /></td><td><input type="reset"   class="btn btn-primary"value="limpiar"/></td>
        
            </tr></form>
            <div id="miModal">
        <div class="modal-content">
            <span class="close" id="cerrarModal">&times;</span>
            <div id="mensaje"></div>
        </div>
    </div>
          <div class="spinner" id="spinner">
            
          </div>

        </table></center>
        <center><table class="shape" border="1"><h2 class="enum"><img src="../images/withdraw-money-icon-vector.webp" width="55" height="55" border="2" style="border-radius:50%">RETIROS CAPITAL</h2> 
            <form name="retirar" class="mov" action="../php/retirar_ahorro.php" method="post">
                <tr><td><h4>documento usuario</h4></td><td><input type="text"  name="usuario" id="usuario" required/></td></tr>
           
        <tr><td></td><td><input type="hidden" name="valor_a_ahorrar"/></td>
        </tr>
        <tr><td><h4> valor a retirar</h4></td><td><input type="text" id="ret"  name="valor_a_retirar" required/></td>
        </tr>
        
        <tr><td><h4>concepto</h4></td><td><input type="text" id="valps" name="concepto"   required/></td>
        </tr>
        <tr><td><input type="submit" id="sub" class="btn btn-primary" value="retirar valor" onclick="confirmar();"/></td><td><input type="reset" class="btn btn-primary" value="limpiar"/></td>
        
        </tr></form>
        </table> </center>
       
      </div>
      
 

             
      </div>
        <script src=../js/log_out.js></script>
        <script>
        document.getElementById('ingresar').onsubmit = async function(e) {
            e.preventDefault(); // Prevenir el envío normal del formulario
            document.getElementById('spinner').style.display = 'block'; // Mostrar el spinner

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: this.method,
                    body: formData,
                });
                const message = await response.text(); // Obtener el mensaje del PHP
                console.log("Formulario enviado");
                document.getElementById('mensaje').innerHTML = message; // Mostrar el mensaje
                document.getElementById('miModal').style.display = 'block';
                this.reset();
            } catch (error) {
               
              document.getElementById('mensaje').innerHTML = message;
              document.getElementById('miModal').style.display = 'block';
            } finally {
                document.getElementById('spinner').style.display = 'none'; // Ocultar el spinner
            }
        };
        document.getElementById('cerrarModal').onclick = function() {
            document.getElementById('miModal').style.display = 'none';
        };

        // Cerrar el modal si se hace clic fuera del contenido
        window.onclick = function(event) {
            if (event.target == document.getElementById('miModal')) {
                document.getElementById('miModal').style.display = 'none';
            }
        };
    </script>   
        
            
            
           
</body>
</html>