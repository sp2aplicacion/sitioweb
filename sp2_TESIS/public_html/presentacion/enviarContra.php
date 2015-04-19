<?php
    require_once('logica/Administrador.php');	
    require_once('logica/Estudiante.php');	
    require_once('logica/Supervisor.php');	
 	$id=$_POST['id'];
 	$cedula=$_POST['cedula'];
	$correo=$_POST['correo'];
	
	$para=$correo;
	$asunto="Recuperacion de Contrasena SP2";
	$de="SP2 (SISTEMA DE PRACTICAS PROFESIONALES)<andres.ramirez@konradlorenz.edu.co>";
	$contraNueva = rand(1000,9999);
	$datos=array();
	$datos[0]=$id;
	$datos[1]=$cedula;
	$datos[5]=$correo;
	$persona = new Administrador($datos);
	$hecho = false;
	$enviado= false;
	if($persona->datosCorrectosActualizacionContra())
		{$persona->actualizarContra($contraNueva);$hecho=true;}
	else
		{
		$persona = new Estudiante($datos);
		if($persona->datosCorrectosActualizacionContra())
			{$persona->actualizarContra($contraNueva);$hecho=true;}
		else
			{
			$persona = new Supervisor($datos);
			if($persona->datosCorrectosActualizacionContra())
				{$persona->actualizarContra($contraNueva);$hecho=true;}	
			}
		}
		if($hecho)
		{
		   $mensaje="Los datos de su cuenta son:\r\nIdentificacion: ".$id."\r\nNueva Contrasena generada aleatoriamente: ".$contraNueva."\n\n\nSe sugiere que actualice su contrasena.\n\n\nMensaje enviado por SP2 (SISTEMA DE PRACTICAS PROFESIONALES)";
		   if(mail($para,$asunto,$mensaje,"FROM: ".$de))
		   {
		     $enviado=true;
		   }
	    }

?>
<!DOCTYPE html>
<html>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
	<h3>Solicitud de  Contrase&ntilde;a</h3>
	<?php 
	if ($hecho)
	{
   	   if($enviado)
		 echo "<div align='center'><strong>La contraseña fue enviada a su correo: ".$correo."<br></strong></div>";
	   else
	     echo "<div align='center' class='rojo'><strong>La contraseña NO fue enviada a su correo: ".$correo.".<br>Contacte con el administrador<br></strong></div>";
	   echo "<div align='center'><strong>La contrasena nueva es:".$contraNueva."<br>Se sugiere cambiar su contrasena</strong></div>";
	}
	else
		echo "<div align='center' class='rojo'><strong>Sus datos no coinciden con los registrados en el sistema</strong></div>
		<div align='center'><a href='index.php?id=13'><strong>Recuperar Contrasena</strong></a></div>";	
	
	?>
	<div align="center"><a href="index.php"><strong>INICIO</strong></a></div>	
</body>
</html>

	
	
	

	
