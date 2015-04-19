<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Reporte.php');	
	require_once('logica/Convenio.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Estudiante(array($idPersona));
	$persona->consultarNombre();
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
		ddrivetip('Resolver situaciones de la seccion: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Estudiante: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuEstudiante.php");?></td>		
		<td valign="top">
		<h1>Bienvenido Estudiante</h1>
		<h2>Resumen de Actividades</h2>
			<table border="0" align="center">	
				<tr class="titulo">
					<td align="center" colspan="10"><strong>INSCRIPCIONES</strong></a></td>
				</tr>		
				<tr class="titulo">									
					<td align="center"><strong>NIT Entidad</strong></a></td>
					<td align="center"><strong>Entidad</strong></a></td>
					<td align="center"><strong>Convenio</strong></a></td>
					<td align="center"><strong>Area</strong></a></td>
					<td align="center"><strong>Fecha Aplicacion</strong></a></td>
					<td align="center"><strong>Estado</strong></a></td>
				</tr>
				<?php 
				$convenio=new Convenio(array());
				$reporte = new Reporte(); 
				$reportes = $reporte->estudianteInscrito($idPersona);
				for($i=0; $i<count($reportes); $i++)
					{
					echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
					echo "<td>",$reportes[$i][1][0],"</td><td>",$reportes[$i][1][1],"</td><td>",$reportes[$i][0][0],"</td><td>",$reportes[$i][2][1],"</td><td>",$reportes[$i][0][3]," ".$reportes[$i][0][4]."</td><td>",$convenio->estados[$reportes[$i][0][5]],"</td>";			
					echo "</tr>";					
					}
				echo "<tr><td colspan='10'><strong>".count($reportes)." registros encontrados<strong></td></tr>";
				?>	  
			</table>		   		
		</td>
	</tr>
</table>
</body>
</html>

	

