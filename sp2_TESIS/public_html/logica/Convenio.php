<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');
require_once('logica/Actividad.php');
require_once('logica/Estudiante.php');

class Convenio
	{
	private $id;
	private $fechaInicial;
	private $fechaFinal;
	private $cuposOfrecidos;
	private $cuposAsignados;
	private $visible;
	private $firmado;
	private $observaciones;
	private $nombre;
	private $periodo;
	private $supervisor;
	private $empresa;
	private $area;
	private $fabria;
	private $conexion;
	private $conexion2;
	public $estados=array("Inscrito","Aceptado","Rechazado");
	
	function Convenio($datos){	 
		$this->id=$datos[0];
		$this->fechaInicial=$datos[1];
		$this->fechaFinal=$datos[2];
		$this->cuposOfrecidos=$datos[3];
		$this->cuposAsignados=$datos[4];
		$this->visible=$datos[5];
		$this->firmado=$datos[6];
		$this->observaciones=$datos[7];
		$this->nombre=$datos[8];
		$this->periodo=$datos[9];
		$this->supervisor=$datos[10];
		$this->empresa=$datos[11];
		$this->area=$datos[12];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		$this->conexion2 = new Conexion();
		} 
		
	function getId(){Return $this->id;}
	function getFechaInicial()
		{return $this->fechaInicial;}
	function getFechaFinal()
		{return $this->fechaFinal;}
	function getCuposOfrecidos()
		{return $this->cuposOfrecidos;}
	function getCuposAsignados()
		{return $this->cuposAsignados;}
	function getVisible()
		{return $this->visible;}
	function getFirmado()
		{return $this->firmado;}
	function getObservaciones()
		{return $this->observaciones;}
	function getNombre()
		{return $this->nombre;}
	function getSupervisor()
		{return $this->supervisor;}
	function getEmpresa()
		{return $this->empresa;}
	function getArea()
		{return $this->area;}
	function getPeriodo()
		{return $this->periodo;}
	function consultarTodosEmpresa($nitEmpresa){
		$atributosTabla1=array();
		$atributosTabla1[0]="id";
		$atributosTabla1[1]="fechaInicial";
		$atributosTabla1[2]="fechaFinal";
		$atributosTabla1[3]="cuposOfrecidos";
		$atributosTabla1[4]="cuposAsignados";
		$atributosTabla1[5]="visible";
		$atributosTabla1[6]="firmado";
		$atributosTabla1[7]="observaciones";
		$atributosTabla1[8]="nombre";
		$atributosTabla1[9]="periodo";
		$atributosTabla1[10]="supervisor";
		$atributosTabla1[11]="empresa_nit";
		$atributosTabla2=array();
		$atributosTabla2[0]="nombre";				
		$condiciones=array(
			"empresa_nit" => "='".$nitEmpresa."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenio","area",$atributosTabla1,$atributosTabla2,"area_id","id","convenio.fechaInicial desc",$condiciones));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Convenio($filas);
			$numReg++;
			}				
		return $registros;
		}   
	function consultarTodosEmpresaPeriodo($nitEmpresa,$periodo){
		$atributosTabla1=array();
		$atributosTabla1[0]="id";
		$atributosTabla1[1]="fechaInicial";
		$atributosTabla1[2]="fechaFinal";
		$atributosTabla1[3]="cuposOfrecidos";
		$atributosTabla1[4]="cuposAsignados";
		$atributosTabla1[5]="visible";
		$atributosTabla1[6]="firmado";
		$atributosTabla1[7]="observaciones";
		$atributosTabla1[8]="nombre";
		$atributosTabla1[9]="periodo";
		$atributosTabla1[10]="supervisor";
		$atributosTabla1[11]="empresa_nit";
		$atributosTabla2=array();
		$atributosTabla2[0]="nombre";				
		$condiciones=array(
			"empresa_nit" => "='".$nitEmpresa."'",
			"periodo" => "='".$periodo."'",			
			);	
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenio","area",$atributosTabla1,$atributosTabla2,"area_id","id","convenio.fechaInicial desc",$condiciones));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Convenio($filas);
			$numReg++;
			}				
		return $registros;
		}   
	function consultarConvenioActividad($id){
		$atributosTabla1=array();
		$atributosTabla2=array();
		$atributosTabla2[0]="id";				
		$atributosTabla2[1]="nombre";				
		$condiciones=array(
			"convenio_id" => "='".$id."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenioactividad","actividad",$atributosTabla1,$atributosTabla2,"actividad_id","id","actividad.nombre",$condiciones));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Actividad($filas);
			$numReg++;
			}				
		return $registros;
		}   
	function insertar(){
		$datos=array(
			"fechaInicial" => $this->fechaInicial,
    		"fechaFinal" => $this->fechaFinal,
    		"cuposOfrecidos" => $this->cuposOfrecidos,
    		"visible" => $this->visible,
    		"firmado" => $this->firmado,
    		"observaciones" => $this->observaciones,
    		"nombre" => $this->nombre,
    		"periodo" => $this->periodo,
    		"supervisor" => $this->supervisor,
			"empresa_nit" => $this->empresa,
    		"area_id" => $this->area,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("convenio",$datos));
				
		}   
	function copiar(){
		$datos=array(
			"fechaInicial" => $this->fechaInicial,
    		"fechaFinal" => $this->fechaFinal,
    		"cuposOfrecidos" => $this->cuposOfrecidos,
    		"observaciones" => $this->observaciones,
    		"nombre" => $this->nombre,
    		"periodo" => $this->periodo,
    		"supervisor" => $this->supervisor,
			"empresa_nit" => $this->empresa,
    		"area_id" => $this->area,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("convenio",$datos));		
		}   
	function insertarActividad($idConvenio,$idActividad){
		$datos=array(
			"convenio_id" => $idConvenio,
    		"actividad_id" => $idActividad,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("convenioactividad",$datos));		
		}   
	function consultarId(){
		$this->conexion->ejecutar($this->fabrica->consultarEspecificacion("convenio","max(id)"));		
		$filas=$this->conexion->registro();		
		return $filas[0];
		}   
	function actualizar(){
		$datos=array(			
			"id" => $this->id,
			"fechaInicial" => $this->fechaInicial,
    		"fechaFinal" => $this->fechaFinal,
    		"cuposOfrecidos" => $this->cuposOfrecidos,
    		"observaciones" => $this->observaciones,
    		"nombre" => $this->nombre,
    		"periodo" => $this->periodo,
    		"supervisor" => $this->supervisor,
			"area_id" => $this->area,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("convenio",$datos,"id",$this->id));
		}   
	function actualizarVisible($visible){
		$datos=array(
			"visible" => $visible,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("convenio",$datos,"id",$this->id));
		}   
	function actualizarFirmado($firmado){
		$datos=array(
			"firmado" => $firmado,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("convenio",$datos,"id",$this->id));
		}   
	function actualizarEstadoEstudiante($estado,$idEstudiante){
		$datos=array(
			"estado" => $estado,
			"fechaMEstado" => date("Y-m-d"),
			"horaMEstado" => date("H:i:s"),
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("convenioestudiante",$datos,"estudiante_codigo='".$idEstudiante."' and convenio_id",$this->id));
		}		
	function eliminarActividades(){
	$this->conexion->ejecutar($this->fabrica->eliminar("convenioactividad","convenio_id",$this->id));}   
	function consultar(){
		$this->conexion->ejecutar($this->fabrica->consultar("convenio","id",$this->id));		
		$filas=$this->conexion->registro();		
		$this->id=$filas[0];
		$this->fechaInicial=$filas[1];
		$this->fechaFinal=$filas[2];
		$this->cuposOfrecidos=$filas[3];
		$this->cuposAsignados=$filas[4];
		$this->visible=$filas[5];
		$this->firmado=$filas[6];
		$this->observaciones=$filas[7];
		$this->nombre=$filas[8];
		$this->periodo=$filas[9];
		$this->supervisor=$filas[10];
		$this->empresa=$filas[11];
		$this->area=$filas[12];
		}   
	function consultarPeriodos(){
		$this->conexion->ejecutar($this->fabrica->consultarEspecificacion("convenio","distinct(periodo)","periodo desc"));	
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas[0];
			$numReg++;
			}				
		return $registros;
		}   
	function inscribirEstudiante($idEstudiante){
		$datos=array(
			"convenio_id" => $this->id,
    		"estudiante_codigo" => $idEstudiante,
    		"fechaAplicacion" => date("Y-m-d"),
    		"horaAplicacion" => date("H:i:s"),
    		"estado" => 0,
			);
		$this->conexion->ejecutar($this->fabrica->insertar("convenioestudiante",$datos));		
		}   
	function actualizarCuposAsignados($cupos){
		$datos=array(
			"cuposasignados" => $cupos,
			);						
		$this->conexion->ejecutar($this->fabrica->actualizar("convenio",$datos,"id",$this->id));
		}   
	function consultarEstadoEstudiante($idEstudiante){
		$this->conexion->ejecutar($this->fabrica->consultar("estudiante","codigo",$idEstudiante));		
		$filas=$this->conexion->registro();
		return $filas[11];		
		}   
	function consultarAplicantes(){
		$this->conexion->ejecutar($this->fabrica->consultar("convenioestudiante","convenio_id",$this->id));		
		return $this->conexion->filas();		
		}   
	function consultarEstadoEstudianteConvenio($idEstudiante){
		$condiciones=array(
			"convenio_id" => "='".$this->id."'",	
			"estudiante_codigo" => "='".$idEstudiante."'",						
			);	
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("convenioestudiante","estado",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];		
		}   
	function consultarConvenioEstudiante($id){
		$atributosTabla1=array();
		$atributosTabla1[0]="codigo";				
		$atributosTabla1[1]="nombre";				
		$atributosTabla1[2]="apellido";				
		$atributosTabla1[3]="estado";				
		$atributosTabla2=array();
		$atributosTabla2[0]="estado";
		$atributosTabla2[1]="fechaMestado";
		$atributosTabla2[2]="horaMestado";		
		$atributosTabla2[3]="fechaAplicacion";		
		$atributosTabla2[4]="horaAplicacion";		
		$condiciones=array(
			"convenio_id" => "='".$id."'",			
			);	
		$this->conexion->ejecutar($this->fabrica->consultarJoin("estudiante","convenioestudiante",$atributosTabla1,$atributosTabla2,"codigo","estudiante_codigo","estudiante.apellido",$condiciones));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$datos[0]=$filas[0];
			$datos[2]=$filas[1];
			$datos[3]=$filas[2];
			$datos[11]=$filas[3];			
			$registros[$numReg][0]=new Estudiante($datos);
			$registros[$numReg][1]=$filas[4];
			$registros[$numReg][2]=$filas[5];
			$registros[$numReg][3]=$filas[6];
			$registros[$numReg][4]=$filas[7];
			$registros[$numReg][5]=$filas[8];
			$numReg++;
			}				
		return $registros;
		}   
	function conveniosPeriodo($area,$periodo){
		$atributosTabla1=array();
		$atributosTabla1[0]="id";
		$atributosTabla1[1]="fechaInicial";
		$atributosTabla1[2]="fechaFinal";
		$atributosTabla1[3]="cuposOfrecidos";
		$atributosTabla1[4]="cuposAsignados";
		$atributosTabla1[5]="visible";
		$atributosTabla1[6]="firmado";
		$atributosTabla1[7]="observaciones";
		$atributosTabla1[8]="nombre";
		$atributosTabla2=array();
		$atributosTabla2[0]="nombre";
		$atributosTabla2[1]="nit";
		$condiciones=array(
    		"convenio.periodo" => "='".$periodo."'",
    		"convenio.area_id" => "='".$area."'",
			);		
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenio","empresa",$atributosTabla1,$atributosTabla2,"empresa_nit","nit","empresa.nombre",$condiciones));
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Convenio($filas);
			$numReg++;		
			}
		return $registros;			
		}   
	function conveniosPeriodoParaCopia($area,$periodo){
		$atributosTabla1=array();
		$atributosTabla1[0]="id";
		$atributosTabla1[1]="fechaInicial";
		$atributosTabla1[2]="fechaFinal";
		$atributosTabla1[3]="cuposOfrecidos";
		$atributosTabla1[4]="cuposAsignados";
		$atributosTabla1[5]="visible";
		$atributosTabla1[6]="firmado";
		$atributosTabla1[7]="observaciones";
		$atributosTabla1[8]="nombre";
		$atributosTabla1[9]="supervisor";
		$atributosTabla2=array();
		$atributosTabla2[0]="nit";
		$atributosTabla2[1]="nombre";
		$condiciones=array(
    		"convenio.periodo" => "='".$periodo."'",
    		"convenio.area_id" => "='".$area."'",
			);		
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenio","empresa",$atributosTabla1,$atributosTabla2,"empresa_nit","nit","empresa.nombre",$condiciones));
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;		
			}
		return $registros;			
		}   
	function consultarConvenioEstudianteSupervisor($idConvenio,$codEstudiante){
		$condiciones=array(
			"convenioestudiante_estudiante_codigo" => "='".$codEstudiante."'",
			"convenioestudiante_convenio_id" => "='".$idConvenio."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("convenioestudiantesupervisor","supervisor_codigo", $condiciones));		
		$filas=$this->conexion->registro();
		return $filas[0];
		}   
	function asignarConvenioEstudianteSupervisor($idEstudiante,$idSupervisor){
		$datos=array(
			"convenioestudiante_estudiante_codigo" => $idEstudiante,
    		"convenioestudiante_convenio_id" => $this->id,
    		"supervisor_codigo" => $idSupervisor,
    		"estado" => 0,
			);
		$this->conexion->ejecutar($this->fabrica->insertar("convenioestudiantesupervisor",$datos));		
		}
	function InsertarCronogramaConvenioEstudianteSupervisor($idConEstSup,$cronograma){
		$datos=array("cronograma" => $cronograma);
		$this->conexion->ejecutar($this->fabrica->actualizar("convenioestudiantesupervisor",$datos,'id',$idConEstSup));		
		}   		
 	function consultarCronograma($idConEstSup){
		
		$where=array("id" => "=".$idConEstSup);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("convenioestudiantesupervisor",'cronograma',$where));
		$filas=$this->conexion->registro();
		return $filas[0];		
		}  
	function retirarConvenioEstudianteSupervisor($idEstudiante,$idSupervisor){
		$condiciones=array(
			"convenioestudiante_estudiante_codigo" => "='".$idEstudiante."'",
			"convenioestudiante_convenio_id" => "='".$this->id."'",
			"supervisor_codigo" => "='".$idSupervisor."'",
			);	
		$this->conexion->ejecutar($this->fabrica->eliminarCondiciones("convenioestudiantesupervisor",$condiciones));		
		}   
	function consultarEstudiantesAsignadosSupervisor($idSupervisor,$periodo){
		$atributosTabla1=array();
		$atributosTabla1[0]="codigo";
		$atributosTabla1[1]="cedula";
		$atributosTabla1[2]="nombre";
		$atributosTabla1[3]="apellido";
		$atributosTabla1[4]="correo";
		$atributosTabla1[5]="telefono";
		$atributosTabla1[6]="celular";
		$atributosTabla1[7]="hv";
		$atributosTabla2=array();
		$atributosTabla2[0]="id";
		$atributosTabla3=array();
		$atributosTabla3[0]="id";
		$atributosTabla3[1]="nombre";
		$atributosTabla3[2]="periodo";
		$atributosTabla3[3]="empresa_nit";
		$atributosTabla3[4]="area_id";
		$condiciones=array(
			"convenioestudiantesupervisor.supervisor_codigo" => "='".$idSupervisor."'",
			"convenio.periodo" => "='".$periodo."'",			
			);	
		$this->conexion->ejecutar($this->fabrica->consultarDobleJoin("estudiante","convenioestudiantesupervisor","convenio",$atributosTabla1,$atributosTabla2,$atributosTabla3,"codigo","convenioestudiante_estudiante_codigo","convenioestudiante_convenio_id","id","convenio.periodo desc, estudiante.apellido asc",$condiciones));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;
		}   
	function consultarSupervisionEstudiante($idEstudiante){
		$atributosTabla1=array();
		$atributosTabla1[0]="codigo";
		$atributosTabla1[1]="cedula";
		$atributosTabla1[2]="nombre";
		$atributosTabla1[3]="apellido";
		$atributosTabla1[4]="correo";
		$atributosTabla1[5]="telefono";
		$atributosTabla1[6]="celular";
		$atributosTabla2=array();
		$atributosTabla2[0]="id";
		$atributosTabla3=array();
		$atributosTabla3[0]="id";
		$atributosTabla3[1]="nombre";
		$atributosTabla3[2]="periodo";
		$atributosTabla3[3]="empresa_nit";
		$atributosTabla3[4]="area_id";
		$condiciones=array(
			"convenioestudiantesupervisor.convenioestudiante_estudiante_codigo" => "='".$idEstudiante."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarDobleJoin("supervisor","convenioestudiantesupervisor","convenio",$atributosTabla1,$atributosTabla2,$atributosTabla3,"codigo","supervisor_codigo","convenioestudiante_convenio_id","id","convenio.periodo desc",$condiciones));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;
		}   
	function consultarHorarioSupervision($idConEstSup){
		$this->conexion->ejecutar($this->fabrica->consultar("horariosupervision","convenioestudiantesupervisor_id",$idConEstSup,"tipo, dia, horaInicial"));
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;		
		}
	function insertarHorarioSupervision($dia,$horaInicio,$horaFin,$tipo,$idConEstSup){
		$datos=array(
			"dia" => $dia,
    		"horaInicial" => $horaInicio,
    		"horaFinal" => $horaFin,
    		"tipo" => $tipo,
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		$this->conexion->ejecutar($this->fabrica->insertar("horariosupervision",$datos));
		}
	function eliminarHorarioSupervision($idHorarioElim){
		$this->conexion->ejecutar($this->fabrica->eliminar("horariosupervision","id",$idHorarioElim));
		}
	function insertarSeguimientoQuincenalSupervision($fecha,$hora,$tema,$idConEstSup){
		$datos=array(
			"fecha" => $fecha,
    		"hora" => $hora,
    		"tema" => $tema,
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		$this->conexion->ejecutar($this->fabrica->insertar("seguimientoquincenalsupervision",$datos));
		}
	function consultarSeguimientoQuincenalSupervision($idConEstSup){
		$this->conexion->ejecutar($this->fabrica->consultar("seguimientoquincenalsupervision","convenioestudiantesupervisor_id",$idConEstSup,"fecha desc, hora desc"));
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;		
		}	
	function eliminarSeguimientoQuincenalSupervision($idSeguimientoElim)	{
		$this->conexion->ejecutar($this->fabrica->eliminar("seguimientoquincenalsupervision","id",$idSeguimientoElim));
		}
	function consultarEstudiantesInscritosPeriodo($area,$periodo)	{
		$atributosTabla1=array();
		$atributosTabla1[0]="estudiante_codigo";				
		$atributosTabla2=array();
		$atributosTabla2[0]="id";				
		$atributosTabla2[1]="nombre";				
		$condiciones=array(
			"convenio.periodo" => "='".$periodo."'",
			"convenio.area_id" => "='".$area."'",
			"convenioestudiante.estado" => "='1'",
			);				
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenioestudiante","convenio",$atributosTabla1,$atributosTabla2,"convenio_id","id","convenioestudiante.estudiante_codigo, convenioestudiante.fechaAplicacion desc, convenioestudiante.horaAplicacion desc",$condiciones));	
		$registros = array();
		$numReg=0;
		while($filasConvenioEstudiante=$this->conexion->registro())
			{
			$this->conexion2->ejecutar($this->fabrica->consultar("estudiante","codigo",$filasConvenioEstudiante[0]));
			$filasEstudiante=$this->conexion2->registro();
			
			$atributosTabla1=array();
			$atributosTabla1[0]="nit";
			$atributosTabla1[1]="nombre";
			$atributosTabla2=array();
			$condiciones=array(
	    		"convenio.id" => "='".$filasConvenioEstudiante[1]."'",
				);
			$this->conexion2->ejecutar($this->fabrica->consultarJoin("empresa","convenio",$atributosTabla1,$atributosTabla2,"nit","empresa_nit","empresa.nombre",$condiciones));
			$filasEmpresaCovenio=$this->conexion2->registro();		

			$atributosTabla1=array();
			$atributosTabla1[0]="codigo";
			$atributosTabla1[1]="nombre";
			$atributosTabla1[2]="apellido";
			$atributosTabla2=array();
			$atributosTabla2[0]="id";
			$condiciones=array(
	    		"convenioestudiantesupervisor.convenioestudiante_convenio_id" => "='".$filasConvenioEstudiante[1]."'",
	    		"convenioestudiantesupervisor.convenioestudiante_estudiante_codigo" => "='".$filasConvenioEstudiante[0]."'",
				);
			$this->conexion2->ejecutar($this->fabrica->consultarJoin("supervisor","convenioestudiantesupervisor",$atributosTabla1,$atributosTabla2,"codigo","supervisor_codigo","supervisor.apellido",$condiciones));
			$filasSupervisor=$this->conexion2->registro();		

			$registros[$numReg][0]=$filasConvenioEstudiante;
			$registros[$numReg][1]=$filasEstudiante;
			$registros[$numReg][2]=$filasEmpresaCovenio;			
			$registros[$numReg][3]=$filasSupervisor;			
			$numReg++;									
			}			
		return $registros;			
		}   
    function consultarConvenioEstudianteSupervisor2($estudiante,$area){		
	    $registros=array();
		$this->conexion->ejecutar($this->fabrica->consultarConvenioEstudianteSupervisor($estudiante,$area));
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			//echo($registros[$numReg][0]);
			$numReg++;
			}				
		return $registros; 
	}
    function consultarEstudiantespPorPeriodo($area,$periodo){
		
		$atributosTabla1=array();
		$atributosTabla1[0]="codigo";
		$atributosTabla1[1]="apellido";		
		$atributosTabla1[2]="nombre";	
		$atributosTabla2=array();
		$atributosTabla3=array();		
		$condiciones=array(
			"convenio.periodo" => "='".$periodo."'",
			"convenio.area_id" => "='".$area."'",
			"convenioestudiante.estado" => "='1'",
			);				

		$this->conexion->ejecutar($this->fabrica->consultarDobleJoin("estudiante","convenioestudiante","convenio",$atributosTabla1,$atributosTabla2,$atributosTabla3,"codigo","estudiante_codigo","convenio_id", "id","apellido",$condiciones));	
		
//		$this->conexion->ejecutar($this->fabrica->consultarEstudiantespPorPeriodo($area,$periodo));	
		$registros = array();
		$numReg=0;
		
		while($filas=$this->conexion->registro())
			{
			  //echo($filas[0]);
	   		  $registros[$numReg][0]=$filas;					  
			  $numReg++;									
			}		
   //     echo("numero de registros:" .$numReg);			
		return $registros;			
		} 
	function insertarControlDiarioPractica($fecha,$horaEntrada,$horaSalida,$duracion,$actividades,$idConEstSup){
	
		$datos=array(
			"fecha" => $fecha,
    		"horaEntrada" => $horaEntrada,
    		"horaSalida" => $horaSalida,
    		"duracion" => $duracion,
    		"actividades" => $actividades,
    		"fechaRegistro" => date("Y-m-d"),
    		"horaRegistro" => date("H:i"),
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		$this->conexion->ejecutar($this->fabrica->insertar("controldiariopractica",$datos));
		}
	function actualizarControlDiarioPractica($idCDP,$fecha,$horaEntrada,$horaSalida,$duracion,$actividades,$idConEstSup){
		$datos=array(
			"fecha" => $fecha,
    		"horaEntrada" => $horaEntrada,
    		"horaSalida" => $horaSalida,
    		"duracion" => $duracion,
    		"actividades" => $actividades,
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		$this->conexion->ejecutar($this->fabrica->actualizar("controldiariopractica",$datos,"id",$idCDP));
		}
	function habilitarEdicion($idCDP){
		$datos=array(
    		"fechaRegistro" => date("Y-m-d"),
    		"horaRegistro" => date("H:i"),
			);		
		if($this->conexion->ejecutar($this->fabrica->actualizar("controldiariopractica",$datos,"id",$idCDP)))
		   return true;
		else 
		   return false;
		}
	function eliminarActividad($idCDP){		
		if($this->conexion->ejecutar($this->fabrica->eliminar("controldiariopractica","id",$idCDP)))
		   return true;
		else 
		   return false;
		}
	function consultarControlDiarioPractica($idConEstSup){
		$this->conexion->ejecutar($this->fabrica->consultar("controldiariopractica","convenioestudiantesupervisor_id",$idConEstSup,"fecha desc, horaEntrada desc"));
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;		
		}	
	function consultarControlDiarioPracticaId($idCDP){
		$this->conexion->ejecutar($this->fabrica->consultar("controldiariopractica","id",$idCDP));
		$filas=$this->conexion->registro();
		return $filas;		
		}	
	function consultarControlDiarioPracticaFecha($idConEstSup,$fechaInicial,$fechaFinal){
		$condiciones=array(
    		"convenioestudiantesupervisor_id" => "='".$idConEstSup."'",
    		"fecha" => ">='".$fechaInicial."' and fecha<='".$fechaFinal."'",
			);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("controldiariopractica","*",$condiciones,"fecha"));
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;		
		}	
	function consultarDatosReportePDF($idConEstSup){
		$atributosTabla1=array();
		$atributosTabla1[0]="codigo";
		$atributosTabla1[1]="cedula";
		$atributosTabla1[2]="nombre";
		$atributosTabla1[3]="apellido";
		$atributosTabla1[4]="correo";
		$atributosTabla1[5]="telefono";
		$atributosTabla1[6]="celular";
		$atributosTabla2=array();
		$atributosTabla2[0]="id";
		$atributosTabla3=array();
		$atributosTabla3[0]="id";
		$atributosTabla3[1]="nombre";
		$atributosTabla3[2]="periodo";
		$atributosTabla3[3]="supervisor";
		$atributosTabla3[4]="empresa_nit";
		$atributosTabla3[5]="area_id";
		$condiciones=array(
			"convenioestudiantesupervisor.id" => "='".$idConEstSup."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarDobleJoin("supervisor","convenioestudiantesupervisor","convenio",$atributosTabla1,$atributosTabla2,$atributosTabla3,"codigo","supervisor_codigo","convenioestudiante_convenio_id","id","convenio.periodo",$condiciones));		
		$registros = array();
		$numReg=0;
		return $this->conexion->registro();
		}   	
	function consultarNumeroSesion($idConEstSup){
		$condiciones=array(
    		"convenioestudiantesupervisor_id" => "='".$idConEstSup."'",
			);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("sesionsupervision","count(*)",$condiciones));
		$filas=$this->conexion->registro();
		return $filas[0];		
		}	
	function consultarIdMaxSesionSupervision(){
		$this->conexion->ejecutar($this->fabrica->consultarEspecificacion("sesionsupervision","max(id)"));
		$filas=$this->conexion->registro();
		return $filas[0];		
		}	
	function insertarSesionUnoSupervision($fecha,$horaInicio,$horaFinal,$puntualidad,$objetivos,$bitacora,$compromisos,$planMejoramiento,$observaciones,$idConEstSup){
		$datos=array(
			"numSesion" => "1",
			"fecha" => $fecha,
    		"horaInicio" => $horaInicio,
    		"horaFinal" => $horaFinal,
    		"asistencia" => "1",
    		"puntualidad" => $puntualidad,
    		"objetivos" => $objetivos,
    		"bitacora" => $bitacora,
    		"compromisos" => $compromisos,
			"planMejoramiento" => $planMejoramiento,
    		"observaciones" => $observaciones,
    		"fechaRegistro" => date("Y-m-d"),
    		"horaRegistro" => date("H:i"),
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		$this->conexion->ejecutar($this->fabrica->insertar("sesionsupervision",$datos));
		}
	function insertarSesionUnoInasistenciaSupervision($fecha,$horaInicio,$horaFinal,$observacionesInasistencia,$idConEstSup){
		$datos=array(
			"numSesion" => "1",
			"fecha" => $fecha,
    		"horaInicio" => $horaInicio,
    		"horaFinal" => $horaFinal,
    		"asistencia" => "0",
    		"observacionesInasistencia" => $observacionesInasistencia,
    		"fechaRegistro" => date("Y-m-d"),
    		"horaRegistro" => date("H:i"),
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		$this->conexion->ejecutar($this->fabrica->insertar("sesionsupervision",$datos));
		}
	function insertarSesionDiferenteUnoSupervision($numSesion,$fecha,$horaInicio,$horaFinal,$calificacionSesion,$puntualidad,$calificacionCumplimientoCompromisos,$objetivos,$aspectos,$calificacionAspectos,$bitacora,$compromisos,$planMejoramiento,$observaciones,$idConEstSup){
		
		if($calificacionSesion!="NA")
		{
			//echo("Tienes un valor");
			$datos=array(
			"numSesion" => $numSesion,
			"fecha" => $fecha,
    		"horaInicio" => $horaInicio,
    		"horaFinal" => $horaFinal,
    		"calificacionSesion" => $calificacionSesion,
    		"asistencia" => "1",
    		"puntualidad" => $puntualidad,
    		"calificacionCumplimientoCompromisos" => $calificacionCumplimientoCompromisos,
    		"objetivos" => $objetivos,
    		"aspectos" => $aspectos,
    		"calificacionAspectos" => $calificacionAspectos,
    		"compromisos" => $compromisos,
    		"bitacora" => $bitacora,
			"planMejoramiento" => $planMejoramiento,
    		"observaciones" => $observaciones,
			"fechaRegistro" => date("Y-m-d"),
    		"horaRegistro" => date("H:i"),
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		}
		else
		{
			//echo("NOOOOO Tienes un valor");
			$datos=array(
			"numSesion" => $numSesion,
			"fecha" => $fecha,
    		"horaInicio" => $horaInicio,
    		"horaFinal" => $horaFinal,
    		"asistencia" => "1",
    		"puntualidad" => $puntualidad,
    		"calificacionCumplimientoCompromisos" => $calificacionCumplimientoCompromisos,
    		"objetivos" => $objetivos,
    		"aspectos" => $aspectos,
    		"calificacionAspectos" => $calificacionAspectos,
    		"compromisos" => $compromisos,
    		"bitacora" => $bitacora,
			"planMejoramiento" => $planMejoramiento,
    		"observaciones" => $observaciones,
			"fechaRegistro" => date("Y-m-d"),
    		"horaRegistro" => date("H:i"),
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		}

		$this->conexion->ejecutar($this->fabrica->insertar("sesionsupervision",$datos));
		}
	function nota40 ($ces, $fecha_cierre){
	  $this->conexion->ejecutar($this->fabrica->nota40($ces,$fecha_cierre));
	  $filas=$this->conexion->registro();
	  return $filas[0];
	}
	function nota60 ($ces, $fecha_cierre){
	  $this->conexion->ejecutar($this->fabrica->nota60($ces, $fecha_cierre));
	  $filas=$this->conexion->registro();
	  return $filas[0];
	}
	function fecha_cierre($periodo){
	   $this->conexion->ejecutar($this->fabrica->fecha_cierre($periodo));
	   $filas=$this->conexion->registro();
	   return $filas[0];
	}
	function insertarSesionDiferenteUnoInasistenciaSupervision($numSesion,$fecha,$horaInicio,$horaFinal,$observacionesInasistencia,$idConEstSup)	{
		$datos=array(
			"numSesion" => $numSesion,
			"fecha" => $fecha,
    		"horaInicio" => $horaInicio,
    		"horaFinal" => $horaFinal,
    		"calificacionSesion" => "0",
    		"asistencia" => "0",
    		"observacionesInasistencia" => $observacionesInasistencia,
    		"fechaRegistro" => date("Y-m-d"),
    		"horaRegistro" => date("H:i"),
    		"convenioestudiantesupervisor_id" => $idConEstSup,
			);		
		$this->conexion->ejecutar($this->fabrica->insertar("sesionsupervision",$datos));
		}
	function insertarIndicadorSesion($competencia,$indicador,$calificacionIndicador,$idSesion)		{
		$datos=array(
			"competencia" => $competencia,
			"indicador" => $indicador,
    		"calificacionIndicador" => $calificacionIndicador,
    		"sesionsupervision_id" => $idSesion,
			);		
		$this->conexion->ejecutar($this->fabrica->insertar("indicadoressesion",$datos));
		}
	function consultarSesionsupervision($idConEstSup)	{
		$this->conexion->ejecutar($this->fabrica->consultar("sesionsupervision","convenioestudiantesupervisor_id ",$idConEstSup,"numSesion desc"));
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}					
		return $registros;
		}	
	function consultarIndicadoresSesionSupervision($idSesionSupervision)	{
		$this->conexion->ejecutar($this->fabrica->consultar("indicadoressesion","sesionsupervision_id",$idSesionSupervision,"id"));
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}					
		return $registros;
		}

	   function eliminarEstudiante($idEstElim){
		$this->conexion->ejecutar($this->fabrica->eliminar("estudiante","codigo",$idEstElim));		
		}
	   function eliminarSupervisor($idSupElim){
		$this->conexion->ejecutar($this->fabrica->eliminar("supervisor","codigo",$idSupElim));		
		}			
		function eliminarSesionSupervision($idSesionElim){
		$this->conexion->ejecutar($this->fabrica->eliminar("indicadoressesion","sesionsupervision_id",$idSesionElim));
		$this->conexion->ejecutar($this->fabrica->eliminar("sesionsupervision","id",$idSesionElim));		
		}   
	function retirarEstudianteConvenio($idEstudiante){
		$condiciones=array(
    		"convenio_id" => "='".$this->id."'",
    		"estudiante_codigo" => "='".$idEstudiante."'",
			);
		$this->conexion->ejecutar($this->fabrica->eliminarCondiciones("convenioestudiante",$condiciones));
		$estudiante=new Estudiante(array($idEstudiante));
		$estudiante->consultar();
		$estudiante->actualizarEstado($estudiante->getEstado()-1);
		}   
	function eliminarConvenio(){
		$this->conexion->ejecutar($this->fabrica->eliminar("convenioactividad","convenio_id",$this->id));
		$this->conexion->ejecutar($this->fabrica->eliminar("convenio","id",$this->id));
		}   
	function consultarSupervisorAsignado($idEstudiante){
		$condiciones=array(
    		"convenioestudiante_estudiante_codigo" => "='".$idEstudiante."'",
    		"convenioestudiante_convenio_id" => "='".$this->id."'",
		);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("convenioestudiantesupervisor", "supervisor_codigo", $condiciones));
		$filas=$this->conexion->registro();
		return $filas[0];
		}   
	function inhabilitarEstudiantes(){
		  if($this->conexion->ejecutar($this->fabrica->inhabilitarEstudiantes()))
		  {
			$numReg=0;
		    while($filas=$this->conexion->registro())
			{
			  $registros[$numReg]=$filas;
			  $numReg++;
			  //echo($filas[0]." ");
			  $this->inhabilitarEstudiante($filas[0]);
			}	    
			
		  }		  
		}
	function inhabilitarEstudiante($codigo){
		  $this->conexion2->ejecutar($this->fabrica->inhabilitarEstudiante($codigo));
		}
	function consultarPeriodo($idces){
	     $this->conexion->ejecutar($this->fabrica->consultarPeriodo($idces));
		 $filas=$this->conexion->registro();
		 $filas[0];
		 return $filas[0];
	   }
	function cerrarPeriodo(){

	    if($this->conexion->ejecutar($this->fabrica->nivelar_estudiantes()))
		  {
			$numReg=0;
		    while($filas=$this->conexion->registro())
			{
			  $registros[$numReg]=$filas;
			  $numReg++;
			  //echo($filas[0]." ");
			  $this->nivelar_estudiante($filas[0]);
			}	    
		}	
	
        $datos=array(
			"visible" => "0",
			);		  
		$this->conexion->ejecutar($this->fabrica->actualizarTodo("convenio",$datos));
		$this->conexion->ejecutar($this->fabrica->actualizarTodo("empresa",$datos));
	}   
	function nivelar_estudiante ($codigo){
	   $this->conexion2->ejecutar($this->fabrica->nivelar_estudiante($codigo));
	}
	function supervisores (){
	    $this->conexion->ejecutar($this->fabrica->consultarTodos("supervisor","apellido, nombre"));
		$numReg=0;
		while($filas=$this->conexion->registro())
		{
			$registros[$numReg]=$filas;
			$numReg++;
		}					
		return $registros;
    }	
    function actualizarsupervisor ($id,$supervisor){
	 	$datos=array(
			"supervisor_codigo" => $supervisor
			);		
		$this->conexion->ejecutar($this->fabrica->actualizar("convenioestudiantesupervisor",$datos,"id",$id));
	}
	}   	
?>