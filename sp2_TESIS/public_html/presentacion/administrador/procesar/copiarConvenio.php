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
	$fechaInicial=$_POST['fechaInicial'];
	$fechaFinal=$_POST['fechaFinal'];
	$periodoCopia=$_POST['periodoCopia'];
	$datos = array();

	$convenios=$_POST['convenios'];
	$numConvenios=0;
	for($i=0; $i<count($convenios); $i++)
		{
		$info=explode("@-@",$convenios[$i]);
		$datos[0]=0;
		$datos[1]=$fechaInicial;
		$datos[2]=$fechaFinal;
		$datos[3]=$info[0];
		$datos[7]=$info[1];
		$datos[8]=$info[2];
		$datos[9]=$periodoCopia;
		$datos[10]=$info[3];
		$datos[11]=$info[4];				
		$datos[12]=$info[5];				
		$numConvenios++;
		$convenio= new Convenio($datos);
		$convenio->copiar();
		}

?>
<!DOCTYPE html>
<html>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Info Convenios Copiados</h3>
			<div align="center">Se han copiado <?php echo $numConvenios ?> Convenios</div>
		</td>
	</tr>
</table>
</body>
</html>

	

