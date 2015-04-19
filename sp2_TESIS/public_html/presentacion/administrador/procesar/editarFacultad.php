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
	$persona->consultar();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$id=$_POST['id'];
	$nombre=$_POST['nombre'];
	$decano=$_POST['decano'];
	$coordinador=$_POST['coordinador'];
	$telefono=$_POST['telefono'];

	$datos = array();
	$datos[0]=$id;
	$datos[1]=$nombre;
	$datos[2]=$decano;
	$datos[3] = $coordinador;
	$datos[4] = $telefono;
	$facultad= new Facultad($datos);
	$facultad->actualizar();
?>
<!DOCTYPE html>
<html>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Info Facultad Editada</h3>
			<div align="center">
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">ID</label><?php echo $id ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><?php echo $nombre ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Decano</label><?php echo $decano ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Coordinador</label><?php echo $coordinador ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Telefono</label><?php echo $telefono ?></fieldset>
			</div>
		</td>
	</tr>
</table>
</body>
</html>
