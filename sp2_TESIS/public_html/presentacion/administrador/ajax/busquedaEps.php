<?php
	require_once('logica/Eps.php');		
	$eps = new Eps(array()); 
	$q=$_POST['q'];
	if($q =="*")
		$eps_s=$eps->consultarTodos("eps.nombreeps");	
	else if($q!="")
		$eps_s=$eps->buscar($q,"eps.nombreeps");
	$cuenta=0;

?>
<table border="0" align="center">			
	<?php if (count($eps_s)>0) { ?>
	<tr class="titulo">				
		
		<td align="center"><strong>Servicios</strong></td>
		<td align="center"><strong>ID</strong></td>
		<td align="center"><strong>Nombre</strong></td>

		
	</tr>
	<?php
	for($i=0; $i<count($eps_s); $i++)
		{		
		        echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
	  			echo "<td align='center' nowrap><a href='index.php?id=300&idEdit=".$eps_s[$i]->getId()."'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'".str_replace(" ","_",$eps_s[$i]->getId())."') onMouseout=hideddrivetip()></a>",
			  		 "<a href=javascript:actualizar(81,'id=".$eps_s[$i]->getId()."&q=".str_replace(" ","%20",$q)."') onClick=\"return confirmacion('".$eps_s[$i]->getId()."')\"><img src='img/eliminar.png' border='0' onMouseover=mensaje(6,'".str_replace(" ","_",$eps_s[$i]->getId())."') onMouseout=hideddrivetip()></a>",
			  		 "<hr>",($eps_s[$i]->getVisible()==1)?"<a href=javascript:actualizar(82,'id=".$eps_s[$i]->getId()."&visible=0&q=".str_replace(" ","%20",$q)."')><img src='img/visibleizq.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$eps_s[$i]->getId())."') onMouseout=hideddrivetip()><img src='img/visibleder.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$eps_s[$i]->getId())."') onMouseout=hideddrivetip()></a>":"<a href=javascript:actualizar(82,'id=".$eps_s[$i]->getId()."&visible=1&q=".str_replace(" ","%20",$q)."')><img src='img/novisibleizq.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$eps_s[$i]->getId())."') onMouseout=hideddrivetip()><img src='img/novisibleder.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$eps_s[$i]->getId())."') onMouseout=hideddrivetip()></a>";
			         "</td>";
			    echo "<td align='center' nowrap>", $eps_s[$i]->getId(),"</td>";
			    echo "<td align='center' nowrap>", $eps_s[$i]->getNombreeps(),"</td>";
			    echo "</tr>\n";	  	          
		}
	}
	echo "<tr><td colspan='10'><strong>".count($eps_s)." registros encontrados<strong></td></tr>";
	?>	  
</table>	   

