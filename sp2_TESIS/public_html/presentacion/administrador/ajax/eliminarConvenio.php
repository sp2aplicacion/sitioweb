<?php
	require_once('logica/Convenio.php');		
	$id=$_POST['id'];
	$idEstudiante=$_POST['idEstudiante'];
	$nitEmpresa=$_POST['nitEmpresa'];
	$periodo=$_POST['periodo'];	
	$datos[0]=$id;
	$convenio = new Convenio($datos); 
	$convenio->eliminarConvenio();
	$_POST['nitEmpresa']=$nitEmpresa;
	$_POST['periodo']=$periodo;
	echo "<div class='rojo' align='center'><strong>El convenio se ha eliminado correctamente</strong></div>";
	include("presentacion/administrador/ajax/consultarConvenio.php");
?>