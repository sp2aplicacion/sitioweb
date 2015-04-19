<?php
session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Programa.php');	
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
	$id=$_GET['idEdit'];
	$programa = new Programa(array($id));
	$programa->consultar();
?>
<!DOCTYPE html>
<html>
 <head>
 	<script src="scripts/validarIngresarPrograma.js"></script>
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
				{Sexy.alert('<h1>Alerta</h1><em>Validacion de Programa</em><p>'+mensaje+'</p>');return false;}
			}
	</script>
	<body>
	<?php
					$nom = "";
					$facultad = new Facultad(array());
					$facultades = $facultad->consultarTodos();

					for ($i=0; $i < count($facultades) ; $i++) { 
						
						if($programa->getFacultad == $facultades[$i]->getId())
						{
							echo "Nombre: ".$facultades[$i]->getNombre();
						}
						?>
						<!--<option value="<?= $facultades[$i]->getId();?>"><?= $nom?></option>-->

						<?php
					}
				?>
		<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
			<h3>Editar Programa</h3>

			<form name="Formulario" method="post" action="index.php?id=270">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*ID</label><input name="id" type="text" value="<?php echo $programa->getId() ?>" readonly></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Nombre</label><input name="nombre" type="text" value="<?php echo $programa->getNombre() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Director</label><input name="director" type="text" value="<?php echo $programa->getDirector() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Facultad</label>
				<select name="facultad">
				<option value="0">Seleccione</option>

				<?php

					$facultad = new Facultad(array());
					$facultades = $facultad->consultarTodos();

					for ($i=0; $i < count($facultades) ; $i++) { 
						echo "<option value='".$facultades[$i]->getId()."'". (($programa->getFacultad()==$facultades[$i]->getId())? " selected" : "").">".$facultades[$i]->getNombre()."</option>";
					}
				?>
				
				</select></fieldset>
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();">
				</div>
			</form>
		</td>
	</tr>
</table>
	</body>
 </head>
</html>