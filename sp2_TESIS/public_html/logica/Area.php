<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Area
	{
	private $id;
	private $nombre;
	private $responsable;
	private $id_programa;
	private $visible;
	private $fabrica;
	private $conexion;
	
	function Area($datos)
		{	 
		$this->id=$datos[0];
		$this->nombre=$datos[1];
		$this->responsable=$datos[2];
		$this->id_programa=$datos[3];
		$this->visible=$datos[4];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 
		
	function getId()
		{return $this->id;}

	function getNombre()
		{return $this->nombre;}

	function getResponsable()
		{return $this->responsable;}

	function getPrograma()
		{return $this->id_programa;}

	function getVisible()
		{return $this->visible;}	
		
	function consultarTodos()
		{
		$this->conexion->ejecutar($this->fabrica->consultarTodos("area","id_programa"));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Area($filas);
			$numReg++;
			}				
		return $registros;
		}   

	function insertar()
		{
		$datos=array(
			"nombre" => $this->nombre,
    		"responsable" => $this->responsable,
    		"id_programa" => $this->id_programa,
    		"visible" => $this->visible,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("area",$datos));		
		}   

	function buscar($q,$orden)
	   {
			$claves=array();
			$claves[0]="nombre";
			$this->conexion->ejecutar($this->fabrica->buscar("area",$orden,$claves,$q));		
			$registros = array();
			$numReg=0;
			while($filas=$this->conexion->registro())
				{
				$registros[$numReg]=new Area($filas);
				$numReg++;
				}				
			return $registros;
		} 
		
	function consultar()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("area","id",$this->id));		
		$filas=$this->conexion->registro();		
		$this->id=$filas[0];
		$this->nombre=$filas[1];
		$this->responsable=$filas[2];
		$this->id_programa=$filas[3];
		}   

	function actualizar()
		{
		$datos=array(
			"nombre" => $this->nombre,
    		"responsable" => $this->responsable,
    		"id_programa" => $this->id_programa,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("area",$datos,"id",$this->id));
		}   
	
	function consultarPrograma()
		{
		$condiciones=array(
			"id" => "='".$this->id_programa."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("programa","nombre",$condiciones));
		$filas=$this->conexion->registro();
		return $filas[0];	
		}  
	
	function consultarAreaPrograma($id_programa)
		{
		$condiciones=array(
			"id_programa" => "='".$id_programa."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultar("area","id_programa",$id_programa));
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;
		}  
		
		function eliminar()
		{
			$this->conexion->ejecutar($this->fabrica->eliminar("area","id",$this->id));
		}

		function actualizarVisible($visible)
		{
			$datos=array(
				"visible" => $visible,
				);				
			$this->conexion->ejecutar($this->fabrica->actualizar("area",$datos,"id",$this->id));
		} 	
	}   	
?>