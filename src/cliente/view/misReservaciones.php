<?php
    include_once("../../servidor/sesion.php");
    include_once("../../servidor/reservacion.php");
    validarSesionCliente();
    $idUsuario = $_SESSION['idUsuario'];
?>

<html>
    <head>
        <title>Cuenta</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="../css/pagar.css" rel="stylesheet" type="text/css">
    </head>

    <body>
    <div class="grid">
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

        <section>
            <h1>Mi cuenta</h1>
            <p> Usuario: <?php  echo $_SESSION["user"]?> </p>
            <p> Rol: <?php echo $_SESSION["rol"] ?> </p>
            <h2>Reservaci&oacute;nes pagadas:</h2>
            <h3>
                <?php echo misReservaciones($idUsuario); ?>
            </h3>

        </section>

        <footer>
            <p>&copy; Todos los derechos reservados</p>
        </footer>
    </div>
    </body>
</html>