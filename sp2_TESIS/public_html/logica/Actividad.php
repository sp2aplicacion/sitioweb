<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Actividad
	{
	private $id;
	private $nombre;	
	private $area;	
	private $fabrica;
	private $conexion;
	
	function Actividad($datos)
		{	 
		$this->id=$datos[0];
		$this->nombre=$datos[1];
		$this->area=$datos[2];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 
		
	function getId()
		{return $this->id;}

	function getNombre()
		{return $this->nombre;}

	function getArea()
		{return $this->area;}

	function consultarTodos()
		{
		$atributosTabla1=array();
		$atributosTabla1[0]="id";
		$atributosTabla1[1]="nombre";
		$atributosTabla2=array();
		$atributosTabla2[0]="nombre";				
		$this->conexion->ejecutar($this->fabrica->consultarJoin("actividad","area",$atributosTabla1,$atributosTabla2,"area_id","id","area.nombre, actividad.nombre"));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Actividad($filas);
			$numReg++;
			}				
		return $registros;
		}   

	function insertar()
		{
		$datos=array(
			"nombre" => $this->nombre,
			"area_id" => $this->area,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("actividad",$datos));		
		}   

	function consultar()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("actividad","id",$this->id));		
		$filas=$this->conexion->registro();		
		$this->id=$filas[0];
		$this->nombre=$filas[1];
		$this->area=$filas[2];
		}   

	function actualizar()
		{
		$datos=array(
			"nombre" => $this->nombre,
			"area_id" => $this->area,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("actividad",$datos,"id",$this->id));
		}   
		
	}   	
?>