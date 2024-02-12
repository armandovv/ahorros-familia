<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


$enviarpass = $_POST['enviarpass'];
$contraseña = $_POST['contraseña'];
$confirm = $_POST['confirm'];

if($contraseña==$confirm)
{
$query =mysqli_query ($conn,"select *from login where enviarpass='".$enviarpass."'");
	$nr= mysqli_num_rows($query);
	if ($nr==1)
	{ 
        $contraseña = password_hash($contraseña,PASSWORD_DEFAULT);
   

        $query =mysqli_query($conn,"update login set contraseña='".$contraseña."'");
        echo "<script> alert('se cambio la contraseña');window.location= '../index.html' </script>";
      

    }
    else{

        echo "<script> alert('CODIGO DE RECUPERACION INCORRECTO, INTENTELO DE NUEVO');window.location= '../index.html' </script>";
    }
}
    else{

        echo "<script> alert('VERIFIQUE LA INFORMACION INGRESADA E INTENTE DE NUEVO');window.location= '../index.html' </script>"; 
    }

?>