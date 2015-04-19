<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Administrador.php');	
	require_once('logica/Supervisor.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$cnueva=$_POST['cnueva'];
	$cant=$_POST['cant'];
	$cconf=$_POST['cconf'];
	$error=0;
	if($cnueva=="" || $cant=="" || $cconf=="")
		{$error=1;}
	elseif ($cnueva!=$cconf)
		{$error=2;}

	$rol=$_GET['rol'];
	$datos=array();
	$datos[0]=$idPersona;
	$datos[4]=$cant;
	if ($rol=="Administrador")
		$persona = new Administrador($datos);	
	elseif ($rol=="Estudiante")
		$persona = new Estudiante($datos);
	elseif ($rol=="Supervisor")
		$persona = new Supervisor($datos);
	$persona->consultarNombre();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
?>
<!DOCTYPE html>
<html>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como <?php  if($rol=="Administrador") {echo('Coordinador de Prácticas');} else echo($rol);  ?>: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menu".$rol.".php") ?></td>		
		<td valign="top">
		<h3>Cambiar Contrase&ntilde;a</h3>
		<?php 
		if($error==1)
			{echo "<h3>DEBE INGRESAR TODOS LOS DATOS</h3>";}
		elseif($error==2)
			{echo "<h3>LA NUEVA CONTRASEÑA DEBE SER IGUAL A LA CONFIRMACION</h3>";}
		elseif($persona->autenticar()==1)
			{
			$persona->actualizarContra($cnueva);							
			echo "<h3>LA CONTRASEÑA FUE CAMBIADA CON EXITO</h3>";
			}
		else
			{echo "<h3>LA CONTRASEÑA ANTERIOR ESTA ERRADA. VERIFIQUELA E INTENTELO DE NUEVO</h3>";}
		?>					
		</td>
	</tr>
</table>
</body>
</html>

	

