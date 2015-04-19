<?php
	require_once('logica/Supervisor.php');		
	$supervisor = new Supervisor(array()); 
	$q=$_POST['q'];
	if($q=="*")
		$supervisores = $supervisor->consultarTodos("supervisor.apellido");
	else if($q!="")
		$supervisores = $supervisor->buscar($q,"supervisor.apellido");
?>
<table border="0" align="center">			
	<tr class="titulo">				
		<td align="center"><strong>Eliminar</strong></td>
   	    <td align="center"><strong>Asignar</strong></td>
		<td align="center"><strong>Codigo</strong></td>
		<td align="center"><strong>Cedula</strong></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Apellido</strong></td>
		<td align="center"><strong>Correo</strong></td>
		<td align="center"><strong>Telefono</strong></td>
		<td align="center"><strong>Celular</strong></td>
		<td align="center"><strong>Direccion</strong></td>
		<td align="center"><strong>Profesion</strong></td>
		<td align="center"><strong>Facultad</strong></td>
	</tr>
	<?php 
	for($i=0; $i<=count($supervisores)-1; $i++)
		{
	    $valor=$supervisor->seleccionarsupervisorSinConvenio($supervisores[$i]->getCodigo());
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		if($valor)
		{
		   echo "<td align='Center'><a href='index.php?id=223&idSupElim=".$supervisores[$i]->getCodigo()."' onClick=\"return confirm('Realmente deseas eliminar el supervisor con codigo ".$supervisores[$i]->getCodigo()."');\"> 
		                                 <img src='img/eliminar.png' border='0' onMouseover=mensaje(4,'".$supervisores[$i]->getCodigo()."') onMouseout=hideddrivetip() />
				                    </a>
		         </td>";
		}
		else
		{
		 echo "<td> </td>";
		}
		echo "<td nowrap><a href='index.php?id=224&idSupervisor=".$supervisores[$i]->getCodigo()."'><img src='img/agregar.png' border='0' onMouseover=mensaje(1,'".str_replace(" ","_",$supervisores[$i]->getCodigo())."') onMouseout=hideddrivetip()></a></td>
		      <td>",$supervisores[$i]->getCodigo(),"</td>
			  <td>",$supervisores[$i]->getCedula(),"</td>
			  <td>",$supervisores[$i]->getNombre(),"</td>
			  <td>",$supervisores[$i]->getApellido(),"</td>
			  <td>",$supervisores[$i]->getCorreo(),"</td>
			  <td>",$supervisores[$i]->getTelefono(),"</td>
			  <td>",$supervisores[$i]->getCelular(),"</td>
			  <td>",$supervisores[$i]->getDireccion(),"</td>
			  <td>",$supervisores[$i]->getProfesion(),"</td>
			  <td>",$supervisores[$i]->getFacultad(),"</td>";			
		echo "</tr>";					
		}
	echo "<tr><td colspan='10'><strong>".count($supervisores)." registros encontrados<strong></td></tr>";
	?>	  
</table>		   

