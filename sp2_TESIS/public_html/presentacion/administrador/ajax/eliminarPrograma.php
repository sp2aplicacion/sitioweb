<?php
	require_once('logica/Programa.php');		
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$programa = new Programa($datos); 
	$programa->eliminar($visible);	
	$_POST['q']=$q;
	echo "<div class='rojo' align='center'><strong>El programa con ID ".$id." se ha eliminado correctamente</strong></div>";
	include("presentacion/administrador/ajax/busquedaPrograma.php");
?>