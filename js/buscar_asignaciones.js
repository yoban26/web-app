function getAsignaciones(){
  var tipo_usuario = document.getElementById("tipo_usuario").value;
  var tipo_cliente = document.getElementById("tipo_cliente").value;
  
  if(tipo_usuario == "" && tipo_cliente == ""){
    showMsg('Debe seleccionar tipo usuario y tipo cliente!!');
  }else if(tipo_usuario == ""){
    showMsg('Debe seleccionar tipo usuario!!');
  }else if(tipo_cliente == ""){
    showMsg('Debe seleccionar tipo cliente!!');
  }else{
    console.log("tipo usuario: "+tipo_usuario);
    console.log("tipo cliente: "+tipo_cliente);
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
    conexion.open("GET","ajax/buscar_asignaciones.php?tu="+tipo_usuario+"&tc="+tipo_cliente,true);
    conexion.send();
  }
}

function showMsg(str) {
    var x = document.getElementById("snackbar");
    x.innerHTML = str;
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
