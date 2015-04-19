<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Empresa
	{
	private $nit;
	private $nombre;
	private $correo;
	private $direccion;
	private $telefono;
	private $representante;
	private $supervisor;
	private $cargosupervisor;
	private $estrato;
	private $objetoSocial;
	private $descripcion;	
	private $fichaTecnica;	
	private $visible;
	private $fabrica;

	function getNit()
		{return $this->nit;}

	function getNombre()
		{return $this->nombre;}

	function getCorreo()
		{return $this->correo;}

	function getDireccion()
		{return $this->direccion;}

	function getTelefono()
		{return $this->telefono;}

	function getRepresentante()
		{return $this->representante;}

	function getSupervisor()
		{return $this->supervisor;}

	function getCargosupervisor()
		{return $this->cargosupervisor;}

	function getEstrato()
		{return $this->estrato;}

	function getObjetoSocial()
		{return $this->objetoSocial;}

	function getDescripcion()
		{return $this->descripcion;}
		
	function getFichaTecnica()
		{return $this->fichaTecnica;}

	function getVisible()
		{return $this->visible;}

	function Empresa($datos){	 
		$this->nit=$datos[0];
		$this->nombre=$datos[1];
		$this->correo=$datos[2];
		$this->direccion=$datos[3];
		$this->telefono=$datos[4];
		$this->representante=$datos[5];
		$this->supervisor=$datos[6];
		$this->cargosupervisor=$datos[7];
		$this->estrato=$datos[8];
		$this->objetoSocial=$datos[9];
		$this->descripcion=$datos[10];
		$this->fichaTecnica=$datos[11];
		$this->visible=$datos[12];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 

	function insertar(){
		$datos=array(
    		"nit" => $this->nit,
			"nombre" => $this->nombre,
			"correo" => $this->correo,
    		"direccion" => $this->direccion,
    		"telefono" => $this->telefono,
    		"representante" => $this->representante,
    		"supervisor" => $this->supervisor,
    		"cargosupervisor" => $this->cargosupervisor,
    		"estrato" => $this->estrato,
    		"objetoSocial" => $this->objetoSocial,
    		"descripcion" => $this->descripcion,
    		"fichaTecnica" => $this->fichaTecnica,
    		"visible" => 0,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("empresa",$datos));		
		}

	function insertarProceso($idProceso){
		$datos=array(
    		"empresa_nit" => $this->nit,
			"proceso_id" => $idProceso,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("empresaproceso",$datos));		
		}

	function consultarTodos($orden){
		$this->conexion->ejecutar($this->fabrica->consultarTodos("empresa",$orden));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Empresa($filas);
			$numReg++;
			}				
		return $registros;
		}  
				
	function buscar($q,$orden){
		$claves=array();
		$claves[0]="nombre";
		$this->conexion->ejecutar($this->fabrica->buscar("empresa",$orden,$claves,$q));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Empresa($filas);
			$numReg++;
			}				
		return $registros;
		}   
	
	function consultar(){
	
		$this->conexion->ejecutar($this->fabrica->consultar("empresa","nit",$this->nit));		
		$filas=$this->conexion->registro();	
		
/*		echo("NIT:".$filas[0]);
		echo("</br>1: ".$filas[1]);
		echo("</br>2: ".$filas[2]);
		echo("</br>3:".$filas[3]);
		echo("</br>4: ".$filas[4]);
		echo("</br>5: ".$filas[5]);
		echo("</br>6: ".$filas[6]);
		echo("</br>7: ".$filas[7]);
		echo("</br>8: ".$filas[8]);
		echo("</br>9: ".$filas[9]);
		echo("</br>10: ".$filas[10]);
		echo("</br>11: ".$filas[11]);
		echo("</br>12: ".$filas[12]);
		echo("</br>13: ".$filas[13]);	
*/		
		$this->nit=$filas[0];
		$this->nombre=$filas[1];
		$this->correo=$filas[2];
		$this->direccion=$filas[3];
		$this->telefono=$filas[4];
		$this->representante=$filas[5];
		$this->supervisor=$filas[6];
		$this->cargosupervisor=$filas[7];
		$this->estrato=$filas[8];
		$this->objetoSocial=$filas[9];
		$this->descripcion=$filas[10];
		$this->fichaTecnica=$datos[11];
		$this->visible=$datos[12];
		}   

	function actualizar(){
		$datos=array(
    		"nit" => $this->nit,
			"nombre" => $this->nombre,
			"correo" => $this->correo,
    		"direccion" => $this->direccion,
    		"telefono" => $this->telefono,
    		"representante" => $this->representante,
    		"supervisor" => $this->supervisor,
    		"cargosupervisor" => $this->cargosupervisor,
    		"estrato" => $this->estrato,
    		"objetoSocial" => $this->objetoSocial,
    		"descripcion" => $this->descripcion,
			);				
		if($this->fichaTecnica!="")
			$datos["fichatecnica"]=$this->fichaTecnica;
		$this->conexion->ejecutar($this->fabrica->actualizar("empresa",$datos,"nit",$this->nit));
		}   

	function actualizarVisible($visible){
		$datos=array(
			"visible" => $visible,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("empresa",$datos,"nit",$this->nit));
		}   

	function numConvenios(){
		$condiciones=array(
			"empresa_nit" => "='".$this->nit."'",
			);				
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("convenio", "count(*)", $condiciones));
		$filas=$this->conexion->registro();		
		return $filas[0];
		}   

	function eliminar(){
		$this->conexion->ejecutar($this->fabrica->eliminar("empresa","nit",$this->nit));
		}	
		
	}   	
?>