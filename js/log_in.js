

function login(){

exampleInputEmail1 = document.getElementById('exampleInputEmail1').value;

if(document.getElementById('exampleInputEmail1')== ""){
  alert("contraseña incorrecta");
 return false;
      }
      else {
       location.href="../php/login.php";
       
       }
   }

