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
	$eliminado=false;
	$editado=false;
	if(!empty($_GET['idControlElim']))
		{
		$convenio=new Convenio(array());
		$convenio->eliminarActividad($_GET['idControlElim']);
		$eliminado=true;
		}
	if(!empty($_GET['idControlEdit']))
		{
		$convenio=new Convenio(array());
		$convenio->habilitarEdicion($_GET['idControlEdit']);
		$editado=true;
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
<script src="scripts/funciones.js"></script>
<script language="Javascript">
function confirmacionElim(parametro){
	return confirm('Esta seguro que desea eliminar el contro de práctica numero: '+parametro+ '?');
}
function confirmacionEdit(parametro){
	return confirm('Esta seguro que desea habilitar la edición del control de práctica numero: '+parametro+ '?');
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
			<h3>Consultar Control Diario de Practica para el estudiante:<br /> <?php echo $idEstudiante.", ".$estudiante->getNombre()." ".$estudiante->getApellido() ?></h3>
			<div align="center"><a href="index.php?id=402&periodo=<?php echo $periodo ?>"><strong>Regresar</strong></a></div>
		<?php if($eliminado) {echo "<div align='center' class='rojo'><strong>El registro fue eliminado correctamente.</strong></div>";} ?>
		<?php if($editado) {echo "<div align='center' class='rojo'><strong>El registro fue habilitado correctamente. El estudiante tendrá 12 horas para corregir la actividad</strong></div>";} ?>
		<?php 
		
			$convenio = new Convenio(array()); 
			$controlesDiarios=$convenio->consultarControlDiarioPractica($idConEstSup);
			echo "<table align='center' border='0'>";
			echo "<tr class='titulo'><td><strong>Eliminar</strong></td><td><strong>Habilitar</strong></td><td><strong>No</strong></td><td align='center'><strong>Fecha</strong></td><td align='center'><strong>Hora Entrada</strong></td><td align='center'><strong>Hora Salida</strong></td><td align='center'><strong>Duracion</strong></td><td align='center'><strong>Actividades</strong></td><td align='center'><strong>Fecha Registro</strong></td><td align='center'><strong>Hora Registro</strong></td></tr>";
			for($i=0; $i<count($controlesDiarios); $i++)
				{
				echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
				echo "
				<td align='center'>
				   <a href='index.php?id=408&idEstudiante=".$idEstudiante."&idConEstSup=".$idConEstSup."&idControlElim=".$controlesDiarios[$i][0]."' onClick=\"return confirmacionElim('".$controlesDiarios[$i][0]."')\">
				      <img src='img/eliminar.png' border='0' onMouseout=hideddrivetip()/>
				   </a>
				</td>
                <td align='center'>
				   <a href='index.php?id=408&idEstudiante=".$idEstudiante."&idConEstSup=".$idConEstSup."&idControlEdit=".$controlesDiarios[$i][0]."' onClick=\"return confirmacionEdit('".$controlesDiarios[$i][0]."')\">
				      <img src='img/editar.png' border='0' onMouseout=hideddrivetip()/>
				   </a>
                </td>				   
				<td align='center'>",$i+1,"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][1],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][2],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][3],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][4],"</td>
				<td align='left'>",str_replace("\n","<br>",$controlesDiarios[$i][5]),"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][6],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][7],"</td>";
				}
			echo "</table>";
			?>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>