<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Administrador.php');	
	require_once('logica/Supervisor.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$rol=$_GET['rol'];
	if ($rol=="Administrador")
		$persona = new Administrador(array($idPersona));	
	elseif ($rol=="Estudiante")
		$persona = new Estudiante(array($idPersona));
	elseif ($rol=="Supervisor")
		$persona = new Supervisor(array($idPersona));
	else
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php							
		}
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
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script>
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});

function validar(obj)
	{
	if(obj.cant.value==''||obj.cnueva.value==''||obj.cconf.value=='') 
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Contrasena</em><p>Debe llenar todos los campos.</p>');return false;}
	if(obj.cconf.value!=obj.cnueva.value)
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Contrasena</em><p>La contraseña nueva y la confirmacion deben ser iguales.</p>');return false;}
	}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<?php if($rol!="Empresa"){?>
<div align="right">Usted esta en el sistema como <?php  if($rol=="Administrador") {echo('Coordinador de Prácticas');} else echo($rol); ?>: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<?php } ?>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menu".$rol.".php") ?></td>		
		<td valign="top">
		<h3>Cambiar Contraseña</h3>
			<form name="Formulario" method="post" action="index.php?id=12&rol=<?php echo $rol ?>">
			<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Contrase&ntilde;a Anter</label><input name="cant" type="password" value="<?php echo $cedula ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nueva Contrase&ntilde;a</label><input name="cnueva" type="password" value="<?php echo $nombre ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Confirm Contrase&ntilde;a</label><input name="cconf" type="password" value="<?php echo $apellido ?>"></fieldset>
			<input id="enviar" type="submit" name="enviar" value="Enviar" onClick="return validar(document.forms.Formulario)">
			</form>
		</td>
	</tr>
</table>
</body>
</html>

	

