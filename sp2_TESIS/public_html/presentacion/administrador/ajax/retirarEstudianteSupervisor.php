<?php
	require_once('logica/Convenio.php');		
	require_once('logica/Estudiante.php');		
	$idConvenio=$_POST['idConvenio'];
	$idEstudiante=$_POST['idEstudiante'];
	$idSupervisor=$_POST['idSupervisor'];
	$datos[0]=$idConvenio;
	$convenio = new Convenio($datos); 
	$convenio->retirarConvenioEstudianteSupervisor($idEstudiante,$idSupervisor);
	$_GET['idSupervisor']=$idSupervisor;
	$_GET['idEstudiante']=$idEstudiante;
	include("presentacion/administrador/ajax/consultarConvenioAsignarEstudianteSupervisor.php");
?>