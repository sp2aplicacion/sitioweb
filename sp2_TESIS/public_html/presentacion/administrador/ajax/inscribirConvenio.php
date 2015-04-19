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
	if($estudiante->getNombre()!="")
		{
		if($convenio->consultarAplicantes()<$convenio->getCuposOfrecidos()*3)
			{
			$convenio->inscribirEstudiante($idEstudiante,$periodo,$fechaAplicacion);	
			$estudiante->actualizarEstado(3);//Coloca por defecto en inscrito(1)
			}
		else
			$_GET['error']=2;
		}
	else
		$_GET['error']=3;
	$_GET['nitEmpresa']=$nitEmpresa;
	$_GET['idEstudiante']=$idEstudiante;
	include("presentacion/administrador/ajax/consultarConvenio.php");
?>