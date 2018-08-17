function eliminar(id){
    //variable booleana para controlar el dialogo
    var r = confirm('Desea eliminar el cuestionario asignado?');
    if(r==true){
      if(id==""){
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
        conexion.open("GET","ajax/delete.php?id="+id,true);
        conexion.send();
      }
    }
}
