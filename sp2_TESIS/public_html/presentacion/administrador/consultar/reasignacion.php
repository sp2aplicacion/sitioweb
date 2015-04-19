<?php 
	session_start();	
	require_once('logica/Administrador.php');	
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
	$persona = new Administrador(array($idPersona));
	$persona->consultar();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$estado=0;
	$datos=array();
	$datos[0]=$_POST['supervisor'];
	$datos[1]=$_POST['sup_asig'];
	
//	echo("supervisor: ".$datos[0]);
//  echo("id: ".$datos[1]);
	
	if($datos[0]=="" || $datos[1]=="" || $datos[1]==0 || $datos[0]=="0")
	{
       $estado=0;
	}
	else
	{
	  
      $convenio = new Convenio(array()); 
	  $convenio->actualizarsupervisor($datos[1],$datos[0]);	
	  $estado=1;
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
		<h3>Convenios para Supervision</h3>
		<?php
		 if($estado==1)
		    echo "<div align='center'><strong>Los datos han sido ingresados correctamente.</strong></div>";
		 else  echo "<div align='center' class='rojo'><strong>Ingrese los datos correctamente</strong></div>";
		?>		
		<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Area</label><select name="q" id="q" onchange="return buscar(54,'&periodo='+document.forms[0].periodo.value)">
			<option value="0">Seleccione</option>
			<?php 
			$area = new Area(array()); 
			$areas = $area->consultarTodos();		
			for($i=0; $i<count($areas); $i++)
				echo "<option value='".$areas[$i]->getId()."'>".$areas[$i]->getNombre()."</option>";
			?>				
			</select></fieldset>					
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Perido</label>
			<select name="periodo" id="periodo" onchange="return buscar(54,'&periodo='+document.forms[0].periodo.value)">
			<option value="0">Seleccione</option>			
			<?php 
			$convenio = new Convenio(array()); 
			$periodos = $convenio->consultarPeriodos();		
			for($i=0; $i<count($periodos); $i++)
				echo "<option value='".$periodos[$i]."'>".$periodos[$i]."</option>";			
			?>
			</select>
			</fieldset>	
	
			<span id="loading"></span>
		</div>
		<div id="resultados"></div>		
		</td>
	</tr>

</table>
</form>
</body>
</html>

	
