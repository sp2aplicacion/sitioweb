<?php
	require_once('logica/Reporte.php');		
	require_once('logica/Convenio.php');		
	$convenio=new Convenio(array());
	$q=$_POST['q'];
	$periodo=$_POST['periodo'];
	$estado=$_POST['estado'];
	$reporte = new Reporte(); 
	$reportes = $reporte->estudiantesInscritosPeriodo($q,$periodo,$estado);
?>
<?php if (count($reportes)>0) { ?>
<div align="center"><input type="button" value="Generar Excel" onClick="abrir('index.php?id=802&idArea=<?php echo $q; ?>&periodo=<?php echo $periodo ?>&estado=<?php echo $estado ?>', 'Excel');" /></div>
<table border="0" align="center">			
	<tr class="titulo">				
		<td align="center"><strong>Codigo</strong></td>
		<td align="center"><strong>Cedula</strong></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Apellido</strong></td>
		<td align="center"><strong>NIT Entidad</strong></td>
		<td align="center"><strong>Entidad</strong></td>
		<td align="center"><strong>Convenio</strong></td>
		<td align="center"><strong>Fecha Aplicacion</strong></td>
		<td align="center"><strong>Fecha Modificacion Estado</strong></td>
		<td align="center"><strong>Estado</strong></td>
	</tr>
	<?php
	$numInscritos=0;
	$numAceptados=0;
	$numRechazados=0;
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
	?>	  
</table>
	<?php
	echo "<div class='resumen'><strong>RESUMEN:</strong><br>Estudiantes Inscritos: ".$numInscritos."<br>Estudiantes Aceptados: ".$numAceptados."<br>Estudiantes Rechazados: ".$numRechazados."</div>";
	}
	?>	   

	   

