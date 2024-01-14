function validar(){
   
    var pasNew1=document.getElementById("inputPassword").value;
    var pasNew2=document.getElementById("inputPassword5").value;
 
  
  if(pasNew1!= pasNew2){
  alert("CAMPO CONTRASEÑA NUEVA Y CAMPO CONFIRMACION NO COINCIDEN");
  document.getElementById("contraseña").focus();
  return false;
  } else{
    
    return true;
  }
}
  