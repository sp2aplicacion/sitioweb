<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Programa
	{

	private $id;
	private $nombre;
	private $director;
	private $visible;
	private $idfacultad;
	
		
	function getId()
		{return $this->id;}

	function getNombre()
		{return $this->nombre;}

	function getDirector()
		{return $this->director;}


	function getVisible()
	{
		return $this->visible;
	}

	function getFacultad()
	{
		return $this->idfacultad;
	}

	function Programa($datos)
		{	 
		$this->id=$datos[0];
		$this->nombre=$datos[1];
		$this->director=$datos[2];
		$this->visible=$datos[3];
		$this->idfacultad=$datos[4];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 

	function consultarTodos()
		{
			$this->conexion->ejecutar($this->fabrica->consultarTodos("programa","nombre"));		
			$registros = array();
			$numReg=0;
			while($filas=$this->conexion->registro())
				{
				$registros[$numReg]=new Programa($filas);
				$numReg++;
				}		
			return $registros;
		}   

	function insertar()
		{
		$datos=array(
			"id" => $this->id,
			"nombre" => $this->nombre,
    		"director" => $this->director,
    		"visible" => $this->visible,
    		"idfacultad" => $this->idfacultad,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("programa",$datos));		
		}   

	function buscar($q,$orden)
	   {
			$claves=array();
			$claves[0]="nombre";
			$this->conexion->ejecutar($this->fabrica->buscar("programa",$orden,$claves,$q));		
			$registros = array();
			$numReg=0;
			while($filas=$this->conexion->registro())
				{
					$registros[$numReg]=new Programa($filas);
					$numReg++;
				}				
			return $registros;
		}   

    function consultarFacultad()
		{
		$condiciones=array(
			"id" => "='".$this->idfacultad."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("facultad","nombre",$condiciones));
		$filas=$this->conexion->registro();
		return $filas[0];	
		}  

		function consultarProgramaFacultad($id_facultad)
		{
		$condiciones=array(
			"id_facultad" => "='".$id_programa."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultar("programa","id_facultad",$id_programa));
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;
		}  
		

	function consultar()
		{
			$this->conexion->ejecutar($this->fabrica->consultar("programa","id",$this->id));		
			$filas=$this->conexion->registro();		
			$this->id=$filas[0];
			$this->nombre=$filas[1];
			$this->director=$filas[2];
			$this->idfacultad=$filas[4];
		}   

	function actualizarVisible($visible)
		{
			$datos=array(
				"visible" => $visible,
					);				
			$this->conexion->ejecutar($this->fabrica->actualizar("programa",$datos,"id",$this->id));
		}  

	function actualizar()
		{
			$datos=array(
				"nombre" => $this->nombre,
	    		"director" => $this->director,
	    		"idfacultad" => $this->idfacultad,
				);				
			$this->conexion->ejecutar($this->fabrica->actualizar("programa",$datos,"id",$this->id));
			}  

			function eliminar(){
			$this->conexion->ejecutar($this->fabrica->eliminar("programa","id",$this->id));
		}	 
		
	}   	
?>