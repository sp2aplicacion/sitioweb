<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Supervisor.php');			
	$idPersona=$_SESSION['idPersona'];
	$datos=array();
	$datos[0]=$_POST['codigo'];
	$contra=$_POST['contra'];
	$encontrado=false;
	$llego=false;
	if($idPersona=="")
	{
	  ?>
		<script>location.replace('index.php');</script>	
	   <?php	
    }
	
	$persona = new supervisor(array($idPersona));
	$persona->consultar();	
	if($persona->getNombre()=="")
	{
	
	?>
		<script>location.replace('index.php?id=-1');</script>	
	  <?php			
	}
	
	if($datos[0]=="" || $contra=="")
	{
      $llego=false;
	}
	else
	{
	   $llego=TRUE;
	   $usuario = new Estudiante($datos);
	   $cedula=$usuario->consultarCedula();
	   if($cedula)
	   {
	     $encontrado=true;
	     $usuario->actualizarContra($contra);	  
   	   }
	   
	}
?>
<!DOCTYPE html>
<html>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Administrador: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<form name="Formulario" method="post" action="index.php?id=409">
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuSupervisor.php");?></td>		
		<td valign="top">
		<h3>Cambio de contrase&ntildea</h3>
		<table class="tabla" width='60%'>
		 <tr>
		   <td width='60%'>
		      <div align="right">C&oacutedigo<input type="input" name="codigo" value="" /></div>
           <td>
		 </tr>
		 <tr>
		   <td width='60%'>
		      <div align="right">Contrase&ntildea<input type="input" name="contra" value="" /></div>
           <td>
		 </tr>		
		</table>
		<div align="center"><input type="submit" name="reset" value="Restablecer" /></div> 
		<?php
		if($llego)
		{
		  if ($encontrado)
		     echo "<div align='center' class='rojo'><strong>La contrase&ntilde ha sido restablecida correctamente.</strong></div>";
		  else
		     echo "<div align='center' class='rojo'><strong>El c&oacutedigo del estudiante no se encuentra en el sistema</strong></div>";
		}
		else
		{
		  echo "<div align='center'><strong>Ingrese los datos correctamente</strong></div>";
		}
		?>
</td>
	</tr>
</table>
</form>
</body>
</html>

	
