

function seleccionar(check,todos)
	{
	for (i=0; i<check.length; i++)
		{check[i].checked=todos.checked;}
	}
	
function verificarseleccion(check)
	{
	for (i = 0; i < check.length; i++)
		{
		if(check[i].checked)
			{return true;}
		}
	alert("Seleccione al menos un registro.");
	return false;
	}
	
