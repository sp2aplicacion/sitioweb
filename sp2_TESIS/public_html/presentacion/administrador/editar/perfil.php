<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$hecho=false;
	if(!empty($_POST['actualizar']))
		{
		$datos = array();
		$datos[0]=$_POST['codigo'];
		$datos[1]=$_POST['cedula'];
		$datos[2]=$_POST['nombre'];
		$datos[3]=$_POST['apellido'];
		$datos[5]=$_POST['correo'];
		$datos[6]=$_POST['telefono'];
		$datos[7]=$_POST['celular'];
		$datos[8]=$_POST['direccion'];
		$persona = new Administrador($datos);
		$persona->actualizar();
		$hecho=true;
		}

	$persona = new Administrador(array($idPersona));
	$persona->consultar();
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
<script src="scripts/validarIngresarAdministrador.js"></script>
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
	if((mensaje=verificar(document.forms.Formulario))!="") 
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Administrador</em><p>'+mensaje+'</p>');return false;}
	if((mensaje=emailCheck(document.forms.Formulario.correo.value))!="")
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Correo</em><p>'+mensaje+'</p>');return false;}
	}
</script>
</head>
<body>

<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr><div class="">
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
			<h3>Actualizar Perfil</h3>
			<?php 
				if($hecho)
					echo "<div class='rojo' align='center'><strong>Los datos se han actualizado</strong></div>"
			?>
			<form name="Formulario" method="post" action="index.php?id=201">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Codigo</label><input name="codigo" type="text" value="<?php echo $persona->getCodigo() ?>" readonly></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cedula</label><input name="cedula" type="text" value="<?php echo $persona->getCedula() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><input name="nombre" type="text" value="<?php echo $persona->getNombre() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Apellido</label><input name="apellido" type="text" value="<?php echo $persona->getApellido() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Correo Institucional</label><input name="correo" type="text" value="<?php echo $persona->getCorreo() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Telefono</label><input name="telefono" type="text" value="<?php echo $persona->getTelefono() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Celular</label><input name="celular" type="text" value="<?php echo $persona->getCelular() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Direccion</label><input name="direccion" type="text" value="<?php echo $persona->getDireccion() ?>"></fieldset>
				<input name="actualizar" type="submit" value="Enviar" onClick="return validar();">	
				</div>
			</form>
		</td>
	</tr>
</table>
</body>
</html>

	

