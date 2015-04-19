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
	
	$datos = array();
		
    $actividades=$_POST['actividades'];


	$datos[0]=$_POST['id'];
	$datos[1]=$_POST['fechaInicial'];
	$datos[2]=$_POST['fechaFinal'];
	$datos[3]=$_POST['cupos'];
	$datos[7]=$_POST['observaciones'];
	$datos[8]=$_POST['nombre'];
	$datos[9]=$_POST['periodo'];
	$datos[10]=$_POST['supervisor'];
	$datos[11]=$_POST['nitEmpresa'];
	$datos[12]=$_POST['area'];
	
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
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">NIT Empresa</label><?php echo $datos[11] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><?php echo $datos[8] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Supervisor</label><?php echo $datos[10] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Fecha Inicial</label><?php echo $datos[1] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Fecha Final</label><?php echo $datos[2] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Periodo</label><?php echo $datos[9] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cupos Ofrecidos</label><?php echo $datos[3] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Observaciones</label><?php echo $datos[7] ?></fieldset>
			</div>
		</td>
	</tr>
</table>
</body>
</html>

	

