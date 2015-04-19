<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Facultad
	{
	private $id;
	private $nombre;
	private $decano;
	private $coordinador;
	private $telefono;
	private $fabrica;
	private $conexion;
	private $visible;
	
		
	function getId()
		{return $this->id;}

	function getNombre()
		{return $this->nombre;}

	function getDecano()
		{return $this->decano;}

	function getCoordinador()
		{return $this->coordinador;}

	function getTelefono()
		{return $this->telefono;}

	function getVisible()
		{return $this->visible;}

	function Facultad($datos)
		{	 
		$this->id=$datos[0];
		$this->nombre=$datos[1];
		$this->decano=$datos[2];
		$this->coordinador=$datos[3];
		$this->telefono=$datos[4];
		$this->visible=$datos[5];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 

	function consultarTodos()
		{
		$this->conexion->ejecutar($this->fabrica->consultarTodos("facultad","nombre"));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Facultad($filas);
			$numReg++;
			}				
		return $registros;
		}   

	function insertar()
		{
		$datos=array(
			"id" => $this->id,
			"nombre" => $this->nombre,
    		"decano" => $this->decano,
    		"coordinador" => $this->coordinador,
    		"telefono" => $this->telefono,
    		"visible" => 0,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("facultad",$datos));		
		}   

	function buscar($q,$orden)
	   {
			$claves=array();
			$claves[0]="nombre";
			$this->conexion->ejecutar($this->fabrica->buscar("facultad",$orden,$claves,$q));		
			$registros = array();
			$numReg=0;
			while($filas=$this->conexion->registro())
				{
				$registros[$numReg]=new Facultad($filas);
				$numReg++;
				}				
			return $registros;
		}   

	function actualizarVisible($visible)
		{
			$datos=array(
				"visible" => $visible,
				);				
			$this->conexion->ejecutar($this->fabrica->actualizar("facultad",$datos,"id",$this->id));
		}  


	function consultar()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("facultad","id",$this->id));		
		$filas=$this->conexion->registro();		
		$this->id=$filas[0];
		$nombre = $this->nombre=$filas[1];
		$this->decano=$filas[2];
		$this->coordinador=$filas[3];
		$this->telefono=$filas[4];
		$this->visible=$filas[5];

		echo $nombre;
		}   

	function actualizar()
		{
		$datos=array(
			"nombre" => $this->nombre,
    		"decano" => $this->decano,
    		"coordinador" => $this->coordinador,
    		"telefono" => $this->telefono,
    		"visible" => $this->visible,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("facultad",$datos,"id",$this->id));
		}   

		function eliminar()
		{
			$this->conexion->ejecutar($this->fabrica->eliminar("facultad","id",$this->id));
		}	
		
	}   	
?>