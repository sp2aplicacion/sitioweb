<?php
require_once('Persona.php'); 
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Supervisor extends Persona
	{
	private $profesion;
	private $facultad;
	private $area;
	private $fabrica;

	function getProfesion()
		{return $this->profesion;}
		
	function getFacultad()
		{return $this->facultad;}

	function Supervisor($datos)
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
		$this->profesion=$datos[9];
		$this->facultad=$datos[10];
		$this->area=$datos[11];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 

	function autenticar()
		{
		$this->conexion->ejecutar($this->fabrica->autenticar("supervisor",$this->codigo,md5($this->contra)));
		return $this->conexion->filas();
		}   
		
	function consultarNombre()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("supervisor","codigo",$this->codigo));		
		$filas=$this->conexion->registro();		
		$this->nombre=$filas[2];
		$this->apellido=$filas[3];
		}   

	function consultar()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("supervisor","codigo",$this->codigo));		
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
		$this->profesion=$filas[9];
		$this->facultad=$filas[10];
		$this->area=$filas[11];
		}   

	function actualizar()
		{
		$datos=array(
    		"cedula" => $this->cedula,
    		"nombre" => $this->nombre,
    		"apellido" => $this->apellido,
    		"correo" => $this->correo,
    		"telefono" => $this->telefono,
    		"celular" => $this->celular,
    		"direccion" => $this->direccion,
    		"profesion" => $this->profesion,
    		"facultad_id" => $this->facultad,
    		"area_id" => $this->area,
			);		
		$this->conexion->ejecutar($this->fabrica->actualizar("supervisor",$datos,"codigo",$this->codigo));
		}   

	function actualizarContra($c)
		{$this->conexion->ejecutar($this->fabrica->actualizar("supervisor",array("contra" => md5($c)),"codigo",$this->codigo));}   

	function insertar()
		{
		$datos=array(
    		"codigo" => $this->codigo,
			"cedula" => $this->cedula,
    		"nombre" => $this->nombre,
    		"apellido" => $this->apellido,
    		"contra" => md5($this->cedula),
    		"correo" => $this->correo,
    		"telefono" => $this->telefono,
    		"celular" => $this->celular,
    		"direccion" => $this->direccion,
    		"profesion" => $this->profesion,
    		"facultad_id" => $this->facultad,
    		"area_id" => $this->area,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("supervisor",$datos));		
		}
		   
	function consultarTodos($orden)
		{
		
		$this->conexion->ejecutar($this->fabrica->consultarTodos("supervisor","area_id"));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Supervisor($filas);
			$numReg++;
			}				
		return $registros;
		}   

	function correoCorrecto()
		{
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			"correo" => "='".$this->correo."'",
			);			
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("supervisor","count(*)",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}

	function buscar($q,$orden)
		{
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
		$atributosTabla1[9]="profesion";
		$atributosTabla2=array();
		$atributosTabla2[0]="nombre";		
		$claves=array();
		$claves[0]="supervisor.nombre";
		$claves[1]="supervisor.apellido";
		$this->conexion->ejecutar($this->fabrica->buscarJoin("supervisor","facultad",$atributosTabla1,$atributosTabla2,"facultad_id","id",$orden,$claves,$q));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Supervisor($filas);
			$numReg++;
			}				
		return $registros;
		}   
		
	function datosCorrectosActualizacionContra()
		{
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			"cedula" => "='".$this->cedula."'",
			"correo" => "='".$this->correo."'",
			);			
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("estudiante","count(*)",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}
		function consultarCedula()
		{
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			);			
		//echo $this->fabrica->consultarCondiciones("administrador","count(*)",$condiciones);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("supervisor","cedula",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}
		function seleccionarsupervisorSinConvenio ($codigo)
		{
	    $this->conexion->ejecutar($this->fabrica->seleccionarSupervisorSinConvenio($codigo));
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