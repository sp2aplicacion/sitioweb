<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Reporte.php');	
	require_once('logica/Convenio.php');	
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
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/ajax.js"></script>
<script>
function abrir(pagina) {
	window.open(pagina, 'null', 'height=500,width=600,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');
}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<form name="Formulario">
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Convenios</h3>
		<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Area</label><select name="q" id="q" onchange="return buscar(32,'&periodo='+document.forms[0].periodo.value+'&firmado='+document.forms[0].firmado.value)">
			<option value="0">Seleccione</option>
			<?php 
			$area = new Area(array()); 
			$areas = $area->consultarTodos();		
			for($i=0; $i<count($areas); $i++)
				echo "<option value='".$areas[$i]->getId()."'>".$areas[$i]->getNombre()."</option>";
			?>				
			</select></fieldset>					
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Perido</label>
			<select name="periodo" id="periodo" onchange="return buscar(32,'&periodo='+document.forms[0].periodo.value+'&firmado='+document.forms[0].firmado.value)">
			<?php for($i=date("Y")+1; $i>=2009; $i--) echo "<option value='".$i."-2'>".$i."-2</option><option value='".$i."-1'>".$i."-1</option>"; ?>
			</select>
			</fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Firmado</label>
			<select name="firmado" id="firmado" onchange="return buscar(32,'&periodo='+document.forms[0].periodo.value+'&firmado='+document.forms[0].firmado.value)">
				<option value="-1">Todos</option>
				<option value="0">NO</option>
				<option value="1">SI</option>
			</select>
			</fieldset>
			<span id="loading"></span>
		</div>
		<div id="resultados"></div>
		</td>
	</tr>
</table>
</form>
</body>
</html>

	
