<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script>
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});

function validar()
	{
	if(document.forms.Formulario.id.value=="" document.forms.Formulario.id.value=="" |||| document.forms.Formulario.correo.value=="") 
		{
		Sexy.alert('<h1>Alerta</h1><em>Validacion de Generacion de Contrasena</em><p>Debe ingresar los datos solicitados</p>');return false;			
		}
	if((mensaje=emailCheck(document.forms.Formulario.correo.value))!="")
		{
		Sexy.alert('<h1>Alerta</h1><em>Validacion de Correo</em><p>'+mensaje+'</p>');return false;			
		}
	}
</script>
</head>	
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<h3>Solicitud de  Contrase&ntilde;a</h3>
<form name="Formulario" method="post" action="index.php?id=14">
	<div align="center">
	<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Codigo</label><input name="id" type="text"></fieldset>
	<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cedula</label><input name="cedula" type="text"></fieldset>
	<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Correo</label><input name="correo" type="text"></fieldset>
	<input id="enviar" type="submit" name="enviar" value="Enviar" onclick="return validar()" >
	</div>	
	<div align="center"><a href="index.php"><strong>INICIO</strong></a></div>
</form>
</body>
</html>

	
	
	

	
