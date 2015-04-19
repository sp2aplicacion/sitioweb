<?php
require_once('Persona.php'); 
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Administrador extends Persona
	{
	private $fabrica;
	private $conexion;

	function getCodigo()
		{return $this->codigo;}
		
	function Administrador($datos)
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
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 

	function autenticar()
		{
		$this->conexion->ejecutar($this->fabrica->autenticar("administrador",$this->codigo,md5($this->contra)));
		return $this->conexion->filas();
		}   
		
	function consultarNombre()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("administrador","codigo",$this->codigo));		
		$filas=$this->conexion->registro();		
		$this->nombre=$filas[2];
		$this->apellido=$filas[3];
		}   

	function consultar()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("administrador","codigo",$this->codigo));		
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
			);		
		$this->conexion->ejecutar($this->fabrica->actualizar("administrador",$datos,"codigo",$this->codigo));
		}   

	function actualizarContra($c)
		{$this->conexion->ejecutar($this->fabrica->actualizar("administrador",array("contra" => md5($c)),"codigo",$this->codigo));}   
		
	function insertar_cierre40($periodo, $fechaCierre)
	{ 
	  $datos=array(
    		"periodo" => $periodo,
			"fecha_cierre" => $fechaCierre
			);
	  $this->conexion->ejecutar($this->fabrica->insertar("cierre",$datos));
	}
	function actualizar_cierre40($periodo, $fechaCierre)
	{ 
	  $datos=array(
    		"periodo" => $periodo,
			"fecha_cierre" => $fechaCierre
			);
	  $this->conexion->ejecutar($this->fabrica->actualizar("cierre",$datos,"periodo",$periodo));
	}
	function consultar_cierre40($periodo)
	{ 
	  $this->conexion->ejecutar($this->fabrica->consultar("cierre","periodo",$periodo));
      $filas=$this->conexion->registro();
	  return $filas[2];	  
	}

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
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("administrador",$datos));		
		}
		   
	function consultarTodos($orden)
		{
		$this->conexion->ejecutar($this->fabrica->consultarTodos("administrador",$orden));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$administrador = new Administrador($filas);
			$registros[$numReg]=$administrador;
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
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("administrador","count(*)",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}

	function datosCorrectosActualizacionContra()
		{
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			"cedula" => "='".$this->cedula."'",
			"correo" => "='".$this->correo."'",
			);			
		//echo $this->fabrica->consultarCondiciones("administrador","count(*)",$condiciones);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("administrador","count(*)",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}
	function consultarCedula()
		{
		$condiciones=array(
			"codigo" => "='".$this->codigo."'",
			);			
		//echo $this->fabrica->consultarCondiciones("administrador","count(*)",$condiciones);
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("administrador","cedula",$condiciones));	
		$filas=$this->conexion->registro();
		return $filas[0];								
		}
		
	}   	
?>