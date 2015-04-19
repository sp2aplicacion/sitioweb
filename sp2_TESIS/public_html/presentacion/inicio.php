<?php 
    session_register("idPersona");	
	if(!empty($_GET['salida']))
		{$_SESSION['idPersona']="";}
	$err=0;
	if(!empty($_GET['err']))
		{$err=$_GET['err'];}	
?>
<html>
<body>
<div align="center"><?php include("banner.php")?></div>
<h3>MATEMÁTICAS E INGENIERÍAS</h3>
<?php
	if($err==1)
	{echo "<div class='error'>ERROR DE ACCESO. Debe llenar ambos campos</div>";}
	else if($err==2)
	{echo "<div class='error'>ERROR DE ACCESO. Error de Id o contraseña</div>";}
?>
<form name="acceso" method="post" action="index.php?id=1">  
	<div align="center">
	<fieldset class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><label>Codigo</label><input name="id" type="text"></fieldset>
	<fieldset class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'"><label>Contrase&ntilde;a</label><input name="contra" type="password"></fieldset>
	<input type="submit" name="Submit" value="Acceso">
	</div>
	<div align="center"><strong>Olvido su contrasena??<br> Contacte a su supervisor o coordinador</strong></div>
</form>
</body>
</html>
