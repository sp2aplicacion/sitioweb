<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Supervisor.php');
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
	
	$eliminado=false;
	if(!empty($_GET['idSupElim']))
	{
	  $convenio=new Convenio(array());
      $convenio->eliminarSupervisor($_GET['idSupElim']);
      $eliminado=true;
	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/toolTip.css" /> 
<script src="scripts/toolTip.js"></script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Asignar estudiante al supervisor: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==2)
		ddrivetip('Agregar convenio a la Empresa con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)	
	if(men==3)
		ddrivetip('Consultar convenios de la Empresa con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==4)
		ddrivetip('Eliminar supervisor con c&oacute;digo '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
<script src="scripts/ajax.js"></script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php");?></div>
<div align="right">Usted esta en el sistema como Coordinador de Pr&aacute;cticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<?php if($eliminado) {echo "<div align='center' class='rojo'><strong>El Estudiante fue eliminado correctamente.</strong></div>";} ?>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Consultar Supervisor</h3>
			<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre o Apellido</label><input type="text" id="q" name="q" value="<?php echo $q ?>" onKeyUp="return buscar(53,'')" autocomplete="off" /></fieldset><span id="loading"></span>
			</div>
    		<div id="resultados"></div>
		</td>
	</tr>
</table>
</body>
</html>

	
