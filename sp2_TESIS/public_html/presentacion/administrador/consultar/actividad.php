<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Actividad.php');	
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
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/toolTip.css"> 
<script src="scripts/toolTip.js"></script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Editar el Proceso '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==2)
		ddrivetip('La Situacion '+parametro+' ya esta incluida en la Seccion',((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Consultar Actividad</h3>
			<table border="0" align="center">			
				<tr class="titulo">				
					<td></td>
					<td align="center"><strong>Nombre</strong></td>
					<td align="center"><strong>Area</strong></td>
				</tr>
				<?php 
				$actividad = new Actividad(array()); 
				$actividades = $actividad->consultarTodos("nombre");
				for($i=0; $i<count($actividades); $i++)
					{
					echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
					echo "<td><a href='index.php?id=264&idEdit=",$actividades[$i]->getId(),"'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'".str_replace(" ","_",$actividades[$i]->getNombre())."') onMouseout=hideddrivetip()></a></td><td>",$actividades[$i]->getNombre(),"</td><td>",$actividades[$i]->getArea(),"</td>";					
					echo "</tr>";					
					}
				echo "<tr><td colspan='10'><strong>".count($actividades)." registros encontrados<strong></td></tr>";
				?>	  
			</table>		   
		</td>
	</tr>
</table>
</body>
</html>

	
