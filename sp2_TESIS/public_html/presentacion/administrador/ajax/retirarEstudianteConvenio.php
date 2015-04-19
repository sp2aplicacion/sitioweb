<?php
	require_once('logica/Convenio.php');		
	require_once('logica/Estudiante.php');		
	$id=$_POST['id'];
	$idEstudiante=$_POST['idEstudiante'];
	$nitEmpresa=$_POST['nitEmpresa'];
	$periodo=$_POST['periodo'];	
	$datos[0]=$id;
	$convenio = new Convenio($datos); 
	$convenio->retirarEstudianteConvenio($idEstudiante);
	$_POST['nitEmpresa']=$nitEmpresa;
	$_POST['periodo']=$periodo;
	include("presentacion/administrador/ajax/consultarConvenio.php");
?>