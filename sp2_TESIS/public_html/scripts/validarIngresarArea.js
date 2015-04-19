function verificar(obj) 
{	missinginfo = "";	
	if (obj.nombre.value=="")
		missinginfo += "<br>-  Nombre";
	if (obj.responsable.value=="")
		missinginfo += "<br>-  Responsable";
	if (missinginfo != "") 
		return "Introduzca los siguientes datos:" + missinginfo;
	else
		return "";
}