<?php 
	session_start();	
	require_once('logica/Supervisor.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Area.php');	
    require_once('logica/Facultad.php');
	
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
	$facultad = new Facultad(array()); 
	$facultades = $facultad->consultarTodos();	
	$idEstudiante=$_GET['idEstudiante'];
	$estudiante=new Estudiante(array($idEstudiante));
	$estudiante->consultarNombre();
	$fac=$estudiante->consultarFacultad();
	$idConEstSup=$_GET['idConEstSup'];
	$periodo=$_GET['periodo'];
	$dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	if($estudiante->consultarFacultad()==1)
	{
	  	$competencias=array(
		"HABILIDADES SOCIALES",
		"PRODUCTIVIDAD",
		"FORMULACIÓN EN AMBIENTES APLICADOS",
		"PROCESOS PSICOLÓGICOS",
		);
	}
	if($estudiante->consultarFacultad()==5  || $estudiante->consultarFacultad()==3 || $estudiante->consultarFacultad()==7)
	{
	 	$competencias=array(
	 	"HABILIDADES SOCIALES",
		"PRODUCTIVIDAD",
		"FORMULACIÓN EN AMBIENTES APLICADOS",
		);
	}	
	$indicadores=array();
	
	if($estudiante->consultarFacultad()==1)
	{
	   	$indicadores[0][0]="Muestra habilidad para integrarse pro activamente a las sesiones de trabajo";
		$indicadores[0][1]="Hacer frente al desacuerdo, oposición o adversidad de manera asertiva.";
		$indicadores[0][2]="Expresa claramente ideas y opiniones mediante el lenguaje oral y escrito";
		$indicadores[0][3]="Es agil en el diseño de nuevas estrategias para enfrentar las condiciones cambiantes";
		$indicadores[0][4]="Utiliza correctamente herramientas e instrumentos de planificación , como cronogramas, graficas para organizar su trabajo y hacer seguimiento";
		$indicadores[0][5]="Elabora informes precisos y fáciles de comprender, interpretando y simplificando la complejidad de la información";
		$indicadores[1][0]="Aborda sus tareas con exigencia y rigurosidad, ofreciendo altos estándares de calidad";
		$indicadores[1][1]="Sus reportes, trabajos y proyectos son completos, precisos y siempre bien presentados";
		$indicadores[1][2]="Encuentra información adicional a la exigida por los supervisores sobre los aspectos que se manejan en la práctica profesional buscando superara sus propios limites";
		$indicadores[1][3]="Consulta las decisiones que están por fuera de sus atribuciones";
		$indicadores[1][4]="Es prudente en el manejo de la información bajo su responsabilidad";
		$indicadores[1][5]="Conoce y aplica los principios y normas éticas en su ejercicio profesional";
		$indicadores[1][6]="Reporta oportunamente a su supervisor universitario cualquier violación a la ética profesional que observe en el desarrollo de su práctica";
		$indicadores[2][0]="Define claramente la situación problema y se basa en  un marco teórico para este fin";
	   	$indicadores[2][1]="Diseña y utiliza instrumentos y estrategias de recolección de información (conoce tipos de entrevista, pruebas, registros de conducta, etc.) ajustados a la situación particular y a los criterios de calidad psicometrica";
		$indicadores[2][2]="Elabora hipótesis y las somete a verificación y a análisis a través de multiples metodos y fuentes";
		$indicadores[2][3]="Propone estrategias de intervención acordes con la evaluación y análisis de la problemática diagnosticada/formulada";
		$indicadores[2][4]="Selecciona estrategias de seguimiento para establecer la efectividad de la intervención";
		$indicadores[3][0]="Identifica los procesos psicológicos que se relacionan con el comportamiento individual, colectivo y determina su funcion y la forma de modificarlos";
		$indicadores[3][1]="Analiza las variables que influyen sobre la conducta,  determina su funcion y diseña contingencias para su modificación";
		$indicadores[3][2]="Emplea las teorías del aprendizaje para modificar el comportamiento del grupo";
 
	}
	if($estudiante->consultarFacultad()==5  || $estudiante->consultarFacultad()==3 || $estudiante->consultarFacultad()==7)
	{
	   	$indicadores[0][0]="Muestra habilidad para integrarse pro activamente a las sesiones de trabajo";
		$indicadores[0][1]="Hacer frente al desacuerdo, oposición o adversidad de manera asertiva.";
		$indicadores[0][2]="Expresa claramente ideas y opiniones mediante el lenguaje oral y escrito";
		$indicadores[0][3]="Es agil en el diseño de nuevas estrategias para enfrentar las condiciones cambiantes";
		$indicadores[0][4]="Utiliza correctamente herramientas e instrumentos de planificación , como cronogramas, graficas para organizar su trabajo y hacer seguimiento";
		$indicadores[0][5]="Elabora informes precisos y fáciles de comprender, interpretando y simplificando la complejidad de la información";
		$indicadores[1][0]="Aborda sus tareas con exigencia y rigurosidad, ofreciendo altos estándares de calidad";
		$indicadores[1][1]="Sus reportes, trabajos y proyectos son completos, precisos y siempre bien presentados";
		$indicadores[1][2]="Encuentra información adicional a la exigida por los supervisores sobre los aspectos que se manejan en la práctica profesional buscando superara sus propios limites";
		$indicadores[1][3]="Consulta las decisiones que están por fuera de sus atribuciones";
		$indicadores[1][4]="Es prudente en el manejo de la información bajo su responsabilidad";
		$indicadores[1][5]="Conoce y aplica los principios y normas éticas en su ejercicio profesional";
		$indicadores[1][6]="Reporta oportunamente a su supervisor universitario cualquier violación a la ética profesional que observe en el desarrollo de su práctica";
		$indicadores[2][0]="Define claramente la situación problema y se basa en  un marco teórico para este fin";
		$indicadores[2][1]="Elabora hipótesis y las somete a verificación y a análisis a través de multiples metodos y fuentes";
		$indicadores[2][2]="Propone estrategias de intervención acordes con la evaluación y análisis de la problemática diagnosticada/formulada";
		$indicadores[2][3]="Selecciona estrategias de seguimiento para establecer la efectividad de la intervención";
	}

	$convenio = new Convenio(array()); 
	$numSesion=$convenio->consultarNumeroSesion($idConEstSup)+1;
	$per=$convenio->consultarPeriodo($idConEstSup);
	$fecha_cierre=$convenio->fecha_cierre($per);
	//echo("periodo=".$per."Cierre=".$fecha_cierre);
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
<script src="scripts/funciones.js"></script>

</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Supervisor: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuSupervisor.php");?></td>		
		<td valign="top">
			<h3>Agregar Sesion de Supervision para el estudiante:<br /> <?php echo $idEstudiante.", ".$estudiante->getNombre()." ".$estudiante->getApellido() ?> </h3>
			<div align="center"><a href="index.php?id=402&periodo=<?php echo $periodo ?>"><strong>Regresar</strong></a></div>
			<form name="Formulario" method="post" enctype="multipart/form-data" action="index.php?id=406&idEstudiante=<?php echo $idEstudiante ?>&idConEstSup=<?php echo $idConEstSup ?>&periodo=<?php echo $periodo ?>">
				<table align="center" border="0">
				<tr><td align="center" colspan="2">		
				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Numero Sesion</label><input name="numSesion" type="text" value="<?php echo $numSesion ?>" readonly="true" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha</label><input name="fecha" type="text" id="fecha" onclick="cal1xx.select(document.forms[0].fecha,'fecha','yyyy-MM-dd'); return false;" readonly="true" value="<?php echo date("Y-m-d") ?>" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora Inicio</label>
				<select name="horaInicio">
				<?php
					for($i=6;$i<=22;$i++)
					{
						for($j=0;$j<=50;$j+=10)
						{
							if($j==0)
								$h=$i.":00";
							else
								$h=$i.":".$j;
							echo "<option value='".$h."'>".$h."</option>";	
						}						
					}		
				?>
				</select>				
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora Final</label>
				<select name="horaFinal">
				<?php
					for($i=6;$i<=22;$i++)
					{
						for($j=0;$j<=50;$j+=10)
						{
							if($j==0)
								$h=$i.":00";
							else
								$h=$i.":".$j;
							echo "<option value='".$h."'>".$h."</option>";	
						}						
					}		
				?>
				</select>				
				</fieldset>
				<?php if($numSesion>1) { ?>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Calificacion de Ses&iacuteon</label><input name="calificacionSesion" type="text" value="NA" readonly="true" /></fieldset>
   			    <fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Promedio 40%</label><input name="promedio40" type="text" value="<?php echo $promedio40 ?>" readonly="true" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Promedio 60%</label><input name="promedio60" type="text" value="<?php echo $promedio60 ?>" readonly="true" /></fieldset>
				<?php  	} ?>					
				</td></tr>
				<tr><td colspan="2" align="center">
				<h3>CRITERIOS DE EVALUACION</h3>	
				<strong>ASPECTOS GENERALES</strong>
 			    <fieldset><input name="facultad" type="hidden" value="<?php echo $fac ?>" readonly="true" /></fieldset>
				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Asistencia</label><input class="checkbox" type="radio" name="asistencia" checked="true" value="1" onclick="verFilas('filaAsistencia',1);verFilas('filaNoAsistencia',0);calcularCalificacion();" />SI <input class="checkbox" type="radio" name="asistencia" value="0" onclick="verFilas('filaAsistencia',0);verFilas('filaNoAsistencia',1);calcularCalificacion();" />NO</fieldset>
				</td></tr>
				<tr name="filaAsistencia" id="filaAsistencia"><td colspan="2" align="center">				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Puntualidad</label><input class="checkbox" type="radio" name="puntualidad" checked="true" value="1" />SI <input class="checkbox" type="radio" name="puntualidad" value="0" />NO</fieldset>
				</td></tr>				
				<?php if($numSesion>1) { ?>
				
				<tr name="filaAsistencia" id="filaAsistencia"><td colspan="2" align="center">				
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cumplimiento de compromisos</label>
    		    <?php
				  echo "<select name='calificacionCumplimientoCompromisos' onchange='calcularCalificacion();'><option value='-1'>NA</option>";
					for($i=0;$i<=50;$i++)
					{				  
					  echo "<option value='".$i."'>".$i."</option>";	
					  
					}		
					echo "</select>";
				?>
				</td></tr>
				<?php } ?>
				<tr name="filaAsistencia" id="filaAsistencia"><td colspan="2" align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><?php if ($convenio->consultarCronograma($idConEstSup)=="") echo "Cronograma(Excel)"; else echo "<a href='cronogramas/".$convenio->consultarCronograma($idConEstSup)."'>Cronograma Excel</a>"; ?></label><input type="file" name="cronograma"></fieldset>	
				</td></tr>
				<tr name="filaAsistencia" id="filaAsistencia"><td valign="bottom" width="300px">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Objetivos de la Sesión</label>
				<textarea name="objetivos" rows="10">Ning&uacuten objetivo registrado</textarea>
				</fieldset>				
				</td>
				<td valign="bottom" width="300px">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Bit&aacutecora de sesi&oacuten </label>(Descripción de aspectos trabajados en la sesión)
				<textarea name="bitacora" rows="10">Ningún aspecto registrado</textarea>
				</fieldset>				
				</td>
				</tr>
				<tr name="filaAsistencia" id="filaAsistencia">
				<td valign="bottom" width="300px">
				<?php if ($numSesion==1) { ?>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Compromisos para la próxima sesión</label>
				<textarea name="compromisos" rows="10">Ning&uacuten compromiso registrado</textarea>
				</fieldset>
				<?php } else { ?>
<!--				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Calificacion Aspectos</label><input class="checkbox" type="radio" name="calificacionAspectos" value="10" onclick="calcularCalificacion();" />10 <input class="checkbox" type="radio" name="calificacionAspectos" value="20" onclick="calcularCalificacion();" />20 <input class="checkbox" type="radio" name="calificacionAspectos" value="30" onclick="calcularCalificacion();" />30<br /><input class="checkbox" type="radio" name="calificacionAspectos" value="40" onclick="calcularCalificacion();" />40 <input class="checkbox" type="radio" name="calificacionAspectos" value="50" onclick="calcularCalificacion();" />50 <input class="checkbox" type="radio" name="calificacionAspectos" value="0" checked="true" onclick="calcularCalificacion();" />NA</fieldset>
-->
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Compromisos para la próxima sesión</label>
				<textarea name="compromisos" rows="10">Ningun compromiso registrado</textarea>
				</fieldset>			
				<?php } ?>
				</td>
				<td valign="bottom" width="300px">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><br>*Plan de <br>Mejoramiento</label>(Descripción de aspectos a mejorar en el desempeño del estudiante) 
				<textarea name="planMejoramiento" rows="10">Ning&uacuten plan de mejoramiento registrado</textarea>
				</fieldset>		
				</td>
				</tr>
				<tr name="filaAsistencia" id="filaAsistencia"><td valign="bottom" width="300px" colspan="2" align="center">
				<?php if ($numSesion==1) { ?>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Observaciones de la Sesi&oacuten</label>
				<textarea name="observaciones" rows="10">Ninguna observaci&oacuten registrada</textarea>
				</fieldset>
				<?php } else { ?>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Observaciones de la Sesi&oacuten</label>
				<textarea name="observaciones" rows="10">Ninguna observaci&oacuten registrada</textarea>
				</fieldset>			
				<?php } ?>
				</td>
				</tr>
				<?php if($numSesion>1) { ?>
				<tr name="filaAsistencia" id="filaAsistencia"><td align="center" colspan="2">
				<strong>ASPECTOS DEL DESARROLLO PROFESIONAL</strong><br />	
				<table border="0" width="650px">
					<tr class="titulo">
						<td align="center"><strong>Competencia</strong></td>
						<td align="center"><strong>Evaluacion de Indicadores</strong></td>
					</tr>
					<?php 
					for($i=0;$i<count($competencias);$i++)
						{
					echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' " : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par'" , ">";
						echo "<td align='center'>".$competencias[$i]."</td>";
						echo "<td>";
						echo "<table border='0'>";
						echo "<tr class='titulo'><td align='center'><strong>Indicador</strong></td><td align='center'><strong>Calificacion</strong></td></tr>";
						for($j=0;$j<count($indicadores[$i]);$j++)
							{
							echo "<tr ", ($j%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' " : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par'" , ">";
							echo "<td align='left'>".$indicadores[$i][$j]."</td>";
							echo "<td align='center'><select name='calificacionIndicador".$i.$j."' class='ancho50' onchange='calcularCalificacion();'><option value='-1'>NA</option>";
							for($k=0;$k<=50;$k++)
								{
								echo "<option value='".$k."'>".$k."</option>";
								}
							
							echo "</select></td></tr>";
							}
						echo "</table>";
						echo "</td>";
						echo "</tr>";
						}
						
					?>
				
				</table>			
				</td></tr>
				<?php } ?>
				<tr name="filaNoAsistencia" id="filaNoAsistencia" style="display:none"><td colspan="2" align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Observaciones Inasistencia</label>
				<textarea name="observacionesInasistencia" rows="10">Observaciones Inasistencia</textarea>
				</fieldset>
				</td>
				</tr>

				<tr><td align="center" colspan="2">
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();" />	
				</td></tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>