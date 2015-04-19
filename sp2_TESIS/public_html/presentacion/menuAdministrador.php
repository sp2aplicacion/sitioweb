
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
</head>
<body>
	<div class="menu" align="center"><a href="#" onclick="myMenu.collapseAll()">Contraer</a> <a href="#" onclick="myMenu.expandAll()">Expandir</a></div>
<div style="float:left" id="my_menu" class="sdmenu">
  <div>
	<span>Salir</span>
	<a href="index.php?salida=1">SALIDA SEGURA</a>
	<a href="index.php?id=3"><img src="img/inicio.png" border="0" />Inicio</a>
  </div>
  <div>
	<span>Ayuda</span>
	<a href="ManualAdministradorSP2_1.pdf" target="_blank">Manual Administrador Parte 1</a>
	<a href="ManualAdministradorSP2_2.pdf" target="_blank">Manual Administrador Parte 2</a>
	<a href="ManualSupervisorSP2.pdf" target="_blank">Manual Supervisor</a>
	<a href="ManualEstudianteSP2.pdf" target="_blank">Manual Estudiante</a>
  </div>
  <div>
	<span>Perfil</span>
	<a href="index.php?id=201">Actualizar</a>
	<a href="index.php?id=11&rol=Administrador">Cambiar Contra</a>
  </div>
  <div>
	<span>Agregar</span>
	<a href="index.php?id=202">Administrador</a>
	<a href="index.php?id=211">Estudiante</a>
	<a href="index.php?id=221">Supervisor</a>
	<a href="index.php?id=231">Entidad</a>
	<a href="index.php?id=251">Area Profesional</a>
	<a href="index.php?id=256">Facultad</a>
	<a href="index.php?id=260">Programa</a>
	<a href="index.php?id=298">EPS</a>
    
  </div>
  <div>
	<span>Consultar</span>
	<a href="index.php?id=204">Administrador</a>
	<a href="index.php?id=213">Estudiante</a>
	<a href="index.php?id=223">Supervisor</a>
	<a href="index.php?id=233">Entidad</a>
	<a href="index.php?id=276">Convenio</a>
	<a href="index.php?id=253">Area Profesional</a>
	<a href="index.php?id=258">Facultad</a>
	<a href="index.php?id=268">Programa</a>
	<a href="index.php?id=297">EPS</a>
  </div>
  <div>
	<span>Supervisi&oacute;n</span>
	<a href="index.php?id=291">Convenios para Supervisi&oacute;n</a>
	<a href="index.php?id=295">Reasignaci�n</a>
  </div>
  <div>
	<span>Reportes</span>
	<a href="index.php?id=281">Est Inscritos</a>
	<a href="index.php?id=282">Convenios</a>
	<a href="index.php?id=283">Historial Est</a>
	<a href="index.php?id=284">Entidades</a>
  </div>
  <div>
	<span>Administraci�n</span>
	<a href="index.php?id=288">Cierre del 40%</a>
	<a href="index.php?id=285">Cierre Periodo</a>
	<a href="index.php?id=286">Inhabilitar</a>
	<a href="index.php?id=287">Restablecer contrase�a</a>
  </div>
</div>
</body>
</html>


