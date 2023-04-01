<!DOCTYPE html>
<html lang="en">
	<?php>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHORRO ALEJANDRO</title>
	<link rel="icon" href="../images/pesos.png">
	<link rel= "stylesheet"  href="../css/userlog.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		<script type="text/javascript" language="javascript">
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
		function confirmar(){
			var num= document.getElementById('ret').value;
			if (confirm("¿RETIRAR VALOR $" + new Intl.NumberFormat().format(num)+ "?")){
			   document.retirar.submit()
			}else{
				document.getElementById('date').value="";		
         document.getElementById('ret').value="";
         document.getElementById('concept').value="";
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
		<img src="../images/pngegg (2).png" width="47" height="47">
		</a>
		<ul class="dropdown-menu">
		  <li><a class="dropdown-item" href="./actualizarpass.html">Cambiar contraseña</a></li>
		 
		</ul>
	  </li>
	  <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		<img src="../images/pngegg (4).png" width="47" height="47">
		</a>
		<ul class="dropdown-menu">
		<li><a class="dropdown-item" href="./general.php">Usuario</a></li>
		  <li><a class="dropdown-item" href="../php/logout.php">Cerrar Sesion</a></li>
		 
		</ul>
	  </li>
	</ul>
  </div>
</div>
</nav> 
<h2> AHORROS ALEJANDRO </h2>
	<center><table class="shape" border="1"><h2 class="enum"><img src="../images/descarga.png" width="55" height="55" border="2" style="border-radius:50%">CONSIGNACIONES</h2>
		<form action="../php/ingresar_ahorroalejo.php" method="post">
		<tr><td>fecha</td><td><input type="date" name="fecha" required/></td>
     </tr>
    <tr><td>ingrese valor a ahorrar</td><td><input type="text" name="valor_a_ahorrar" required/></td>
    </tr>
	<tr><td></td><td><input type="hidden" name="valor_a_retirar"/></td>
    </tr>
	<tr><td>concepto</td><td><input type="text" name="concepto" required/></td>
	</tr>
	<tr><td><input type="submit"   class="btn btn-primary" value="registrar"/><input type="reset"   class="btn btn-primary"value="limpiar"/></td>

	</tr></form>
</table></center><center><table class="shape" border="1"><h2 class="enum"><img src="../images/withdraw-money-icon-vector.webp" width="55" height="55" border="2" style="border-radius:50%">RETIROS CAPITAL</h2>

	<form name="retirar" action="../php/retirar_ahorroalejo.php" method="post">
	<tr><td>fecha</td><td><input type="date" name="fecha" id="date" required/></td>
 </tr>
<tr><td></td><td><input type="hidden" name="valor_a_ahorrar"/></td>
</tr> 
<tr><td>ingrese valor a retirar</td><td><input type="text"  name="valor_a_retirar" id="ret" required/></td>
</tr>
<tr><td>concepto</td><td><input type="text" name="concepto" id="concept" required/></td>
</tr>
<tr><td><input type="submit"  class="btn btn-primary" value="retirar valor" onclick="confirmar();"/><input type="reset" class="btn btn-primary" value="limpiar"/></td>

</tr></form>
</table></center>
<table class="formed">
    <form action="../php/mostrarahorroalejo.php" method="post">
		<tr><td>
			<input type="submit"  class="btn btn-primary" value="mostrar movimientos financieros"/>
	 </td></tr>
      </form>
	  <tr><td>
	  <form action="../php/mostrar_ahorroxfechaalejo.php" method="post" onsubmit="return validatmonth()">
		
		<select name="fecha" class="fecha"  id="month" style="color:#03302f ;"  width="30">
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
			<input type="submit"  class="btn btn-primary" value="mostrar movimientos por mes" />
	 </td></tr>
	 <tr><td><input type="text" id="dd" class="noborder" disabled></td></tr>
      </form></table>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
	</body>
	 
	
</html>