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
	<a href="index.php?id=5">SALIDA SEGURA</a>
	<a href="index.php?id=2"><img src="img/inicio.png" border="0" />Inicio</a>
  </div>
  <div>
	<span>Ayuda</span>
	<a href="ManualEstudianteSP2.pdf" target="_blank">Manual Estudiante</a>
  </div>
  <div>
	<span>Perfil</span>
	<a href="index.php?id=101">Actualizar</a>
	<a href="index.php?id=11&rol=Estudiante">Cambiar Contra</a>
  </div>
  <div>
	<span>Consultar</span>
	<a href="index.php?id=102">Entidad</a>
  </div>
  <div>
	<span>Supervision</span>
	<a href="index.php?id=104">Convenios para supervision</a>
  </div>
</div>