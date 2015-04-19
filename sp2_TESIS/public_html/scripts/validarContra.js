verificar(obj)
	{
	if(obj.cant.value==''||obj.cnueva.value==''||obj.cconf.value=='') 
		return 'Debe llenar todos los campos';
	if(obj.cconf.value!=obj.cnueva.value)
		return 'La contraseña nueva y la confirmacion deben ser iguales';
	}
