

function login(){

var email = document.getElementById('exampleInputEmail1').value;
var pass = document.getElementById("exampleInputPassword1").value;
if(( email== "")||(pass=="")){
 alert("usuario o clave incorrectos");
 return false;
      }
      else {
        
       location.href="../php/login.php";
       
       }
   }

