<?php
	require_once('logica/Facultad.php');		
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$facultad = new Facultad($datos); 
	$facultad->eliminar($visible);	
	$_POST['q']=$q;
	echo "<div class='rojo' align='center'><strong>La Facultad con ID ".$id." se ha eliminado correctamente</strong></div>";
	include("presentacion/administrador/ajax/busquedaFacultad.php");
?>