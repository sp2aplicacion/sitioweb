<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Area.php');	
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
	$idConEstSup=$_GET['idConEstSup'];
?>
<!DOCTYPE html>
<html>
<head>
<script>
function abrir(pagina) {
	var fecha=document.forms[0].fecha.value;
	if(fecha==""){
		alert("Debe incluir una fecha");
	}else{
		var objfecha=new Date(fecha.substring(0,4),fecha.substring(5,7)-1,fecha.substring(8,10));
		if(objfecha.getDay()!=1){
			alert("La fecha seleccionada debe ser Lunes");
		}else{
			window.open(pagina+"&fecha="+fecha, 'null', 'height=600,width=1000,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');
		}
	}
}
</script>
<script src="scripts/CalendarPopup.js" type="text/javascript"></script>
<script>document.write(getCalendarStyles());</script>
<script>
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</script>
<link rel="stylesheet" href="estilos/CalendarPopup.css" type="text/css" media="all" />
<link rel="stylesheet" href="estilos/toolTip.css" /> 
<script src="scripts/toolTip.js"></script>
<script src="scripts/ajax.js"></script>
<script language="Javascript">
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Editar control diario de practica '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
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
			<h3>Consultar Control Diario de Practica</h3>
			<form name="Formulario">
			<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Seleccione el dia lunes de la semana de la cual desea generar el reporte en PDF</label><input name="fecha" type="text" id="fecha" onclick="cal1xx.select(document.forms[0].fecha,'fecha','yyyy-MM-dd'); return false;" readonly="true" /></fieldset>	
			</div>
			<div align="center"><input type="button" value="Generar PDF" onClick="abrir('index.php?id=901&idConEstSup=<?php echo $idConEstSup; ?>&idEstudiante=<?php echo $idPersona ?>');" /></div>
			</form>
			<?php
			$tiempoActual=mktime();			 
			$convenio = new Convenio(array()); 
			$controlesDiarios=$convenio->consultarControlDiarioPractica($idConEstSup);
			echo "<table align='center' border='0'>";
			echo "<tr class='titulo'><td></td><td><strong>No</strong></td><td align='center'><strong>Fecha</strong></td><td align='center'><strong>Hora Entrada</strong></td><td align='center'><strong>Hora Salida</strong></td><td align='center'><strong>Duracion</strong></td><td align='center'><strong>Actividades</strong></td><td align='center'><strong>Fecha Registro</strong></td><td align='center'><strong>Hora Registro</strong></td></tr>";
			for($i=0; $i<count($controlesDiarios); $i++)
				{
				echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
				$tiempoRegistro=mktime(substr($controlesDiarios[$i][7], 0,2),substr($controlesDiarios[$i][7],3,2),0,substr($controlesDiarios[$i][6], 5,2),substr($controlesDiarios[$i][6], 8,2),substr($controlesDiarios[$i][6], 0,4));
				$tiempoDif=$tiempoActual-$tiempoRegistro;
				$tiempoDif/=3600;
				echo "					
				<td align='center'>", ($tiempoDif<=12)?"<a href='index.php?id=109&idCDP=".$controlesDiarios[$i][0]."&idConEstSup=".$idConEstSup."'><img src='img/editar.png' border='0' onMouseover=mensaje(1,'') onMouseout=hideddrivetip() /></a>": "" ,"</td>
				<td align='center'>",$i+1,"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][1],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][2],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][3],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][4],"</td>
				<td align='left'>",str_replace("\n","<br>",$controlesDiarios[$i][5]),"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][6],"</td>
				<td align='center' nowrap>",$controlesDiarios[$i][7],"</td>";
				}
			echo "</table>";
			?>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>

	

