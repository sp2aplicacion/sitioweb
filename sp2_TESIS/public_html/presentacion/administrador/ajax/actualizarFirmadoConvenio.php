<?php
	require_once('logica/Convenio.php');		
	$firmado=$_POST['firmado'];
	$id=$_POST['id'];
	$nitEmpresa=$_POST['nitEmpresa'];
	$datos[0]=$id;
	$convenio = new Convenio($datos); 
	$convenio->actualizarFirmado($firmado);	
	$_GET['nitEmpresa']=$nitEmpresa;
	$_GET['rol']=$rol;
	include("presentacion/administrador/ajax/consultarConvenio.php");
?>