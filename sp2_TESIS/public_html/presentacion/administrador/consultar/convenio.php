<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Empresa.php');	
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
	$nitEmpresa=$_GET['nitEmpresa'];
	$empresa=new Empresa(array($nitEmpresa));
	$empresa->consultar();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos/toolTip.css"> 
<script src="scripts/toolTip.js"></script>
<script language="Javascript">
function confirmacion(men,parametro){
	if(men==1)
		return confirm('Esta seguro que desea retirar del convenio el estudiante con codigo: '+parametro+ '?');
	else if(men==2)
		return confirm('Esta seguro que desea retirar el Convenio'+parametro+ '?');
			
}

function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Editar este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==2)
		ddrivetip('Colocar NO visible este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==3)
		ddrivetip('Colocar visible este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==4)
		ddrivetip('Colocar NO firmado este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==5)
		ddrivetip('Colocar firmado este Convenio',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==6)
		ddrivetip('Aceptar el estudiante con codigo '+parametro+' al convenio',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==7)
		ddrivetip('Rechazar el estudiante con codigo '+parametro+' del convenio',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==8)
		ddrivetip('Fecha y hora de asignacion: '+parametro+'.<br>Click para deshacer la operacion',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==9)
		ddrivetip('Fecha y hora de aplicacion: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==10)
		ddrivetip('Cancelar Operacion del estudiante con codigo: '+parametro+'<br>NOTA: Si esta operacion no se realiza, consulte el estado del estudiante y asignelo correctamente.',((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==11)
		ddrivetip('Retirar del convenio al estudiante con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==12)
		ddrivetip('Eliminar este Convenio'+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==13)
		ddrivetip('El estudiante tiene asignado al supervisor con codigo: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
}

function asignarValorLista(){
	texto=document.getElementById('textoConsultaLista');
	valor=document.getElementById('valorConsultaLista');
	lista=document.getElementById('listaEstudiantes');
	valor.value=lista.value;
	texto.value=lista.options[lista.selectedIndex].text;
	lista.style.display='none';
}
</script>
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/ajax.js"></script>
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script>
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});

</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php");?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Consultar Convenio de Entidad <br><?php echo $empresa->getNombre(); ?></h3>
		<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Periodo</label><select name="q" id="q" onchange="return buscar(26,'&nitEmpresa=<?php echo $nitEmpresa?>')">
			<option value="0">Seleccione</option>
			<?php 
			$convenio = new Convenio(array()); 
			$periodos = $convenio->consultarPeriodos();		
			for($i=0; $i<count($periodos); $i++)
				echo "<option value='".$periodos[$i]."'>".$periodos[$i]."</option>";
			?>				
			</select></fieldset>					
			<span id="loading"></span>
		</div>
		<div align="center"><span id="loading"><img src="img/loading2.gif"></span></div>
		<div id="resultados"></div>
		</td>
	</tr>
</table>
</body>
</html>

	
