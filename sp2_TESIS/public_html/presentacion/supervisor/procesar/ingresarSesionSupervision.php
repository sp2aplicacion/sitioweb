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
	$convenio = new Convenio(array()); 
	$estudiante->consultarNombre();
	$idConEstSup=$_GET['idConEstSup'];
	$periodo=$_GET['periodo'];
	$numSesion=$_POST['numSesion'];
	$fecha=$_POST['fecha'];
	$horaInicio=$_POST['horaInicio'];
	$horaFinal=$_POST['horaFinal'];
	$calificacionSesion=$_POST['calificacionSesion'];
	$per=$convenio->consultarPeriodo($idConEstSup);
	$fecha_cierre=$convenio->fecha_cierre($per);
	$asistencia=$_POST['asistencia'];
	$puntualidad=$_POST['puntualidad'];
	$calificacionCumplimientoCompromisos=$_POST['calificacionCumplimientoCompromisos'];
	$calificacionAspectos=$_POST['calificacionAspectos'];
	$objetivos=$_POST['objetivos'];
	$resumen=$_POST['resumen'];
	$aspectos=$_POST['aspectos'];
	$compromisos=$_POST['compromisos'];
	$bitacora=$_POST['bitacora'];
	$observaciones=$_POST['observaciones'];
	$planMejoramiento=$_POST['planMejoramiento'];
	$observacionesInasistencia=$_POST['observacionesInasistencia'];
	$cronograma=str_replace(" ","_",$_FILES['cronograma']['name']);
	if($cronograma!="")
	{ 
      $rutalocal=$_FILES['cronograma']['tmp_name'];
	  $extension = explode(".",$cronograma);
	  $tipo=$_FILES['cronograma']['type'];
      $num = count($extension)-1;
	  if($extension[$num]=='xlsx' || $extension[$num]=='xls') 
	  { 
	   $cronograma=date("Y-m-d_H_i_").$cronograma;
	    $rutaservidor = "cronogramas/".$cronograma;				
	    copy($rutalocal,$rutaservidor);	
	    chmod($rutaservidor,0777); 
		$convenio->InsertarCronogramaConvenioEstudianteSupervisor($idConEstSup,$cronograma);		
      }
	  else
	  {
	    ?> 
		  <script>alert('El archivo debe ser �nicamente de extension xlsx o xls');history.go(-1);</script>	
		<?php
	  }
	       	  
	}
	
	$dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	if($estudiante->consultarFacultad()==1)
	{
	  	$competencias=array(
		"HABILIDADES SOCIALES",
		"PRODUCTIVIDAD",
		"FORMULACI�N EN AMBIENTES APLICADOS",
		"PROCESOS PSICOL�GICOS",
		);
	}
	if($estudiante->consultarFacultad()==5  || $estudiante->consultarFacultad()==3 || $estudiante->consultarFacultad()==7)
	{
	 	$competencias=array(
	 	"HABILIDADES SOCIALES",
		"PRODUCTIVIDAD",
		"FORMULACI�N EN AMBIENTES APLICADOS",
		);
	}	
	$indicadores=array();
	if($estudiante->consultarFacultad()==1)
	{
	   	$indicadores[0][0]="Muestra habilidad para integrarse pro activamente a las sesiones de trabajo";
		$indicadores[0][1]="Hacer frente al desacuerdo, oposici�n o adversidad de manera asertiva.";
		$indicadores[0][2]="Expresa claramente ideas y opiniones mediante el lenguaje oral y escrito";
		$indicadores[0][3]="Es agil en el dise�o de nuevas estrategias para enfrentar las condiciones cambiantes";
		$indicadores[0][4]="Utiliza correctamente herramientas e instrumentos de planificaci�n , como cronogramas, graficas para organizar su trabajo y hacer seguimiento";
		$indicadores[0][5]="Elabora informes precisos y f�ciles de comprender, interpretando y simplificando la complejidad de la informaci�n";
		$indicadores[1][0]="Aborda sus tareas con exigencia y rigurosidad, ofreciendo altos est�ndares de calidad";
		$indicadores[1][1]="Sus reportes, trabajos y proyectos son completos, precisos y siempre bien presentados";
		$indicadores[1][2]="Encuentra informaci�n adicional a la exigida por los supervisores sobre los aspectos que se manejan en la pr�ctica profesional buscando superara sus propios limites";
		$indicadores[1][3]="Consulta las decisiones que est�n por fuera de sus atribuciones";
		$indicadores[1][4]="Es prudente en el manejo de la informaci�n bajo su responsabilidad";
		$indicadores[1][5]="Conoce y aplica los principios y normas �ticas en su ejercicio profesional";
		$indicadores[1][6]="Reporta oportunamente a su supervisor universitario cualquier violaci�n a la �tica profesional que observe en el desarrollo de su pr�ctica";
		$indicadores[2][0]="Define claramente la situaci�n problema y se basa en  un marco te�rico para este fin";
	   	$indicadores[2][1]="Dise�a y utiliza instrumentos y estrategias de recolecci�n de informaci�n (conoce tipos de entrevista, pruebas, registros de conducta, etc.) ajustados a la situaci�n particular y a los criterios de calidad psicometrica";
		$indicadores[2][2]="Elabora hip�tesis y las somete a verificaci�n y a an�lisis a trav�s de multiples metodos y fuentes";
		$indicadores[2][3]="Propone estrategias de intervenci�n acordes con la evaluaci�n y an�lisis de la problem�tica diagnosticada/formulada";
		$indicadores[2][4]="Selecciona estrategias de seguimiento para establecer la efectividad de la intervenci�n";
		$indicadores[3][0]="Identifica los procesos psicol�gicos que se relacionan con el comportamiento individual, colectivo y determina su funcion y la forma de modificarlos";
		$indicadores[3][1]="Analiza las variables que influyen sobre la conducta,  determina su funcion y dise�a contingencias para su modificaci�n";
		$indicadores[3][2]="Emplea las teor�as del aprendizaje para modificar el comportamiento del grupo";
 
	}
	if($estudiante->consultarFacultad()==5  || $estudiante->consultarFacultad()==3 || $estudiante->consultarFacultad()==7)
	{
	   	$indicadores[0][0]="Muestra habilidad para integrarse pro activamente a las sesiones de trabajo";
		$indicadores[0][1]="Hacer frente al desacuerdo, oposici�n o adversidad de manera asertiva.";
		$indicadores[0][2]="Expresa claramente ideas y opiniones mediante el lenguaje oral y escrito";
		$indicadores[0][3]="Es agil en el dise�o de nuevas estrategias para enfrentar las condiciones cambiantes";
		$indicadores[0][4]="Utiliza correctamente herramientas e instrumentos de planificaci�n , como cronogramas, graficas para organizar su trabajo y hacer seguimiento";
		$indicadores[0][5]="Elabora informes precisos y f�ciles de comprender, interpretando y simplificando la complejidad de la informaci�n";
		$indicadores[1][0]="Aborda sus tareas con exigencia y rigurosidad, ofreciendo altos est�ndares de calidad";
		$indicadores[1][1]="Sus reportes, trabajos y proyectos son completos, precisos y siempre bien presentados";
		$indicadores[1][2]="Encuentra informaci�n adicional a la exigida por los supervisores sobre los aspectos que se manejan en la pr�ctica profesional buscando superara sus propios limites";
		$indicadores[1][3]="Consulta las decisiones que est�n por fuera de sus atribuciones";
		$indicadores[1][4]="Es prudente en el manejo de la informaci�n bajo su responsabilidad";
		$indicadores[1][5]="Conoce y aplica los principios y normas �ticas en su ejercicio profesional";
		$indicadores[1][6]="Reporta oportunamente a su supervisor universitario cualquier violaci�n a la �tica profesional que observe en el desarrollo de su pr�ctica";
		$indicadores[2][0]="Define claramente la situaci�n problema y se basa en  un marco te�rico para este fin";
		$indicadores[2][1]="Elabora hip�tesis y las somete a verificaci�n y a an�lisis a trav�s de multiples metodos y fuentes";
		$indicadores[2][2]="Propone estrategias de intervenci�n acordes con la evaluaci�n y an�lisis de la problem�tica diagnosticada/formulada";
		$indicadores[2][3]="Selecciona estrategias de seguimiento para establecer la efectividad de la intervenci�n";
	}
	
	$calificacionIndicadores=array();	
	$calificacionIndicadores[0][0]=$_POST['calificacionIndicador00'];
	for($i=0;$i<count($competencias);$i++)
	{
		for($j=0;$j<count($indicadores[$i]);$j++)
		{
			$calificacionIndicadores[$i][$j]=$_POST['calificacionIndicador'.$i.$j];
		}
	}
	if($numSesion==1 && $asistencia==1)
		{
		$convenio->insertarSesionUnoSupervision($fecha,$horaInicio,$horaFinal,$puntualidad,$objetivos,$bitacora,$compromisos,$planMejoramiento,$observaciones,$idConEstSup);
		}
	else if($numSesion==1 && $asistencia==0)
		{
		$convenio->insertarSesionUnoInasistenciaSupervision($fecha,$horaInicio,$horaFinal,$observacionesInasistencia,$idConEstSup);			
		}
	else if($numSesion>1 && $asistencia==1)
		{
		$convenio->insertarSesionDiferenteUnoSupervision($numSesion,$fecha,$horaInicio,$horaFinal,$calificacionSesion,$puntualidad,$calificacionCumplimientoCompromisos,$objetivos,$aspectos,$calificacionAspectos,$bitacora,$compromisos,$planMejoramiento,$observaciones,$idConEstSup);
		$idSesionSupervision=$convenio->consultarIdMaxSesionSupervision();

		for($i=0;$i<count($competencias);$i++)
			{
			for($j=0;$j<count($indicadores[$i]);$j++)
				{
				if($calificacionIndicadores[$i][$j]!=-1 )
					{
					$convenio->insertarIndicadorSesion($competencias[$i],$indicadores[$i][$j],$calificacionIndicadores[$i][$j],$idSesionSupervision);
					}
				}
			}					
		}
	else if($numSesion>1 && $asistencia==0)
		{
		$convenio->insertarSesionDiferenteUnoInasistenciaSupervision($numSesion,$fecha,$horaInicio,$horaFinal,$observacionesInasistencia,$idConEstSup);			
		$calificacionSesion='0';
		}
	$promedio40=$convenio->nota40($idConEstSup,$fecha_cierre);
	$promedio60=$convenio->nota60($idConEstSup,$fecha_cierre);
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


</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Supervisor: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuSupervisor.php");?></td>		
		<td valign="top">
			<h3>Informacion Sesion de Supervision Agregada para el estudiante:<br /> <?php echo $idEstudiante.", ".$estudiante->getNombre()." ".$estudiante->getApellido() ?> </h3>
			<div align="center" class="rojo"><strong>Cuenta con 24 horas para actualizar la informacion</strong></div>
			<div align="center"><a href="index.php?id=402&periodo=<?php echo $periodo ?>"><strong>Regresar</strong></a></div>
			<form name="Formulario" method="post" enctype="multipart/form-data" action="index.php?id=404&idEstudiante=<?php echo $idEstudiante ?>&idConEstSup=<?php echo $idConEstSup ?>">
				<table align="center" border="0">
				<tr><td align="center" colspan="2">								
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Numero Sesion</label><?php echo $numSesion ?></fieldset>				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha</label><?php echo $fecha ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora Inicio</label><?php echo $horaInicio ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora Final</label><?php echo $horaFinal ?></fieldset>	
				<?php if ($numSesion>1) { ?>				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Calificacion Sesion</label><?php echo $calificacionSesion ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Promedio 40%</label><?php echo $promedio40 ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Promedio 60%</label><?php echo $promedio60 ?></fieldset>
				<?php } ?>
				</td></tr>
				<tr><td colspan="2" align="center">
				<h3>CRITERIOS DE EVALUACION</h3>	
				<strong>ASPECTOS GENERALES</strong>				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Asistencia</label><?php echo ($asistencia==1)?"SI":"NO" ?></fieldset>
				<?php if ($asistencia==1) { ?>				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Puntualidad</label><?php echo ($puntualidad==1)?"SI":"NO" ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cumplimiento Compromisos</label><?php echo ($calificacionCumplimientoCompromisos==-1)?"NA":$calificacionCumplimientoCompromisos ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Calificacion Aspectos</label><?php echo ($calificacionAspectos==0)?"NA":$calificacionAspectos ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Cronograma de actividades</label><?php if ($convenio->consultarCronograma($idConEstSup)=="") echo "Ning�n Cronograma"; else echo "<a href='cronogramas/".$convenio->consultarCronograma($idConEstSup)."'>Cronograma</a>"; ?></fieldset>
				</td></tr>
				<tr><td valign="bottom" width="300px">		
				<?php if ($numSesion==1) { ?>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><strong>*Objetivos de la sesi�n</strong></label></fieldset><?php echo $objetivos ?>
				<?php } else { ?>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><strong>*Objetivos de la sesi�n</strong></label></fieldset><?php echo $objetivos ?>		
				<?php } ?>				</td>
				<td valign="bottom" width="300px">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><strong>*Bit�cora de sesi&oacuten</strong></label></fieldset><?php echo $bitacora ?>
				</td></tr>
				<tr>
				  <td valign="bottom" width="300px">
				    <fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><strong>*Compromisos para la proxima Sesion</strong></label></fieldset><?php echo $compromisos ?>
				  </td>
				  <td valign="bottom" width="300px">	
				    <?php if ($numSesion==1) { ?>
				    <fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><strong>*Plan de Mejoramiento</strong></label></fieldset><?php echo $planMejoramiento 	?>
				    <?php } else { ?>
				    <fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><strong>*Plan de Mejoramiento</strong></label></fieldset><?php echo $planMejoramiento ?>				
				    <?php } ?>			
				  </td>
				</tr>
				<tr> 
    				<td valign="bottom" width="300px" colspan="2"> 
		   		      <fieldset>
					       <label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'" align="center"><strong>*Observaciones de la Sesion</strong></label>
					  </fieldset><?php echo $observaciones ?>			
				    </td>
				</tr>	
				<?php if($numSesion>1) { ?>
				<tr><td colspan="2">
				</tr>
				<tr><td align="center" colspan="2">
				<strong>ASPECTOS DEL DESARROLLO PROFESIONAL</strong><br />	
				<table border="0" width="650px">
					<tr class="titulo">
						<td align="center"><strong>Competencia</strong></td>
						<td align="center"><strong>Indicador</strong></td>
						<td align="center"><strong>Calif.</strong></td>
					</tr>
					<?php 
					$numCalificaciones=0;
					for($i=0;$i<count($competencias);$i++)
						{
						for($j=0;$j<count($indicadores[$i]);$j++)
							{
							if($calificacionIndicadores[$i][$j]!=-1)
								{
								echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' " : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par'" , ">";
								echo "<td align='center'>".$competencias[$i]."</td>";
								echo "<td align='left'>".$indicadores[$i][$j]."</td>";
								echo "<td align='center'>".$calificacionIndicadores[$i][$j]."</td>";
								echo "</tr>";
								$numCalificaciones++;
								}
							}
						}					
						echo "<tr><td colspan='3'><strong>".$numCalificaciones." indicadores calificados</strong></td></tr>";
					?>
				
				</table>			
				</td></tr>
				<?php } ?>
				<?php }else{ //Asistencia ?>
				<tr><td valign="bottom" width="300px">		
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Observaciones Inasistencia</label></fieldset><?php echo $observacionesInasistencia ?>
				</td>
				<?php } ?>				 			
				</table>
			</form>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>