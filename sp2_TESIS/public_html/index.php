<?php 
if(empty($_GET['id']))
	include('presentacion/inicio.php');
else
	{
	$id=$_GET['id'];
//Gestion Sesiones
	if($id==1)
		include('presentacion/autenticar.php');
	elseif($id==2)
		include('presentacion/sesionEstudiante.php');
	elseif($id==3)
		include('presentacion/sesionAdministrador.php');
	elseif($id==4)
		include('presentacion/sesionSupervisor.php');
	elseif($id==5)
		include('presentacion/salir.php');
		

//Getsion Otros
	elseif($id==11)
		include('presentacion/cambiarContra.php');
	elseif($id==12)
		include('presentacion/procesarCambiarContra.php');
	elseif($id==13)
		include('presentacion/generarContra.php');
	elseif($id==14)
		include('presentacion/enviarContra.php');

//Sitios Estudiante
	elseif($id==101)
		include('presentacion/estudiante/editar/perfil.php');
	elseif($id==102)
		include('presentacion/estudiante/consultar/empresa.php');
	elseif($id==103)
		include('presentacion/estudiante/consultar/convenio.php');
	elseif($id==104)
		include('presentacion/estudiante/consultar/conveniosSupervision.php');
	elseif($id==105)
		include('presentacion/estudiante/ingresar/controlDiarioPractica.php');
	elseif($id==106)
		include('presentacion/estudiante/consultar/controlDiarioPractica.php');
	elseif($id==107)
		include('presentacion/estudiante/consultar/seguimientoQuincenal.php');
	elseif($id==108)
		include('presentacion/estudiante/consultar/sesionSupervision.php');
	elseif($id==109)
		include('presentacion/estudiante/editar/controlDiarioPractica.php');
	elseif($id==110)
		include('presentacion/supervisor/procesar/habilitarEdicion.php');		
	/*elseif($id==111)
		include('presentacion/supervisor/procesar/eliminarActividad.php');	*/
	/*elseif($id==112)
		include('presentacion/supervisor/procesar/confirmarEliminarActividad.php');*/
	//Sitios Administrador
	//Gestion Administrador
	elseif($id==201)
		include('presentacion/administrador/editar/perfil.php');
	elseif($id==202)
		include('presentacion/administrador/ingresar/administrador.php');
	elseif($id==203)
		include('presentacion/administrador/procesar/ingresarAdministrador.php');
	elseif($id==204)
		include('presentacion/administrador/consultar/administrador.php');
	
	//Gestion Estudiante
	elseif($id==211)
		include('presentacion/administrador/ingresar/estudiante.php');
	elseif($id==212)
		include('presentacion/administrador/procesar/ingresarEstudiante.php');
	elseif($id==213)
		include('presentacion/administrador/consultar/estudiante.php');
	elseif($id==214)
		include('presentacion/administrador/editar/estudiante.php');
	elseif($id==215)
		include('presentacion/administrador/procesar/editarEstudiante.php');
	
	//Gestion Supervisor
	elseif($id==221)
		include('presentacion/administrador/ingresar/supervisor.php');
	elseif($id==222)
		include('presentacion/administrador/procesar/ingresarSupervisor.php');
	elseif($id==223)
		include('presentacion/administrador/consultar/supervisor.php');	
	elseif($id==224)
		include('presentacion/administrador/consultar/convenioAsignarEstudianteSupervisor.php');	
	
	//Gestion Empresa
	elseif($id==231)
		include('presentacion/administrador/ingresar/empresa.php');
	elseif($id==232)
		include('presentacion/administrador/procesar/ingresarEmpresa.php');
	elseif($id==233)
		include('presentacion/administrador/consultar/empresa.php');
	elseif($id==234)
		include('presentacion/administrador/editar/empresa.php');
	elseif($id==235)
		include('presentacion/administrador/procesar/editarEmpresa.php');

	//Gestion Area
	elseif($id==251)
		include('presentacion/administrador/ingresar/area.php');
	elseif($id==252)
		include('presentacion/administrador/procesar/ingresarArea.php');
	elseif($id==253)
		include('presentacion/administrador/consultar/area.php');
	elseif($id==254)
		include('presentacion/administrador/editar/area.php');
	elseif($id==255)
		include('presentacion/administrador/procesar/editarArea.php');


	//Facultad

	elseif($id==256)
		include('presentacion/administrador/ingresar/facultad.php');
	elseif($id==257)
		include('presentacion/administrador/procesar/ingresarFacultad.php');
	elseif($id==258)
		include('presentacion/administrador/consultar/facultad.php');
	elseif($id==259)
		include('presentacion/administrador/editar/facultad.php');
	else if ($id == 267)
		include('presentacion/administrador/procesar/editarFacultad.php');

	//EPS
	
	elseif($id==296)
        include('presentacion/administrador/procesar/ingresarEps.php');
    elseif($id==297)
        include('presentacion/administrador/consultar/eps.php');       
    elseif($id==298)
		include('presentacion/administrador/ingresar/eps.php');
    elseif($id==299)
		include('presentacion/administrador/procesar/editarEps.php');
    elseif($id==300)
    	include('presentacion/administrador/editar/eps.php');
        
        
	
		
	//Programa
	
	elseif($id==260)
		include('presentacion/administrador/ingresar/programa.php');	
	elseif($id==266)
		include('presentacion/administrador/procesar/ingresarPrograma.php');	
	elseif($id==268)
		include('presentacion/administrador/consultar/programa.php');	
	elseif($id==269)
		include('presentacion/administrador/editar/programa.php');
	elseif($id==270)
		include('presentacion/administrador/procesar/editarPrograma.php');

	//Gestion Actividad
	elseif($id==261)
		include('presentacion/administrador/ingresar/actividad.php');
	elseif($id==262)
		include('presentacion/administrador/procesar/ingresarActividad.php');
	elseif($id==263)
		include('presentacion/administrador/consultar/actividad.php');
	elseif($id==264)
		include('presentacion/administrador/editar/actividad.php');
	elseif($id==265)
		include('presentacion/administrador/procesar/editarActividad.php');

	//Gestion Convenio
	elseif($id==271)
		include('presentacion/administrador/ingresar/convenio.php');
	elseif($id==272)
		include('presentacion/administrador/procesar/ingresarConvenio.php');
	elseif($id==273)
		include('presentacion/administrador/consultar/convenio.php');
	elseif($id==274)
		include('presentacion/administrador/editar/convenio.php');
	elseif($id==275)
		include('presentacion/administrador/procesar/editarConvenio.php');
	elseif($id==276)
		include('presentacion/administrador/consultar/convenioGeneral.php');

		
	//Gestion Reporte
	elseif($id==281)
		include('presentacion/administrador/reporte/estudianteInscrito.php');
	elseif($id==282)
		include('presentacion/administrador/reporte/convenio.php');
	elseif($id==283)
		include('presentacion/administrador/reporte/historialEstudiante.php');
	elseif($id==284)
		include('presentacion/administrador/reporte/empresa.php');
		
    //Administración
	elseif($id==285)
		include('presentacion/administrador/reporte/cierrePeriodo.php');
	elseif($id==286)
		include('presentacion/administrador/reporte/inhabilitarEstudiantes.php');
	elseif($id==287)
		include('presentacion/administrador/reporte/restablecerContrasena.php');  
	elseif($id==288)
		include('presentacion/administrador/reporte/cierre40.php');  		
		
	//Supervision
	elseif($id==291)
		include('presentacion/administrador/consultar/conveniosSupervision.php');
	elseif($id==292)
		include('presentacion/administrador/consultar/controlDiarioPractica.php');
	elseif($id==293)
		include('presentacion/administrador/consultar/seguimientoQuincenal.php');
	elseif($id==294)
		include('presentacion/administrador/consultar/sesionSupervision.php');
	elseif($id==295)
		include('presentacion/administrador/consultar/reasignacion.php');
		
//Sitios Supervisor
	elseif($id==401)
		include('presentacion/supervisor/editar/perfil.php');
	elseif($id==402)
		include('presentacion/supervisor/consultar/estudiantesAsignados.php');
	elseif($id==403)
		include('presentacion/supervisor/ingresar/horarioSupervision.php');
	elseif($id==404)
		include('presentacion/supervisor/ingresar/seguimientoQuincenal.php');
	elseif($id==405)
		include('presentacion/supervisor/ingresar/sesionSupervision.php');
	elseif($id==406)
		include('presentacion/supervisor/procesar/ingresarSesionSupervision.php');
	elseif($id==407)
		include('presentacion/supervisor/consultar/sesionSupervision.php');
	elseif($id==408)
		include('presentacion/supervisor/consultar/controlDiarioPractica.php');
	elseif($id==409)
		include('presentacion/supervisor/administrar/restablecerContrasena.php'); 

//Impresion Reporte Excel y PDF
	//Excel
	elseif($id==801)
		include('presentacion/administrador/reporte/excelConvenio.php');
	elseif($id==802)
		include('presentacion/administrador/reporte/excelEstudianteInscrito.php');
	elseif($id==803)
		include('presentacion/administrador/reporte/excelHistorialEstudiante.php');
	elseif($id==804)
		include('presentacion/administrador/reporte/excelEmpresa.php');

	//PDF
	elseif($id==901)
		include('presentacion/estudiante/reporte/pdfControlDiarioPracticaV.php');
	
//Sitios Error
	elseif($id==-1)
		include('presentacion/sinPermiso.php');
	else
		include('presentacion/error.php');
	}

	if($id<=800)
	{
?>
<head>
<link rel="SHORTCUT ICON" href="img/icono.jpg" />
<link rel="stylesheet" href="estilos/estilo.css" /> 
<title>SP^2</title>
</head>
<body>
<hr />
<div class="direccion">FUNDACI&Oacute;N UNIVERSITARIA KONRAD LORENZ. Carrera 9 bis # 62-43. Telefono 3472311. Bogota Colombia</div>
<div class="derechos">&copy; <?php echo date("Y") ?> Todos los derechos reservados. SP2 es un producto exclusivo de la Fundaci&oacute;n Universitaria Konrad Lorenz. Prohibida su reproducci&oacute;n total o parcial.<br>Sitio dise&ntilde;ado para resolucion 1024X768<br>Dise&ntilde;ado y Desarrollado por: Hector Florez Fernandez</div>
</body>
<?php } ?>