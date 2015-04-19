<?php
	require_once('logica/Programa.php');	
	require_once('logica/Facultad.php');		
	$programa = new Programa(array()); 
	$q=$_POST['q'];
	if($q =="*")
		$programas=$programa->consultarTodos("programa.nombre");	
	else if($q!="")
		$programas=$programa->buscar($q,"programa.nombre");
	$cuenta=0;

?>
<table border="0" align="center">			
	<?php if (count($programas)>0) { ?>
	<tr class="titulo">				
		
		<td align="center"><strong>Servicios</strong></td>
		<td align="center"><strong>ID</strong></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Director</strong></td>
		<td align="center"><strong>Facultad</strong></td>

	</tr>
	<?php

	$nombrefacultad = "";
	$facultad = new Facultad(array());
	$facultades = $facultad->consultarTodos("facultad.nombre");

	for($i=0; $i<count($programas); $i++)
		{		
			for ($j=0; $j <count($facultades) ; $j++) { 
				if($facultades[$j]->getId() == $programas[$i]->getFacultad())
				{
					$nombrefacultad = $facultades[$j]->getNombre();
				}
			}
			
		        echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
	  			echo "<td align='center' nowrap><a href='index.php?id=269&idEdit=".$programas[$i]->getId()."'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'".str_replace(" ","_",$programas[$i]->getId())."') onMouseout=hideddrivetip()></a>",
	  			"<a href=javascript:actualizar(17,'id=".$programas[$i]->getId()."&q=".str_replace(" ","%20",$q)."') onClick=\"return confirmacion('".$programas[$i]->getId()."')\"><img src='img/eliminar.png' border='0' onMouseover=mensaje(6,'".str_replace(" ","_",$programas[$i]->getId())."') onMouseout=hideddrivetip()></a>",
	  			"<hr>",($programas[$i]->getVisible()==1)?"<a href=javascript:actualizar(18,'id=".$programas[$i]->getId()."&visible=0&q=".str_replace(" ","%20",$q)."')><img src='img/visibleizq.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$programas[$i]->getId())."') onMouseout=hideddrivetip()><img src='img/visibleder.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$programas[$i]->getId())."') onMouseout=hideddrivetip()></a>":"<a href=javascript:actualizar(18,'id=".$programas[$i]->getId()."&visible=1&q=".str_replace(" ","%20",$q)."')><img src='img/novisibleizq.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$programas[$i]->getId())."') onMouseout=hideddrivetip()><img src='img/novisibleder.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$programas[$i]->getId())."') onMouseout=hideddrivetip()></a>";
			    echo "<td align='center' nowrap>", $programas[$i]->getId(),"</td>";
			    echo "<td align='center' nowrap>", $programas[$i]->getNombre(),"</td>";
			    echo "<td align='center' nowrap>", $programas[$i]->getDirector(),"</td>";
			    echo "<td align='center' nowrap>", $nombrefacultad,"</td>";
			    echo "</tr>\n";	  	          
		}
	}
	echo "<tr><td colspan='10'><strong>".count($programas)." registros encontrados<strong></td></tr>";
	?>	  
</table>	   

