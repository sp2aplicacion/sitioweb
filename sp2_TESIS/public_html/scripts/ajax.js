function xmlhttp(){
	var xmlhttp;
	try{xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");}
	catch(e){
		try{xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");}
		catch(e){
			try{xmlhttp = new XMLHttpRequest();}
			catch(e){
				xmlhttp = false;
			}
		}
	}
	if (!xmlhttp) 
		return null;
	else
		return xmlhttp;
}

function buscar(idPagina,parametro){
	var query = document.getElementById('q').value;
	var resultados = document.getElementById('resultados');
	var loading = document.getElementById('loading');
	var ajax = xmlhttp();
	
//	alert(query);
	ajax.open("POST","indexAjax.php?id="+idPagina);

	ajax.onreadystatechange=function(){
		if(ajax.readyState==1){
			loading.innerHTML = "<img src='img/loading.gif'>";
		}
		if(ajax.readyState==4){
			resultados.innerHTML = ajax.responseText;
			loading.innerHTML = "<img src='img/loading2.gif'>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("q="+query+parametro);
}

function buscarSupervisor(idPagina,parametro){
	var query = document.getElementById('q').value;
	var resultados = document.getElementById('resultados2');
	var loading = document.getElementById('loading2');
	var ajax = xmlhttp();
	ajax.open("POST","indexAjax.php?id="+idPagina);

	ajax.onreadystatechange=function(){
		if(ajax.readyState==1){
			loading.innerHTML = "<img src='img/loading.gif'>";
		}
		if(ajax.readyState==4){
			resultados.innerHTML = ajax.responseText;
			loading.innerHTML = "<img src='img/loading2.gif'>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("q="+query+parametro);
}

function buscadorLista(idPagina,parametro){	
	var query = document.getElementById('textoConsultaLista').value;
	var resultadosLista = document.getElementById('resultadosLista');
	var ajax = xmlhttp();
	ajax.open("POST","indexAjax.php?id="+idPagina);

	ajax.onreadystatechange=function(){
		if(ajax.readyState==1){
		}
		if(ajax.readyState==4){
			resultadosLista.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("q="+query+parametro);
}

function actualizar(idPagina,dato){
	var resultados = document.getElementById('resultados');
	var loading = document.getElementById('loading');
	var ajax = xmlhttp();
	ajax.open("POST","indexAjax.php?id="+idPagina);

	ajax.onreadystatechange=function(){
		if(ajax.readyState==1){
			loading.innerHTML = "<img src='img/loading.gif'>";
		}
		if(ajax.readyState==4){
			resultados.innerHTML = ajax.responseText;
			loading.innerHTML = "<img src='img/loading2.gif'>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(dato);
}

function insertar(idPagina,datos){
	var resultados = document.getElementById('resultados');
	var loading = document.getElementById('loading');
	var ajax = xmlhttp();
	ajax.open("POST","indexAjax.php?id="+idPagina);

	ajax.onreadystatechange=function(){
		if(ajax.readyState==1){
			loading.innerHTML = "<img src='img/loading.gif'>";
		}
		if(ajax.readyState==4){
			resultados.innerHTML = ajax.responseText;
			loading.innerHTML = "<img src='img/loading2.gif'>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(datos);
}

function insertarLista(idPagina,datos){
	var valor = document.getElementById('valorConsultaLista').value;
	var resultados = document.getElementById('resultados');
	var loading = document.getElementById('loading');
	var ajax = xmlhttp();
	ajax.open("POST","indexAjax.php?id="+idPagina);

	ajax.onreadystatechange=function(){
		if(ajax.readyState==1){
			loading.innerHTML = "<img src='img/loading.gif'>";
		}
		if(ajax.readyState==4){
			resultados.innerHTML = ajax.responseText;
			loading.innerHTML = "<img src='img/loading2.gif'>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idEstudiante="+valor+datos);
}

function eliminar(idPagina,dato){
	var resultados = document.getElementById('resultados');
	var loading = document.getElementById('loading');
	var ajax = xmlhttp();
	ajax.open("POST","indexAjax.php?id="+idPagina);

	ajax.onreadystatechange=function(){
		if(ajax.readyState==1){
			loading.innerHTML = "<img src='img/loading.gif'>";
		}
		if(ajax.readyState==4){
			resultados.innerHTML = ajax.responseText;
			loading.innerHTML = "<img src='img/loading2.gif'>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(dato);
}