function verificar(obj) 
{	missinginfo = "";	

	if (obj.id.value=="")
		missinginfo += "<br>-  ID";
	if (obj.nombre.value=="")
		missinginfo += "<br>-  Nombre";
	if (obj.decano.value=="")
		missinginfo += "<br>-  Decano";
	if (obj.coordinador.value=="")
		missinginfo += "<br>-  Coordinador";

	if (missinginfo != "") 
		return "Introduzca los siguientes datos:" + missinginfo;
	else
		return "";
}