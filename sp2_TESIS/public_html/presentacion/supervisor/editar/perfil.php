<?php 
	session_start();	
	require_once('logica/Supervisor.php');	
	require_once('logica/Facultad.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
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
		$datos[9]=$_POST['profesion'];
		$datos[10]=$_POST['facultad'];
		$datos[11]=1;
		
		$persona = new Supervisor($datos);
		$persona->actualizar();
		}

	$persona = new Supervisor(array($idPersona));
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
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Supervisor</em><p>'+mensaje+'</p>');return false;}
	if((mensaje=emailCheck(document.forms.Formulario.correo.value))!="")
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Correo</em><p>'+mensaje+'</p>');return false;}
	}
</script>
</head>
<body>

<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Supervisor: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuSupervisor.php");?></td>		
		<td valign="top">
			<h3>Actualizar Perfil</h3>
			<form name="Formulario" method="post" action="index.php?id=401">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Codigo</label><input name="codigo" type="text" value="<?php echo $persona->getCodigo() ?>" readonly></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cedula</label><input name="cedula" type="text" value="<?php echo $persona->getCedula() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><input name="nombre" type="text" value="<?php echo $persona->getNombre() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Apellido</label><input name="apellido" type="text" value="<?php echo $persona->getApellido() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Correo Institucional</label><input name="correo" type="text" value="<?php echo $persona->getCorreo() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Telefono</label><input name="telefono" type="text" value="<?php echo $persona->getTelefono() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Celular</label><input name="celular" type="text" value="<?php echo $persona->getCelular() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Direccion</label><input name="direccion" type="text" value="<?php echo $persona->getDireccion() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Profesion</label><input name="profesion" type="text" value="<?php echo $persona->getProfesion() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Facultad</label><select name="facultad">
				<?php 
				$facultad = new Facultad("","","","",""); 
				$facultades = $facultad->consultarTodos();		
				for($i=0; $i<count($facultades); $i++)
					echo "<option value='".$facultades[$i]->getId()."'". (($persona->getFacultad()==$facultades[$i]->getId())? " selected" : "").">".$facultades[$i]->getNombre()."</option>";
				?>				
				</select></fieldset>

				<input name="actualizar" type="submit" value="Actualizar" onClick="return validar();">	
				</div>
			</form>
		</td>
	</tr>
</table>
</body>
</html>

	

