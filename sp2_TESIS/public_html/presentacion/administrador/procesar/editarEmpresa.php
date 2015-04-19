<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Empresa.php');	
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
	$nit=$_POST['nit'];
	$nombre=$_POST['nombre'];
	$correo=$_POST['correo'];
	$direccion=$_POST['direccion'];
	$telefono=$_POST['telefono'];
	$representante=$_POST['representante'];
	$supervisor=$_POST['supervisor'];
	$cargosupervisor=$_POST['cargosupervisor'];
	$estrato=$_POST['estrato'];
	$objetoSocial=$_POST['objetoSocial'];
	$descripcion=$_POST['descripcion'];
	$fichaTecnica=str_replace(" ","_",$_FILES['fichaTecnica']['name']);	
	if($fichaTecnica!="")
	{
		$rutalocal=$_FILES['fichaTecnica']['tmp_name'];
		$tipo=$_FILES['fichaTecnica']['type'];
		if($tipo!="application/vnd.openxmlformats-officedocument.wordprocessingml.document" && $tipo!="application/msword" && $tipo!="application/msword" && $tipo!="application/pdf") { ?> 
		<script>alert('El archivo debe ser unicamente de extension doc, docx o pdf');history.go(-1);</script>	
		<?php		
		}else{
		$fichaTecnica=date("Y-m-d_H_i_").$fichaTecnica;
		$rutaservidor = "archivos/".$fichaTecnica;				
		copy($rutalocal,$rutaservidor);		
		chmod($rutaservidor,0777);
		}
	}

	$datos = array();
	$datos[0]=$nit;
	$datos[1]=$nombre;
	$datos[2]=$correo;
	$datos[3]=$direccion;
	$datos[4]=$telefono;
	$datos[5]=$representante;
	$datos[6]=$supervisor;
	$datos[7]=$cargosupervisor;
	$datos[8]=$estrato;
	$datos[9]=$objetoSocial;
	$datos[10]=$descripcion;
	$datos[11]=$fichaTecnica;
	
	$empresa= new Empresa($datos);
	$empresa->actualizar();
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
		<h3>Info Entidad Editada</h3>
			<div align="center">
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">NIT</label><?php echo $nit ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><?php echo $nombre ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Correo</label><?php echo $correo ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Direccion</label><?php echo $direccion ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Telefono</label><?php echo $telefono ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Representante</label><?php echo $representante ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Supervisor Int</label><?php echo $supervisor ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Estrato</label><?php echo $estrato ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Objeto Social</label><?php echo $objetoSocial ?></fieldset>
			<fieldset class="filaAgregada"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Descripcion</label><?php echo $descripcion ?></fieldset>
			</div>
		</td>
	</tr>
</table>
</body>
</html>

	

