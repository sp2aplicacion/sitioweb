<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Supervisor.php');	
	require_once('logica/Administrador.php');	
	require_once('logica/Convenio.php');	
	$idPersona=$_SESSION['idPersona'];
	$datos=array();
	$datos[0]=$_POST['periodo'];
	$datos[1]=$_POST['fechaCierre'];
	$llego=false;
	$ingreso=false;
	$actualizo=false;
	$iguales=true;
	
	
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
	
	if($datos[0]=="" || $datos[1]=="")
	{
      $llego=false;
	}
	else
	{
	   $llego=true;
	   if(substr($datos[1],0,4)."-".(int)(((substr($datos[1],5,2)-7)/7)+2)==$datos[0])
	   {
		   if($persona->consultar_cierre40($datos[0]))
		   {
			  $actualizo=true;
			  $persona->actualizar_cierre40($datos[0],$datos[1]);
		   }
		   else
		   {	   
			  $persona->insertar_cierre40($datos[0],$datos[1]);
			  $ingreso=true;
		   }
	     
	   }
	   else
	   {
	      $iguales=false;
	   }

	}
	$cierre=$persona->consultar_cierre40(date("Y")."-".(int)(((date("M")-7)/7)+2));
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script src="scripts/CalendarPopup.js" type="text/javascript"></script>
<script>document.write(getCalendarStyles());</script>
<script>
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</script>
<link rel="stylesheet" href="estilos/CalendarPopup.css" type="text/css" media="all" />

</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<form name="Formulario" method="post" action="index.php?id=288">
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>
		<?php if($cierre!="")
              {
			   ?>Cierre del 40%: <?php echo($cierre);
              }
			  else
			  {
			    ?>Cierre del 40% <?php 
			  }
  	    ?> 
		</h3>
		<table class="tabla" width='60%' border="0">
		 <tr>
		   <td width='60%'>
		      <div align="right">
				<fieldset>
				   <label  class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar' ">*Perido</label>
				   <select name="periodo" align="right">
				      <?php 
					    for($i=date("Y")+1; $i>=date("Y")-2; $i--) 
				          echo "<option value='".$i."-2'>".$i."-2</option><option value='".$i."-1'>".$i."-1</option>"; 
			          ?>
				   </select>
				</fieldset>
			  </div>
           <td>
		 </tr>
		 <tr>
		   <td width='60%'>
		     <div align="right">
		      <fieldset align="right"><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha Cierre</label><input name="fechaCierre" type="text" id="fechaFinal" onclick="cal1xx.select(document.forms[0].fechaFinal,'fechaFinal','yyyy-MM-dd'); return false;" readonly="true" /></fieldset>
             </div>
		   <td>
		 </tr>		
		</table>
		<div align="center"><input type="submit" name="reset" value="Enviar" /></div> 
		<?php

		if($ingreso)
		   echo "<div align='center'><strong>Los datos han sido ingresados correctamente.</strong></div>";
		else if($actualizo)
		   echo "<div align='center'><strong>Los datos han sido actualizados correctamente.</strong></div>";
		else if(!$iguales)
		   echo "<div align='center' class='rojo'><strong>La fecha no coincide con el periodo.</strong></div>";
 	    else if(!$llego)
		   echo "<div align='center' class='rojo'><strong>Ingrese los datos correctamente</strong></div>";
		

		?>
</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</form>
</body>
</html>

	
