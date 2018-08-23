var user="";

function modificar(username){
    user = username;
}

function update(){
    var user_type = document.getElementById("tipo_usuario_modal").value;
    console.log(user_type);
        //variable booleana para controlar el dialogo
          if(user_type==""){
            //mostrar error si no pudo optener el id
            var msg = '<div class="alert alert-warning"><strong>Aviso!</strong> Seleccione el tipo de usuario.</div>';
            document.getElementById("show_advice").innerHTML = msg;
          }else{
            var conexion;
            if(window.XMLHttpRequest){
              conexion = new XMLHttpRequest();
            }else{
              conexion = new ActiveXObject("Microsoft.XMLHttp");
            }
            conexion.onreadystatechange = function(){
              if(conexion.readyState == 4 && conexion.status == 200){
                  var resp = this.responseText;
                  console.log(resp);
                  resultado(resp);
              }
            }
            conexion.open("GET","ajax/update.php?user_type="+user_type+"&user="+user,true);
            conexion.send();
          }
}

function resultado(num){
  if(num == "1"){
    //update con exito
    document.getElementById("guardar_datos").disabled = true;
    document.getElementById("btn_cancel").innerHTML = "Cerrar";
    var msg = '<div class="alert alert-success"><strong>Listo!</strong> Rol de usuario modificado con exito.</div>';
    document.getElementById("show_advice").innerHTML = msg;
    document.getElementById("result").innerHTML = "";
  }else if(num== "0"){
    //error al tratar de actualizar
    document.getElementById("guardar_datos").disabled = false;
    document.getElementById("btn_cancel").innerHTML = "Cerrar";
    var msg = '<div class="alert alert-danger"><strong>Aviso!</strong> Se produjo un error al intentar modificar.</div>';
    document.getElementById("show_advice").innerHTML = msg;
  }

}