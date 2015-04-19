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
	$nitEmpresa=$_POST['nitEmpresa'];
	$id=$_POST['id'];
	$fechaInicial=$_POST['fechaInicial'];
	$fechaFinal=$_POST['fechaFinal'];
	$cupos=$_POST['cupos'];
	$observaciones=$_POST['observaciones'];
	$nombre=$_POST['nombre'];
	$periodo=$_POST['periodo'];	
	$supervisor=$_POST['supervisor'];	
	$area=$_POST['area'];
	$actividades=$_POST['actividades'];

	$datos = array();
	$datos[0]=$id;
	$datos[1]=$fechaInicial;
	$datos[2]=$fechaFinal;
	$datos[3]=$cupos;
	$datos[7]=$observaciones;
	$datos[8]=$nombre;
	$datos[9]=$periodo;
	$datos[10]=$supervisor;
	$datos[11]=$nitEmpresa;
	$datos[12]=$area;
	
	$convenio= new Convenio($datos);
	$convenio->actualizar();	
	$convenio->eliminarActividades();
	for($i=0; $i<count($actividades); $i++)
		$convenio->insertarActividad($id,$actividades[$i]);
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
		<h3>Info Convenio Editado</h3>
			<div align="center">
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">NIT Empresa</label><?php echo $nitEmpresa ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><?php echo $nombre ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Supervisor</label><?php echo $supervisor ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Fecha Inicial</label><?php echo $fechaInicial ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Fecha Final</label><?php echo $fechaFinal ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Periodo</label><?php echo $periodo ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cupos Ofrecidos</label><?php echo $cupos ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Observaciones</label><?php echo $observaciones ?></fieldset>
			</div>
		</td>
	</tr>
</table>
</body>
</html>

	

