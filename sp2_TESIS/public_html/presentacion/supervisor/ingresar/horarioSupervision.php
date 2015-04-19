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
	$idConEstSup=$_GET['idConEstSup'];
	$periodo=$_GET['periodo'];
	$dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	$tipo=array("Horario Practica","Reunion Individual","Reunion Grupal");
	if(!empty($_POST['enviar']))
		{
		$convenio = new Convenio(array()); 
		$convenio->insertarHorarioSupervision($_POST['dia'],$_POST['horaInicio'],$_POST['horaFin'],$_POST['tipo'],$idConEstSup);		
		}
	if(!empty($_GET['idHorarioElim']))
		{
		$convenio = new Convenio(array()); 
		$convenio->eliminarHorarioSupervision($_GET['idHorarioElim']);					
		}
	
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/validarIngresarSupervisor.js"></script>
<script src="scripts/validarCorreo.js"></script>
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
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Administrador</em><p>'+mensaje+'</p>');return false;}
	if((mensaje=emailCheck(document.forms.Formulario.correo.value))!="")
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Correo</em><p>'+mensaje+'</p>');return false;}
	}
</script>

</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Supervisor: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuSupervisor.php");?></td>		
		<td valign="top">
			<h3>Horario de Supervision del estudiante con codigo: <?php echo $idEstudiante ?> </h3>
			<div align="center"><a href="index.php?id=402&periodo=<?php echo $periodo ?>"><strong>Regresar</strong></a></div>
			<form name="Formulario" method="post" action="index.php?id=403&idEstudiante=<?php echo $idEstudiante ?>&idConEstSup=<?php echo $idConEstSup ?>">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Dia</label>
				<select name="dia">
				<?php
					for($i=0;$i<6;$i++)
						echo "<option value='".$i."'>".$dias[$i]."</option>";	
				?>
				</select>
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora Inico</label>
				<select name="horaInicio">
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
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora Fin</label>
				<select name="horaFin">
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
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Tipo</label>
				<select name="tipo">
					<option value="0">Horario Practica</option>
					<option value="1">Reunion Individual</option>
					<option value="2">Reunion Grupal</option>
				</select>								
				</fieldset>
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();" />	
				</div>
			</form>
			<h3>Horario Existente</h3>
				<?php 
				$convenio = new Convenio(array()); 
				$horarios=$convenio->consultarHorarioSupervision($idConEstSup);
				echo "<table align='center' border='0'>";
				echo "<tr class='titulo'><td></td><td align='center'><strong>Dia</strong></td><td align='center'><strong>Hora Inicio</strong></td><td align='center'><strong>Hora Fin</strong></td><td align='center'><strong>Tipo</strong></td></tr>";
				for($i=0; $i<count($horarios); $i++)
					{
					echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
					echo "					
					<td><a href='index.php?id=403&idEstudiante=".$idEstudiante."&idConEstSup=".$idConEstSup."&idHorarioElim=".$horarios[$i][0]."'><img src='img/eliminar.png' border='0' /></a></td>
					<td align='center' nowrap>",$dias[$horarios[$i][1]],"</td>
					<td align='center' nowrap>",$horarios[$i][2],"</td>
					<td align='center' nowrap>",$horarios[$i][3],"</td>
					<td align='center' nowrap>",$tipo[$horarios[$i][4]],"</td>";
					}
				echo "</table>";
				?>
				
			
			
		</td>
	</tr>
</table>
</body>
</html>

	

