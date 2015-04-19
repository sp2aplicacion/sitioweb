<?php 
	session_start();	
	require_once('logica/Supervisor.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Area.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Supervisor(array($idPersona));
	$persona->consultarNombre();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$idEstudiante=$_GET['idEstudiante'];
	$estudiante=new Estudiante(array($idEstudiante));
	$estudiante->consultarNombre();
	$idConEstSup=$_GET['idConEstSup'];
	$periodo=$_GET['periodo'];
	$dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	$insertado=false;
	if(!empty($_POST['enviar']))
		{
		$convenio = new Convenio(array()); 
		$convenio->insertarSeguimientoQuincenalSupervision($_POST['fecha'],$_POST['hora'],$_POST['tema'],$idConEstSup);		
		$insertado=true;
		}
	
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/CalendarPopup.js" type="text/javascript"></script>
<script>document.write(getCalendarStyles());</script>
<script>
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</script>
<link rel="stylesheet" href="estilos/CalendarPopup.css" type="text/css" media="all" />
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Supervisor: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuSupervisor.php");?></td>		
		<td valign="top">
			<h3>Seguimiento Quincenal del estudiante:<br /> <?php echo $idEstudiante.", ".$estudiante->getNombre()." ".$estudiante->getApellido() ?>  </h3>
			<div align="center"><a href="index.php?id=402&periodo=<?php echo $periodo ?>"><strong>Regresar</strong></a></div>
			<?php if($insertado) {echo "<div align='center' class='rojo'><strong>El registro fue ingresado correctamente.</strong></div>";} ?>
			<form name="Formulario" method="post" action="index.php?id=404&idEstudiante=<?php echo $idEstudiante ?>&idConEstSup=<?php echo $idConEstSup ?>&periodo=<?php echo $periodo ?>">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha</label><input name="fecha" type="text" id="fecha" value="<?php echo date("Y-m-d") ?>" onclick="cal1xx.select(document.forms[0].fecha,'fecha','yyyy-MM-dd'); return false;" readonly="true" />
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora</label>
				<select name="hora">
				<?php
					for($i=6;$i<=22;$i++)
					{
						for($j=0;$j<=50;$j+=10)
						{
							if($j==0)
								$h=$i.":00";
							else
								$h=$i.":".$j;
							echo "<option value='".$h."'>".$h."</option>";	
						}						
					}		
				?>
				</select>				
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Temas</label>
				<textarea name="tema" rows="10"></textarea>
				</fieldset>
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();" />	
				</div>
			</form>
			<h3>Registro de Seguimiento Quincenal</h3>
				<?php
				$convenio = new Convenio(array()); 
				$seguimientos=$convenio->consultarSeguimientoQuincenalSupervision($idConEstSup);
				echo "<table align='center' border='0'>";
				echo "<tr class='titulo'><td><strong>No</strong></td><td align='center'><strong>Fecha</strong></td><td align='center'><strong>Hora</strong></td><td align='center'><strong>Tema</strong></td></tr>";
				for($i=0; $i<count($seguimientos); $i++)
					{
					echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
					echo "					
					<td align='center'>",$i+1,"</td>
					<td align='center' nowrap>",$seguimientos[$i][1],"</td>
					<td align='center' nowrap>",$seguimientos[$i][2],"</td>
					<td align='left'>",str_replace("\n","<br>",$seguimientos[$i][3]),"</td>";
					}
				echo "</table>";
				?>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>

	

