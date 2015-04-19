<?php 
	session_start();	
	require_once('logica/Estudiante.php');	
	require_once('logica/Facultad.php');	
	$idPersona=$_SESSION['idPersona'];
	$actualizado=false;
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	if(!empty($_POST['actualizar']))
		{
		 $hv=str_replace(" ","_",$_FILES['hv']['name']);			 
		 $tipo=$_FILES['hv']['type'];
		 
		 $extension="";
		 if($tipo=="application/vnd.openxmlformats-officedocument.wordprocessingml.document")
      		  $extension=".doc";
		 else if($tipo=="application/msword")
			  $extension=".doc";
         else if($tipo=="application/pdf")
		      $extension=".pdf";
		 else { 
			  ?> 
			  <script>alert('El archivo debe ser unicamente de extension doc, docx o pdf');history.go(-1);</script>	
			  <?php		
			}
			
		 $_FILES['hv']['name']=$_POST['codigo'];
		 $hv=$_FILES['hv']['name'];	
		 
		 if($hv!="")
		 {
		   	$rutalocal=$_FILES['hv']['tmp_name'];
			$hv=date("Y-m-d_H_i_").$hv.$extension;
		    $rutaservidor = "archivos/".$hv;				
		    copy($rutalocal,$rutaservidor);	
		    chmod($rutaservidor,0777);	

		 }
//		 echo($hv);
		 $datos = array();
		 $datos[0]=$_POST['codigo'];
		 $datos[1]=$_POST['cedula'];
		 $datos[2]=$_POST['nombre'];
		 $datos[3]=$_POST['apellido'];
		 $datos[5]=$_POST['correo'];
		 $datos[6]=$_POST['telefono'];
		 $datos[7]=$_POST['celular'];
		 $datos[8]=$_POST['direccion'];
		 $datos[9]=$hv;
		 $datos[10]=$_POST['semestre'];
		 $datos[12]=$_POST['eps'];
		 $datos[13]=$_POST['observaciones'];
		 $datos[14]=$_POST['facultad'];	
		 $persona = new Estudiante($datos);
		 $persona->actualizar();
		 $actualizado=true;
		}

	    $persona = new Estudiante(array($idPersona));
	    $persona->consultar();
	//	echo('HV:'.$persona->getHv());
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
<script src="scripts/validarIngresarEstudiante.js"></script>
<script src="scripts/validarCorreo.js"></script>
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script>
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});

function validar()
	{
	if((mensaje=verificar(document.forms.Formulario))!="") 
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Estudiante</em><p>'+mensaje+'</p>');return false;}
	if((mensaje=emailCheck(document.forms.Formulario.correo.value))!="")
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Correo</em><p>'+mensaje+'</p>');return false;}		
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
		<h3>Perfil Estudiante</h3>
		<form name="Formulario" method="post" action="index.php?id=101" enctype="multipart/form-data">
			<?php if ($actualizado) {echo "<div align='center'><font color='red''><strong>Datos Actualizados</strong></font></div>";}?>
			<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Codigo</label><input name="codigo" type="text" value="<?php echo $persona->getCodigo() ?>" readonly></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Cedula</label><input name="cedula" type="text" value="<?php echo $persona->getCedula() ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><input name="nombre" type="text" value="<?php echo $persona->getNombre() ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Apellido</label><input name="apellido" type="text" value="<?php echo $persona->getApellido() ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Correo institucional</label><input name="correo" type="text" value="<?php echo $persona->getCorreo() ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Telefono</label><input name="telefono" type="text" value="<?php echo $persona->getTelefono() ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Celular</label><input name="celular" type="text" value="<?php echo $persona->getCelular() ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Direccion</label><input name="direccion" type="text" value="<?php echo $persona->getDireccion() ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><?php if ($persona->getHv()=="") echo "Hoja de Vida"; else echo "<a href='archivos/".$persona->getHv()."'>Hoja de Vida</a>"; ?></label><input name="hv" type="file"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Semestre</label><select name="semestre">
			<option value="Sexto"<?php if ($persona->getSemestre()=="Sexto") echo " selected"?>>Sexto</option>
			<option value="Septimo"<?php if ($persona->getSemestre()=="Septimo") echo " selected"?>>Septimo</option>
			<option value="Octavo"<?php if ($persona->getSemestre()=="Octavo") echo " selected"?>>Octavo</option>
			<option value="Noveno"<?php if ($persona->getSemestre()=="Noveno") echo " selected"?>>Noveno</option>
			<option value="Decimo"<?php if ($persona->getSemestre()=="Decimo") echo " selected"?>>Decimo</option>
			<option value="Decimo Primero"<?php if ($persona->getSemestre()=="Decimo Primero") echo " selected"?>>Decimo Primero</option>
			</select></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Estado</label><input name="estado" type="text" readonly value="<?php echo $persona->estados[$persona->getEstado()] ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">EPS</label><input name="eps" type="text" value="<?php echo $persona->getEps() ?>"></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Observaciones</label><textarea name="observaciones" readonly><?php echo $persona->getObservaciones() ?></textarea></fieldset>
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Facultad</label><select name="facultad">
			<?php 
			$facultad = new Facultad("","","","",""); 
			$facultades = $facultad->consultarTodos();		
			for($i=0; $i<count($facultades); $i++)
				echo "<option value='".$facultades[$i]->getId()."'". (($persona->getFacultad()==$facultades[$i]->getId())? " selected" : "").">".$facultades[$i]->getNombre()."</option>";
			?>				
			</select></fieldset>
			<input name="actualizar" type="submit" value="Actualizar" onClick="return validar();">	
			</div>			
		</form>
		</td>
	</tr>
</table>
</body>
</html>