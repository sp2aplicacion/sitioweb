<?php
	require_once('logica/Empresa.php');		
	$id=$_POST['id'];
	$q=$_POST['q'];
	$datos[0]=$id;
	$empresa = new Empresa($datos); 
	$empresa->eliminar($visible);	
	$_POST['q']=$q;
	echo "<div class='rojo' align='center'><strong>La entidad con NIT ".$id." se ha eliminado correctamente</strong></div>";
	include("presentacion/administrador/ajax/busquedaEmpresa.php");
?>