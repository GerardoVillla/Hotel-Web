<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/hotel/src/cliente/css/home-styles.css">
	<title>Hotel ecológico</title>
</head>

<body>
	<header>
		<h1>Hotel ecológico</h1>
		<nav>
			<ul>
				<li><a href="index.html">Carrito</a></li>
				<li><a href="#nosotros-tarjeta">Nosotros</a></li>
				<li><a href="#desglose-habitaciones">Habitaciones</a></li>
				<!--Este es el boton de reservar-->
				<li id="btn-reservar"><a href="reservar.html">Reservar</a></li>
			</ul>
		</nav>
	</header>
	<!-- Contenido de la pagina -->
	<div class="contenido">
		<div id="img-home">
			<img src="/hotel/src/cliente/recursos/img/principal/home.png" alt="img de bienvenida">
		</div>
		<section id="bienvenida-tarjeta">
			<div class="articulo">
				<h1>Bienvenido a <span>Hotel Ek' Balam</span></h1>
				<p>Localizado a tan solo 3 minutos del Aeropuerto Internacional de Mérida y a 10 minutos del centro
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
			<img src="/hotel/src/cliente/recursos/img/principal/bienvenida.png" alt="img ek' balam">
		</section>
		<section id="desglose-habitaciones">
			<h1>
				< Nuestras habitaciones>
			</h1>
			<div class="carrusel">
				<a class="tarjeta-habitacion" href="#">
					<img src="/hotel/src/cliente/recursos/img/principal/estandar.jpg" alt="img habitacion estandar">
					<div class="descripcion-articulo">
						<h2>Estandar</h2>
						<p>Espacio confortable, decorado con materiales sostenibles, iluminación natural, sistema de
							reciclaje, y productos orgánicos para una experiencia armoniosa.</>
						<h3>MXN 1100</h3>
					</div>
				</a>
				<a class="tarjeta-habitacion" href="#">
					<img src="/hotel/src/cliente/recursos/img/principal/deluxe.jpg" alt="img habitacion deluxe">
					<div class="descripcion-articulo">
						<h2>Deluxe</h2>
						<p>Espacio confortable, decorado con materiales sostenibles, iluminación natural, sistema de
							reciclaje, y productos orgánicos para una experiencia armoniosa.</p>
						<h3>MXN 1700</h3>
					</div>
				</a>
				<a class="tarjeta-habitacion" href="#">
					<img src="/hotel/src/cliente/recursos/img/principal/suite.jpg" alt="img habitacion suite">
					<div class="descripcion-articulo">
						<h2>Suite</h2>
						<p>Espacio confortable, decorado con materiales sostenibles, iluminación natural, sistema de
							reciclaje, y productos orgánicos para una experiencia armoniosa.</p>
						<h3>MXN 2500</h3>
					</div>
				</a>
			</div>
		</section>
		<section id="nosotros-tarjeta">
			<div id="articulo-nosotros">
				<img src="/hotel/src/cliente/recursos/img/principal/bienvenida.png" alt="img ek' balam">
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
		<p>&copy; Derechos reservados a un tal fulano</p>
	</footer>

</body>

</html>