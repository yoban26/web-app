function getUsuarios(){
    var conexion;
    if(window.XMLHttpRequest){
      conexion = new XMLHttpRequest();
    }else{
      conexion = new ActiveXObject("Microsoft.XMLHttp");
    }
    conexion.onreadystatechange = function(){
      if(conexion.readyState == 4 && conexion.status == 200){
        document.getElementById("show_data").innerHTML = this.responseText;
        //console.log(resp);
      }
    }
    conexion.open("GET","ajax/buscar_usuarios.php",true);
    conexion.send();
}

