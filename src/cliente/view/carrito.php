<?php
include_once("../../servidor/sesion.php");
validarSesionCliente();


    $entradaRecibida = isset($_GET['entrada']);
    $salidaRecibida = isset($_GET['salida']);
    $personasRecibida = isset($_GET['personas']);

    if($entradaRecibida && $salidaRecibida && $personasRecibida){
        $entrada = $_GET['entrada'];
        $salida = $_GET['salida'];
        $personas = $_GET['personas'];
    }else{
        $entrada = 0;
        $salida = 0;
        $personas = 0;
    }



    if(isset($_GET['id'])){
        include_once("../../servidor/reservacion.php");
    }else{
        $curl = "Location:".$GLOBALS["raiz_sitio"]."/src/cliente/view/reservar.php.php";
        header($curl);
        exit();
    }
?>

<html>
    <head>
        <title>A&nacute;adir al carrito:</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="../css/anadirCarro.css" rel="stylesheet" type="text/css">
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

        <aside class="aside">
        <?php obtenerImagen($_GET['id']) ?>    

        </aside>

        <section class="section">
            <h2>Añadir al carrito</h2><br>
            <form id="reservaForm">
                <?php reservar($_GET['id'], $entrada, $salida, $personas) ?>
                <br><input type="button" value="añadir" id="btn_anadir"><br>
            </form>
            <div id="mensaje"></div>
        </section>

        <footer>
            <p>&copy; Todos los derechos reservados</p>
        </footer>
    </div>
    <script type="module" src="../scripts/carrito.js"></script>
    </body>
</html>