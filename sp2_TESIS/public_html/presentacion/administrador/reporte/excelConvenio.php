<?php
	require_once('logica/Reporte.php');		
	require_once('logica/Convenio.php');		
	require_once('logica/Area.php');		
	$convenio=new Convenio(array());
	$idArea=$_GET['idArea'];
	$periodo=$_GET['periodo'];
	$datos = array();
	$datos[0]=$idArea;
	$area = new Area($datos);
	$area->consultar();
	$reporte = new Reporte(); 
	$reportes = $reporte->conveniosPeriodo($idArea,$periodo);
	header("Content-type: application/vnd.ms-excel.xls");
	header("Content-Disposition: attachment; filename=Reporte_Convenio_".str_replace(" ","_",$area->getNombre())."_".$periodo.".xls");

	echo "<table border='1' align='center'>			
		<tr class='titulo'>				
		<td align='center'><strong>Nombre</strong></a></td>
		<td align='center'><strong>Fecha Inicial</strong></a></td>
		<td align='center'><strong>Fecha Final</strong></a></td>
		<td align='center'><strong>Cupos</strong></a></td>
		<td align='center'><strong>Visible</strong></a></td>
		<td align='center'><strong>Firmado</strong></a></td>
		<td align='center'><strong>NIT Entidad</strong></a></td>
		<td align='center'><strong>Entidad</strong></a></td>
		</tr>";

	for($i=0; $i<count($reportes); $i++)
		{
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		echo "<td>",$reportes[$i][6],"</td><td>",$reportes[$i][0],"</td><td>",$reportes[$i][1],"</td><td nowrap>Ofrecidos: ",$reportes[$i][2],"<br>Asignados: ",$reportes[$i][3],"</td><td align='center'>",($reportes[$i][4]==0)?"NO":"SI","</td><td align='center'>",($reportes[$i][5]==0)?"NO":"SI","</td><td>",$reportes[$i][7],"</td><td>",$reportes[$i][8],"</td>";			
		echo "</tr>";					
		$numCuposOfrecidos+=$reportes[$i][2];
		$numCuposAsignados+=$reportes[$i][3];
		$numVisibles+=$reportes[$i][4];
		$numFirmados+=$reportes[$i][5];		
		}
	echo "<tr><td colspan='8'><strong>".count($reportes)." registros encontrados<strong></td></tr>";		
	echo "</table>";	
	?>	   

