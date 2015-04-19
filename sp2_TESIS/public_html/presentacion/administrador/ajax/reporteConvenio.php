<?php
	require_once('logica/Reporte.php');		
	require_once('logica/Convenio.php');		
	$convenio=new Convenio(array());
	$q=$_POST['q'];
	$periodo=$_POST['periodo'];
	$firmado=$_POST['firmado'];
	$reporte = new Reporte(); 
	$reportes = $reporte->conveniosPeriodo($q,$periodo,$firmado);
?>
<?php if (count($reportes)>0) { ?>
<div align="center"><input type="button" value="Generar Excel" onClick="abrir('index.php?id=801&idArea=<?php echo $q; ?>&periodo=<?php echo $periodo ?>&firmado=<?php echo $firmado ?>', 'Excel');" /></div>
<table border="0" align="center">			
	<tr class="titulo">				
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Fecha Inicial</strong></td>
		<td align="center"><strong>Fecha Final</strong></td>
		<td align="center"><strong>Cupos</strong></td>
		<td align="center"><strong>Visible</strong></td>
		<td align="center"><strong>Firmado</strong></td>
		<td align="center"><strong>NIT Entidad</strong></td>
		<td align="center"><strong>Entidad</strong></td>
	</tr>
	<?php
	$numCuposOfrecidos=0;
	$numCuposAsignados=0;
	$numVisibles=0;
	$numFirmados=0;
	$numInscripcionesDisponibles=0;
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
	echo "<tr><td colspan='10'><strong>".count($reportes)." registros encontrados<strong></td></tr>";		
	echo "</table>";	
	echo "<div class='resumen'><strong>RESUMEN:</strong><br>Cupos Ofrecidos: ".$numCuposOfrecidos."<br>Cupos Asignados: ".$numCuposAsignados."<br>Cupos Disponibles: ",$numCuposOfrecidos-$numCuposAsignados,"<br>Visibles: ".$numVisibles."<br>Firmados: ".$numFirmados."</div>";
	}
	?>	   
</table>