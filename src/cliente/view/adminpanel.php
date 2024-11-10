<?php
require_once ("../../servidor/sesion.php");
validarSesion();
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
				<li id="btn-menu"><a href="#">Menu</a></li>
			</ul>
		</nav>
	</header>
	<section id="panel-admin">
		<div id="barra-editor">
			<form>
				<span>
					<select name="categorias" id="Categorias-cuarto">
						<option disabled selected>...</option>
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
				<li class="habitacion-propiedades" onClick="selecc_cuarto(this)" data-tipo="Estandar">
					<img src="../recursos/img/principal/deluxe.jpg" alt="">
						<div class="detalles-habitacion">
							<h2 id="nombre-habitacion">Estandar</h2>
							<p><strong>Categoría:</strong> <span id="categoria-habitacion">Economico</span></p>
							<p><strong>Disponibilidad:</strong> <span id="disponibilidad-habitacion">Disponible</span></p>
							<p><strong>Habitaciones:</strong> <span id="cantidad-habitacion">5</span></p>
							<p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">5</span></p>
							<p><strong>Costo:</strong> <span id="costo-habitacion">$1200</span></p>
						</div>	
				</li>
				<li class="habitacion-propiedades" onClick="selecc_cuarto(this)" data-tipo="Suite">
					<img src="../recursos/img/principal/deluxe.jpg" alt="">
						<div class="detalles-habitacion">
							<h2 id="nombre-habitacion">Suite</h2>
							<p><strong>Categoría:</strong> <span id="categoria-habitacion">Ejecutiva</span></p>
							<p><strong>Disponibilidad:</strong> <span id="disponibilidad-habitacion">Disponible</span></p>
							<p><strong>Habitaciones:</strong> <span id="cantidad-habitacion">5</span></p>
							<p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">5</span></p>
							<p><strong>Costo:</strong> <span id="costo-habitacion">$2000</span></p>

						</div>	
					</li>
					<li class="habitacion-propiedades" onClick="selecc_cuarto(this)" data-tipo="Deluxe">
						<img src="../recursos/img/principal/deluxe.jpg" alt="">
							<div class="detalles-habitacion">
								<h2 id="nombre-habitacion">Deluxe</h2>
								<p><strong>Categoría:</strong> <span id="categoria-habitacion">Deluxe</span></p>
								<p><strong>Disponibilidad:</strong> <span id="disponibilidad-habitacion">Disponible</span></p>
								<p><strong>Habitaciones:</strong> <span id="cantidad-habitacion">5</span></p>
								<p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">5</span></p>
								<p><strong>Costo:</strong> <span id="costo-habitacion">$3000</span></p>
							</div>	
					</li>
			</ul>
		</div>
	</section>
	<footer>
		<p>&copy; Derechos reservados a un tal fulano</p>
	</footer>
	<script src="../scripts/adminpanel.js"></script>
</body>
</html>