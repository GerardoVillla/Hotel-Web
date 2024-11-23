<?php
require_once ("../../servidor/sesion.php");
validarSesionAdministrador();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/adminpanel-styles.css">
	<title>Panel Administrador</title>
</head>
<body>
	<header>
		<h1>Hotel ecológico</h1>
		<nav>
			<ul>
				<form action="../../servidor/autenticacion.php" method="post" >
				<input type="hidden" name="action" value="cerrarsesion">
				<input type="submit" value="Salir">
				<!--<li id="btn-menu"><a href="../../servidor/autenticacion.php?action=cerrarsesion">Salir</a></li>-->
				</form>
			</ul>
		</nav>
	</header>
	<section id="panel-admin">
		<div id="barra-editor">
			<form>
				<span>
					<select name="categorias" id="Categorias-cuarto">
						<option value= "Todas" selected>Todas</option>
						<option value="Estandar">Estandar</option>
						<option value="Deluxe">Deluxe</option>
						<option value="Suite">Suite</option>
					</select>
				</span>
				<div id="botones-panel">
					<input id="btn-agregar" type="button" value="Agregar" onClick="dirigirAeditar('añadir')">
					<input id="btn-editar" type="button" value="Editar" onClick="dirigirAeditar('editar')">
					<input id="btn-eliminar"type="button" value="Eliminar" onClick="eliminarHab()">
				</div>
			</form>
		</div>
		<div id="seccion-habitaciones">
			<ul id="lista-cuartos">
				<li class="habitacion-propiedades" onClick="selecc_cuarto(this)" data-tipo="Suite">	
				</li>
			</ul>
		</div>
	</section>
	<footer>
		<p>&copy; Todos los derechos reservados</p>
	</footer>
	<script src="../scripts/adminpanel.js"></script>
</body>
</html>