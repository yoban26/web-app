function setParameters(){
  var region_id = document.getElementById("region_id").value;
  var cliente_id = document.getElementById("cliente_id").value;
  console.log("id region: "+region_id);
  console.log("id cliente: "+cliente_id);
  var conexion;
  if(window.XMLHttpRequest){
    conexion = new XMLHttpRequest();
  }else{
    conexion = new ActiveXObject("Microsoft.XMLHttp");
  }
  conexion.onreadystatechange = function(){
    if(conexion.readyState == 4 && conexion.status == 200){
      //mostrar mensaje en Dashboard Administrador
      document.getElementById("replace_data").innerHTML = this.responseText;
    }
  }
  conexion.open("GET","ajax/admin_parameters.php?region_id="+region_id+"&cliente_id="+cliente_id,true);
  conexion.send();
}
