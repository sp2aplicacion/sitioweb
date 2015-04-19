<?php
	require_once('logica/Area.php');		
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$area = new Area($datos); 
	$area->eliminar($visible);	
	$_POST['q']=$q;
	echo "<div class='rojo' align='center'><strong>La Area con ID ".$id." se ha eliminado correctamente</strong></div>";
	include("presentacion/administrador/ajax/busquedaArea.php");
?>