<?php
	require_once('logica/Area.php');
	require_once('logica/Convenio.php');
	$programa=$_POST['programa'];
	$q=$_POST['q'];	
	//echo("Programa".$programa);
	//echo("Periodo".$q);	
	$area = new Area(array()); 
	$areas = $area->consultarAreaPrograma($programa);
	$cronograma="";
?>
<?php if (count($area)>0) { ?>

	<table border="0" align="center">
		<div align="center">	
        <fieldset>
		  <label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Area</label>
		    <select name="area" id="area" onchange="return buscarSupervisor(52,'&area='+document.forms[0].area.value)">
			<option value="0">Seleccione</option>
			  <?php 
  		        for($i=0; $i<count($areas); $i++)
			 	    echo "<option value='".$areas[$i][0]."'>".$areas[$i][1]."</option>";	
			  ?>				
			</select>
		</fieldset>
		
		<input type="hidden" id="q" value= "<?php echo($q) ?>" name="q" />
		
		<span id="loading2"></span>
            <div id="resultados2"></div>		
		  <?php
	    }
	       ?>
	   </div>
    </table>