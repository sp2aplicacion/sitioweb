<?php
	require_once('logica/Area.php');		
	$visible=$_POST['visible'];
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$area = new Area($datos); 
	$area->actualizarVisible($visible);	
	$_POST['q']=$q;
	include("presentacion/administrador/ajax/busquedaArea.php");
?>