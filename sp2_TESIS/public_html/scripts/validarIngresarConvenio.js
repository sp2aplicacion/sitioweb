function verificar(obj) 
{
	missinginfo = "";	
	if (obj.nombre.value=="")
		missinginfo += "<br>-  Nombre";
	if (obj.supervisor.value=="")
		missinginfo += "<br>-  Supervisor";
	if (obj.fechaInicial.value=="")
		missinginfo += "<br>-  Fecha Inicial";
	if (obj.fechaFinal.value=="")
		missinginfo += "<br>-  Fecha Final";
	if (obj.area.value==0)
		missinginfo += "<br>-  Area";
	if (missinginfo != "") 
		return "Introduzca los siguientes datos:" + missinginfo;
	else
		return "";
}