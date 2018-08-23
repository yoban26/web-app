function buscar_cliente(region){
    //var region = document.getElementById("region_id").value;
    //console.log("region el js: "+region);
    if(region == ""){
      //show error
    }else{
      var conexion;
      if(window.XMLHttpRequest){
        conexion = new XMLHttpRequest();
      }else{
        conexion = new ActiveXObject("Microsoft.XMLHttp");
      }
      conexion.onreadystatechange = function(){
        if(conexion.readyState == 4 && conexion.status == 200){
          document.getElementById("id_cliente").innerHTML = this.responseText;
        }
      }
      conexion.open("GET","ajax/select_cliente.php?region="+region,true);
      conexion.send();
    }
  }
