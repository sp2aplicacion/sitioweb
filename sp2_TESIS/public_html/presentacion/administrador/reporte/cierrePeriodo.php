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
	if(!empty($_POST['cerrarPeriodo']))
		{
		$convenio=new Convenio(array());
		$convenio->cerrarPeriodo();
		$cierre=true;
		}
?>
<!DOCTYPE html>
<html>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<form name="Formulario" method="post" action="index.php?id=285">
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Cierre de Periodo</h3>
		<?php if($cierre) echo "<div align='center' class='rojo'><strong>El cierre se ha realizado correctamente</strong></div>" ?>
		<div align="center"><input type="submit" name="cerrarPeriodo" value="Cerrar Periodo" /></div> 
		<div align="center" class="rojo">NOTA: EL CIERRE DE PERIODO IMPLICA QUE TODAS LAS ENTIDADES Y CONVENIOS SE COLOCAN COMO NO VISIBLE</div>
		</td>
	</tr>
</table>
</form>
</body>
</html>

	
