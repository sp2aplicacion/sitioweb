<?php
class Fabrica
	{
	private $sentencia;
					
	function insertar($nombreTabla, $datos){
		$atributos="";
		$valores="";
		foreach ($datos as $atributo => $valor)
			{
			$atributos.=$atributo.",";
			$valores.="'".$valor."',";
			}
		$this->sentencia="insert into ".$nombreTabla." (".substr($atributos,0,strlen($atributos)-1).") values(".substr($valores,0,strlen($valores)-1).")";
		return $this->sentencia;
		} 

	function actualizar($nombreTabla, $datos, $clave, $valorClave){
		$valores="";
		foreach ($datos as $atributo => $valor)
			$valores.=$atributo."='".$valor."',";
		$this->sentencia="update ".$nombreTabla." set ".substr($valores,0,strlen($valores)-1)." where ".$clave."='".$valorClave."'";
		return $this->sentencia;
		} 

	function actualizarTodo($nombreTabla, $datos){
		$valores="";
		foreach ($datos as $atributo => $valor)
			$valores.=$atributo."='".$valor."',";
		$this->sentencia="update ".$nombreTabla." set ".substr($valores,0,strlen($valores)-1);
		return $this->sentencia;
		} 
		
	function eliminar($nombreTabla, $clave="", $valorClave=""){
		$this->sentencia="delete from ".$nombreTabla;
		if($clave!="")
			$this->sentencia.=" where ".$clave."='".$valorClave."'";
		return $this->sentencia;
		} 
		
	function eliminarCondiciones($nombreTabla, $condiciones){
		$condicion="";		
		foreach ($condiciones as $atributo => $valor)
			$condicion.=$atributo.$valor." and ";
		return "delete from ".$nombreTabla." where ".substr($condicion,0,strlen($condicion)-5);
		} 

//Consultas basicas
	function consultarTodos($nombreTabla,$orden){
	  return "select * from ".$nombreTabla." order by ".$orden;} 

	function consultar($nombreTabla,$atributo,$valor,$orden=""){
		return ($orden=="")?"select * from ".$nombreTabla." where ".$atributo."='".$valor."'" : "select * from ".$nombreTabla." where ".$atributo."='".$valor."' order by ".$orden;} 

	function consultarPorID($nombreTabla ,$valor)
	{
		return "select nombre from ".$nombreTabla." where id=".$valor;
	}	

	function consultarEspecificacion($nombreTabla,$atributo,$orden=""){
		$s="select ".$atributo." from ".$nombreTabla;
		if ($orden!="")
			$s.=" order by ".$orden;
		return $s;
		} 
		
	function consultarCondiciones($nombreTabla,$atributoR,$condiciones,$orden=""){
		$condicion="";		
		foreach ($condiciones as $atributo => $valor)
			$condicion.=$atributo.$valor." and ";
		$s="select ".$atributoR." from ".$nombreTabla." where ".substr($condicion,0,strlen($condicion)-5);
		if ($orden!="")
			$s.=" order by ".$orden;
		return $s;
		} 

    function iniciar_sesion($nombreTabla,$codigo){
           $this->sentencia="insert into ".$nombreTabla." (sesion,codigo) values(".$codigo.",".$codigo.")";
		   return $this->sentencia;	  
		} 
	function confirmar_sesion($nombreTabla,$codigo, $sesion){
		  return $resultado="select * 
		         from ".$nombreTabla." 
				 where codigo='".$codigo."' 
				  ";		  
		} 
	function verificarEstado($nombreTabla,$codigo){
		  return $resultado="select estado 
		         from ".$nombreTabla." 
				 where codigo='".$codigo."' 
				 and estado!=0
				 and estado!=11
				  ";		  
		} 	
    /*para nivelar un estudiante se deben tener en cuenta los siguientes casos.
	  1. Que el ultimo registro al semestre pasado sea el que curso en Psicología Clinica.

    */	
	function nivelar_estudiantes(){
	 return $resultado=
	   "
        select distinct(e.codigo)
        from   estudiante e
		      ,convenioestudiante ce
              ,convenio c
              ,area a
        where ce.estudiante_codigo=e.codigo
        and c.id=ce.convenio_id
        and a.id=c.area_id
        and c.periodo=
		(select
			case 
			   when SUBSTRING((SUBSTRING(now(),6,2)-7)/7+2,1,1)=1
				 then CONCAT(SUBSTRING(now(),1,4)-1,'-2')
			   when SUBSTRING((SUBSTRING(now(),6,2)-7)/7+2,1,1)=2
				 then CONCAT(SUBSTRING(now(),1,4),'-1')
			end as semestre_ant)
        and a.nombre='Psicologia Clinica' 
	  ";
	}
	function nivelar_estudiante($codigo){
       $this->sentencia="update estudiante e 
                          set  e.estado=2
                          where e.codigo=".$codigo."
                          ";
	   return $this->sentencia;
	}
	function inhabilitarEstudiante($codigo){
	   
       $this->sentencia="update estudiante e 
                          set  e.estado=0
                          where e.codigo=".$codigo."
                          ";
	   return $this->sentencia;
	}
	
	function nota40($ces, $fecha_cierre){
	  return $resultado="SELECT round(avg(calificacionSesion))
						 FROM `sesionsupervision`
						 WHERE `convenioestudiantesupervisor_id`='".$ces."' 
						 and fechaRegistro<='".$fecha_cierre."'
						 ";
	}
    function nota60($ces, $fecha_cierre){
	  return $resultado="SELECT round(avg(calificacionSesion))
						 FROM `sesionsupervision`
						 WHERE `convenioestudiantesupervisor_id`='".$ces."' 
						 and fechaRegistro>'".$fecha_cierre."'
						 ";
	}
	function consultarPeriodo($idces){
	  return $resultado ="select c.periodo
						  from convenioestudiantesupervisor ces,
							 convenioestudiante ce,
							 convenio c
						  where ces.id='".$idces."'
						  and   ces.convenioestudiante_estudiante_codigo=ce.estudiante_codigo
						  and   ces.convenioestudiante_convenio_id=ce.convenio_id
						  and   c.id=ce.convenio_id";
	}
	function consultarConvenioEstudianteSupervisor ($estudiante,$area)
	{
	  return $resultado ='select ces.id, s.apellido,s.nombre
                         from convenioestudiantesupervisor ces,
							  convenioestudiante ce,
							  supervisor s,
							  convenio c,
                              area a
							  
						 where ces.convenioestudiante_estudiante_codigo=ce.estudiante_codigo
						 and   ces.convenioestudiante_convenio_id=ce.convenio_id
						 and   ces.supervisor_codigo=s.codigo
						 and   c.id=ce.convenio_id
                         and   a.id=c.area_id
						 and   ce.estado=1
						 and   ce.estudiante_codigo='.$estudiante.'
						 and   a.id='.$area;
						 
	}
	function fecha_cierre($periodo){
	   return $resultado ="SELECT fecha_cierre 
	                       FROM `cierre` 
						   WHERE periodo='".$periodo."'";
	}
	function obtener_sesion($nombreTabla,$codigo){
		  return $resultado="select codigo 
		         from ".$nombreTabla." 
				 where codigo='".$codigo."' 
				  ";		  
		} 
	function autenticar($nombreTabla,$codigo,$contra){ return "select * 
		         from ".$nombreTabla." 
				 where codigo='".$codigo."' 
				 and contra='".$contra."'
				  ";
		} 

	function buscar($nombreTabla,$orden,$claves,$valorClave){
		$atributosConsulta="";		
		for ($i=0; $i<count($atributosTabla1); $i++)
			$atributosConsulta.=$nombreTabla1.".".$atributosTabla1[$i].",";
		for ($i=0; $i<count($atributosTabla2); $i++)
			$atributosConsulta.=$nombreTabla2.".".$atributosTabla2[$i].",";
		$this->sentencia="select * from ".$nombreTabla." where ";		
		$clavesConsulta="("; 
		for ($i=0; $i<count($claves); $i++)
			$clavesConsulta.=$claves[$i]." like '%".$valorClave."%' or "; 		
		$clavesConsulta=substr($clavesConsulta,0,strlen($clavesConsulta)-4).")";
		$this->sentencia.=$clavesConsulta." order by ".$orden;
		return $this->sentencia;
		} 
//Consultas con Join

	//ConsultarJoin
	//Parametro nombreTabla1
	//Parametro nombreTabla2
	//Parametro atributosTabla1. Debe colocarse los atributos de la tabla1 que se desean mostrar en un arreglo cuyo indice inicial es 0
	//Parametro atributosTabla2. Debe colocarse los atributos de la tabla2 que se desean mostrar en un arreglo cuyo indice inicial es 0
	//Parametro atributoJoinTabla1. Atributo en la tabla1 por el cual se realiza el join
	//Parametro atributoJoinTabla2. Atributo en la tabla2 por el cual se realiza el join
	//Parametro orden. Atributo por el cual se ordena
	//Parametro condiciones. Debe colocarse los atributos y valores en un arreglo donde el indice es el nombre del atributo. Los valores deben incluir comilla sencilla. Esto permite colocar condiciones entre atributos de cada tabla. Se debe incluir operador de comparacion.

	function consultarJoin($nombreTabla1, $nombreTabla2, $atributosTabla1, $atributosTabla2, $atributoJoinTabla1,$atributoJoinTabla2,$orden,$condiciones=""){
		$atributosConsulta="";		
		for ($i=0; $i<count($atributosTabla1); $i++)
			$atributosConsulta.=$nombreTabla1.".".$atributosTabla1[$i].",";
		for ($i=0; $i<count($atributosTabla2); $i++)
			$atributosConsulta.=$nombreTabla2.".".$atributosTabla2[$i].",";
		$this->sentencia="select ".substr($atributosConsulta,0,strlen($atributosConsulta)-1)." from ".$nombreTabla1.", ".$nombreTabla2." where ".$nombreTabla1.".".$atributoJoinTabla1."=".$nombreTabla2.".".$atributoJoinTabla2;
		if($condiciones!="")
			{
			foreach ($condiciones as $atributo => $valor)
				$this->sentencia.=" and ".$atributo.$valor;
			}
		$this->sentencia.=" order by ".$orden;
		return $this->sentencia;
		} 

	function consultarDobleJoin($nombreTabla1,$nombreTabla2,$nombreTabla3,$atributosTabla1,$atributosTabla2,$atributosTabla3,$atributoJoinTabla1,$atributo1JoinTabla2,$atributo2JoinTabla2,$atributoJoinTabla3,$orden,$condiciones=""){
		$atributosConsulta="";		
		for ($i=0; $i<count($atributosTabla1); $i++)
			$atributosConsulta.=$nombreTabla1.".".$atributosTabla1[$i].",";
		for ($i=0; $i<count($atributosTabla2); $i++)
			$atributosConsulta.=$nombreTabla2.".".$atributosTabla2[$i].",";
		for ($i=0; $i<count($atributosTabla3); $i++)
			$atributosConsulta.=$nombreTabla3.".".$atributosTabla3[$i].",";
		$this->sentencia="select ".substr($atributosConsulta,0,strlen($atributosConsulta)-1)." from ".$nombreTabla1.", ".$nombreTabla2.", ".$nombreTabla3." where ".$nombreTabla1.".".$atributoJoinTabla1."=".$nombreTabla2.".".$atributo1JoinTabla2." and ".$nombreTabla2.".".$atributo2JoinTabla2."=".$nombreTabla3.".".$atributoJoinTabla3;
		if($condiciones!="")
			{
			foreach ($condiciones as $atributo => $valor)
				$this->sentencia.=" and ".$atributo.$valor;
			}
		$this->sentencia.=" order by ".$orden;
		return $this->sentencia;
		} 

	function buscarJoin($nombreTabla1, $nombreTabla2, $atributosTabla1, $atributosTabla2, $atributoJoinTabla1,$atributoJoinTabla2,$orden,$claves,$valorClave){
		$atributosConsulta="";		
		for ($i=0; $i<count($atributosTabla1); $i++)
			$atributosConsulta.=$nombreTabla1.".".$atributosTabla1[$i].",";
		for ($i=0; $i<count($atributosTabla2); $i++)
			$atributosConsulta.=$nombreTabla2.".".$atributosTabla2[$i].",";
		$this->sentencia="select ".substr($atributosConsulta,0,strlen($atributosConsulta)-1)." from ".$nombreTabla1.", ".$nombreTabla2." where ".$nombreTabla1.".".$atributoJoinTabla1."=".$nombreTabla2.".".$atributoJoinTabla2;		
		$clavesConsulta=" and ("; 
		for ($i=0; $i<count($claves); $i++)
			$clavesConsulta.=$claves[$i]." like '%".$valorClave."%' or "; 		
		$clavesConsulta=substr($clavesConsulta,0,strlen($clavesConsulta)-4).")";
		$this->sentencia.=$clavesConsulta." order by ".$orden;
		return $this->sentencia;
		}
    function seleccionarEstudianteSinConvenio ($codigo) {

	  return $resultado= 'select e.codigo
               from estudiante e
               left outer join convenioestudiante ce
               on e.codigo=ce.estudiante_codigo
               where ce.convenio_id is null
               and e.codigo="'.$codigo.'"';	
    }	
    function seleccionarSupervisorSinConvenio ($codigo) {

	  return $resultado=
		               'select codigo
                        from supervisor s
                        left outer join convenioestudiantesupervisor ces
                        on s.codigo=ces.supervisor_codigo
						where ces.id is null
                        and s.codigo="'.$codigo.'"';
    }
	
	} 
?>