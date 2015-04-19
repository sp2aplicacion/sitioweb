<?php 
	$id=$_GET['id'];
//AJAX Estudiante
	if($id==1)
		include('presentacion/administrador/ajax/busquedaEstudiante.php');
	if($id==2)
		include('presentacion/administrador/ajax/busquedaEstudianteLista.php');
	if($id==3)
		include('presentacion/administrador/ajax/actualizarEstadoEstudiante.php');

	else if($id==8)
		include('presentacion/administrador/ajax/eliminarFacultad.php');
	else if($id==9)
		include('presentacion/administrador/ajax/actualizarVisibleFacultad.php');

//AJAX Empresa
	else if($id==11)
		include('presentacion/administrador/ajax/busquedaEmpresa.php');
	else if($id==12)
		include('presentacion/administrador/ajax/actualizarVisibleEmpresa.php');
	else if($id==13)
		include('presentacion/estudiante/ajax/busquedaEmpresa.php');
	else if($id==14)
		include('presentacion/administrador/ajax/eliminarEmpresa.php');
	else if($id==15)
		include('presentacion/administrador/ajax/busquedaFacultad.php');

//AJAX Programa

	else if($id==16)
		include('presentacion/administrador/ajax/busquedaPrograma.php');
	else if($id==17)
		include('presentacion/administrador/ajax/eliminarPrograma.php');
	else if($id==18)
		include('presentacion/administrador/ajax/actualizarVisiblePrograma.php');
		
//AJAX Convenio
	else if($id==20)
		include('presentacion/administrador/ajax/ajaxAreaPrograma.php');
	else if($id==21)
		include('presentacion/administrador/ajax/actualizarVisibleConvenio.php');
	else if($id==22)
		include('presentacion/administrador/ajax/actualizarFirmadoConvenio.php');
	else if($id==23)
		include('presentacion/estudiante/ajax/inscribirConvenio.php');
	else if($id==24)
		include('presentacion/administrador/ajax/actualizarEstadoEstudianteConvenio.php');
	else if($id==25)
		include('presentacion/administrador/ajax/inscribirConvenio.php');
	else if($id==26)
		include('presentacion/administrador/ajax/consultarConvenio.php');
	else if($id==27)
		include('presentacion/administrador/ajax/consultarConvenioGeneral.php');
	else if($id==28)
		include('presentacion/administrador/ajax/retirarEstudianteConvenio.php');
	else if($id==29)
		include('presentacion/administrador/ajax/eliminarConvenio.php');

		
//AJAX Reporte
	else if($id==31)
		include('presentacion/administrador/ajax/reporteEstudianteInscrito.php');
	else if($id==32)
		include('presentacion/administrador/ajax/reporteConvenio.php');
	else if($id==33)
		include('presentacion/administrador/ajax/reporteHistorialEstudiante.php');
	else if($id==34)
		include('presentacion/administrador/ajax/reporteEmpresa.php');

//AJAX Supervisor
	else if($id==41)
		include('presentacion/administrador/ajax/consultarConvenioAsignarEstudianteSupervisor.php');
	else if($id==42)
		include('presentacion/administrador/ajax/asignarEstudianteSupervisor.php');
	else if($id==43)
		include('presentacion/administrador/ajax/retirarEstudianteSupervisor.php');

//AJAX Supervision
	else if($id==51)
		include('presentacion/supervisor/ajax/consultarEstudiantesAsignados.php');
	else if($id==52)
		include('presentacion/administrador/ajax/consultarConveniosSupervision.php');
	else if($id==53)
		include('presentacion/administrador/ajax/busquedaSupervisor.php');
	else if($id==54)
		include('presentacion/administrador/ajax/ajaxReasignacion.php');
	else if($id==55)
		include('presentacion/administrador/ajax/ajaxReasignacionSupervisor.php');

//AJAX Area

elseif ($id == 70) 
		include('presentacion/administrador/ajax/busquedaArea.php');
else if($id == 71)
		include('presentacion/administrador/ajax/eliminarArea.php');
else if($id == 72)
		include('presentacion/administrador/ajax/actualizarVisibleArea.php');

//AJAX Eps


else if($id == 80)
		include('presentacion/administrador/ajax/busquedaEps.php');
else if($id == 81)
		include('presentacion/administrador/ajax/eliminarEps.php');
else if($id==82)
		include('presentacion/administrador/ajax/actualizarVisibleEps.php');	
   
?>
