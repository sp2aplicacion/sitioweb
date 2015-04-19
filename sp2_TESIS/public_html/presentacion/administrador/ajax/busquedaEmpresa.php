<?php
	require_once('logica/Empresa.php');		
	$empresa = new Empresa(array()); 
	$q=$_POST['q'];
	if($q=="*")
		$empresas=$empresa->consultarTodos("empresa.nombre");	
	else if($q!="")
		$empresas=$empresa->buscar($q,"empresa.nombre");
	$cuenta=0;

?>
<table border="0" align="center">			
	<?php if (count($empresas)>0) { ?>
	<tr class="titulo">				
		<td align="center"><strong>Servicios</strong></td>
		<td align="center"><strong>NIT</strong></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Correo<br>Direccion<br>Telefono<br>Estrato<br>Num Convenios</strong></td>
		<td align="center" nowrap><strong>Representante<br>Supervisor Entidad<br>Cargo Supervisor</strong></td>
		<td align="center" nowrap><strong>Objeto Social</strong></td>
		<td align="center" nowrap><strong>Ficha Tecnica</strong></td>
	</tr>
	<?php
	for($i=0; $i<count($empresas); $i++)
		{
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		$numConvenios=$empresas[$i]->numConvenios();
		echo "<td align='center' nowrap><a href='index.php?id=234&idEdit=".$empresas[$i]->getNit()."'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'".str_replace(" ","_",$empresas[$i]->getNIT())."') onMouseout=hideddrivetip()></a> 
		<a href='index.php?id=271&nitEmpresa=".$empresas[$i]->getNit()."'><img src='img/agregar.png' border='0' onMouseover=mensaje(2,'".str_replace(" ","_",$empresas[$i]->getNIT())."') onMouseout=hideddrivetip()></a> 
		<a href='index.php?id=273&nitEmpresa=".$empresas[$i]->getNit()."'><img src='img/consultar.png' border='0' onMouseover=mensaje(3,'".str_replace(" ","_",$empresas[$i]->getNIT())."') onMouseout=hideddrivetip()></a>",
		($numConvenios==0)?" <a href=javascript:actualizar(14,'id=".$empresas[$i]->getNit()."&q=".str_replace(" ","%20",$q)."') onClick=\"return confirmacion('".$empresas[$i]->getNit()."')\"><img src='img/eliminar.png' border='0' onMouseover=mensaje(6,'".str_replace(" ","_",$empresas[$i]->getNIT())."') onMouseout=hideddrivetip()></a>":"",		
		"<hr>",($empresas[$i]->getVisible()==1)?"<a href=javascript:actualizar(12,'id=".$empresas[$i]->getNit()."&visible=0&q=".str_replace(" ","%20",$q)."')><img src='img/visibleizq.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$empresas[$i]->getNIT())."') onMouseout=hideddrivetip()><img src='img/visibleder.gif' border='0' onMouseover=mensaje(4,'".str_replace(" ","_",$empresas[$i]->getNIT())."') onMouseout=hideddrivetip()></a>":"<a href=javascript:actualizar(12,'id=".$empresas[$i]->getNit()."&visible=1&q=".str_replace(" ","%20",$q)."')><img src='img/novisibleizq.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$empresas[$i]->getNIT())."') onMouseout=hideddrivetip()><img src='img/novisibleder.gif' border='0' onMouseover=mensaje(5,'".str_replace(" ","_",$empresas[$i]->getNIT())."') onMouseout=hideddrivetip()></a>",
		"</td>";
		echo "<td align='center' nowrap>",$empresas[$i]->getNit(),"</td>
		<td>",$empresas[$i]->getNombre(),"</td>
		<td align='center'>",$empresas[$i]->getCorreo(),"<hr>",$empresas[$i]->getDireccion(),"<hr>",$empresas[$i]->getTelefono(),"<hr>",$empresas[$i]->getEstrato(),"<hr>",$numConvenios," convenios registrados</td>
		<td>",$empresas[$i]->getRepresentante(),"<hr>",$empresas[$i]->getSupervisor(),"<hr>",$empresas[$i]->getCargoSupervisor(),"</td>
		<td>",$empresas[$i]->getObjetoSocial(),"</td>
		<td nowrap>",($empresas[$i]->getFichaTecnica()!="") ? "<a href='archivos/".$empresas[$i]->getFichaTecnica()."' target='_blank'><strong>Ver Ficha</strong></a>" : "Sin Ficha" ,"</td>";
		echo "</tr>\n";					
		}
	}
	echo "<tr><td colspan='10'><strong>".count($empresas)." registros encontrados<strong></td></tr>";
	?>	  
</table>	   

