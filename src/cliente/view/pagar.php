<?php
include_once("../../servidor/sesion.php");
validarSesionCliente();
function reservar() {
    // Recuperar y convertir la cookie en un arreglo
    $cookieValue = isset($_COOKIE['carritoHabitaciones']) ? $_COOKIE['carritoHabitaciones'] : '';
    $reservas = array_filter(explode(",", $cookieValue)); // Filtrar elementos vacíos
    $longitud = count($reservas);

    if ($longitud === 0) {
        return "<p id=\"totalFinal\">No hay habitaciones en el carrito.</p>";
    }


    $html = "";
    $totalFinal = 0;

    foreach ($reservas as $habitacion) {
        $habitacion = htmlspecialchars($habitacion);

        // Usamos el número de la habitación directamente para las cookies
        $entrada = isset($_COOKIE['entrada' . $habitacion]) ? htmlspecialchars($_COOKIE['entrada' . $habitacion]) : 'No definida';
        $salida = isset($_COOKIE['salida' . $habitacion]) ? htmlspecialchars($_COOKIE['salida' . $habitacion]) : 'No definida';
        $personas = isset($_COOKIE['habitacion' . $habitacion]) ? htmlspecialchars($_COOKIE['habitacion' . $habitacion]) : 'No definidas';
        $totalReserva = isset($_COOKIE['total' . $habitacion]) ? htmlspecialchars($_COOKIE['total' . $habitacion]) : 'No definidas';
        $idUsuario = $_SESSION['idUsuario'];

        $html .= "<h2>Reservacion: </h2>";

        $html .= "<button class=\"eliminar\" id=\"$habitacion\" value=\"eliminarReservacion\">  eliminar </button>   ";
        $html .= "<button class=\"editar\" id=\"$habitacion\" value=\"editarReservacion\"> editar </button>";

        $html .= "<div id=\"tabla\"><table>";
        $html .= '<tr> <input type="hidden" value=' . $idUsuario . ' id="idUsuario"> </tr>';
        $html .= "<tr> <td><label>Habitación: </label></td> <td>$habitacion</td> </tr>";
        $html .= "<tr> <td><label>Entrada: </label></td> <td>$entrada</td> </tr>";
        $html .= "<tr> <td><label>Salida: </label></td> <td>$salida</td> </tr>";
        $html .= "<tr> <td><label>Personas: </label></td> <td>$personas</td> </tr>";
        $html .= "<tr> <td><label>Total reservación : </label></td> <td>$ $totalReserva</td> </tr>";
        $html .= "</table></div><hr>";

        $intTotalReserva = is_numeric($totalReserva) ? (int)$totalReserva : 0;
        $totalFinal += $intTotalReserva;
    }

    $html .= "<p id=\"totalFinal\">Total final: $ $totalFinal</p>";
    return $html;

}
?>


<html>
    <head>
        <title>Pagar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="../css/pagar.css" rel="stylesheet" type="text/css">
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

        <section>
            <h2>Carrito de reservaci&oacute;nes : </h2> <hr>
            <h3>
                <?php echo reservar(); ?>
            </h3>
            
            <br><br>
            <a class="boton" id="btnPagar">Pagar</a>
            <br><br>
        </section>

        <footer>
            <p>&copy; Todos los derechos reservados</p>
        </footer>
    </div>
    <script type="module" src="../scripts/pagar.js"></script>
    </body>
</html>