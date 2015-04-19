<?php
	require_once('logica/Programa.php');		
	$visible=$_POST['visible'];
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$facultad = new Programa($datos); 
	$facultad->actualizarVisible($visible);	
	$_POST['q']=$q;
	include("presentacion/administrador/ajax/busquedaPrograma.php");
?>