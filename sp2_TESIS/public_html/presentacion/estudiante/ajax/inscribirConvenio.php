<?php
	require_once('logica/Convenio.php');		
	require_once('logica/Estudiante.php');		
	$idConvenio=$_POST['idConvenio'];
	$idEstudiante=$_POST['idEstudiante'];
	$nitEmpresa=$_POST['nitEmpresa'];
	$datos[0]=$idConvenio;
	$convenio = new Convenio($datos); 
	$convenio->consultar();
	$datos[0]=$idEstudiante;
	$estudiante=new Estudiante($datos);
	$estudiante->consultar();
	if($convenio->consultarAplicantes()<$convenio->getCuposOfrecidos()*3)
		{
		$convenio->inscribirEstudiante($idEstudiante,$periodo,$fechaAplicacion);
		$estudiante->actualizarEstado($estudiante->getEstado()+1);
		}
	else
		$_GET['error']=1;
	$_GET['nitEmpresa']=$nitEmpresa;
	$_GET['idEstudiante']=$idEstudiante;
	include("presentacion/estudiante/ajax/consultarConvenio.php");
?>