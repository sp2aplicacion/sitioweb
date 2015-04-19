<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Programa.php');
	require_once('logica/Facultad.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Administrador(array($idPersona));
	$persona->consultar();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}

	$id=$_POST['id'];
	$nombre=$_POST['nombre'];
	$director=$_POST['director'];
	$idfacultad = $_POST['facultad']; 
	$visible = 0;


	$datos = array();
	
	$datos[0]=$id;
	$datos[1]=$nombre;
	$datos[2]=$director;
	$datos[3]=$visible;
	$datos[4] = $idfacultad;
	$nombreFacultad = "";

	//echo("responsable: ".$datos[2]."Programa: ".$datos[3]);
	$programa= new Programa($datos);
	$programa->insertar();
   
    $nom_facultad=$programa->consultarFacultad();

?>
<!DOCTYPE html>
<html>

<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Info Programa Agregado</h3>
			<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">ID</label><?php echo $id ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><?php echo $nombre ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Director</label><?php echo $director ?></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Facultad</label><?php echo $nom_facultad ?></fieldset>
		    </div>
		</td>
	</tr>
</table>
</body>
</html>*/

	

