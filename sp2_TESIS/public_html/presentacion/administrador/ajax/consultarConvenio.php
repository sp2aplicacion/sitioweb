<?php
	require_once('logica/Convenio.php');		
	$nitEmpresa=$_POST['nitEmpresa'];
	$periodo=$_POST['q'];	
	if($periodo=="")
		{
		$periodo=$_POST['periodo'];			
		}
	$error=0;
	if(!empty($_GET['error']))
		$error=$_GET['error'];
	if($error==1)
		echo "<div align='center' class='error'>Error. Ya estan todos los cupos asignados</div>";
	elseif($error==2)
		echo "<div align='center' class='error'>Error. Lamentablemente, se ha completado el cupo. Por favor, intente aplicar en otro convenio</div>";		
	elseif($error==3)
		echo "<div align='center' class='error'>Error. El estudiante no existe</div>";		
	$convenio = new Convenio(array()); 
	$convenios = $convenio->consultarTodosEmpresaPeriodo($nitEmpresa,$periodo);
?>	
<table border="0" align="center">			
	<?php if (count($convenios)>0) 
	{ ?>
		<tr class="titulo">				
			<td></td>
			<td align="center"><strong>Inscribir</strong>
			<div align="center"><input type='text' id="textoConsultaLista" name='textoConsultaLista' onKeyUp="return buscadorLista(2,'')" /><input type="hidden" id="valorConsultaLista" name='valorConsultaLista' /><div id="resultadosLista" style="POSITION: absolute;"></div></div></td>
			<td align="center"><strong>Nombre</strong></td>
			<td align="center"><strong>Supervisor Interno</strong></td>
			<td align="center" nowrap><strong>Fecha Inicial<br>Fecha Final</strong></td>
			<td align="center"><strong>Cupos</strong></td>
			<td align="center"><strong>Visible<br>Firmado</strong></td>
			<td align="center"><strong>Observaciones</strong></td>
			<td align="center"><strong>Area</strong></td>
			<!--<td align="center"><strong>Actividades</strong></td>-->
		</tr>
	<?php 
		for($i=0; $i<count($convenios); $i++)
		{
		$datos[0]=$convenios[$i]->getId();
		$convenio2=new Convenio($datos);				
		//$actividades=$convenio->consultarConvenioActividad($convenios[$i]->getId());
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		echo "<td align='center' nowrap><a href='index.php?id=274&idEdit=",$convenios[$i]->getId(),"&nitEmpresa=".$nitEmpresa."'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'') onMouseout=hideddrivetip()></a> ",
		($convenio2->consultarAplicantes()==0)?"<a href=javascript:actualizar(29,'id=".$convenios[$i]->getId()."&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."') onClick=\"return confirmacion(2,'')\"><img src='img/eliminar.png' border='0' onMouseover=mensaje(12,'') onMouseout=hideddrivetip()></a> ":"","</td>";
		echo "<td align='center' nowrap><a href=javascript:insertarLista(25,'&idConvenio=".$convenios[$i]->getId()."&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."')><strong>Inscribir</strong></a><br>";
		echo "<table align='left' border='0'>";
		$estudiantes=$convenio->consultarConvenioEstudiante($convenios[$i]->getId());
		for($j=0;$j<count($estudiantes);$j++)
			{
			echo "<tr>";
			echo "<td nowrap><img src='img/info.png' border='0' onMouseover=mensaje(9,'".$estudiantes[$j][4]."_".$estudiantes[$j][5].".",($estudiantes[$j][1]==0)?"Estado:".$estudiantes[$j][0]->estados[$estudiantes[$j][0]->getEstado()]: "","') onMouseout=hideddrivetip()>",
			($estudiantes[$j][1]==0)?" <a href=javascript:actualizar(28,'id=".$convenios[$i]->getId()."&idEstudiante=".$estudiantes[$j][0]->getCodigo()."&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."') onClick=\"return confirmacion(1,'".$estudiantes[$j][0]->getCodigo()."')\"><img src='img/eliminar.png' border='0' onMouseover=mensaje(11,'".$convenios[$i]->getId()."') onMouseout=hideddrivetip() /></a>":"","</td>			
			<td>".$estudiantes[$j][0]->getCodigo().", ".$estudiantes[$j][0]->getNombre()." ".$estudiantes[$j][0]->getApellido(),
			"</td>";
			if($estudiantes[$j][1]==0)
				echo "<td nowrap><a href=javascript:actualizar(24,'id=".$convenios[$i]->getId()."&idEstudiante=".$estudiantes[$j][0]->getCodigo()."&estado=1&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."')><img src='img/ok.png' border='0' onMouseover=mensaje(6,'".$estudiantes[$j][0]->getCodigo()."') onMouseout=hideddrivetip()></a> <a href=javascript:actualizar(24,'id=".$convenios[$i]->getId()."&idEstudiante=".$estudiantes[$j][0]->getCodigo()."&estado=2&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."')><img src='img/error.png' border='0' onMouseover=mensaje(7,'".$estudiantes[$j][0]->getCodigo()."') onMouseout=hideddrivetip()></a></td>";
			else
				{
				echo "<td nowrap class='", ($estudiantes[$j][1]==1)?"aceptado":"rechazado" ,"'><img src='img/info.png' border='0' onMouseover=mensaje(8,'".$estudiantes[$j][2]."_".$estudiantes[$j][3]."') onMouseout=hideddrivetip()> ".$convenio->estados[$estudiantes[$j][1]]."</td>";
				$supervisor=$convenio2->consultarSupervisorAsignado($estudiantes[$j][0]->getCodigo());
				if($supervisor=="")
					{
					echo "<td><a href=javascript:actualizar(24,'id=".$convenios[$i]->getId()."&idEstudiante=".$estudiantes[$j][0]->getCodigo()."&estado=0&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."')><img src='img/cancelar.png' border='0' onMouseover=mensaje(10,'".$estudiantes[$j][0]->getCodigo()."') onMouseout=hideddrivetip()></a></td>";					
					}
				else 
					{
					echo "<td><img src='img/supervisor.png' border='0' onMouseover=mensaje(13,'".$supervisor."') onMouseout=hideddrivetip()></td>";						
					}
				}
			echo "</tr>";
			}
		echo "</table>";
		
		echo "</td>";
		echo "<td>",$convenios[$i]->getNombre(),"</td>
		<td>",$convenios[$i]->getSupervisor(),"</td>
		<td>",$convenios[$i]->getFechaInicial(),"<br>",$convenios[$i]->getFechaFinal(),"</td>
		<td align='center' nowrap>Ofrecidos: ",$convenios[$i]->getCuposOfrecidos(),"<br>Asignados: ",$convenios[$i]->getCuposAsignados(),"<br>Aplicantes: ".$convenio2->consultarAplicantes()."</td>";
		echo "<td align='center'>",($convenios[$i]->getVisible()==1)? "<a href=javascript:actualizar(21,'id=".$convenios[$i]->getId()."&visible=0&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."')><img src='img/visibleizq.gif' border='0' onMouseover=mensaje(2,'') onMouseout=hideddrivetip()><img src='img/visibleder.gif' border='0' onMouseover=mensaje(2,'') onMouseout=hideddrivetip()></a>":"<a href=javascript:actualizar(21,'id=".$convenios[$i]->getId()."&visible=1&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."')><img src='img/novisibleizq.gif' border='0' onMouseover=mensaje(3,'') onMouseout=hideddrivetip()><img src='img/novisibleder.gif' border='0' onMouseover=mensaje(3,'') onMouseout=hideddrivetip()></a>","<br><br>",
		($convenios[$i]->getFirmado()==1)?"<a href=javascript:actualizar(22,'id=".$convenios[$i]->getId()."&firmado=0&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."')><img src='img/ok.png' border='0' onMouseover=mensaje(4,'') onMouseout=hideddrivetip()></a>":"<a href=javascript:actualizar(22,'id=".$convenios[$i]->getId()."&firmado=1&nitEmpresa=".$nitEmpresa."&periodo=".$periodo."')><img src='img/error.png' border='0' onMouseover=mensaje(5,'') onMouseout=hideddrivetip()></a>","</td>";
		echo "<td align='center'>",$convenios[$i]->getObservaciones(),"</td>";
		echo "<td align='center'>",$convenios[$i]->getArea(),"</td><td nowrap>";
		/*for($j=0;$j<count($actividades);$j++)
			echo $actividades[$j]->getNombre()."<br>";*/
		echo "</td>";
		echo "</tr>";

			
		}

		echo "<tr><td colspan='10'><strong>".count($convenios)." registros encontrados<strong></td></tr>";
	}
	?>
</table>	  