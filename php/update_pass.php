<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


$enviarpass = $_POST['enviarpass'];
$contraseña = $_POST['contraseña'];

$query =mysqli_query ($conn,"select *from login where enviarpass='".$enviarpass."'");
	$nr= mysqli_num_rows($query);
	if ($nr==1)
	{ 


        $query =mysqli_query($conn,"update login set contraseña='".$contraseña."'");
        echo "<script> alert('se cambio la contraseña');window.location= '../index.html' </script>";
      

    }
    else{

        echo "<script> alert('codigo incorrecto');window.location= 'recuperar.php' </script>";
    }


?>