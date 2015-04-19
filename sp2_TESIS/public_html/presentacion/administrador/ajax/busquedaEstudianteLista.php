<?php
	require_once('logica/Estudiante.php');		
	$estudiante = new Estudiante(array()); 
	$q=$_POST['q'];
	if($q=="*")
		$estudiantes=$estudiante->consultarTodos("estudiante.apellido");	
	else if($q!="")
		$estudiantes=$estudiante->buscar($q,"estudiante.apellido");
?>
	<?php if (count($estudiantes)>0) { ?>
	<select id="listaEstudiantes" size="<?php echo (count($estudiantes)>=10)?"10":(count($estudiantes)>=2)?count($estudiantes):"2" ?>" class="comboLista" onclick="asignarValorLista()">
	<?php
	for($i=0; $i<count($estudiantes); $i++)
		{
		echo "<option value='".$estudiantes[$i]->getCodigo()."'>".$estudiantes[$i]->getNombre()." ".$estudiantes[$i]->getApellido()."</option>";
		}
	}
	?>	
	</select>