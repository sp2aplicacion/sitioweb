<?php 
	session_start();	
    require_once('logica/Estudiante.php');
    require_once('logica/Administrador.php');
    require_once('logica/Supervisor.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
	{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
	}
	$persona = new Estudiante(array($idPersona));
	$persona->eliminar_sesion();
    ?>
	   <script>location.replace('index.php');</script>	
    <?php	
?>