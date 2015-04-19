function verificar(obj) 
{	missinginfo = "";	
	if (obj.nombre.value=="")
		missinginfo += "<br>-  Nombre";
	if (obj.area.value==0)
		missinginfo += "<br>-  Area";
	if (missinginfo != "") 
		return "Introduzca los siguientes datos:" + missinginfo;
	else
		return "";
}