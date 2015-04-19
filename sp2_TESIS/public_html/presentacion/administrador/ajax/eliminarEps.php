<?php
	require_once('logica/Eps.php');		
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$eps = new Eps($datos); 
	$eps->eliminar($visible);	
	$_POST['q']=$q;
	echo "<div class='rojo' align='center'><strong>La Eps con ID ".$id." se ha eliminado correctamente</strong></div>";
	include("presentacion/administrador/ajax/busquedaEps.php");
?>