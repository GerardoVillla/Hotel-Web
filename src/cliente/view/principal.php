<?php
require_once ("../../servidor/sesion.php");
validarSesionPantallaPrincipal();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/home-styles.css">
	<title>Hotel ecológico</title>
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
	<!-- Contenido de la pagina -->
	<div class="contenido">
		<div id="img-home">
			<img src="../recursos/img/principal/principal2.jpg" alt="img de bienvenida">
		</div>
		<section id="bienvenida-tarjeta">
			<div class="articulo">
				<h1 class="playfair-display-subtitulo">Bienvenido a <span>Hotel Ek' Balam</span></h1>
				<p class="playfair-display-parrafo">Localizado a tan solo 3 minutos del Aeropuerto Internacional de Mérida y a 10 minutos del centro
					histórico.
					El Hotel Hacienda Inn ofrece una opción única en Yucatán.
					Se caracteriza por una gran personalidad, con un ambiente cómodo y relajado con un estilo
					tradicional de
					Hacienda Yucateca, las 116 habitaciones del Hotel están completamente equipadas por lo que su
					estancia será
					placentera. Puede reservar al instante la habitación de su agrado y puede visualizar las ofertas
					especiales.
				</p>
			</div>
			<img src="../recursos/img/principal/bienvenida.png" alt="img ek' balam">
		</section>
		<section id="desglose-habitaciones">
			<h1>
				< Nuestras habitaciones>
			</h1>
			<div class="carrusel-container">
			    <button id="prev" class="carrusel-btn">‹</button>
			    <div class="carrusel" id="carrusel">
			        <!-- Las tarjetas de habitaciones se llenarán dinámicamente con JavaScript -->
			    </div>
			    <button id="next" class="carrusel-btn">›</button>
			</div>
		</section>
		<section id="nosotros-tarjeta">
			<div id="articulo-nosotros">
				<img src="../recursos/img/principal/bienvenida.png" alt="img ek' balam">
				<div id="descripcion-nosotros">
					<h2>Acerca de nosotros</h2>
					<p>Somos un refugio ecológico situado en el corazón de la selva maya, donde la naturaleza y la
						cultura se entrelazan para ofrecerte una experiencia única.Nuestro hotel se erige en un entorno
						sostenible,
						comprometido con la conservación del medio ambiente y la promoción de prácticas responsables.
						Nuestra misión es proporcionar experiencias auténticas que resalten la riqueza de la cultura
						maya.Desde actividades de ecoturismo hasta talleres de artesanías locales, cada momento en Hotel Ek'
						balam te permitirá sumergirte en las tradiciones y costumbres de este fascinante pueblo.
						Estamos dedicados a reducir nuestra huella ambiental mediante el uso de energías renovables,
						sistemas de recolección de agua de lluvia y prácticas de reciclaje.
				</div>
			</div>
		</section>
	</div>
	<footer>
		<p>&copy; Todos los derechos reservados</p>
	</footer>
	<script type="module" src="../scripts/principal.js"></script>
</body>

</html>