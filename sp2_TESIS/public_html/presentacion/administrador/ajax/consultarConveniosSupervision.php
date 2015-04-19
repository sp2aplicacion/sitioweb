<?php
	require_once('logica/Convenio.php');		
	$convenio=new Convenio(array());
	$area=$_POST['area'];
	$q=$_POST['q'];
	$convenio = new Convenio(array()); 
	$convenios = $convenio->consultarEstudiantesInscritosPeriodo($area,$q);
	$cronograma="";
	//echo(count($convenio));
?>
<?php if (count($convenio)>0) { ?>
<table border="0" align="center">			
	<tr class="titulo">				
		<td align="center"><strong>Horario</strong></a></td>
		<td align="center"><strong>Servicios</strong></a></td>
		<td align="center"><strong>Promedio 40%</strong></a></td>
		<td align="center"><strong>Promedio 60%</strong></a></td>
		<td align="center"><strong>Cronograma</strong></a></td>
		<td align="center"><strong>Codigo</strong></a></td>
		<td align="center"><strong>Cedula</strong></a></td>
		<td align="center"><strong>Estudiante</strong></a></td>
		<td align="center"><strong>NIT Entidad</strong></a></td>
		<td align="center"><strong>Entidad</strong></a></td>
		<td align="center"><strong>Convenio</strong></a></td>
		<td align="center"><strong>Supervisor</strong></a></td>
	</tr>
	<?php
	for($i=0; $i<count($convenios); $i++)
		{
		if($convenios[$i][3][0]!="")
			{
			echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
			$horarios=$convenio->consultarHorarioSupervision($convenios[$i][3][3]);
			$cronograma=$convenio->consultarCronograma($convenios[$i][3][3]);
			$per=$convenio->consultarPeriodo($convenios[$i][3][3]);
	        $fecha_cierre=$convenio->fecha_cierre($per);
			$promedio40=$convenio->nota40($convenios[$i][3][3],$fecha_cierre);
	        $promedio60=$convenio->nota60($convenios[$i][3][3],$fecha_cierre);
			echo "
			<td align='center' nowrap>";
			for($j=0; $j<count($horarios); $j++)
				{
				echo $dias[$horarios[$j][1]]." ",substr($horarios[$j][2],0,5),"-",substr($horarios[$j][3],0,5)," ",($horarios[$j][4]==0)?"P":(($horarios[$j][4]==1)?"I":"G"),"<br />";
				}
			echo "</td>";
			echo "<td align='center'><strong>Estudiante</strong><br /><a href=javascript:abrir('index.php?id=292&idConEstSup=".$convenios[$i][3][3]."&idEstudiante=".$convenios[$i][1][0]."')><img src='img/consultar.png' border='0' onMouseover=mensaje(1,'') onMouseout=hideddrivetip()></a><hr /><strong>Supervisor</strong><br/><a href=javascript:abrir('index.php?id=293&idConEstSup=".$convenios[$i][3][3]."')><img src='img/quincenal.png' border='0' onMouseover=mensaje(2,'') onMouseout=hideddrivetip()></a>|<a href=javascript:abrir('index.php?id=294&idConEstSup=".$convenios[$i][3][3]."')><img src='img/consultar.png' border='0' onMouseover=mensaje(3,'') onMouseout=hideddrivetip()></a></td><td align='center'>".$promedio40."</td><td align='center'>".$promedio60."</td>";
			if($cronograma=="")
			{
   			   echo "<td>Ning&uacuten Cronograma</td>";
			}
			else
			{
			  echo "<td><a href='cronogramas/".$cronograma."'>cronograma</a></td>";
			}
			echo "<td>",$convenios[$i][1][0],"</td><td>",$convenios[$i][1][1],"</td><td>",$convenios[$i][1][2]," ",$convenios[$i][1][3],"</td><td>",$convenios[$i][2][0],"</td><td>",$convenios[$i][2][1],"</td><td>",$convenios[$i][0][2],"</td><td>".$convenios[$i][3][1]." ".$convenios[$i][3][2]."</td>";			
			echo "</tr>";									
			}
		}
	echo "<tr><td colspan='10'><strong>".count($convenios)." registros encontrados<strong></td></tr>";
	}
	?>	  
</table>  