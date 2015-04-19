<?php
	require_once('logica/Estudiante.php');		
	$estudiante = new Estudiante(array()); 
	$q=$_POST['q'];
	if($q=="*")
		$estudiantes=$estudiante->consultarTodos("estudiante.apellido");	
	else if($q!="")
		$estudiantes=$estudiante->buscar($q,"estudiante.apellido");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table border="0" align="center">			
	<?php if (count($estudiantes)>0) { ?>
	<tr class="titulo">				
		<td align="center"><strong>Eliminar</strong></td>
    	<td align="center"><strong>Editar</strong></td>
		<td align="center"><strong>Estado</strong></td>
		<td align="center"><strong>Codigo</strong></td>
		<td align="center"><strong>Cedula</strong></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Apellido</strong></td>
		<td align="center"><strong>Correo</strong></td>
		<td align="center"><strong>Telefono</strong></td>
		<td align="center"><strong>Celular</strong></td>
		<td align="center"><strong>Direccion</strong></td>
		<td align="center"><strong>HV</strong></td>
		<td align="center"><strong>Semestre</strong></td>
		<td align="center"><strong>EPS</strong></td>
		<td align="center"><strong>Observaciones</strong></td>
		<td align="center"><strong>Facultad</strong></td>
	</tr>
	<?php

	 for($i=0; $i<count($estudiantes); $i++)
	 {
	    $valor=$estudiante->seleccionarEstudianteSinConvenio($estudiantes[$i]->getCodigo());
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		if($valor)
		{
		echo "<td align='Center'><a href='index.php?id=213&idEstElim=".$estudiantes[$i]->getCodigo()."' onClick=\"return confirm('Realmente deseas eliminar el estudiante con codigo ".$estudiantes[$i]->getCodigo()."');\"> 
		              <img src='img/eliminar.png' border='0' onMouseover=mensaje(2,'".$estudiantes[$i]->getCodigo()."') onMouseout=hideddrivetip() />
				   </a>
		      </td>";
	    }
		else
		{
		 echo "<td> </td>";
		}
		echo "<td align='Center'><a href='index.php?id=214&idEdit=".$estudiantes[$i]->getCodigo()."'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'".$estudiantes[$i]->getCodigo()."') onMouseout=hideddrivetip() /></a></td>";
		echo "<td align='center' nowrap>";
		for($j=0;$j<count($estudiante->estados);$j++)
			{
				if($estudiantes[$i]->getEstado()==$j)
					echo $estudiante->estados[$j];
			}
		echo "<br><select name='estado".$i."' id='estado".$i."' class='estado' onChange=cambiarEstado('".$estudiantes[$i]->getCodigo()."','estado".$i."')><option value='-1'>Cambiar</option>";
		for($j=0;$j<count($estudiante->estados);$j++)
			echo "<option value='".$j."'>".$estudiante->estados[$j]."</option>";
		echo "</select>";
		echo "</td>";
		echo "<td align='center' nowrap>",$estudiantes[$i]->getCodigo(),"</td>
		<td>",$estudiantes[$i]->getCedula(),"</td>
		<td>",$estudiantes[$i]->getNombre(),"</td>
		<td>",$estudiantes[$i]->getApellido(),"</td>
		<td>",$estudiantes[$i]->getCorreo(),"</td>
		<td>",$estudiantes[$i]->getTelefono(),"</td>
		<td>",$estudiantes[$i]->getCelular(),"</td>
		<td>",$estudiantes[$i]->getDireccion(),"</td>
		<td nowrap>", ($estudiantes[$i]->getHv()!="") ? "<a href='archivos/".$estudiantes[$i]->getHv()."' target='_blank'><strong>Ver</strong></a>" : "&nbsp;" ,"</td>
		<td>",$estudiantes[$i]->getSemestre(),"</td>
		<td>",$estudiantes[$i]->getEps(),"</td>
		<td>",$estudiantes[$i]->getObservaciones(),"</td>
		<td>",$estudiantes[$i]->getFacultad(),"</td>";
		echo "</tr>\n";					
	 }
	}
	echo "<tr><td colspan='10'><strong>".count($estudiantes)." registros encontrados<strong></td></tr>";
	?>	  
</table>
</body>	
</html>   

