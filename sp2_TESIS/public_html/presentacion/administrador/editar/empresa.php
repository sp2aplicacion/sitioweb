<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Empresa.php');	
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
	$nit=$_GET['idEdit'];
	$empresa = new Empresa(array($nit));
	$empresa->consultar();
//	echo($empresa->getObjetoSocial());
//	echo($empresa->getNit());
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/validarIngresarEmpresa.js"></script>
<script src="scripts/validarCorreoEmpresa.js"></script>
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
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Empresa</em><p>'+mensaje+'</p>');return false;}
	if((mensaje=verificarNumericos(document.forms.Formulario))!="") 
		{Sexy.alert('<h1>Alerta</h1><em>Validacion Numerica</em><p>'+mensaje+'</p>');return false;}
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
			<h3>Editar Entidad</h3>
			<form name="Formulario" method="post" action="index.php?id=235" enctype="multipart/form-data">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*NIT</label><input name="nit" type="text" value="<?php echo $empresa->getNit() ?>" readonly></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Nombre</label><input name="nombre" type="text" value="<?php echo $empresa->getNombre() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Correo</label><input name="correo" type="text" value="<?php echo $empresa->getCorreo() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Direccion</label><input name="direccion" type="text" value="<?php echo $empresa->getDireccion() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Telefono</label><input name="telefono" type="text" value="<?php echo $empresa->getTelefono() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Representante</label><input name="representante" type="text" value="<?php echo $empresa->getRepresentante() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Supervisor Int.</label><input name="supervisor" type="text" value="<?php echo $empresa->getSupervisor() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cargo Sup. Int.</label><input name="cargosupervisor" type="text" value='<?php echo $empresa->getCargosupervisor() ?>'></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Estrato</label><select name="estrato">
				<option value="Uno" <?php if ($empresa->getEstrato()=="Uno") echo " selected"?>>Uno</option>
				<option value="Dos" <?php if ($empresa->getEstrato()=="Dos") echo " selected"?>>Dos</option>
				<option value="Tres" <?php if ($empresa->getEstrato()=="tres") echo " selected"?>>Tres</option>
				<option value="Cuatro" <?php if ($empresa->getEstrato()=="Cuatro") echo " selected"?>>Cuatro</option>
				<option value="Cinco" <?php if ($empresa->getEstrato()=="Cinco") echo " selected"?>>Cinco</option>
				<option value="Seis" <?php if ($empresa->getEstrato()=="Seis") echo " selected"?>>Seis</option>
				</select></fieldset>
<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Objeto Social</label><textarea name="objetoSocial"><?php echo $empresa->getObjetoSocial() ?></textarea></fieldset>	
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Descripcion</label><textarea name="descripcion"><?php echo $empresa->getDescripcion() ?></textarea></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Ficha Tecnica</label><input type="file" name="fichaTecnica" /></fieldset>				
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();">	
				</div>
			</form>
		</td>
	</tr>
</table>
</body>
</html>

	

