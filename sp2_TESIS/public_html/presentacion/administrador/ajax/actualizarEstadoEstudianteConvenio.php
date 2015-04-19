<?php
	require_once('logica/Convenio.php');		
	$id=$_POST['id'];
	$idEstudiante=$_POST['idEstudiante'];
	$estado=$_POST['estado'];
	$nitEmpresa=$_POST['nitEmpresa'];
	$periodo=$_POST['periodo'];
	$datos[0]=$id;
	$convenio = new Convenio($datos); 
	$convenio->consultar();
	$datos[0]=$idEstudiante;
	$estudiante=new Estudiante($datos);
	$estudiante->consultar();	
	if($estado!=0)
		{
		if((($convenio->getCuposOfrecidos()>$convenio->getCuposAsignados()) && $estado==1) || $estado==2)	
			{
			$estudiante->actualizarEstado($estudiante->getEstado()+$estado);
			$convenio->actualizarEstadoEstudiante($estado,$idEstudiante);
			}	
		else
			$_GET['error']=1;	
		if(($convenio->getCuposOfrecidos()>$convenio->getCuposAsignados()) && $estado==1)
			$convenio->actualizarCuposAsignados($convenio->getCuposAsignados()+1);			
		}
	elseif($estado==0&&($estudiante->getEstado()==4||$estudiante->getEstado()==7||$estudiante->getEstado()==10))
		{
		$estudiante->actualizarEstado($estudiante->getEstado()-1);
		$convenio->actualizarEstadoEstudiante($estado,$idEstudiante);
		$convenio->actualizarCuposAsignados($convenio->getCuposAsignados()-1);
		}
	elseif($estado==0&&($estudiante->getEstado()==5||$estudiante->getEstado()==8||$estudiante->getEstado()==11))
		{
		$estudiante->actualizarEstado($estudiante->getEstado()-2);
		$convenio->actualizarEstadoEstudiante($estado,$idEstudiante);
		}		
	$_POST['nitEmpresa']=$nitEmpresa;
	$_POST['periodo']=$periodo;
	include("presentacion/administrador/ajax/consultarConvenio.php");
?>