function getUsuario(){
  var nombre_usuario = document.getElementById("name_user").value;

  if(nombre_usuario == ""){
    //se asume que presiono el boton buscar y quiere ver todos los usuarios
    showMsg('Debe ingresar el nombre del usuario!!!');
  }else{
    console.log(nombre_usuario);
    var conexion;
    if(window.XMLHttpRequest){
      conexion = new XMLHttpRequest();
    }else{
      conexion = new ActiveXObject("Microsoft.XMLHttp");
    }
    conexion.onreadystatechange = function(){
      if(conexion.readyState == 4 && conexion.status == 200){
        document.getElementById("result").innerHTML = this.responseText;
      }
    }
    conexion.open("GET","ajax/buscar_usuario.php?user="+nombre_usuario,true);
    conexion.send();
  }
}

function showMsg(str) {
    var x = document.getElementById("snackbar");
    x.innerHTML = str;
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}