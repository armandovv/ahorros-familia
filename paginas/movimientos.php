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
			
			
			
				function validatmonth(){
				 month = document.getElementById('month').value;
				 if(document.getElementById('month').value=="---------seleccione mes--------"){
					document.getElementById('dd').value="DEBE ESCOGER UN MES!!";
					document.getElementById('dd').style= "background-color:#F6DDCC; border-color:red;  border-style: solid; border-width: 1px";
					
					return false;
				 }
			   else{
				return true;
			   }
        
		
				}
		
      
		
		
		
				

		</script>
</head>
<body>
    <nav class="navbar navbar-expand-lg  bg-secondary">
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
                  <li><a class="dropdown-item" href="../php/logout.php">Cerrar Sesion</a></li>
                
                </ul>
              </li>
              <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../images/png-clipart-market-market-text-investment.png" width="47" height="47" border="1">
          </a>
          <ul class="dropdown-menu">
         <li><a class="dropdown-item" href="./movimientos.php">Movimientos financieros</a></li>
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
        <h2> REGISTRAR MOVIMIENTOS </h2>
            <center><table class="shape" border="1"><h2 class="enum"><img src="../images/descarga.png" width="55" height="55" border="2" style="border-radius:50%">CONSIGNACIONES</h2>
               
                <form action="../php/ingresar_ahorro.php"  method="post">
                    <tr><td>documento usuario</td><td><input type="text"  name="usuario" required/></td></tr>
                <tr><td>fecha</td><td><input type="date" id="date" name="fecha"  required/></td>
             </tr>
            <tr><td>ingrese valor a ahorrar</td><td><input type="text" id="val" name="valor_a_ahorrar"  required /></td>
            </tr>
            <tr><td></td><td><input type="hidden" name="valor_a_retirar"/></td>
            </tr>
            <tr><td>concepto</td><td><input type="text"  id="valp" name="concepto"  required /></td>
            </tr>
            <tr><td><input type="submit" id="sub"  class="btn btn-primary" value="ingresar ahorro" /><input type="reset"   class="btn btn-primary"value="limpiar"/></td>
        
            </tr></form>
        </table></center>
        <center><table class="shape" border="1"><h2 class="enum"><img src="../images/withdraw-money-icon-vector.webp" width="55" height="55" border="2" style="border-radius:50%">RETIROS CAPITAL</h2>
            <form name="retirar"  action="../php/retirar_ahorro.php" method="post">
                <tr><td>documento usuario</td><td><input type="text"  name="usuario" id="usuario" required/></td></tr>
            <tr><td>fecha</td><td><input type="date" id="dates" name="fecha"  required /></td>
         </tr>
        <tr><td></td><td><input type="hidden" name="valor_a_ahorrar"/></td>
        </tr>
        <tr><td>ingrese valor a retirar</td><td><input type="text" id="ret"  name="valor_a_retirar"   required/></td>
        </tr>
        <tr><td>concepto</td><td><input type="text" id="valps" name="concepto"   required/></td>
        </tr>
        <tr><td><input type="submit" id="sub" class="btn btn-primary" value="retirar valor" onclick="confirmar();"/><input type="reset" class="btn btn-primary" value="limpiar"/></td>
        
        </tr></form>
        </table></center>
      </div>
      <div class="div_2">
        <table class="formed">
            <form action="../php/mostrar_ahorro.php" method="post">
                <tr><td>ingrese documento usuario</td></tr>
                <tr><td><input type="text" name="usuario" required placeholder="documento usuario"></td><input type="hidden" name="documento"><td>
                    <input type="submit"  class="btn btn-primary" value="mostrar movimientos financieros"/>
             </td></tr>
              </form>
              
              <form action="../php/mostrar_ahorroxfecha.php" method="post"  onsubmit="return validatmonth()">
               <tr> <td><input type="text" name="usuario" required placeholder="documento usuario"></td>
               <td> <select name="fecha" class="fecha" id="month" style="color:#0ba842 ;"  width="30">
                    <option selected="selected">---------seleccione mes--------</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                     <option value="9">Septiembre</option>
                     <option value="10">Octubre</option>
                     <option value="11">Noviembre</option>
                     <option value="12">Diciembre</option>
                    </select></td>
                <td>
                    <input type="submit"  class="btn btn-primary" value="mostrar movimientos por mes"/>
             </td>
             <tr><td><input type="text" id="dd" class="noborder" disabled></td></tr>
              </form>
              
                <form action ="../php/mostrarconcepto.php" method ="post">
                <tr>
                   <td><input type="text" name="usuario" required placeholder="documento usuario"></td> <td><input type="text" id="concepto" name="concepto" required placeholder="ingrese el concepto" /></td>
                    <td><input type="submit"  class="btn btn-primary" value="mostrar movimientos por concepto"/></td>
                </tr>
        
        
        
        
        
            </form>
              </table>
             
      </div>
        
            
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 	
        </body>
        
        </html>
           
</body>
</html>
