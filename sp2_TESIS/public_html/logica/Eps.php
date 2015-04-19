<?php

require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Eps {

    private $id;
    private $nombreeps;
    private $fabrica;
    private $conexion;
    private $visible;

    function Eps($datos) {
        $this->id = $datos[0];
        $this->nombreeps = $datos[1];
        $this->visible=$datos[2];
        $this->fabrica = new Fabrica();
        $this->conexion = new Conexion();
    }

    function getNombreEps() {
        return $this->nombreeps;
    }

    function getId() {
        return $this->id;
    }

    function getVisible()
        {return $this->visible;}

    function consultarTodos() {
        $this->conexion->ejecutar($this->fabrica->consultarTodos("eps", "nombreeps"));
        $registros = array();
        $numReg = 0;
        while ($filas = $this->conexion->registro()) {
            $registros[$numReg] = new Eps($filas);
            $numReg++;
        }
        return $registros;
    }

    function insertar() {
        $datos = array(
            "nombreeps" => $this->nombreeps,
            "visible" => 0,
        );
        $this->conexion->ejecutar($this->fabrica->insertar("eps", $datos));
    }

    
    function buscar($q, $orden) {
        
        $claves = array();
        $claves[0] = "nombreeps";
        $this->conexion->ejecutar($this->fabrica->buscar("eps", $orden, $claves, $q));
        
        $registros = array();
        $numReg = 0;
        while ($filas = $this->conexion->registro()) {
            $registros[$numReg] = new Eps($filas);
            $numReg++;
        }
        return $registros;
    }

    function consultar()
        {
        $this->conexion->ejecutar($this->fabrica->consultar("eps","id",$this->id));        
        $filas=$this->conexion->registro();     
        $this->id=$filas[0];
        $this->nombreeps=$filas[1];
        $this->visible=$filas[2];
        }   

    function actualizar()
        {
        $datos=array(
            "nombreeps" => $this->nombreeps,
            "visible" => $this->visible,
            );              
        $this->conexion->ejecutar($this->fabrica->actualizar("eps",$datos,"id",$this->id));
        }  

    function eliminar()
        {
            $this->conexion->ejecutar($this->fabrica->eliminar("eps","id",$this->id));
        }   
         
    function actualizarVisible($visible)
        {
            $datos=array(
                "visible" => $visible,
                );              
            $this->conexion->ejecutar($this->fabrica->actualizar("eps",$datos,"id",$this->id));
        }  
}

?>