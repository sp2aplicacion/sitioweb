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
	$idConEstSup=$_GET['idConEstSup'];
	$dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	
?>
<!DOCTYPE html>
<html>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td valign="top">
		<h3>Seguimiento Quincenal</h3>
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

	
