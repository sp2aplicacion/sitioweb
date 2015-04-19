<?php
	require_once('logica/Eps.php');		
	$visible=$_POST['visible'];
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$eps = new Eps($datos); 
	$eps->actualizarVisible($visible);	
	$_POST['q']=$q;
	include("presentacion/administrador/ajax/busquedaEps.php");
?>