<?php
class Persona
	{
	protected $codigo;  
	protected $cedula;  
	protected $nombre;
	protected $apellido;  
	protected $contra;
	protected $correo;
	protected $telefono;
	protected $celular;
	protected $direccion;
	
	function getCodigo()	
		{return $this->codigo;}

	function getCedula()
		{return $this->cedula;}

	function getNombre()
		{return $this->nombre;}

	function getApellido()
		{return $this->apellido;}

	function getCorreo()
		{return $this->correo;}
	
	function getTelefono()
		{return $this->telefono;}
	
	function getCelular()
		{return $this->celular;}

	function getDireccion()
		{return $this->direccion;}
	}
	
?>