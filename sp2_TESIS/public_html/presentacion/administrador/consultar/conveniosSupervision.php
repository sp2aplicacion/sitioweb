<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Empresa.php');	
	require_once('logica/Area.php');	
	require_once('logica/Facultad.php');	
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
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/ajax.js"></script>
<link rel="stylesheet" href="estilos/toolTip.css" /> 
<script src="scripts/toolTip.js"></script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Consultar actividad de control diario de practica de supervision '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==2)
		ddrivetip('Consultar seguimiento quincenal '+parametro,((parametro.length*8)>200)?parametro.length*8:200)	
	if(men==3)
		ddrivetip('Consultar sesion de supervision'+parametro,((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
<script>
function abrir(pagina) {
	window.open(pagina, 'null', 'height=600,width=1000,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');
}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<form name="Formulario">
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Convenios para Supervisión</h3>
		<div align="center">
		
		<fieldset>
		  <label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Periodo</label>
		  <select name="q" id="q" onchange="return buscarSupervisor(52,'&area='+document.forms[0].area.value)">
			<option value="0">Seleccione</option>			
			 <?php 
			   $convenio = new Convenio(array()); 
			   $periodos = $convenio->consultarPeriodos();		
			   for($i=0; $i<count($periodos); $i++)
			   echo "<option value='".$periodos[$i]."'>".$periodos[$i]."</option>";			
			 ?>
	      </select>
		</fieldset>
		
		
		<fieldset>
		   <label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Programa</label>
		   <select name="programa" id="programa" onchange="return buscar(20,'&programa='+document.forms[0].programa.value)">
			 <option value="0">Seleccione</option>
			  <?php 
                $facultad = new Facultad(array()); 
			    $facultades = $facultad->consultarTodos();		
			    for($i=0; $i<count($facultades); $i++)
			    echo "<option value='".$facultades[$i]->getId()."'>".$facultades[$i]->getNombre()."</option>";
			  ?>				
		   </select>
		</fieldset>
		
		</div>
		<div id="resultados"></div>		
		</td>
	</tr>
</table>
</form>
</body>
</html>

	
