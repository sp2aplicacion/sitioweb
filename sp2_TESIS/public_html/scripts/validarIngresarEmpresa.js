function verificar(obj) 
{
	missinginfo = "";	
	if (obj.nit.value=="")
		missinginfo += "<br>-  NIT";
	if (obj.nombre.value=="")
		missinginfo += "<br>-  Nombre";
	if (obj.correo.value=="")
		missinginfo += "<br>-  Correo";
	if (obj.direccion.value=="")
		missinginfo += "<br>-  Direccion";
	if(obj.telefono.value=="")
		missinginfo += "<br>-  Telefono";	 
	if(obj.representante.value=="")
		missinginfo += "<br>-  Gerente";	 
	if(obj.supervisor.value=="")
		missinginfo += "<br>-  Supervisor";	 
	if(obj.objetoSocial.value=="")
		missinginfo += "<br>-  Objeto Social";	 
	if (missinginfo != "") 
		return "Introduzca los siguientes datos:" + missinginfo;
	else
		return "";
}


function verificarNumericos(obj) 
{
	missinginfo = "";	
	if (!esNum(obj.nit.value))
	 missinginfo += "<br>-  El NIT debe ser numerico con digito de verificacion";
	if (missinginfo != "") 		
	return missinginfo;	
	else
	return "";
}

function esNum(sText)
	{
	var ValidChars = "0123456789-";
	var IsNumber=true;
	var Char;
	for (i = 0; i < sText.length && IsNumber == true; i++) 
		{ 
      	Char = sText.charAt(i); 
      	if (ValidChars.indexOf(Char) == -1) 
       		IsNumber = false;
      	}
	return IsNumber;
	}