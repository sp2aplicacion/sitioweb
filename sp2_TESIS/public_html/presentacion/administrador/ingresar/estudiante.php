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
<script src="scripts/validarIngresarEstudiante.js"></script>
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
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
			<h3>Agregar Estudiante</h3>
			<form name="Formulario" method="post" action="index.php?id=212">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Codigo</label><input name="codigo" type="text" value="<?php echo $codigo ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cedula</label><input name="cedula" type="text" value="<?php echo $cedula ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><input name="nombre" type="text" value="<?php echo $nombre ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Apellido</label><input name="apellido" type="text" value="<?php echo $apellido ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Correo Institucional</label><input name="correo" type="text" value="<?php echo "@konradlorenz.edu.co" ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Semestre</label><select name="semestre">
				<option value="0">Seleccione</option>
				<option value="Octavo">Octavo</option>
				<option value="Noveno">Noveno</option>
				<option value="Decimo">Decimo</option>
				<option value="Decimo Primero">Decimo Primero</option>
				</select></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Programa</label><select name="facultad">
				<option value="0">Seleccione</option>
				<?php 

				$facultad = new Facultad(array()); 
				$facultades = $facultad->consultarTodos();		
				for($i=0; $i<count($facultades); $i++)
					echo "<option value='".$facultades[$i]->getId()."'>".$facultades[$i]->getNombre()."</option>";
				?>				
				</select></fieldset>
				<input name="enviar" type="submit" value="Enviar" onclick="return validar();">
				</div>
			</form>
		</td>
	</tr>
</table>
</body>
</html>

	

