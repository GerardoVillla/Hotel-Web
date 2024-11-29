<?php
require_once ("../../servidor/sesion.php");
validarSesionAdministrador();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edithabitacion-styles.css" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <title>Editar habitacion</title>
</head>
<body>
    <header>
    <h1 class="playfair-display-titulo"><img id="logo" src="../recursos/img/iconos/logopng.png" alt="">Ek' Balam</h1>
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
    <form id="grid" method="get" enctype="multipart/form-data" >
        <div id="etiquetas">
            <p><b>Nombre:</b></p>
            <p><b>Categoria (tipo):</b></p>
            <p><b>Habitaciones:</b></p>
            <p><b>Hab. disponibles:</b></p>
            <p><b>Cap. personas:</b></p>
            <p><b>Costo: $</b></p>
        </div>
        <div id="entradas">
            <input type="text" id="txt_nombre" name="Nombre" onkeyup="mostrar(this.value, 'nombre_habitacion')">

                <select name="Categoria" id="txt_categoria" onchange="mostrar(this.value , 'categoria_habitacion')">
                    <option value="" selected disabled hidden></option>
                    <option value="Estandar">Estandar</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Suite">Suite</option>
                </select>
            <input type="number" id="txt_habitaciones" name="Habitaciones" min="0" max="50" oninput="mostrar(this.value, 'info_habitaciones')">
            <input type="number" id="txt_habdisponibles" name="Habitaciones disponibles" min="0" max="50" oninput="mostrar(this.value, 'info_disponibles');">
            
            <input type="number" id="txt_capacidad" name="Capacidad" min="0" max="10" oninput="mostrar(this.value,'info_cap_personas')">

            <p><input type="text" id="txt_costo" onkeyup="mostrar(this.value,'info_Costo')" oninput="soloNumeros(this)"></p>
        </div>
        <div id="descripcion">
            <p><b>Descripcion:</b></p>
            <textarea id="t_area_descripcion" onkeyup="mostrar(this.value,'info_descripcion')"></textarea>
        </div>
        <div id="btns_vista_prev">
            <p><b>Cambiar imagen:   </b><input type="file" id="btn_cambiarimg" accept="image/*" multiple onchange="PrevisualizarImagen(event)"></p>
            <input type="button" id="btn_eliminar_imagen" value="Eliminar imagen">
            <input type="button" id="btn_predeterminada_imagen" value="Mostrar primero">
        </div>
        <div id="imagen">
            <!--<img id="imagen-prev" src="../assets/img/home/deluxe.jpg" alt="Previsualización de la Imagen" accept="image/*">
-->
            <div class="swiper">
                <div class="swiper-wrapper">
                </div>
                <!-- Botones de navegación -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <div id="vista_previa">
            <h2 id="id_habitacion">ID</h2>
            <h2 id="nombre_habitacion">Nombre</h2>
            <h3 id="categoria_habitacion">Categoria</h3>
            <p id="info_descripcion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad doloremque eum cum? Eligendi id vitae dicta perferendis magnam dignissimos voluptatum. Ducimus, in labore. Amet magnam, ducimus necessitatibus facilis explicabo iusto.</p>
            <p id="info_habitaciones"><b>Habitaciones:</b></p>
            <p id="info_disponibles"><b>Habitaciones disponibles:</b></p>
            <p id="info_cap_personas"><b>Cap. Personas:</b></p>
            <p id="info_Costo"><b>Costo:</b></p>
        </div>
        <div  id="btns_verificacion">
            <button class="btn" id="btn_guardar">
                Guardar
            </button>
            <button class="btn" id="btn_cancelar" href="">
                Cancelar
            </button>
        </div>
    </form>
    <footer>
        <p>&copy; Todos los derechos reservados</p>
    </footer>
    <script src="../scripts/edithabitacion.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>