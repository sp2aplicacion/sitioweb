<?php
session_start();
require_once('logica/Administrador.php');
require_once('logica/Eps.php');
$idPersona = $_SESSION['idPersona'];
if ($idPersona == "") {
    ?>
    <script>location.replace('index.php');</script>	
    <?php
}
$persona = new Administrador(array($idPersona));
$persona->consultar();
if ($persona->getNombre() == "") {
    ?>
    <script>location.replace('index.php?id=-1');</script>	
    <?php
}
$nombreeps = $_POST['nombreeps'];


$datos = array();

$datos[1] = $nombreeps;


//echo("responsable: ".$datos[2]."Programa: ".$datos[3]);
$Eps = new Eps($datos);
$Eps->insertar();
//$nom_eps=$Eps->consultar();
?>
<!DOCTYPE html>
<html>
    <body>
        <div align="center"><?php include("presentacion/banner.php") ?></div>
        <div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
        <table class="tabla">
            <tr>
                <td class="menu"><?php include("presentacion/menuAdministrador.php"); ?></td>		
                <td valign="top">
                    <h3>Info Eps Agregada</h3>
                    <div align="center">
                        <fieldset><label class="impar" onMouseOver="this.className = 'verde'" onMouseOut="this.className = 'impar'">Nombre Eps</label><?php echo $nombreeps ?></fieldset>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>


