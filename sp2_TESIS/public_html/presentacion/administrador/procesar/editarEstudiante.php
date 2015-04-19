<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Estudiante.php');	
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
	$hv=str_replace(" ","_",$_FILES['hv']['name']);	
	if($hv!="")
	{
		$rutalocal=$_FILES['hv']['tmp_name'];
		$tipo=$_FILES['hv']['type'];
		if($tipo!="application/vnd.openxmlformats-officedocument.wordprocessingml.document" && $tipo!="application/msword" && $tipo!="application/msword" && $tipo!="application/pdf") { ?> 
		<script>alert('El archivo debe ser unicamente de extension doc, docx o pdf');history.go(-1);</script>	
		<?php		
		}else{
		$hv=date("Y-m-d_H_i_").$hv;
		$rutaservidor = "archivos/".$hv;				
		copy($rutalocal,$rutaservidor);	
		chmod($rutaservidor,0777);	
		}
	}
	
	$datos = array();
	$datos[0]=$_POST['codigo'];
	$datos[1]=$_POST['cedula'];
	$datos[2]=$_POST['nombre'];
	$datos[3]=$_POST['apellido'];
	$datos[5]=$_POST['correo'];
	$datos[6]=$_POST['telefono'];
	$datos[7]=$_POST['celular'];
	$datos[8]=$_POST['direccion'];
	$datos[9]=$hv;
	$datos[10]=$_POST['semestre'];
	$datos[12]=$_POST['eps'];
	$datos[13]=$_POST['observaciones'];	
	$datos[14]=$_POST['facultad'];	

	$estudiante= new Estudiante($datos);
	$estudiante->actualizar();
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
		<h3>Info Estudiante Editado</h3>
			<div align="center">
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Codigo</label><?php echo $datos[0] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cedula</label><?php echo $datos[1] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><?php echo $datos[2] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Apellido</label><?php echo $datos[3] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Correo Institucional</label><?php echo $datos[5] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Telefono</label><?php echo $datos[6] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Celular</label><?php echo $datos[7] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Direccion</label><?php echo $datos[8] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Semestre</label><?php echo $datos[10] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">EPS</label><?php echo $datos[12] ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Observaciones</label><?php echo $datos[13] ?></fieldset>
			</div>
		</td>
	</tr>
</table>
</body>
</html>

	

