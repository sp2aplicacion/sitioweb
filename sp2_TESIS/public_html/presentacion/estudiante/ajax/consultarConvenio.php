<?php
	$rol=$_GET['rol'];
	$nitEmpresa=$_GET['nitEmpresa'];
	$idEstudiante=$_GET['idEstudiante'];
	$error=0;
	if(!empty($_GET['error']))
		$error=$_GET['error'];
	if($error==1)
		echo "<div align='center' class='error'>Error. Lamentablemente, se ha completado el cupo. Por favor, intente aplicar en otro convenio</div>";
?>
	<table border="0" align="center">			
		<tr class="titulo">				
			<td align="center"><strong>Nombre</strong></td>
			<td align="center"><strong>Fecha Inicial</strong></td>
			<td align="center"><strong>Fecha Final</strong></td>
			<td align="center"><strong>Periodo</strong></td>
			<td align="center"><strong>Cupos</strong></td>
			<td align="center"><strong>Area</strong></td>
			<td align="center"><strong>Actividades</strong></td>
			<td align="center"><strong>Inscribir</strong></td>
			</tr>
		<?php 
		
		$convenio = new Convenio(array()); 
		$convenios = $convenio->consultarTodosEmpresa($nitEmpresa);
		$cuenta=0;
		for($i=0; $i<count($convenios); $i++)
			{
			if($convenios[$i]->getVisible()==1)
				{
				$datos[0]=$convenios[$i]->getId();
				$convenio2=new Convenio($datos);
				$actividades=$convenio->consultarConvenioActividad($convenios[$i]->getId());
				echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
				echo "<td>",$convenios[$i]->getNombre(),"</td>
				<td>",$convenios[$i]->getFechaInicial(),"</td>
				<td>",$convenios[$i]->getFechaFinal(),"</td>
				<td>",$convenios[$i]->getPeriodo(),"</td>
				<td align='center'>Ofrecidos: ",$convenios[$i]->getCuposOfrecidos(),"<br>Asignados: ",$convenios[$i]->getCuposAsignados(),"<br>Aplicantes: ".$convenio2->consultarAplicantes()."</td>";
				echo "<td align='center'>",$convenios[$i]->getArea(),"</td><td>";
				for($j=0;$j<count($actividades);$j++)
					echo $actividades[$j]->getNombre()."<br>";
				echo "</td>";
				$estadoEstudiante=$convenio2->consultarEstadoEstudiante($idEstudiante);
				$estadoEstudianteConvenio=$convenio2->consultarEstadoEstudianteConvenio($idEstudiante);
				if($estadoEstudiante==2||$estadoEstudiante==5||$estadoEstudiante==8||$estadoEstudiante==11)
					{
					if($estadoEstudianteConvenio!="")
						{
						echo "<td class='", ($estadoEstudianteConvenio=="1")?"aceptado":"rechazado" ,"'>".$convenio2->estados[$estadoEstudianteConvenio]."</td>";						
						}
					else
						{
						if($convenio2->consultarAplicantes()<$convenios[$i]->getCuposOfrecidos()*3)
							{
							echo "<td><a href=javascript:insertar(23,'&idConvenio=".$convenios[$i]->getId()."&idEstudiante=".$idEstudiante."&nitEmpresa=".$nitEmpresa."') onClick=\"return confirmacion('".$convenios[$i]->getArea()."')\">Inscribir</a></td>";										
							}
						else
							echo "<td>Cupo completado</td>";
						}
					}
				else
					{
					echo "<td class='", ($estadoEstudianteConvenio=="1")?"aceptado":"" ,"'>".$convenio2->estados[$estadoEstudianteConvenio]."</td>";
					}				
				echo "</tr>";
				$cuenta++;
				}
			}
		echo "<tr><td colspan='10'><strong>".$cuenta." registros encontrados<strong></td></tr>";
		?>	  
	</table>		   