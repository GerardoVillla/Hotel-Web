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
	<link rel="stylesheet" href="../css/home-styles.css">
	<title>Panel Administrador</title>
</head>
<body>
	<header>
		<h1><img id="logo" src="../recursos/img/iconos/logopng.png" alt="">Ek' Balam</h1>
		<nav>
			<ul>
				<li><a href="pagar.php"><img class="icono-encabezado" src="../recursos/img/iconos/carrito-de-compras.png"></a></li>
				<li><a href="buscar.php"><img class="icono-encabezado" src="../recursos/img/iconos/lupa.png"></a></li>
				<li><a href="misReservaciones.php"><img class="icono-encabezado" src="../recursos/img/iconos/avatar.png"></a></li>
				<li><a href="#nosotros-tarjeta"><img class="icono-encabezado" src="../recursos/img/iconos/informacion.png" alt=""></a></li>
				<li id="cerrarSesion"><a href="#"><img class="icono-encabezado" src="../recursos/img/iconos/cerrar-sesion.png"></a></li>
				<li id="btn-reservar"><a href="reservar.php">Reservar</a></li>
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