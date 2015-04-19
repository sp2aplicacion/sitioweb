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
	$q=$_GET['q'];

	$eliminado=false;
	if(!empty($_GET['idEstElim']))
	{
	  $convenio=new Convenio(array());
      $convenio->eliminarEstudiante($_GET['idEstElim']);
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
		ddrivetip('Agregar la Situacion '+parametro+ 'a la Seccion',((parametro.length*8)>200)?parametro.length*8:200)
	if(men==2)
		ddrivetip('La Situacion '+parametro+' ya esta incluida en la Seccion',((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
<script>
function cambiarEstado(idEstudiante,combo){
 
	var estado=document.getElementById(combo).value;
	var q=document.getElementById('q').value;
	if(estado!="-1"){
		actualizar('3','&idEstudiante='+idEstudiante+'&estado='+estado+'&q='+q);	
	}	
}
</script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Editar el estudiante con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==2)
		ddrivetip('Eliminar el estudiante con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
<script src="scripts/ajax.js"></script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
			<h3>Consultar Estudiante</h3>
			<?php if($eliminado) {echo "<div align='center' class='rojo'><strong>El Estudiante fue eliminado correctamente.</strong></div>";} ?>
			<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre o Apellido</label><input type="text" id="q" name="q" value="<?php echo $q ?>" onKeyUp="return buscar(1,'')" autocomplete="off" /></fieldset><span id="loading"></span>
			</div>
    		<div id="resultados"></div>
		</td>
	</tr>
</table>
</body>
</html>

	