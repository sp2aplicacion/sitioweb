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
    $eliminado=false;
	if(!empty($_GET['idSesionElim']))
		{
		$convenio=new Convenio(array());
		$convenio->eliminarSesionSupervision($_GET['idSesionElim']);
		$eliminado=true;
		}
	
	
?>
<!DOCTYPE html>
<html>
<head>
<script language="Javascript">
function confirmacion(parametro){
	return confirm('Esta seguro que desea eliminar la sesion numero: '+parametro+ '?');
}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla" border="0">
	<tr>
		<td valign="top">
		<h3>Sesion de Supervision</h3>
		<?php if($eliminado) {echo "<div align='center' class='rojo'><strong>La sesion fue eliminada correctamente.</strong></div>";} ?>
			<?php 
			$convenio = new Convenio(array()); 
			$sesiones=$convenio->consultarSesionsupervision($idConEstSup);
			for($i=0; $i<count($sesiones); $i++)
				{
				echo  "<br /><div align='center'><a href='index.php?id=294&idConEstSup=".$idConEstSup."&idSesionElim=".$sesiones[$i][0]."' onClick=\"return confirmacion('".$sesiones[$i][1]."')\">
				<img src='img/eliminar.png' border='0' onMouseout=hideddrivetip() /></a> ";
				
				echo "<strong>SESION NUMERO:".$sesiones[$i][1]."</strong></div>";
				if($sesiones[$i][1]==1 && $sesiones[$i][9]==1)
					{
					echo "<table align='center'>
					<tr class='titulo'>
					<td align='center' nowrap><strong>Fecha<br>Hora Inicio<br>Hora Final</strong></td>
					<td align='center'><strong>Asistencia<br>Puntualidad</strong></td>
					<td align='center'><strong>Objetivos</strong></td>
					<td align='center'><strong>Bitácora</strong></td>
					<td align='center'><strong>Compromisos</strong></td>
					<td align='center'><strong>Plan de mejoramiento</strong></td>
					<td align='center'><strong>Observaciones</strong></td>
					<td align='center' nowrap><strong>Fecha Registro<br>Hora Registro</strong></td>
					</tr>";
					echo "<tr class='par'>
					<td align='center'>".$sesiones[$i][2]."<br>".$sesiones[$i][3]."<br>".$sesiones[$i][4]."</td>
					<td align='center'>",($sesiones[$i][9]==1)?"SI":"NO","<br>",($sesiones[$i][10]==1)?"SI":"NO","</td>
					<td>".$sesiones[$i][5]."</td>
                    <td>".$sesiones[$i][14]."</td>
					<td>".$sesiones[$i][7]."</td>
					<td>".$sesiones[$i][15]."</td>
					<td>".$sesiones[$i][8]."</td>
					<td align='center'>".$sesiones[$i][18]."<br>".$sesiones[$i][19]."</td>
					</tr>";
					echo "</table>";
					}
				else if($sesiones[$i][1]==1 && $sesiones[$i][9]==0)
					{
					echo "<table align='center'>
					<tr class='titulo'>
					<td align='center' nowrap><strong>Fecha<br>Hora Inicio<br>Hora Final</strong></td>
					<td align='center'><strong>Asistencia</strong></td>
					<td align='center'><strong>Observaciones Inasistencia</strong></td>
					<td align='center' nowrap><strong>Fecha Registro<br>Hora Registro</strong></td>
					</tr>";
					echo "<tr class='par'>
					<td align='center'>".$sesiones[$i][2]."<br>".$sesiones[$i][3]."<br>".$sesiones[$i][4]."</td>
					<td align='center'>",($sesiones[$i][9]==1)?"SI":"NO","</td>
					<td>".$sesiones[$i][17]."</td>
					<td align='center'>".$sesiones[$i][18]."<br>".$sesiones[$i][19]."</td>
					</tr>";
					echo "</table>";
					}
				else if($sesiones[$i][1]>1 && $sesiones[$i][9]==1)
					{
					echo "<table align='center'>
					<tr class='titulo'>
					<td align='center' nowrap><strong>Fecha<br>Hora Inicio<br>Hora Final</strong></td>
					<td align='center'><strong>Asistencia<br>Puntualidad</strong></td>
					<td align='center'><strong>Calificacion<br>Sesion</strong></td>
					<td align='center'><strong>Objetivos</strong></td>
					<td align='center'><strong>Bitácora</strong></td>
					<td align='center'><strong>Compromisos</strong></td>
					<td align='center'><strong>Plan Mejoramiento</strong></td>
					<td align='center'><strong>Observaciones</strong></td>
					<td align='center' nowrap><strong>Fecha Registro<br>Hora Registro</strong></td>
					</tr>";
					echo "<tr class='par'>
					<td align='center'>".$sesiones[$i][2]."<br>".$sesiones[$i][3]."<br>".$sesiones[$i][4]."</td>
					<td align='center'>",($sesiones[$i][9]==1)?"SI":"NO","<br>",($sesiones[$i][10]==1)?"SI":"NO","</td>
					<td align='center' nowrap>".$sesiones[$i][16]."</td>
					<td>".$sesiones[$i][5]."</td>
					<td>".$sesiones[$i][14]."</td>
					<td>".$sesiones[$i][7]."</td>
					<td>".$sesiones[$i][15]."</td>
					<td>".$sesiones[$i][8]."</td>
					<td align='center'>".$sesiones[$i][18]."<br>".$sesiones[$i][19]."</td>
					</tr>";
					echo "</table>";
					$indicadores=$convenio->consultarIndicadoresSesionSupervision($sesiones[$i][0]);
					if(count($indicadores)>0)
						{
						echo "<table align='center' width='800'>
						<tr class='titulo'>
						<td align='center'><strong>Competencia</strong></td>
						<td align='center'><strong>Indicador</strong></td>
						<td align='center'><strong>Calificacion</strong></td>
						</tr>";
						for($j=0; $j<count($indicadores); $j++)
							{
							echo "<tr class='impar'>
							<td>".$indicadores[$j][1]."</td>
							<td>".$indicadores[$j][2]."</td>
							<td align='center'>".$indicadores[$j][3]."</td>
							</tr>";						
							}
						echo "</table>";
						}
					}
				else if($sesiones[$i][1]>1 && $sesiones[$i][9]==0)
					{
					echo "<table align='center'>
					<tr class='titulo'>
					<td align='center' nowrap><strong>Fecha<br>Hora Inicio<br>Hora Final</strong></td>
					<td align='center'><strong>Calificacion<br>Sesion</strong></td>
					<td align='center'><strong>Asistencia</strong></td>
					<td align='center'><strong>Observaciones Inasistencia</strong></td>
					<td align='center' nowrap><strong>Fecha Registro<br>Hora Registro</strong></td>
					</tr>";
					echo "<tr class='par'>
					<td align='center'>".$sesiones[$i][2]."<br>".$sesiones[$i][3]."<br>".$sesiones[$i][4]."</td>
					<td align='center'>".$sesiones[$i][16]."</td>
					<td align='center'>",($sesiones[$i][9]==1)?"SI":"NO","</td>
					<td>".$sesiones[$i][17]."</td>
					<td align='center'>".$sesiones[$i][18]."<br>".$sesiones[$i][19]."</td>
					</tr>";
					echo "</table>";
					}				
				}
			?>
		</td>
	</tr>
</table>
</body>
</html>

	
