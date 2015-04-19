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
<script src="scripts/seleccionar.js"></script>
<script src="scripts/CalendarPopup.js" type="text/javascript"></script>
<link rel="stylesheet" href="estilos/CalendarPopup.css" type="text/css" media="all" />
<script>document.write(getCalendarStyles());</script>
<script>
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<form name="Formulario">
		<h3>Convenios</h3>
		<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Area</label><select name="q" id="q" onchange="return buscar(27,'&periodo='+document.forms[0].periodo.value)">
			<option value="0">Seleccione</option>
			<?php 
			$area = new Area(array()); 
			$areas = $area->consultarTodos();		
			for($i=0; $i<count($areas); $i++)
				echo "<option value='".$areas[$i]->getId()."'>".$areas[$i]->getNombre()."</option>";
			?>				
			</select></fieldset>					
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Periodo</label>
			<select name="periodo" id="periodo" onchange="return buscar(27,'&periodo='+document.forms[0].periodo.value)">
			<?php for($i=date("Y")+1; $i>=2009; $i--) echo "<option value='".$i."-2'>".$i."-2</option><option value='".$i."-1'>".$i."-1</option>"; ?>
			</select>
			</fieldset>
			<span id="loading"></span>
		</div>
		</form>
		<div id="resultados"></div>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>

	
