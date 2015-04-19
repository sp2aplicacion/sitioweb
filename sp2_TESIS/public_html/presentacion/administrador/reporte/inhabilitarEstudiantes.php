<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Convenio.php');	
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
	$cierre=false;
	if(!empty($_POST['inhabilitarEstudiantes']))
		{
		$convenio=new Convenio(array());
		$convenio->inhabilitarEstudiantes();
		$cierre=true;
		}
?>
<!DOCTYPE html>
<html>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<form name="Formulario" method="post" action="index.php?id=286">
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Inhabilitar Estudiantes</h3>
		<?php if($cierre) echo "<div align='center' class='rojo'><strong>Estudiantes inhabilitados</strong></div>" ?>
		<div align="center"><input type="submit" name="inhabilitarEstudiantes" value="Inhabilitar" /></div> 
		<div align="center" class="rojo">NOTA: Este procedimiento puede dejar algunos estudiantes inhabilitados cuando no debería ser así.<br>Este error se puede corregir manualmente consultando el estudiante y habilitandolo nuevamente.<br>Sin embargo es recomendable informarle al desarrollador del sistema los inconvenientes para mejorarlo. </div>
		</td>
	</tr>
</table>
</form>
</body>
</html>

	
