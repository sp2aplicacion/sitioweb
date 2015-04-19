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
			<h3>Consultar Sesion de Supervision</h3>
			<?php 
			$convenio = new Convenio(array()); 
			$sesiones=$convenio->consultarSesionsupervision($idConEstSup);
		    $per=$convenio->consultarPeriodo($idConEstSup);
			$fecha_cierre=$convenio->fecha_cierre($per);
			$promedio40=$convenio->nota40($idConEstSup,$fecha_cierre);
	        $promedio60=$convenio->nota60($idConEstSup,$fecha_cierre);
			if($fecha_cierre=="")
			  $fecha_cierre="NO Determinado";				
			echo("<h3><font color='black'>CIERRE DEL 40%: ".$fecha_cierre."</font></h3>");
			
			if($promedio40!="")
			{
			  ?><div align="center"><h4>Promedio 40%=<?php echo $promedio40 ?></h4></div><?php
			}
			if($promedio60!="")
			{
			  ?><div align="center"><h4>Promedio 60%=<?php echo $promedio60 ?></h4></div><?php
			}
			for($i=0; $i<count($sesiones); $i++)
				{
				echo "<br /><div align='center'><strong>SESION NUMERO: ".$sesiones[$i][1]."</strong></div>";
				if($sesiones[$i][1]==1 && $sesiones[$i][9]==1)
					{
					echo "<table align='center'>
					<tr class='titulo'>
					<td align='center' nowrap><strong>Fecha<br>Hora Inicio<br>Hora Final</strong></td>
					<td align='center'><strong>Asistencia<br>Puntualidad</strong></td>
					<td align='center'><strong>Cronograma</strong></td>
					<td align='center'><strong>Objetivos</strong></td>
					<td align='center'><strong>Bitácora</strong></td>
					<td align='center'><strong>Compromisos</strong></td>
					<td align='center'><strong>Plan de mejoramiento</strong></td>
					<td align='center'><strong>Observaciones</strong></td>
					<td align='center' nowrap><strong>Fecha Registro<br>Hora Registro</strong></td>
					</tr>";
					echo "<tr class='par'>
					<td align='center'>".$sesiones[$i][2]."<br>".$sesiones[$i][3]."<br>".$sesiones[$i][4]."</td>
					<td align='center'>",($sesiones[$i][9]==1)?"SI":"NO","<br>",($sesiones[$i][10]==1)?"SI":"NO","</td>";
					if($convenio->consultarCronograma($idConEstSup)==null)
					{
					  echo "<td>Ningún Cronograma</td>";
					}
					else
					{
    					echo "<td><a href='cronogramas/".$convenio->consultarCronograma($idConEstSup)."'>cronograma</a></td>";
					}
					echo "<td>".$sesiones[$i][5]."</td>
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
					<td align='center'><strong>Cronograma</strong></td>
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
					<td align='center' nowrap>".$sesiones[$i][16]."</td>";
					if($convenio->consultarCronograma($idConEstSup)==null)
					{
					  echo "<td>Ningún Cronograma</td>";
					}
					else
					{
    					echo "<td><a href='cronogramas/".$convenio->consultarCronograma($idConEstSup)."'>cronograma</a></td>";
					}
					echo "<td>".$sesiones[$i][5]."</td>
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

	

