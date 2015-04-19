<?php
	require_once('logica/Facultad.php');		
	$facultad = new Facultad(array()); 
	$q=$_POST['q'];
	if($q =="*")
		$facultades=$facultad->consultarTodos("facultad.nombre");	
	else if($q!="")
		$facultades=$facultad->buscar($q,"facultad.nombre");
	$cuenta=0;

?>
<table border="0" align="center">			
	<?php if (count($facultades)>0) { ?>
	<tr class="titulo">				
		
		<td align="center"><strong>Servicios</strong></td>
		<td align="center"><strong>ID</strong></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Decano</strong></td>
		<td align="center"><strong>Coordinador</strong></td>
		<td align="center"><strong>Telefono</strong></td>
		
	</tr>
	<?php
	for($i=0; $i<count($facultades); $i++)
		{		
		        echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
	  			echo "<td align='center' nowrap><a href='index.php?id=259&idEdit=".$facultades[$i]->getId()."'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'".str_replace(" ","_",$facultades[$i]->getId())."') onMouseout=hideddrivetip()></a>",
			  		 "<a href=javascript:actualizar(8,'id=".$facultades[$i]->getId()."&q=".str_replace(" ","%20",$q)."') onClick=\"return confirmacion('".$facultades[$i]->getId()."')\"><img src='img/eliminar.png' border='0' onMouseover=mensaje(6,'".str_replace(" ","_",$facultades[$i]->getId())."') onMouseout=hideddrivetip()></a>",
			  		 "<hr>",($facultades[$i]->getVisible()==1)?"<a href=javascript:actualizar(9,'id=".$facultades[$i]->getId()."&visible=0&q=".str_replace(" ","%20",$q)."')><img src='img/visibleizq.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$facultades[$i]->getId())."') onMouseout=hideddrivetip()><img src='img/visibleder.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$facultades[$i]->getId())."') onMouseout=hideddrivetip()></a>":"<a href=javascript:actualizar(9,'id=".$facultades[$i]->getId()."&visible=1&q=".str_replace(" ","%20",$q)."')><img src='img/novisibleizq.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$facultades[$i]->getId())."') onMouseout=hideddrivetip()><img src='img/novisibleder.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$facultades[$i]->getId())."') onMouseout=hideddrivetip()></a>";
			         "</td>";
			    echo "<td align='center' nowrap>", $facultades[$i]->getId(),"</td>";
			    echo "<td align='center' nowrap>", $facultades[$i]->getNombre(),"</td>";
			    echo "<td align='center' nowrap>", $facultades[$i]->getDecano(),"</td>";
			    echo "<td align='center' nowrap>", $facultades[$i]->getCoordinador(),"</td>";
			    echo "<td align='center' nowrap>", $facultades[$i]->getTelefono(),"</td>";
			    echo "</tr>\n";	  	          
		}
	}
	echo "<tr><td colspan='10'><strong>".count($facultades)." registros encontrados<strong></td></tr>";
	?>	  
</table>	   

