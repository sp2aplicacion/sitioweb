<?php
	require_once('logica/Reporte.php');		
	require_once('logica/Empresa.php');		
	require_once('logica/Convenio.php');		
	$convenio=new Convenio(array());
	$q=$_POST['q'];
	if($q!=-1)
		{
		$empresa = new Empresa(array());
		$empresas = $empresa->consultarTodos("nombre");
?>
<div align="center"><input type="button" value="Generar Excel" onClick="abrir('index.php?id=804&periodo=<?php echo $q ?>', 'Excel');" /></div>
<table border="0" align="center">			
	<tr class="titulo">				
		<td align="center"><strong>NIT</strong></td>
		<td align="center"><strong>Nombre Entidad</strong></td>
		<td align="center"><strong>Convenios</strong></td>		
	</tr>
	<?php
	for($i=0; $i<count($empresas); $i++)
		{
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		echo "<td>",$empresas[$i]->getNit(),"</td><td>",$empresas[$i]->getNombre(),"</td>";
		echo "<td>";
		$reporte = new Reporte(); 
		$reporteConvenios = $reporte->conveniosPeriodoEmpresa($q,$empresas[$i]->getNit());
		
		if(count($reporteConvenios)>0)
		{
			echo "<table border='1' cellspacing='0'>";
			echo "<tr><td align='center'><strong>Nombre</strong></td><td align='center'><strong>Cupos</strong></td><td align='center'><strong>Visible</strong></td><td align='center'><strong>Firmado</strong></td><td align='center'><strong>Area</strong></td><td align='center'><strong>Estudiantes</strong></td></tr>";
			for($j=0; $j<count($reporteConvenios); $j++)
				{
				echo "<tr>";
				echo "<td>".$reporteConvenios[$j][7]."</td><td nowrap>Ofrecidos: ".$reporteConvenios[$j][3]."<br>Asignados: ".$reporteConvenios[$j][4]."</td><td align='center'>",($reporteConvenios[$i][5]==0)?"NO":"SI","</td><td align='center'>",($reporteConvenios[$i][6]==0)?"NO":"SI","</td><td align='center'>",$reporteConvenios[$j][8],"</td>";
				echo "<td>";
				
				$reporteEstudiantes = $reporte->estudianteConvenio($reporteConvenios[$j][0]);
				if(count($reporteEstudiantes)>0)
					{
					echo "<table border='1' cellspacing='0'>";
					echo "<tr><td align='center'><strong>Codigo</strong></td><td align='center'><strong>Cedula</strong></td><td align='center'><strong>Nombre</strong></td><td align='center'><strong>Apellido</strong></td><td align='center'><strong>Fecha Insc.</strong></td><td align='center'><strong>Estado</strong></td></tr>";
					for($k=0; $k<count($reporteEstudiantes); $k++)
						{
						echo "<tr>";
						echo "<td>".$reporteEstudiantes[$k][0]."</td><td>".$reporteEstudiantes[$k][1]."</td><td>".$reporteEstudiantes[$k][2]."</td><td>".$reporteEstudiantes[$k][3]."</td><td>".$reporteEstudiantes[$k][4]."<br>".$reporteEstudiantes[$k][5]."</td><td>".$convenio->estados[$reporteEstudiantes[$k][6]]."</td>";
						echo "</tr>";						
						}
					echo "</table>";
					}
				echo "</td>";
				echo "</tr>";
				}
			echo "</table>";
		}
		echo "</td>";
		echo "</tr>";		
		}
	echo "<tr><td colspan='10'><strong>".count($empresas)." registros encontrados<strong></td></tr>";
	}
	?>		
</table>