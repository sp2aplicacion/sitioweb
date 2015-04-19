function verificar(obj) 
{	missinginfo = "";	

	if (obj.id.value=="")
		missinginfo += "<br>-  ID";
	if (obj.nombre.value=="")
		missinginfo += "<br>-  Nombre";
	if (obj.director.value=="")
		missinginfo += "<br>-  Director";
	
	if (missinginfo != "") 
		return "Introduzca los siguientes datos:" + missinginfo;
	else
		return "";
}