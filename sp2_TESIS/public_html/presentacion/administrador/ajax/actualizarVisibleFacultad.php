<?php
	require_once('logica/Facultad.php');		
	$visible=$_POST['visible'];
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$facultad = new Facultad($datos); 
	$facultad->actualizarVisible($visible);	
	$_POST['q']=$q;
	include("presentacion/administrador/ajax/busquedaFacultad.php");
?>