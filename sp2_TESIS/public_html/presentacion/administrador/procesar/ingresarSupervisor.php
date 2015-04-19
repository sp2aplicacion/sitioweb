<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Supervisor.php');	
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
	$codigo=$_POST['codigo'];
	$cedula=$_POST['cedula'];
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$correo=$_POST['correo'];
	$telefono=$_POST['telefono'];
	$celular=$_POST['celular'];
	$direccion=$_POST['direccion'];
	$profesion=$_POST['profesion'];
	$facultad=$_POST['facultad'];
	$area=$_POST['area'];
	$datos = array();
	$datos[0]=$codigo;
	$datos[1]=$cedula;
	$datos[2]=$nombre;
	$datos[3]=$apellido;
	$datos[4]=$cedula;
	$datos[5]=$correo;
	$datos[6]=$telefono;
	$datos[7]=$celular;
	$datos[8]=$direccion;	
	$datos[9]=$profesion;	
	$datos[10]=$facultad;	
	$datos[11]=$area;	
	$supervisor= new Supervisor($datos);
	$supervisor->insertar();
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
		<h3>Info Supervisor Agregado</h3>
			<div align="center">
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Codigo</label><?php echo $codigo ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cedula</label><?php echo $cedula ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><?php echo $nombre ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Apellido</label><?php echo $apellido ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Contrasena</label><?php echo $cedula ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Correo Institucional</label><?php echo $correo ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Telefono</label><?php echo $telefono ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cellular</label><?php echo $celular ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Direccion</label><?php echo $direccion ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Profesion</label><?php echo $profesion ?></fieldset>
			</div>
		</td>
	</tr>
</table>
</body>
</html>

	

