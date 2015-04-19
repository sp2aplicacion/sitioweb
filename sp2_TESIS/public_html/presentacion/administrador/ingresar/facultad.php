<?php 
	session_start();	
	require_once('logica/Administrador.php');
	require_once('logica/Facultad.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Administrador(array($idPersona));
	$persona->consultarNombre();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/validarIngresarFacultad.js"></script>
<script src="scripts/validarCorreo.js"></script>
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script>
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});

function validar()
	{
	if((mensaje=verificar(document.forms.Formulario))!= "") 
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Facultad</em><p>'+ mensaje +'</p>');return false;}
	}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
			<h3>Agregar Facultad</h3>
			<form name="Formulario" method="post" action="index.php?id=257">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*ID</label><input name="id" type="text"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Nombre</label><input name="nombre" type="text"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Decano</label><input name="decano" type="text"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Coordinador</label><input name="coordinador" type="text"></fieldset>
				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Telefono</label><input name="telefono" type="text"></fieldset>
				
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();">	
				</div>
			</form>
		</td>
	</tr>
</table>
</body>
</html>