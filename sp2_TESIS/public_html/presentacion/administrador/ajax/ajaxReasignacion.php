<?php
	require_once('logica/Convenio.php');		
	$convenio=new Convenio(array());
	$q=$_POST['q'];
//	echo($q);
	$periodo=$_POST['periodo'];
	$convenio = new Convenio(array()); 
	$convenios = $convenio->consultarEstudiantespPorPeriodo($q,$periodo);
	$cronograma="";
?>
<?php if (count($convenio)>0) { ?>

	<table border="0" align="center">
		<div align="center">	
    	  <fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Estudiante</label>
			<select name="estudiante" id="estudiante" onchange="return buscarSupervisor(55,'&estudiante='+document.forms[0].estudiante.value)">
			   <option value="0">Seleccione</option>			
			   <?php 
			     $convenio = new Convenio(array()); 

			     for($i=0; $i<count($convenios); $i++)
			    	echo "<option value='".$convenios[$i][0][0]."'>".$convenios[$i][0][1]." ".$convenios[$i][0][2]."</option>";			
			   ?>
			</select>
		  </fieldset>
	   <input type="hidden" id="q" value= "<?php echo($q) ?>" name="q" /></fieldset>	
	   
		  	<span id="loading2"></span>
            <div id="resultados2"></div>		
		  <?php
	    }
	       ?>
	   </div>		
    </table>  