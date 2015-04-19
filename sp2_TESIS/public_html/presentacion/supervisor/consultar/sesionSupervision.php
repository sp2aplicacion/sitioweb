<?php 
	session_start();	
	require_once('logica/Supervisor.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Area.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Supervisor(array($idPersona));
	$persona->consultarNombre();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$idEstudiante=$_GET['idEstudiante'];
	$estudiante=new Estudiante(array($idEstudiante));
	$estudiante->consultarNombre();
	$idConEstSup=$_GET['idConEstSup'];
	$periodo=$_GET['periodo'];
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
<script src="scripts/CalendarPopup.js" type="text/javascript"></script>
<script>document.write(getCalendarStyles());</script>
<script>
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</script>
<link rel="stylesheet" href="estilos/CalendarPopup.css" type="text/css" media="all" />
<script src="scripts/funciones.js"></script>
<link rel="stylesheet" href="estilos/toolTip.css" /> 
<script src="scripts/toolTip.js"></script>
<script src="scripts/ajax.js"></script>
<script language="Javascript">
function confirmacion(parametro){
	return confirm('Esta seguro que desea eliminar la sesion numero: '+parametro+ '?');
}
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('SERVICIO NO IMPLEMENTADO. Editar sesion de supervision numero: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==2)
		ddrivetip('Eliminar sesion de supervision numero: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Supervisor: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuSupervisor.php");?></td>		
		<td valign="top">
			<h3>Consultar Sesion de Supervision para el estudiante:<br /> <?php echo $idEstudiante.", ".$estudiante->getNombre()." ".$estudiante->getApellido() ?>   </h3>
			<div align="center"><a href="index.php?id=402&periodo=<?php echo $periodo ?>"><strong>Regresar</strong></a></div>
			<?php if($eliminado) {echo "<div align='center' class='rojo'><strong>La sesion fue eliminada correctamente.</strong></div>";} ?>
			<?php
			$tiempoActual=mktime();			 
			$convenio = new Convenio(array()); 
			$sesiones=$convenio->consultarSesionsupervision($idConEstSup);
			$per=$convenio->consultarPeriodo($idConEstSup);
	        $fecha_cierre=$convenio->fecha_cierre($per);
	        $promedio40=$convenio->nota40($idConEstSup,$fecha_cierre);
	        $promedio60=$convenio->nota60($idConEstSup,$fecha_cierre);
		    //$promedio=$convenio->nota40($idConEstSup);
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
			/*	echo("</br>Id [0]: ".$sesiones[$i][0]);
				echo("</br>Numero de sesion [1]: ".$sesiones[$i][1]);
				echo("</br>Fecha [2]: ".$sesiones[$i][2]);
				echo("</br>Hora inicio [3]: ".$sesiones[$i][3]);
				echo("</br>Hora final [4]: ".$sesiones[$i][4]);
				echo("</br>Objetivos [5]: ".$sesiones[$i][5]);
				echo("</br>Fecha Registro [6]: ".$sesiones[$i][6]);
				echo("</br>Compromisos [7]: ".$sesiones[$i][7]);
				echo("</br>Observaciones [8]: ".$sesiones[$i][8]);
				echo("</br>Asistencia [9]: ".$sesiones[$i][9]);
				echo("</br>Puntualidad [10]: ".$sesiones[$i][10]);
				echo("</br>calificacionCumplimientoCompromisos	 [11]: ".$sesiones[$i][11]);
				echo("</br>ASpectos [12]: ".$sesiones[$i][12]);
				echo("</br>Calificacion aspectos [13]: ".$sesiones[$i][13]);
				echo("</br>Bitacora [14]: ".$sesiones[$i][14]);
				echo("</br>Plan de mejoramiento [15]: ".$sesiones[$i][15]);
				echo("</br>Calificacion de sesion [16]: ".$sesiones[$i][16]);
				echo("</br>Observaciones de inasistencia [17]: ".$sesiones[$i][17]);
				echo("</br>Fecha Registro [18]: ".$sesiones[$i][18]);
				echo("</br>Hora Registro [19]: ".$sesiones[$i][19]);
				echo("</br>IdEstSup [20]: ".$sesiones[$i][20]);
			*/	
				$tiempoRegistro=mktime(substr($sesiones[$i][19], 0,2),substr($sesiones[$i][19],3,2),0,substr($sesiones[$i][18], 5,2),substr($sesiones[$i][18], 8,2),substr($sesiones[$i][18], 0,4));
				$tiempoDif=$tiempoActual-$tiempoRegistro;
				$tiempoDif/=3600;
				//echo("Registro".$tiempoRegistro."");
				//echo("Actual".$tiempoActual);
				//echo("</br>Diferencia=".$tiempoDif);
				
				echo "<br /><div align='center'>", ($tiempoDif<=24)?" 
				<a href='index.php?id=407&idEstudiante=".$idEstudiante."&idConEstSup=".$idConEstSup."&periodo=".$periodo."&idSesionElim=".$sesiones[$i][0]."' onClick=\"return confirmacion('".$sesiones[$i][1]."')\">
				<img src='img/eliminar.png' border='0' onMouseover=mensaje(2,'".$sesiones[$i][1]."') onMouseout=hideddrivetip() /></a> ": "" ,"
				<strong>SESION NUMERO: ".$sesiones[$i][1]."</strong></div>";
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
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>