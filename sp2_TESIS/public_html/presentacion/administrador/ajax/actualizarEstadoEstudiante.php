<?php
	require_once('logica/Convenio.php');		
	$id=$_POST['id'];
	$idEstudiante=$_POST['idEstudiante'];
	$estado=$_POST['estado'];
	$q=$_POST['q'];
	$datos[0]=$idEstudiante;
	$estudiante=new Estudiante($datos);
	$estudiante->actualizarEstado($estado);
	$_POST['q']=$q;
	include("presentacion/administrador/ajax/busquedaEstudiante.php");
?>