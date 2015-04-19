<?php
	require_once('logica/Convenio.php');		
	
	$estudiante=$_POST['estudiante'];
	$area=$_POST['q'];
	$convenio = new Convenio(array()); 
 //   echo("Area: ".$area);
 //   echo("Estudiante: ".$estudiante);	
	$convenios = $convenio->consultarConvenioEstudianteSupervisor2($estudiante,$area);


?>
<?php if (count($convenio)>0) { ?>

	  <form name="Formulario" method="post" action="index.php?id=295" enctype="multipart/form-data">
		<div align="center">	
    	  <fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Supervisor actual</label>
			<select name="sup_asig" id="sup_asig" >
			   <option value="0">Seleccione</option>			
			   <?php 
			     $convenio = new Convenio(array()); 

			     for($i=0; $i<count($convenios); $i++)
				 {
			    	echo "<option value='".$convenios[$i][0]."'>".$convenios[$i][1]." ".$convenios[$i][2]."</option>";			
				 }
			   ?>
			</select>
		  </fieldset>	
    	  <fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Supervisor a asignar</label>
			<select name="supervisor" id="supervisor" >
			   <option value="0">Seleccione</option>			
			   <?php 
			     $supervisores=$convenio->supervisores($estudiante,$area);
			     for($i=0; $i<count($supervisores); $i++)
			    	echo "<option value='".$supervisores[$i][0]."'>".$supervisores[$i][3]." ".$supervisores[$i][2]."</option>";			
			   ?>
			</select>
		  </fieldset>
		  
		  <input name="enviar" type="submit" value="Reasignar">	
	       <?php
	    }
	       ?>
  	     </div>
	   </form>	
 