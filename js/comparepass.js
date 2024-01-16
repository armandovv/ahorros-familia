function validar(){
   var cod = document.getElementById("exampleFormControlInput1").value;
    var pasNew1=document.getElementById("inputPassword").value;
    var pasNew2=document.getElementById("inputPassword5").value;
 if(cod.length=="0"){

  return false;
 }
  
  if(pasNew1!= pasNew2){
  alert("LOS CAMPOS CONTRASEÑA NUEVA Y CONFIRMACION NO COINCIDEN");
  document.getElementById("inputpassword").focus();
  return false;
  } else{
    
    return true;
  }
}
  