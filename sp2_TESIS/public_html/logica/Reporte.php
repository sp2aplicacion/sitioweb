<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Reporte
	{
	private $fabrica;
	private $conexion;
	private $conexion2;
	
	function Reporte()
		{	 
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		$this->conexion2 = new Conexion();
		} 
	
	function estudiantesInscritos($area)
		{
		$atributosTabla1=array();
		$atributosTabla1[0]="estudiante_codigo";				
		$atributosTabla1[1]="fechaAplicacion";				
		$atributosTabla1[2]="horaAplicacion";				
		$atributosTabla1[3]="fechaMEstado";				
		$atributosTabla1[4]="horaMEstado";				
		$atributosTabla1[5]="estado";				
		$atributosTabla2=array();
		$atributosTabla2[0]="id";				
		$atributosTabla2[1]="nombre";				
		$atributosTabla2[2]="cuposofrecidos";				
		$atributosTabla2[3]="cuposasignados";				
		$condiciones=array(
			"area_id" => "='".$area."'",
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
	    		"convenio.id" => "='".$filasConvenioEstudiante[6]."'",
				);
			$this->conexion2->ejecutar($this->fabrica->consultarJoin("empresa","convenio",$atributosTabla1,$atributosTabla2,"nit","empresa_nit","empresa.nombre",$condiciones));
			$filasEmpresaCovenio=$this->conexion2->registro();		
			$registros[$numReg][0]=$filasConvenioEstudiante;
			$registros[$numReg][1]=$filasEstudiante;
			$registros[$numReg][2]=$filasEmpresaCovenio;			
			$numReg++;			
			}			
		return $registros;			
		}   

	function estudiantesInscritosPeriodo($area,$periodo,$estado)
		{
		$atributosTabla1=array();
		$atributosTabla1[0]="estudiante_codigo";				
		$atributosTabla1[1]="fechaAplicacion";				
		$atributosTabla1[2]="horaAplicacion";				
		$atributosTabla1[3]="fechaMEstado";				
		$atributosTabla1[4]="horaMEstado";				
		$atributosTabla1[5]="estado";				
		$atributosTabla2=array();
		$atributosTabla2[0]="id";				
		$atributosTabla2[1]="nombre";				
		$atributosTabla2[2]="cuposofrecidos";				
		$atributosTabla2[3]="cuposasignados";				
		if($estado==-1)
			{
			$condiciones=array(
				"periodo" => "='".$periodo."'",
				"area_id" => "='".$area."'",
				);					
			}
		else
			{
			$condiciones=array(
				"periodo" => "='".$periodo."'",
				"area_id" => "='".$area."'",
				"estado" => "='".$estado."'",
				);													
			}
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
	    		"convenio.id" => "='".$filasConvenioEstudiante[6]."'",
				);
			$this->conexion2->ejecutar($this->fabrica->consultarJoin("empresa","convenio",$atributosTabla1,$atributosTabla2,"nit","empresa_nit","empresa.nombre",$condiciones));
			$filasEmpresaCovenio=$this->conexion2->registro();		
			$registros[$numReg][0]=$filasConvenioEstudiante;
			$registros[$numReg][1]=$filasEstudiante;
			$registros[$numReg][2]=$filasEmpresaCovenio;			
			$numReg++;			
			}			
		return $registros;			
		}   

	function estudianteInscrito($codigoEstudiante)
		{
		$atributosTabla1=array();
		$atributosTabla1[0]="nombre";
		$atributosTabla1[1]="empresa_nit";
		$atributosTabla1[2]="area_id";
		$atributosTabla2=array();
		$atributosTabla2[0]="fechaAplicacion";
		$atributosTabla2[1]="horaAplicacion";
		$atributosTabla2[2]="estado";
		$condiciones=array(
    		"convenioestudiante.estudiante_codigo" => "='".$codigoEstudiante."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenio","convenioestudiante",$atributosTabla1,$atributosTabla2,"id","convenio_id","convenioestudiante.fechaAplicacion desc, convenioestudiante.horaAplicacion desc",$condiciones));
		$registros = array();
		$numReg=0;
		while($filasConvenioEstudiante=$this->conexion->registro())
			{
			$this->conexion2->ejecutar($this->fabrica->consultar("empresa","nit",$filasConvenioEstudiante[1]));
			$filasEmpresa=$this->conexion2->registro();
			$this->conexion2->ejecutar($this->fabrica->consultar("area","id",$filasConvenioEstudiante[2]));
			$filasArea=$this->conexion2->registro();		
			$registros[$numReg][0]=$filasConvenioEstudiante;
			$registros[$numReg][1]=$filasEmpresa;
			$registros[$numReg][2]=$filasArea;	
			$numReg++;		
			}
		return $registros;			
		}   

	function convenios($area)
		{
		$atributosTabla1=array();
		$atributosTabla1[0]="fechaInicial";
		$atributosTabla1[1]="fechaFinal";
		$atributosTabla1[2]="cuposOfrecidos";
		$atributosTabla1[3]="cuposAsignados";
		$atributosTabla1[4]="visible";
		$atributosTabla1[5]="firmado";
		$atributosTabla1[6]="nombre";
		$atributosTabla2=array();
		$atributosTabla2[0]="nit";
		$atributosTabla2[1]="nombre";
		$condiciones=array(
    		"convenio.area_id" => "='".$area."'",
			);		
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenio","empresa",$atributosTabla1,$atributosTabla2,"empresa_nit","nit","empresa.nombre",$condiciones));
		$registros = array();
		$numReg=0;
		while($filasConvenio=$this->conexion->registro())
			{
			$registros[$numReg]=$filasConvenio;
			$numReg++;		
			}
		return $registros;			
		}   

	function conveniosPeriodo($area,$periodo,$firmado)
		{
		$atributosTabla1=array();
		$atributosTabla1[0]="fechaInicial";
		$atributosTabla1[1]="fechaFinal";
		$atributosTabla1[2]="cuposOfrecidos";
		$atributosTabla1[3]="cuposAsignados";
		$atributosTabla1[4]="visible";
		$atributosTabla1[5]="firmado";
		$atributosTabla1[6]="nombre";
		$atributosTabla2=array();
		$atributosTabla2[0]="nit";
		$atributosTabla2[1]="nombre";
		if($firmado!=-1)
			{
			$condiciones=array(
	    		"convenio.periodo" => "='".$periodo."'",
	    		"convenio.area_id" => "='".$area."'",
	    		"convenio.firmado" => "='".$firmado."'",
				);		
			}
		else
			{
			$condiciones=array(
	    		"convenio.periodo" => "='".$periodo."'",
	    		"convenio.area_id" => "='".$area."'",
				);		
			}
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenio","empresa",$atributosTabla1,$atributosTabla2,"empresa_nit","nit","empresa.nombre",$condiciones));
		$registros = array();
		$numReg=0;
		while($filasConvenio=$this->conexion->registro())
			{
			$registros[$numReg]=$filasConvenio;
			$numReg++;		
			}
		return $registros;			
		}   

	function conveniosPeriodoEmpresa($periodo,$nitEmpresa)
		{
		$atributosTabla1=array();
		$atributosTabla1[0]="id";
		$atributosTabla1[1]="fechaInicial";
		$atributosTabla1[2]="fechaFinal";
		$atributosTabla1[3]="cuposOfrecidos";
		$atributosTabla1[4]="cuposAsignados";
		$atributosTabla1[5]="visible";
		$atributosTabla1[6]="firmado";
		$atributosTabla1[7]="nombre";
		$atributosTabla2=array();
		$atributosTabla2[0]="nombre";
		$condiciones=array(
    		"convenio.periodo" => "='".$periodo."'",
    		"convenio.empresa_nit" => "='".$nitEmpresa."'",
			);		
		$this->conexion->ejecutar($this->fabrica->consultarJoin("convenio","area",$atributosTabla1,$atributosTabla2,"area_id","id","convenio.nombre",$condiciones));
		$registros = array();
		$numReg=0;
		while($filasConvenio=$this->conexion->registro())
			{
			$registros[$numReg]=$filasConvenio;
			$numReg++;		
			}
		return $registros;			
		}   

	function estudianteConvenio($idConvenio)
		{
		$atributosTabla1=array();
		$atributosTabla1[0]="codigo";
		$atributosTabla1[1]="cedula";
		$atributosTabla1[2]="nombre";
		$atributosTabla1[3]="apellido";
		$atributosTabla2=array();
		$atributosTabla2[0]="fechaAplicacion";
		$atributosTabla2[1]="horaAplicacion";
		$atributosTabla2[2]="estado";
		$condiciones=array(
    		"convenioestudiante.convenio_id" => "='".$idConvenio."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarJoin("estudiante","convenioestudiante",$atributosTabla1,$atributosTabla2,"codigo","estudiante_codigo","convenioestudiante.fechaAplicacion desc, convenioestudiante.horaAplicacion desc",$condiciones));
		$registros = array();
		$numReg=0;
		while($filasConvenio=$this->conexion->registro())
			{
			$registros[$numReg]=$filasConvenio;
			$numReg++;		
			}
		return $registros;			
		}   


	}   	
?>