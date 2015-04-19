function verificar(obj) 
{
	missinginfo = "";	
	if (obj.codigo.value=="")
	{
	 missinginfo += "<br>-  Codigo";
	}
	if (obj.cedula.value=="")
	{
	 missinginfo += "<br>-  Cedula";
	}
	if (obj.nombre.value=="")
	{
	 missinginfo += "<br>-  Nombre";
	}
	if(obj.apellido.value=="")
	{
	 missinginfo += "<br>-  Apellido";	 
	}	 
	if(obj.correo.value=="")
	{
	 missinginfo += "<br>-  Correo";	 
	}
	if (missinginfo != "") 
	{
	return "Introduzca los siguientes datos:" + missinginfo;
	}
	else
	{return "";}
}