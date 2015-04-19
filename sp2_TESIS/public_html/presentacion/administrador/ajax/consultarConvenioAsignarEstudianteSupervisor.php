<?php
	require_once('logica/Reporte.php');		
	require_once('logica/Convenio.php');		
	$convenio=new Convenio(array());
	$q=$_POST['q'];
	$periodo=$_POST['periodo'];
	$convenio = new Convenio(array()); 
	$convenios = $convenio->conveniosPeriodo($q,$periodo);
	$idSupervisor=$_POST['idSupervisor'];
	//$reportes = $reporte->estudiantesInscritos($q);
?>
<table border="0" align="center">			
	<?php if (count($convenios)>0) { ?>
	<tr class="titulo">				
		<td align="center"><strong>Estudiantes</strong></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Fecha Inicial</strong></td>
		<td align="center"><strong>Fecha Final</strong></td>
		<td align="center"><strong>Entidad</strong></td>
	</tr>
	<?php
	for($i=0; $i<count($convenios); $i++)
		{
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		echo "<td nowrap>";
		echo "<table border='0'>";
		$estudiantes=$convenio->consultarConvenioEstudiante($convenios[$i]->getId());
		for($j=0; $j<count($estudiantes); $j++)
			{
			if($estudiantes[$j][1]==1)
				{
				echo "<tr><td><img src='img/info.png' border='0' onMouseover=mensaje(1,'".$estudiantes[$j][4]."_".$estudiantes[$j][5].".",($estudiantes[$j][1]==0)?"Estado:".$estudiantes[$j][0]->estados[$estudiantes[$j][0]->getEstado()]: "","') onMouseout=hideddrivetip()> ".$estudiantes[$j][0]->getCodigo()." ".$estudiantes[$j][0]->getNombre()." ".$estudiantes[$j][0]->getApellido()."</td>";
					
				if(($sup=$convenio->consultarConvenioEstudianteSupervisor($convenios[$i]->getId(),$estudiantes[$j][0]->getCodigo()))!="")
					{
					echo "<td><a href=javascript:actualizar(43,'idConvenio=".$convenios[$i]->getId()."&idEstudiante=".$estudiantes[$j][0]->getCodigo()."&idSupervisor=".$idSupervisor."&q=".$q."&periodo=".$periodo."')><img src='img/cancelar.png' border='0' onMouseover=mensaje(3,'".$idSupervisor."') onMouseout=hideddrivetip()></a> Asignado a: ".$sup."</td>";
					}
				else
					{
					echo "<td><a href=javascript:actualizar(42,'idConvenio=".$convenios[$i]->getId()."&idEstudiante=".$estudiantes[$j][0]->getCodigo()."&idSupervisor=".$idSupervisor."&q=".$q."&periodo=".$periodo."')><img src='img/ok.png' border='0' onMouseover=mensaje(2,'".$idSupervisor."') onMouseout=hideddrivetip()></a></td>";
					}
				}						
			}				
		echo "</table>";
		echo "</td>";
		echo "<td>",$convenios[$i]->getNombre(),"</td><td>",$convenios[$i]->getFechaInicial(),"</td><td>",$convenios[$i]->getFechaFinal(),"</td><td>",$convenios[$i]->getPeriodo(),"</td>";			
		echo "</tr>";					
		}
	echo "<tr><td colspan='10'><strong>".count($convenios)." registros encontrados<strong></td></tr>";		
	}
	?>	  
</table>
