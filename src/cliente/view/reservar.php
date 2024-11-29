<?php
include_once("../../servidor/reservacion.php");
include_once("../../servidor/sesion.php");
validarSesionCliente();

$orden = isset($_GET['orden']) ? $_GET['orden'] : "";
?>
<html>
    <head>
        <title>Reservar habitación</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="../css/reservar.css" rel="stylesheet" type="text/css">
    </head>

    <body>
    <div class="grid">
        <header>
        <a href="principal.php"><h1 class="playfair-display-titulo"><img id="logo" src="../recursos/img/iconos/logopng.png" alt="">Ek' Balam</h1></a>
            <nav>
                <ul>
                    <li><a href="pagar.php"><img class="icono-encabezado" src="../recursos/img/iconos/carrito-de-compras.png"></a></li>
                    <li><a href="buscar.php"><img class="icono-encabezado" src="../recursos/img/iconos/lupa.png"></a></li>
                    <li><a href="misReservaciones.php"><img class="icono-encabezado" src="../recursos/img/iconos/avatar.png"></a></li>
                    <li><a href="principal.php#nosotros-tarjeta"><img class="icono-encabezado" src="../recursos/img/iconos/informacion.png" alt=""></a></li>
                    <li id="cerrarSesion"><a href="#"><img class="icono-encabezado" src="../recursos/img/iconos/cerrar-sesion.png"></a></li>
                    <li id="btn-reservar"><a href="reservar.php">Reservar</a></li>
                </ul>
            </nav>
        </header>

        <section class="section">
            <div class="lista_habitaciones">
                <form method="GET" action="reservar.php">
                    <label for="orden"><b>Categoria: </b></label>
                    <select name="orden" id="orden" onchange="this.form.submit()">
                        <option value="">Todas</option>
                        <option value="Estandar" <?= $orden == "Estandar" ? "selected" : "" ?> >Estandar</option>
                        <option value="Deluxe" <?= $orden == "Deluxe" ? "selected" : "" ?> >Deluxe</option>
                        <option value="Suite" <?= $orden == "Suite" ? "selected" : "" ?> >Suite</option>
                    </select>
                </form>
                <ul>
                    <li>
                        <h1>Habitaciones disponibles:</h1>
                    </li>
                    <?php echo listar($orden); ?>
                </ul>
            </div>
        </section>

        <footer>
            <p>&copy; Todos los derechos reservados</p>
        </footer>
    </div>
    <script type="module" src="../scripts/reservar.js"></script>
    </body>
</html>
