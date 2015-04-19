<?php
	require_once('logica/Empresa.php');		
	$visible=$_POST['visible'];
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$empresa = new Empresa($datos); 
	$empresa->actualizarVisible($visible);	
	$_POST['q']=$q;
	include("presentacion/administrador/ajax/busquedaEmpresa.php");
?>