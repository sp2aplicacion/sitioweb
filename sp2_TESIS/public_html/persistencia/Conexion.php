<?php
class Conexion 
	{
	var $con;
	var $resultado;
	
	function conexion()
		{
		$this->con= mysql_connect("localhost", "root", "");
		mysql_select_db("mating", $this->con);
		}  	
	
	function ejecutar($sentencia)
		{
		$this->resultado=mysql_query($sentencia,$this->con) or die (mysql_error());
		return $this->resultado;
		}
	
	function liberar()
		{mysql_free_result($this->resultado);}
	
	function cerrar()
		{mysql_close($this->con);}
	
	function filas()
		{return mysql_num_rows($this->resultado);}
	
	function campos()
		{return mysql_num_fields($this->resultado);}
	
	function registro()
		{
		  $fila = mysql_fetch_row($this->resultado);
		  return $fila;
		}
	}  
?>
