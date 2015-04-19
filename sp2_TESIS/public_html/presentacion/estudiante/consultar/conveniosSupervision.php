<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Empresa.php');	
	require_once('logica/Area.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Estudiante(array($idPersona));
	$persona->consultar();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$dias=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	$tipo=array("Horario Practica","Reunion Individual","Reunion Grupal");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/toolTip.css" /> 
<script src="scripts/toolTip.js"></script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Agregar actividad al control diario de practica'+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==2)
		ddrivetip('Consultar actividad del control diario de practica'+parametro,((parametro.length*8)>200)?parametro.length*8:200)	
	if(men==3)
		ddrivetip('Consultar seguimiento quincenal'+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	if(men==4)
		ddrivetip('Consultar sesion de supervision'+parametro,((parametro.length*8)>200)?parametro.length*8:200)
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
		<h3>Convenios para supervision</h3>
			<table border="0" align="center">			
				<tr class="titulo">				
					<td align="center"><strong>Horario</strong></td>
					<td align="center"><strong>Servicios</strong></td>
					<td align="center"><strong>Supervisor</strong></td>
					<td align="center"><strong>Correo</strong></td>
					<td align="center"><strong>Convenio</strong></td>
					<td align="center"><strong>Periodo</strong></td>
					<td align="center"><strong>Entidad</strong></td>
					<td align="center"><strong>Area</strong></td>
				</tr>
				<?php 
				$convenio = new Convenio(array()); 
				$convenios=$convenio->consultarSupervisionEstudiante($idPersona);
				for($i=0; $i<count($convenios); $i++)
					{
					echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
					$horarios=$convenio->consultarHorarioSupervision($convenios[$i][7]);
					echo "
					<td align='center' nowrap><table border='0'>";
					for($j=0; $j<count($horarios); $j++)
						{
						echo "<tr><td>",$dias[$horarios[$j][1]]."</td><td>",substr($horarios[$j][2],0,5),"-",substr($horarios[$j][3],0,5),"</td><td>",$tipo[$horarios[$j][4]],"</td></tr>";
						}
					echo "</table></td>
					<td align='center'><strong>Estudiante</strong><br /><a href='index.php?id=105&idConEstSup=".$convenios[$i][7]."'><img src='img/agregar.png' border='0' onMouseover=mensaje(1,'') onMouseout=hideddrivetip() ></a>|<a href='index.php?id=106&idConEstSup=".$convenios[$i][7]."'><img src='img/consultar.png' border='0' onMouseover=mensaje(2,'') onMouseout=hideddrivetip()></a><hr /><strong>Supervisor</strong><br /><a href='index.php?id=107&idConEstSup=".$convenios[$i][7]."'><img src='img/quincenal.png' border='0' onMouseover=mensaje(3,'') onMouseout=hideddrivetip()></a>|<a href='index.php?id=108&idConEstSup=".$convenios[$i][7]."'><img src='img/consultar.png' border='0' onMouseover=mensaje(4,'') onMouseout=hideddrivetip()></a></td>
					<td align='center' nowrap>",$convenios[$i][2]," ",$convenios[$i][3],"</td>
					<td align='center' nowrap>",$convenios[$i][4],"</td>
					<td align='center' nowrap>",$convenios[$i][9],"</td>
					<td align='center' nowrap>",$convenios[$i][10],"</td>";					
					$empresa=new Empresa(array($convenios[$i][11]));
					$empresa->consultar();
					echo "<td align='center'>",$empresa->getNombre(),"</td>";
					$area=new Area(array($convenios[$i][12]));
					$area->consultar();
					echo "<td align='center'>",$area->getNombre(),"</td>";
					}
				echo "<tr><td colspan='10'><strong>".count($convenios)." registros encontrados<strong></td></tr>";
				?>	  
			</table>		   
		</td>
	</tr>
</table>
</body>
</html>

	
