<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Area.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Actividad.php');	
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
	$nitEmpresa=$_GET['nitEmpresa'];
	$idEdit=$_GET['idEdit'];
	$datos[0]=$idEdit;
	$convenio=new Convenio($datos);
	$convenio->consultar();
	$actividadesConvenio=$convenio->consultarConvenioActividad($idEdit);
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/validarIngresarConvenio.js"></script>
<script src="scripts/validarCorreo.js"></script>
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script src="scripts/CalendarPopup.js" type="text/javascript"></script>
<script>document.write(getCalendarStyles());</script>
<script>
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</script>
<link rel="stylesheet" href="estilos/CalendarPopup.css" type="text/css" media="all" />
<script>
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});

function validar()
	{
	if((mensaje=verificar(document.forms.Formulario))!="") 
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Empresa</em><p>'+mensaje+'</p>');return false;}
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
			<h3>Editar Convenio</h3>
			<form name="Formulario" method="post" action="index.php?id=275" enctype="multipart/form-data">
				<div align="center">
				<input type="hidden" name="id" value="<?php echo $idEdit ?>" />
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nit Empresa</label><input type="text" name="nitEmpresa" value="<?php echo $nitEmpresa ?>" readonly="true" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Nombre</label><input type="text" name="nombre" value="<?php echo $convenio->getNombre() ?>" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Supervisor</label><input type="text" name="supervisor" value="<?php echo $convenio->getSupervisor() ?>" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha Inicial</label><input name="fechaInicial" type="text" id="fechaInicial" onclick="cal1xx.select(document.forms[0].fechaInicial,'fechaInicial','yyyy-MM-dd'); return false;" value="<?php echo $convenio->getFechaInicial() ?>" readonly="true" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha Final</label><input name="fechaFinal" type="text" id="fechaFinal" onclick="cal1xx.select(document.forms[0].fechaFinal,'fechaFinal','yyyy-MM-dd'); return false;" value="<?php echo $convenio->getFechaFinal() ?>" readonly="true" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Perido</label>
				<select name="periodo">
				<?php for($i=date("Y")+1; $i>=2009; $i--) 
					{
					echo "<option value='".$i."-2' ",($i."-2"==$convenio->getPeriodo())?" selected":"",">".$i."-2</option><option value='".$i."-1' ",($i."-1"==$convenio->getPeriodo())?" selected":"",">".$i."-1</option>";		
					} 
				?>
				</select>
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Cupos Ofrecidos</label>
				<select name="cupos">
				<?php for($i=1; $i<=20; $i++) echo "<option value='".$i."'",($convenio->getCuposOfrecidos()==$i)?" selected":"",">".$i."</option>"; ?>
				</select>
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Observaciones</label><textarea name="observaciones"><?php echo $convenio->getObservaciones() ?></textarea></fieldset>				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Area</label><select name="area">
				<option value="0">Seleccione</option>
				<?php 
				$area = new Area(array()); 
				$areas = $area->consultarTodos();		
				for($i=0; $i<count($areas); $i++)
					echo "<option value='".$areas[$i]->getId()."'",($convenio->getArea()==$areas[$i]->getId())?" selected":"",">".$areas[$i]->getNombre()."</option>";
				?>				
				</select></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Actividades</label><br /><br /><div style="text-align:left; width: 300px ">
				<?php 
				$actividad = new actividad(array()); 
				$actividades = $actividad->consultarTodos();		
				for($i=0; $i<count($actividades); $i++)
					{
					echo "<input type='checkbox' class='checkbox' name='actividades[]' value='".$actividades[$i]->getId()."'";
					for($j=0;$j<count($actividadesConvenio);$j++)
						{
						if($actividades[$i]->getId()==$actividadesConvenio[$j]->getId())
							echo " checked";
						}
					echo ">".$actividades[$i]->getNombre()."</input><br>";
					}
				?>				
				</div></fieldset>
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();">	
				</div>
			</form>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>

	

