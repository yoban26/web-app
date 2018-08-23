function guardar_usuario(){
	//obtener datos de formulario
	var nombre = document.getElementById("nombre").value;
	var apellido =  document.getElementById("apellido").value;
	var username = document.getElementById("usuario").value;
	var pass = document.getElementById("password").value;
    var pass_conf = document.getElementById("password_confirm").value;
    var estado = document.getElementById("estado").value;
    var id_rol = document.getElementById("tipo_usuario").value;
    var id_region = document.getElementById("region_id").value;
    var id_cliente = document.getElementById("cliente_id").value;
    var error = "";
    if(pass != pass_conf){
	    error = '<div class="alert alert-danger">'+
	                  '<strong>Aviso!</strong> Las contrase&ntilde;as ingresadas no coinciden.'+
	                  '</div>';
	    document.getElementById("show_error").innerHTML = error;
    }else{
    	document.getElementById("show_error").innerHTML = "";
    	var conexion;
    	if(window.XMLHttpRequest){
    		conexion = new XMLHttpRequest();
    	}else{
    		conexion = new ActiveXObjetct("Microsoft.XMLHttp");
    	}
    	conexion.onreadystatechange = function(){
    		if(conexion.readyState == 4 && conexion.status == 200){
    			var resp = this.responseText;
    			result(resp);
    		}
    	}
        conexion.open("GET","ajax/usuario.php?nombre="+nombre+"&apellido="+apellido+"&username="+username+"&password="+password+"&estado="+estado+"&id_rol="+id_rol+"&id_region="+id_region+"&id_cliente="+id_cliente,true);
    	conexion.send();
    }
}

function result(resp){
	if(resp=="1"){
		console.log(resp);
        document.getElementById("btn_save").disabled = true;
        document.getElementById("btn_clean").disabled = true;
        document.getElementById("btn_cancel").innerHTML = "Cerrar";
        var msg = '<div class="alert alert-success"><strong>Listo!</strong> Usuario creado con exito.</div>';
        document.getElementById("show_advice").innerHTML = msg;
	}else if(resp=="0"){
		console.log(resp);
        var msg = '<div class="alert alert-warning"><strong>Aviso!</strong> El nombre de usuario ya existe..</div>';
        document.getElementById("show_advice").innerHTML = msg;
	}else if(resp=="-1"){
		console.log(resp);
        var msg = '<div class="alert alert-danger"><strong>Error!</strong> Se ha producido un error inesperado al intentar crear el usuario..</div>';
        document.getElementById("show_advice").innerHTML = msg;
	}
}