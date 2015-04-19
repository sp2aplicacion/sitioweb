<?php 
	require_once('logica/Convenio.php');	
	require_once('logica/Empresa.php');	
	require_once('logica/Area.php');	
	$idSupervisor=$_POST['idSupervisor'];
	$periodo=$_POST['q'];	
	if($periodo=="")
		{
		$periodo=$_POST['periodo'];			
		}
	$dias=array("Lu","Ma","Mi","Ju","Vi","Sa");
?>
			<table border="0" align="center">			
				<tr class="titulo">				
					<td align="center"><strong>Horario</strong></td>
					<td align="center"><strong>Servicios</strong></td>
					<td align="center"><strong>Codigo</strong></td>
					<td align="center"><strong>Cedula</strong></td>
					<td align="center"><strong>Nombre</strong></td>
					<td align="center"><strong>Apellido</strong></td>
					<td align="center"><strong>Correo</strong></td>
					<td align="center"><strong>Telefono</strong></td>
					<td align="center"><strong>Celular</strong></td>
					<td align="center"><strong>HV</strong></td>
					<td align="center"><strong>Convenio</strong></td>
					<td align="center"><strong>Entidad</strong></td>
					<td align="center"><strong>Area</strong></td>
				</tr>
				<?php 
				$convenio = new Convenio(array()); 
				$estudiantes=$convenio->consultarEstudiantesAsignadosSupervisor($idSupervisor,$periodo);
				$per=$convenio->consultarPeriodo($estudiantes[0][8]);
	            $fecha_cierre=$convenio->fecha_cierre($per);
				if($fecha_cierre=="")
                   $fecha_cierre="NO Determinado";				
				echo("<h3>Cierre del 40: ".$fecha_cierre."</h3>");
				for($i=0; $i<count($estudiantes); $i++)
					{
					echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
					$horarios=$convenio->consultarHorarioSupervision($estudiantes[$i][8]);
					echo "
					<td align='center' nowrap><a href='index.php?id=403&idEstudiante=",$estudiantes[$i][0],"&idConEstSup=".$estudiantes[$i][8]."&periodo=".$periodo."'><img src='img/registrarhorario.png' border='0' onMouseover=mensaje(1,'".str_replace(" ","_",$estudiantes[$i][0])."') onMouseout=hideddrivetip()></a><br />";
					for($j=0; $j<count($horarios); $j++)
						{
						echo $dias[$horarios[$j][1]]." ",substr($horarios[$j][2],0,5),"-",substr($horarios[$j][3],0,5)," ",($horarios[$j][4]==0)?"P":(($horarios[$j][4]==1)?"I":"G"),"<br />";
						}
					echo "</td>";
					echo "<td align='center' nowrap><strong>Supervisor</strong><br /><a href='index.php?id=404&idEstudiante=",$estudiantes[$i][0],"&idConEstSup=".$estudiantes[$i][8]."&periodo=".$periodo."'><img src='img/quincenal.png' border='0' onMouseover=mensaje(2,'".str_replace(" ","_",$estudiantes[$i][0])."') onMouseout=hideddrivetip()></a>|<a href='index.php?id=405&idEstudiante=",$estudiantes[$i][0],"&idConEstSup=".$estudiantes[$i][8]."&periodo=".$periodo."'><img src='img/sesion.png' border='0' onMouseover=mensaje(3,'".str_replace(" ","_",$estudiantes[$i][0])."') onMouseout=hideddrivetip()></a>|<a href='index.php?id=407&idEstudiante=",$estudiantes[$i][0],"&idConEstSup=".$estudiantes[$i][8]."&periodo=".$periodo."'><img src='img/consultar.png' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$estudiantes[$i][0])."') onMouseout=hideddrivetip()></a><hr /><strong>Estudiante</strong><br /><a href='index.php?id=408&idEstudiante=",$estudiantes[$i][0],"&idConEstSup=".$estudiantes[$i][8]."&periodo=".$periodo."'><img src='img/consultar.png' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$estudiantes[$i][0])."') onMouseout=hideddrivetip()></a></td>";					
					echo "<td align='center'>",$estudiantes[$i][0],"</td>
					<td align='center'>",$estudiantes[$i][1],"</td>
					<td align='center'>",$estudiantes[$i][2],"</td>
					<td align='center'>",$estudiantes[$i][3],"</td>
					<td align='center'>",$estudiantes[$i][4],"</td>
					<td align='center'>",$estudiantes[$i][5],"</td>
					<td align='center'>",$estudiantes[$i][6],"</td>
					<td align='center'>",($estudiantes[$i][7]!="")?"<a href='archivos/".$estudiantes[$i][7]."' target='_blank'><strong>Ver</strong></a>":"","</td>
					<td align='center'>",$estudiantes[$i][10],"</td>";					
					$empresa=new Empresa(array($estudiantes[$i][12]));
					$empresa->consultar();
					echo "<td align='center'>",$empresa->getNombre(),"</td>";
					$area=new Area(array($estudiantes[$i][13]));
					$area->consultar();
					echo "<td align='center'>",$area->getNombre(),"</td>";
					}
				echo "<tr><td colspan='10'><strong>".count($estudiantes)." registros encontrados<strong></td></tr>";
				?>	  
			</table>		   

	
