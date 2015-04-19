<?php
	require_once('logica/Convenio.php');		
	$visible=$_POST['visible'];
	$id=$_POST['id'];
	$nitEmpresa=$_POST['nitEmpresa'];
	$datos[0]=$id;
	$convenio = new Convenio($datos); 
	$convenio->actualizarVisible($visible);	
	$_GET['nitEmpresa']=$nitEmpresa;
	$_GET['rol']=$rol;
	include("presentacion/administrador/ajax/consultarConvenio.php");
?>