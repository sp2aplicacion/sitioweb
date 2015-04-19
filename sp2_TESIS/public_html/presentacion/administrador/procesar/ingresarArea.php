<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Area.php');	
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
	$nombre=$_POST['nombre'];
	$responsable=$_POST['responsable'];
	$programa=$_POST['programa'];

	$datos = array();
	$datos[0]=0;
	$datos[1]=$nombre;
	$datos[2]=$responsable;
	$datos[3]=$programa;
	//echo("responsable: ".$datos[2]."Programa: ".$datos[3]);
	$area= new Area($datos);
	$area->insertar();
    $nom_programa=$area->consultarPrograma();
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
		<h3>Info Area Agregada</h3>
			<div align="center">
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><?php echo $nombre ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Responsable</label><?php echo $responsable ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Programa</label><?php echo $nom_programa ?></fieldset>
		    </div>
		</td>
	</tr>
</table>
</body>
</html>

	

