<?php 
	session_start();	
	require_once('logica/Supervisor.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Empresa.php');	
	require_once('logica/Area.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Supervisor(array($idPersona));
	$persona->consultar();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$dias=array("Lu","Ma","Mi","Ju","Vi","Sa");
	$periodo="";
	if(!empty($_GET['periodo']))
		$periodo=$_GET['periodo'];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/toolTip.css" /> 
<script src="scripts/toolTip.js"></script>
<script src="scripts/ajax.js"></script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Registrar horario de supervision para el estudiante con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==2)
		ddrivetip('Gestionar seguimiento quincenal para el estudiante con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)	
	else if(men==3)
		ddrivetip('Agregar sesion de supervision para el estudiante con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==4)
		ddrivetip('Consultar sesion de supervision para el estudiante con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==5)
		ddrivetip('Consultar actividad de control diario de practica  de supervision para el estudiante con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
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
		<h3>Consultar Estudiantes Asignados</h3>
		<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Periodo</label><select name="q" id="q" onchange="return buscar(51,'&idSupervisor=<?php echo $idPersona ?>')">
			<option value="0">Seleccione</option>
			<?php 
			$convenio = new Convenio(array()); 
			$periodos = $convenio->consultarPeriodos();		
			for($i=0; $i<count($periodos); $i++)
				{
				echo "<option value='".$periodos[$i]."'";
				if($periodo==$periodos[$i])
					echo " selected";
				echo ">".$periodos[$i]."</option>";
				}
			?>				
			</select>
			</fieldset>					
		</div>
		<div align="center"><span id="loading"><img src="img/loading2.gif" /></span></div>
		<div id="resultados"></div>
		</td>
	</tr>
</table>
<?php if ($periodo!="") { ?>
<script>buscar(51,'&idSupervisor=<?php echo $idPersona ?>')</script>
<?php } ?>
</body>
</html>

	
