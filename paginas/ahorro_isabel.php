
<!DOCTYPE html>
<html lang="en">
<?php>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHORRO ISABEL</title>
	<link rel="icon" href="../images/pesos.png">
	<link rel= "stylesheet"  href="../css/userlog.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		<script type="text/javascript" language="javascript">
			
			function toggleButton()
            {
                var date = document.getElementById('date').value;
				
                var val = document.getElementById('val').value;
				var valp = document.getElementById('valp').value;
 
                if  (date.length == 0 || /^\s+$/.test(date)) {
                   alert('debe ingresar la fecha');
				   return false;
                } 
				 if  (val.length == 0 || /^\s+$/.test(val)) {
                   alert('ingrese un valor');
				   return false;
                }if( valp.length == 0 || /^\s+$/.test(valp)){
					alert('ingrese el concepto');
					return false;
				}else{
					return true;
				}
            }
			function validateform()
            {
                var dates = document.getElementById('dates').value;
				
                var vals = document.getElementById('vals').value;
				var valps = document.getElementById('valps').value;
 
                if  (dates.length == 0 || /^\s+$/.test(dates)) {
                   alert('debe ingresar la fecha');
				   return false;
                } 
				 if  (vals.length == 0 || /^\s+$/.test(vals)) {
                   alert('ingrese un valor');
				   return false;
                }if( valps.length == 0 || /^\s+$/.test(valps)){
					alert('ingrese el concepto');
					return false;
				}else{
					return true;
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

