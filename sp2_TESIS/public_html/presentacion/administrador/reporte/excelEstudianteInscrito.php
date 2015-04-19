<?php
	require_once('logica/Reporte.php');		
	require_once('logica/Convenio.php');		
	require_once('logica/Area.php');		
	$convenio=new Convenio(array());
	$idArea=$_GET['idArea'];
	$periodo=$_GET['periodo'];
	$estado=$_GET['estado'];
	$datos = array();
	$datos[0]=$idArea;
	$area = new Area($datos);
	$area->consultar();	
	$reporte = new Reporte(); 
	$reportes = $reporte->estudiantesInscritosPeriodo($idArea,$periodo,$estado);
	header("Content-type: application/vnd.ms-excel.xls");
	header("Content-Disposition: attachment; filename=Reporte_Estudiante_Inscrito_".str_replace(" ","_",$area->getNombre())."_".$periodo.".xls");

	echo "<table border='1' align='center'>			
	<tr class='titulo'>				
		<td align='center'><strong>Codigo</strong></a></td>
		<td align='center'><strong>Cedula</strong></a></td>
		<td align='center'><strong>Nombre</strong></a></td>
		<td align='center'><strong>Apellido</strong></a></td>
		<td align='center'><strong>NIT Entidad</strong></a></td>
		<td align='center'><strong>Entidad</strong></a></td>
		<td align='center'><strong>Convenio</strong></a></td>
		<td align='center'><strong>Fecha Aplicacion</strong></a></td>
		<td align='center'><strong>Fecha Modificacion Estado</strong></a></td>
		<td align='center'><strong>Estado</strong></a></td>
	</tr>";
	for($i=0; $i<count($reportes); $i++)
		{
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		echo "<td>",$reportes[$i][1][0],"</td><td>",$reportes[$i][1][1],"</td><td>",$reportes[$i][1][2],"</td><td>",$reportes[$i][1][3],"</td><td>",$reportes[$i][2][0],"</td><td>",$reportes[$i][2][1],"</td><td>",$reportes[$i][0][7],"</td><td>",$reportes[$i][0][1]," ".$reportes[$i][0][2]."</td><td>",$reportes[$i][0][3]," ".$reportes[$i][0][4]."</td><td>",$convenio->estados[$reportes[$i][0][5]],"</td>";			
		echo "</tr>";					
		if($reportes[$i][0][5]==0)
			$numInscritos+=1;
		elseif($reportes[$i][0][5]==1)
			$numAceptados+=1;
		elseif($reportes[$i][0][5]==2)
			$numRechazados+=1;
		}
	echo "<tr><td colspan='10'><strong>".count($reportes)." registros encontrados<strong></td></tr>";
	echo "</table>";

	   

