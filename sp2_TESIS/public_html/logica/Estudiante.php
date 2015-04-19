<?php
require_once('Persona.php'); 
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Estudiante extends Persona
	{
	private $hv;
	private $semestre;
	private $estado;
	private $eps;
	private $observaciones;
	private $facultad;
	private $fabrica;
	private $conexion;
	public $estados=array("Deshabilitado","Desnivelado","Nivelado","Inscrito(1)","Aceptado(1)","Rechazado(1)","Inscrito(2)","Aceptado(2)","Rechazado(2)","Inscrito(3)","Aceptado(3)","Rechazado(3)");
	
	function Estudiante($datos)
		{	 
		$this->codigo=$datos[0];
		$this->cedula=$datos[1];
		$this->nombre=$datos[2];
		$this->apellido=$datos[3];
		$this->contra=$datos[4];
		$this->correo=$datos[5];
		$this->telefono=$datos[6];
		$this->celular=$datos[7];
		$this->direccion=$datos[8];
		$this->hv=$datos[9];
		$this->semestre=$datos[10];
		$this->estado=$datos[11];		
		$this->eps=$datos[12];		
		$this->observaciones=$datos[13];		
		$this->facultad=$datos[14];		
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		}

	function getHv(){
		return $this->hv;}

	function getSemestre(){
		return $this->semestre;}

	function getEstado(){
		return $this->estado;}

	function getEps(){
	return $this->eps;}

	function getFacultad(){
	return $this->facultad;}

	function getObservaciones(){
	return $this->observaciones;}
		
	function registrar(){
		$datos=array(
			"codigo" => $this->codigo,
    		"cedula" => $this->cedula,
    		"nombre" => $this->nombre,
    		"apellido" => $this->apellido,
    		"contra" => md5($this->contra),
    		"correo" => $this->correo,
    		"semestre" => $this->semestre,
    		"estado" => $this->estado,
    		"facultad_id" => $this->facultad,
			);		
		$this->conexion->ejecutar($this->fabrica->insertar("estudiante",$datos));		
		}   

    function sesion(){
		    $this->conexion->ejecutar($this->fabrica->confirmar_sesion("sesion",$this->codigo));
		    return $this->conexion->filas();
		}	   
	
	function verificarEstado(){
	 $this->conexion->ejecutar($this->fabrica->verificarEstado("estudiante",$this->codigo));
	 return $this->conexion->filas();
	}
	
	function iniciar_sesion($sesion){
		    $datos=array(
			"codigo" => $this->codigo,
    		"sesion" => $sesion
			);	
		    $this->conexion->ejecutar($this->fabrica->insertar("sesion",$datos));
		    return $this->conexion->filas();
		}	
    function obtener_sesion(){
		    $this->conexion->ejecutar($this->fabrica->obtener_sesion("sesion",$this->codigo));
		    $filas=$this->conexion->registro();	
            return $filas[0];			
		}
    function eliminar_sesion(){
			$datos=array("codigo" => "='".$this->codigo ."'",);
		    $this->conexion->ejecutar($this->fabrica->eliminarCondiciones("sesion",$datos));
		    return $this->conexion->filas();			
		}		
		
	function autenticar(){
		$this->conexion->ejecutar($this->fabrica->autenticar("estudiante",$this->codigo,md5($this->contra)));
		return $this->conexion->filas();
		}	   
	function consultarNombre(){
		$this->conexion->ejecutar($this->fabrica->consultar("estudiante","codigo",$this->codigo));		
		$filas=$this->conexion->registro();		
		$this->nombre=$filas[2];
		$this->apellido=$filas[3];
		}   

	function consultar(){
		$this->conexion->ejecutar($this->fabrica->consultar("estudiante","codigo",$this->codigo));		
		$filas=$this->conexion->registro();		
		$this->codigo=$filas[0];
		$this->cedula=$filas[1];
		$this->nombre=$filas[2];
		$this->apellido=$filas[3];
		$this->contra=$filas[4];
		$this->correo=$filas[5];
		$this->telefono=$filas[6];
		$this->celular=$filas[7];
		$this->direccion=$filas[8];
		$this->hv=$filas[9];
		$this->semestre=$filas[10];
		$this->estado=$filas[11];		
		$this->eps=$filas[12];		
		$this->observaciones=$filas[13];		
		$this->facultad=$filas[14];		
		}   

	function actualizar(){
		
		$datos=array(
    		"cedula" => $this->cedula,
    		"nombre" => $this->nombre,
    		"apellido" => $this->apellido,
    		"correo" => $this->correo,
    		"telefono" => $this->telefono,
    		"celular" => $this->celular,
    		"direccion" => $this->direccion,
			"semestre" => $this->semestre,
    		"eps" => $this->eps,
    		"observaciones" => $this->observaciones,
			"facultad_id" => $this->facultad,
			);		
		if($this->hv!="")
			$datos["hv"]=$this->hv;
		$this->conexion->ejecutar($this->fabrica->actualizar("estudiante",$datos,"codigo",$this->codigo));	
		}   

	function actualizarContra($c){
	$this->conexion->ejecutar($this->fabrica->actualizar("estudiante",array("contra" => md5($c)),"codigo",$this->codigo));}   

	function actualizarEstado($estado){
		$datos=array(
			"estado" => $estado,
			);						
		$this->conexion->ejecutar($this->fabrica->actualizar("estudiante",$datos,"codigo",$this->codigo));
		}   

	function consultarTodos($orden){
		$atributosTabla1=array();
		$atributosTabla1[0]="codigo";
		$atributosTabla1[1]="cedula";
		$atributosTabla1[2]="nombre";
		$atributosTabla1[3]="apellido";
		$atributosTabla1[4]="contra";
		$atributosTabla1[5]="correo";
		$atributosTabla1[6]="telefono";
		$atributosTabla1[7]="celular";
		$atributosTabla1[8]="direccion";
		$atributosTabla1[9]="hv";
		$atributosTabla1[10]="semestre";
		$atributosTabla1[11]="estado";
		$atributosTabla1[12]="eps";
		$atributosTabla1[13]="observaciones";
		$atributosTabla2=array();
		$atributosTabla2[0]="nombre";		
		$this->conexion->ejecutar($this->fabrica->consultarJoin("estudiante","facultad",$atributosTabla1,$atributosTabla2,"facultad_id","id",$orden));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Estudiante($filas);
			$numReg++;
			}				
		return $registros;
		}   

	function buscar($q,$orden){
		$atributosTabla1=array();
		$atributosTabla1[0]="codigo";
		$atributosTabla1[1]="cedula";
		$atributosTabla1[2]="nombre";
		$atributosTabla1[3]="apellido";
		$atributosTabla1[4]="contra";
		$atributosTabla1[5]="correo";
		$atributosTabla1[6]="telefono";
		$atributosTabla1[7]="celular";
		$atributosTabla1[8]="direccion";
		$atributosTabla1[9]="hv";
		$atributosTabla1[10]="semestre";
		$atributosTabla1[11]="estado";
		$atributosTabla1[12]="eps";
		$atributosTabla1[13]="observaciones";
		$atributosTabla2=array();
		$atributosTabla2[0]="nombre";		
		$claves=array();
		$claves[0]="estudiante.nombre";
		$claves[1]="estudiante.apellido";
		$claves[2]="estudiante.codigo";
		$this->conexion->ejecutar($this->fabrica->buscarJoin("estudiante","facultad",$atributosTabla1,$atributosTabla2,"facultad_id","id",$orden,$claves,$q));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Estudiante($filas);
			$numReg++;
			}				
		return $registros;
		}   

	function correoCorrecto(){
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			"correo" => "='".$this->correo."'",
			);			
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("estudiante","count(*)",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}

	function datosCorrectosActualizacionContra(){
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			"cedula" => "='".$this->cedula."'",
			"correo" => "='".$this->correo."'",
			);			
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("estudiante","count(*)",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}
	function consultarCedula(){
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			);			
		//echo $this->fabrica->consultarCondiciones("administrador","count(*)",$condiciones);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("estudiante","cedula",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}
	
	function consultarFacultad(){
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			);			
		//echo $this->fabrica->consultarCondiciones("administrador","count(*)",$condiciones);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("estudiante","facultad_id",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}
	function seleccionarEstudianteSinConvenio($codigo)
    { 
	    $this->conexion->ejecutar($this->fabrica->seleccionarEstudianteSinConvenio($codigo));
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}
        if($numReg==0)
         return false; // Es un estudiante con convenios
        else 
          return true; // Es un estudiante sin convenios		
    }	
	}   	
?>