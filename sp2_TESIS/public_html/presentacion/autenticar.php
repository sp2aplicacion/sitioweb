<?php 
session_start();
require_once('logica/Estudiante.php');
require_once('logica/Administrador.php');
require_once('logica/Supervisor.php');

$idPersona=$_POST['id'];
$contra=$_POST['contra'];

$_SESSION['idPersona']=$idPersona;
$_SESSION['id']=time();

if($idPersona==""||$contra=="")
	{
	?>
	<script>location.replace('index.php?err=1');</script>
	<?php
	}
else
	{
	 $datos = array();
	 $datos[0]=$idPersona;
	 $datos[4]=$contra;
	 $persona = new Estudiante($datos);
	 
//Se verifica si es estudiante...
	 if($persona->autenticar())
	 {
		if($persona->verificarEstado())
		{
   		  //if($persona->sesion())
		//	{
			  //$_SESSION=array();
			  //session_destroy();
		      //echo($persona->obtener_sesion());
			  unset($_SESSION[$persona->obtener_sesion()]);
			 // $persona->eliminar_sesion();
			  session_start();
			  $_SESSION['idPersona']=$idPersona;
			  $_SESSION['id']=time();
		//	  $persona->iniciar_sesion($_SESSION['id']);
		
		/*	  ?>
				<script>alert("Ud ya se encuentra con una sesión iniciada")</script>
				<script>location.replace('index.php?');</script>
			  <?php
		*/
		//	}
		//	else 
		//	{
			  //$persona->iniciar_sesion($_SESSION['id']);
			  ?>
				<script>location.replace('index.php?id=2');</script>
			  <?php
		//	}
		}
		else
		{
		    ?>
			  <script>alert("usted se encuentra inhabilitado en el sistema. Por favor contacte al coordinador de prácticas.")</script>
			  <script>location.replace('index.php?');</script>
			<?php		  
		}
	 }
// sino
	 else
	 {
	   $persona = new Administrador($datos);
	   //Verificamos se es administrador...
	   if($persona->autenticar())
		{
		  ?>
		   <script>location.replace('index.php?id=3');</script>
		  <?php
		}
        //sino		
		else
		{
		  $persona = new Supervisor($datos);
		  //Verificamos si es supervisor
 		  if($persona->autenticar())
		  {
		   ?>
			 <script>location.replace('index.php?id=4');</script>
		   <?php
	  	  }	
		}
        //sino enviamos un error de permisos		
		?>
		<script>location.replace('index.php?err=2');</script>
		<?php
	 }
	}
?>	