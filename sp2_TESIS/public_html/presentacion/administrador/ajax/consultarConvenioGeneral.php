<?php
	require_once('logica/Convenio.php');		
	$convenio=new Convenio(array());
	$q=$_POST['q'];
	$periodo=$_POST['periodo'];
	$convenio = new Convenio(array()); 
	$convenios = $convenio->conveniosPeriodoParaCopia($q,$periodo);
?>
<form name="Formulario2" method="post" action="index.php?id=277">
<hr />
<div align="center"><strong>Crear una copia con los convenios seleccionados en el area seleccionada</strong>
	<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha Inicial Copia</label><input name="fechaInicial" type="text" id="fechaInicial" onclick="cal1xx.select(document.forms[1].fechaInicial,'fechaInicial','yyyy-MM-dd'); return false;" readonly="true" /></fieldset>
	<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha Final Copia</label><input name="fechaFinal" type="text" id="fechaFinal" onclick="cal1xx.select(document.forms[1].fechaFinal,'fechaFinal','yyyy-MM-dd'); return false;" readonly="true" /></fieldset>
	<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Periodo Copia</label>
	<select name="periodoCopia" id="periodoCopia">
	<?php for($i=date("Y")+1; $i>=2009; $i--) 
		{
		echo "<option value='".$i."-2' ",($i."-2"==$periodo)?" selected":"",">".$i."-2</option><option value='".$i."-1' ",($i."-1"==$periodo)?" selected":"",">".$i."-1</option>";		
		} 	
	 ?>
	</select>
	</fieldset>
	<input name="enviar" type="submit" value="Realizar Copia" onClick="return (verificarseleccion(this.form.convenios));" />		
</div>
<hr />
<table border="0" align="center">			
	<?php if (count($convenios)>0) { ?>
	<tr class="titulo">				
		<td align="center"><input type="checkbox" name="todosConvenio" class="checkbox" onclick="seleccionar(this.form.convenios,this.form.todosConvenio)" /></td>
		<td align="center"><strong>Nombre</strong></td>
		<td align="center"><strong>Fecha Inicial</strong></td>
		<td align="center"><strong>Fecha Final</strong></td>
		<td align="center"><strong>Cupos Ofrecidos</strong></td>
		<td align="center"><strong>Visible</strong></td>
		<td align="center"><strong>Firmado</strong></td>
		<td align="center"><strong>Observaciones</strong></td>
		<td align="center" nowrap><strong>Supervisor Convenio</strong></td>
		<td align="center"><strong>NIT Entidad</strong></td>
		<td align="center"><strong>Entidad</strong></td>
	</tr>
	<?php
	for($i=0; $i<count($convenios); $i++)
		{
		echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
		echo "<td><input type='checkbox' class='checkbox' id='convenios' name='convenios[]' value='".$convenios[$i][3]."@-@".$convenios[$i][7]."@-@".$convenios[$i][8]."@-@".$convenios[$i][9]."@-@".$convenios[$i][10]."@-@".$q."'></td>";		
		echo "<td>",$convenios[$i][8],"</td>
		<td>",$convenios[$i][1],"</td>
		<td>",$convenios[$i][2],"</td>
		<td align='center'>",$convenios[$i][3],"
		<td align='center'>",($convenios[$i][5]==0)?"NO":"SI","</td>
		<td align='center'>",($convenios[$i][6]==0)?"NO":"SI","</td>
		<td>",$convenios[$i][7],"</td>
		<td>",$convenios[$i][9],"</td>
		<td>",$convenios[$i][10],"</td>
		<td>",$convenios[$i][11],"</td>";			
		echo "</tr>";					
		}
	echo "<tr><td colspan='10'><strong>".count($convenios)." registros encontrados<strong></td></tr>";		
	}
	?>	  
</table>
</form>
