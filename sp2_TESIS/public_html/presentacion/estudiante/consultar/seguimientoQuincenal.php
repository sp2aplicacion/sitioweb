<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Area.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Estudiante(array($idPersona));
	$persona->consultarNombre();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$idConEstSup=$_GET['idConEstSup'];
?>
<!DOCTYPE html>
<html>
<head>
<script>
function abrir(pagina) {
	window.open(pagina, 'null', 'height=600,width=1000,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');
}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Estudiante: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuEstudiante.php");?></td>		
		<td valign="top">
			<h3>Consultar Seguimiento Quincenal</h3>
			<?php 
			$convenio = new Convenio(array()); 
			$seguimientos=$convenio->consultarSeguimientoQuincenalSupervision($idConEstSup);
			echo "<table align='center' border='0'>";
			echo "<tr class='titulo'><td><strong>No</strong></td><td align='center'><strong>Fecha</strong></td><td align='center'><strong>Hora</strong></td><td align='center'><strong>Tema</strong></td></tr>";
			for($i=0; $i<count($seguimientos); $i++)
				{
				echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
				echo "					
				<td align='center'>",$i+1,"</td>
				<td align='center' nowrap>",$seguimientos[$i][1],"</td>
				<td align='center' nowrap>",$seguimientos[$i][2],"</td>
				<td align='left'>",str_replace("\n","<br>",$seguimientos[$i][3]),"</td>";
				}
			echo "</table>";
			?>
		</td>
	</tr>
</table>
</body>
</html>

	

