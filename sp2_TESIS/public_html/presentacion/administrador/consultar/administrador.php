<?php 
	session_start();	
	require_once('logica/Administrador.php');	
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
?>
<!DOCTYPE html>
<html>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
		<h3>Consultar Administrador</h3>
			<table border="0" align="center">			
				<tr class="titulo">				
					<td align="center"><strong>Codigo</strong></a></td>
					<td align="center"><strong>Cedula</strong></a></td>
					<td align="center"><strong>Nombre</strong></a></td>
					<td align="center"><strong>Apellido</strong></a></td>
					<td align="center"><strong>Correo</strong></a></td>
					<td align="center"><strong>Telefono</strong></a></td>
					<td align="center"><strong>Celular</strong></a></td>
					<td align="center"><strong>Direccion</strong></a></td>
				</tr>
				<?php 
				$administrador = new Administrador(array()); 
				$administradores = $administrador->consultarTodos("nombre");
				for($i=0; $i<=count($administradores)-1; $i++)
					{
					echo "<tr ", ($i%2==0) ? "class='impar' onMouseOver=this.className='verde' onMouseOut=this.className='impar' onMouseDown=this.className='naranja'" : "class='par' onMouseOver=this.className='verde' onMouseOut=this.className='par' onMouseDown=this.className='naranja'" , ">";
					echo "<td>",$administradores[$i]->getCodigo(),"</td><td>",$administradores[$i]->getCedula(),"</td><td>",$administradores[$i]->getNombre(),"</td><td>",$administradores[$i]->getApellido(),"</td><td>",$administradores[$i]->getCorreo(),"</td><td>",$administradores[$i]->getTelefono(),"</td><td>",$administradores[$i]->getCelular(),"</td><td>",$administradores[$i]->getDireccion(),"</td>";			
					echo "</tr>";					
					}
				echo "<tr><td colspan='10'><strong>".count($administradores)." registros encontrados<strong></td></tr>";
				?>	  
			</table>		   
		</td>
	</tr>
</table>
</body>
</html>

	
