<?php
	require_once('logica/Estudiante.php');		
	require_once('logica/Reporte.php');		
	require_once('logica/Convenio.php');		
	$estudiante = new Estudiante(array()); 
	$q=$_GET['q'];
	if($q=="*")
		$estudiantes=$estudiante->consultarTodos("estudiante.apellido");	
	else if($q!="")
		$estudiantes=$estudiante->buscar($q,"estudiante.apellido");
	$reporte=new Reporte();
	$convenio=new Convenio(array());

	header("Content-type: application/vnd.ms-excel.xls");
	header("Content-Disposition: attachment; filename=Reporte_Historial_Estudiante.xls");
	echo "<table border='1' align='center'>			
	<tr class='titulo'>				
		<td align='center'><strong>Codigo</strong></td>
		<td align='center'><strong>Cedula</strong></td>
		<td align='center'><strong>Nombre</strong></td>
		<td align='center'><strong>Apellido</strong></td>
		<td align='center'><strong>Convenios</strong></td>
	</tr>";
	for($i=0; $i<count($estudiantes); $i++)
		{		
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		echo "<td align='center' nowrap>",$estudiantes[$i]->getCodigo(),"</td>
		<td>",$estudiantes[$i]->getCedula(),"</td>
		<td>",$estudiantes[$i]->getNombre(),"</td>
		<td>",$estudiantes[$i]->getApellido(),"</td>";
		$reportes=$reporte->estudianteInscrito($estudiantes[$i]->getCodigo());
		if(count($reportes)!=0)
			{
			echo "<td><table border='1' cellspacing='0'>";
			echo "<tr><td align='center' width='100'><strong>NIT</strong></td><td align='center' width='200'><strong>Entidad</strong></td><td align='center' width='200'><strong>Convenio</strong></td><td align='center' width='100'><strong>Area</strong></td><td align='center' width='200'><strong>Fecha Inscripcion</strong></td><td align='center' width='80'><strong>Estado</strong></td></tr>";
			for($j=0; $j<count($reportes); $j++)
				{
				echo "<tr>";
				echo "<td>",$reportes[$j][1][0],"</td><td>",$reportes[$j][1][1],"</td><td>",$reportes[$j][0][0],"</td><td>",$reportes[$j][2][1],"</td><td>",$reportes[$j][0][3]," ".$reportes[$j][0][4]."</td><td>",$convenio->estados[$reportes[$j][0][5]],"</td>";			
				echo "</tr>";					
				}
			echo "</table></td>";		
			}
		else
			echo "<td></td>";
		echo "</tr>\n";					
		}
	echo "<tr><td colspan='10'><strong>".count($estudiantes)." registros encontrados<strong></td></tr>";
	echo "</table>";
	?>	  
	   

