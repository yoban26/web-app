function guardar(){
	var tipo_usuario = document.getElementById("tipo_usuario_modal").value;
	var tipo_cliente = document.getElementById("tipo_cliente_modal").value;
	var id_cuestionario = document.getElementById("cuestionario_modal").value;

	console.log("TIPO USUARIO: "+tipo_usuario);
	console.log("TIPO CLIENTE: "+tipo_cliente);
	console.log("ID CUESTIONARIO: "+id_cuestionario);

	if(tipo_usuario != "" && tipo_cliente != "" && id_cuestionario != ""){
		var conexion;
		if(window.XMLHttpRequest){
			conexion = new XMLHttpRequest();
		}else{
			conexion = new ActiveXObject("Microsoft.XMLHttp");
		}

		conexion.onreadystatechange = function(){
			if(conexion.readyState == 4 && conexion.status == 200){
				finalizar(this.responseText);
			}
		}

		conexion.open("GET","ajax/nueva_asignacion.php?tu="+tipo_usuario+"&tc="+tipo_cliente+"&id="+id_cuestionario,true);
		conexion.send();
	}
}

function finalizar(resp){
	var texto = resp;
	//evaluar la respuesta del servidor
	if(texto == "1"){
		//todo bien
		//alert(texto);
		document.getElementById("guardar_datos").disabled = true;
		document.getElementById("btn_cancel").innerHTML = "Cerrar";
		var msg = '<div class="alert alert-success"><strong>Listo!</strong> Cuestionario asignado exitosamente.</div>';
		document.getElementById("result").innerHTML = msg;
	}else if(texto == "0"){
		//registro duplicado
		//alert(texto);
		document.getElementById("guardar_datos").disabled = false;
		document.getElementById("btn_cancel").innerHTML = "Cerrar";
		var msg = '<div class="alert alert-danger"><strong>Aviso!</strong> Ya existe una asignacion con esos datos.</div>';
		document.getElementById("result").innerHTML = msg;
	}else if(texto == "-1"){
		//error al insertar
		alert(texto);
	}
	console.log(texto);
	
}