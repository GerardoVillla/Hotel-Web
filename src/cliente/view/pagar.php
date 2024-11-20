<?php
include_once("../../servidor/sesion.php");

function reservar() {
    validarSesion();
    // Recuperar y convertir la cookie en un arreglo
    $cookieValue = isset($_COOKIE['carritoHabitaciones']) ? $_COOKIE['carritoHabitaciones'] : '';
    $reservas = explode(",", $cookieValue);

    $longitud = count($reservas);
    if ($longitud === 0) {
        return "<p>No hay habitaciones en el carrito.</p>";
    }

    $html = "<h2>Detalles de la reserva:</h2>";
    $totalFinal = 0;

    foreach ($reservas as $habitacion) {
        $habitacion = htmlspecialchars($habitacion);

        // Usamos el número de la habitación directamente para las cookies
        $entrada = isset($_COOKIE['entrada' . $habitacion]) ? htmlspecialchars($_COOKIE['entrada' . $habitacion]) : 'No definida';
        $salida = isset($_COOKIE['salida' . $habitacion]) ? htmlspecialchars($_COOKIE['salida' . $habitacion]) : 'No definida';
        $personas = isset($_COOKIE['habitacion' . $habitacion]) ? htmlspecialchars($_COOKIE['habitacion' . $habitacion]) : 'No definidas';
        $totalReserva = isset($_COOKIE['total' . $habitacion]) ? htmlspecialchars($_COOKIE['total' . $habitacion]) : 'No definidas';
        $idUsuario = $_SESSION['idUsuario'];

        $html .= "<div>";
        $html .= '<input type="hidden" value=' . $idUsuario . ' id="idUsuario">';
        $html .= "<label>Habitación: $habitacion</label><br>";
        $html .= "<label>Entrada: $entrada</label><br>";
        $html .= "<label>Salida: $salida</label><br>";
        $html .= "<label>Personas: $personas</label><br>";
        $html .= "<label>Total reservación $habitacion : $ $totalReserva</label><br>";
        $html .= "</div><hr>";

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
        <nav>
            <a href="principal.php">regresar</a>
        </nav>

        <section>
            <h2>Reservaci&oacute;nes : </h2>
            <h3>
                <?php echo reservar(); ?>
            </h3>


            <form>
                <h2>Detalles del pago: </h2>
                <label>
                    <p>Titular</p><input type="text" id="titular">
                </label>
                <label>
                    <p>Numero de tarjeta:</p><input type="number" maxlength="22" id="numeroTarjeta">
                </label>
                <label>
                    <p>Mes de vencimiento:</p><input type="month">
                </label>
                <label>
                    <p>CVV</p><input type="number" min="000" maxlength="3" max="999" id="cvv">
                </label>
            </form>

            <a class="boton" id="btnPagar">Pagar</a>
        </section>

        <footer>
            <p>&copy; Derechos reservados a un tal fulano</p>
        </footer>
    </div>
    <script type="module" src="../scripts/pagar.js"></script>
    </body>
</html>