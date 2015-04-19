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
	$idEstudiante=$_GET['idEstudiante'];
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
		<h3>Control Diario de Practica</h3>
			<?php 
			$convenio = new Convenio(array()); 
			$controlesDiarios=$convenio->consultarControlDiarioPractica($idConEstSup);
			echo "<table align='center' border='0'>";
			echo "<tr class='titulo'><td><strong>No</strong></td><td align='center'><strong>Fecha</strong></td><td align='center'><strong>Hora Entrada</strong></td><td align='center'><strong>Hora Salida</strong></td><td align='center'><strong>Duracion</strong></td><td align='center'><strong>Actividades</strong></td><td align='center'><strong>Fecha Registro</strong></td><td align='center'><strong>Hora Registro</strong></td></tr>";
			for($i=0; $i<count($controlesDiarios); $i++)
				{
				echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
				echo "					
				<td align='center'><a href='index.php?id=901&idConEstSup=".$idConEstSup."&idEstudiante=".$idEstudiante."&fecha=".$controlesDiarios[$i][1]."'>",$i+1,"</a></td>
				<td align='center' nowrap>",$controlesDiarios[$i][1],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][2],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][3],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][4],"</td>
				<td align='left'>",str_replace("\n","<br>",$controlesDiarios[$i][5]),"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][6],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][7],"</td>";
				}
			echo "</table>";
			?>
		</td>
	</tr>
</table>
</body>
</html>

	
