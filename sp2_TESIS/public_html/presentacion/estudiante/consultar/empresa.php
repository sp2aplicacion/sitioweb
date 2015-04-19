<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Estudiante(array($idPersona));
	$persona->consultar();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$q=$_GET['q'];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/toolTip.css"> 
<script src="scripts/toolTip.js"></script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Editar la Empresa con NIT: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==2)
		ddrivetip('Agregar convenio a la Empresa con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==3)
		ddrivetip('Consultar convenios de la Empresa con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
<script src="scripts/ajax.js"></script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Estudiante: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuEstudiante.php");?></td>		
		<td valign="top">
			<h3>Consultar Entidad</h3>
			<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><input type="text" id="q" name="q" value="<?php echo $q ?>" onKeyUp="return buscar(13,'&idEstudiante=<?php echo $idPersona ?>')"></fieldset><span id="loading"></span>
			</div>
    		<div id="resultados"></div>
		</td>
	</tr>
</table>
</body>
</html>

	