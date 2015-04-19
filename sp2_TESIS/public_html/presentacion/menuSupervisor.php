<link rel="stylesheet" type="text/css" href="estilos/sdmenu.css" />
<script type="text/javascript" src="scripts/sdmenu.js"></script>
<script type="text/javascript">
// <![CDATA[
var myMenu;
window.onload = function() {
	myMenu = new SDMenu("my_menu");
	myMenu.init();
};
// ]]>
</script>
<div class="menu" align="center"><a href="#" onclick="myMenu.collapseAll()">Contraer</a> <a href="#" onclick="myMenu.expandAll()">Expandir</a></div>
<div style="float:left" id="my_menu" class="sdmenu">
  <div>
	<span>Salir</span>
	<a href="index.php?salida=1">SALIDA SEGURA</a>
	<a href="index.php?id=4"><img src="img/inicio.png" border="0" />Inicio</a>
  </div>
  <div>
	<span>Ayuda</span>
	<a href="ManualSupervisorSP2.pdf" target="_blank">Manual Supervisor</a>
  </div>
  <div>
	<span>Perfil</span>
	<a href="index.php?id=401">Actualizar</a>
	<a href="index.php?id=11&rol=Supervisor">Cambiar Contra</a>
  </div>
  <div>
	<span>Consultar</span>
	<a href="index.php?id=402">Estudiantes a Cargo</a>
  </div>
 <!-- estaba tratando de que el supervisor pudiera resetear la contraseña de sus estudiantes pero no pude...  -->
   <div>
	<span>Administración</span>
	<a href="index.php?id=409">Restablecer contraseña</a>
  </div>
</div>