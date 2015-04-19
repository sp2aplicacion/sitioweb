<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Convenio.php');	
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
	$nitEmpresa=$_GET['nitEmpresa'];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/toolTip.css" /> 
<script src="scripts/toolTip.js"></script>
<script>
function confirmacion(parametro){
	return confirm('Esta seguro que desea inscribirse en el convenio del area '+parametro+ '?');
}
</script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Inscribir en convenio con area: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==2)
		ddrivetip('Colocar NO visible este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
	if(men==3)
		ddrivetip('Colocar visible este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
	if(men==4)
		ddrivetip('Colocar NO firmado este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
	if(men==5)
		ddrivetip('Colocar firmado este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
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
		<h3>Consultar Convenio de Entidad con NIT: <?php echo $nitEmpresa ?></h3>
		<div align="center"><span id="loading"><img src="img/loading2.gif"></span></div>
		<div id="resultados"><?php $_GET['idEstudiante']=$idPersona; include("presentacion/estudiante/ajax/consultarConvenio.php") ?></div>
		</td>
	</tr>
</table>
</body>
</html>

	