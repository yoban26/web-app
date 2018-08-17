function modificar(username){
    //variable booleana para controlar el dialogo
    var r = confirm('Desea modificar el rol asignado del usuario?');
    if(r==true){
      if(username==""){
        //mostrar error si no pudo optener el id
      }else{
        var conexion;
        if(window.XMLHttpRequest){
          conexion = new XMLHttpRequest();
        }else{
          conexion = new ActiveXObject("Microsoft.XMLHttp");
        }
        conexion.onreadystatechange = function(){
          if(conexion.readyState == 4 && conexion.status == 200){
              document.getElementById("show_data").innerHTML = "";
          }
        }
        conexion.open("GET","ajax/update.php?username="+username,true);
        conexion.send();
      }
    }
}