<?php
	require_once('logica/Area.php');	
	require_once('logica/Programa.php');		
	$area = new Area(array()); 
	$q=$_POST['q'];
	if($q =="*")
		$areas=$area->consultarTodos("area.nombre");	
	else if($q!="")
		$areas=$area->buscar($q,"area.nombre");
	$cuenta=0;

?>
<table border="0" align="center">			
	<?php if (count($areas)>0) { ?>
	<tr class="titulo">				
		
		<td align="center"><strong>Servicios</strong></td>
		<td align="center"><strong>ID</strong></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Responsable</strong></td>
		<td align="center"><strong>Programa</strong></td>
		
	</tr>
	<?php
	$nom_programa = "";
	$programa = new Programa(array());
	$programas = $programa->consultarTodos("programa.nombre");

	
	
	for($i=0; $i<count($areas); $i++)
		{	
			for ($j=0; $j < count($programas) ; $j++) 
			{ 
				if($areas[$i]->getPrograma() == $programas[$j]->getId())
				{
					$nom_programa = $programas[$j]->getNombre();
				}
					
			}	
		        echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
	  			echo "<td align='center' nowrap><a href='index.php?id=254&idEdit=".$areas[$i]->getId()."'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'".str_replace(" ","_",$areas[$i]->getId())."') onMouseout=hideddrivetip()></a>",
			  		 "<a href=javascript:actualizar(71,'id=".$areas[$i]->getId()."&q=".str_replace(" ","%20",$q)."') onClick=\"return confirmacion('".$areas[$i]->getId()."')\"><img src='img/eliminar.png' border='0' onMouseover=mensaje(6,'".str_replace(" ","_",$areas[$i]->getId())."') onMouseout=hideddrivetip()></a>",
			  		 "<hr>",($areas[$i]->getVisible()==1)?"<a href=javascript:actualizar(72,'id=".$areas[$i]->getId()."&visible=0&q=".str_replace(" ","%20",$q)."')><img src='img/visibleizq.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$areas[$i]->getId())."') onMouseout=hideddrivetip()><img src='img/visibleder.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$areas[$i]->getId())."') onMouseout=hideddrivetip()></a>":"<a href=javascript:actualizar(72,'id=".$areas[$i]->getId()."&visible=1&q=".str_replace(" ","%20",$q)."')><img src='img/novisibleizq.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$areas[$i]->getId())."') onMouseout=hideddrivetip()><img src='img/novisibleder.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$areas[$i]->getId())."') onMouseout=hideddrivetip()></a>";
			         "</td>";
			    echo "<td align='center' nowrap>", $areas[$i]->getId(),"</td>";
			    echo "<td align='center' nowrap>", $areas[$i]->getNombre(),"</td>";
			    echo "<td align='center' nowrap>", $areas[$i]->getResponsable(),"</td>";
			    echo "<td align='center' nowrap>", $nom_programa,"</td>";
			    echo "</tr>\n";	  	          
		}
	}
	echo "<tr><td colspan='10'><strong>".count($areas)." registros encontrados<strong></td></tr>";
	?>	  
</table>	   

