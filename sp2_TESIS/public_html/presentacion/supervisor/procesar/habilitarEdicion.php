<?php 
	session_start();	
	require_once('logica/Supervisor.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Area.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>	
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Supervisor(array($idPersona));
	$persona->consultarNombre();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$idCDP=$_GET['idCDP'];
	$idConEstSup=$_GET['idConEstSup'];	
	
//	echo('Control Diario de practica='.$idCDP);
//	echo('ConvenioEstudianteSupervisor='.$idConEstSup);
    
	$convenio = new Convenio(array()); 
	if($convenio->habilitarEdicion($idCDP,$idConEstSup))
	{
      ?>	
	    <script>alert("Edición habilitada. A partir de ahora el estudiante tiene un plazo de 12 horas para corregir su registro.");history.go(-1);</script>	
	  <?php	
    }
	else
	{
      ?>	
	    <script>alert('Error. Comuníquese con el administrador del sistema');history.go(-1);</script>	
	  <?php		   
	}
	
?>

	

