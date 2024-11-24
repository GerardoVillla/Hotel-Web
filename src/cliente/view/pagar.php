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

        $html .= "<div id=\"tabla\"><table>";
        $html .= '<tr> <input type="hidden" value=' . $idUsuario . ' id="idUsuario"> </tr>';
        $html .= "<tr> <td><label>Habitación: </label></td> <td>$habitacion</td> </tr>";
        $html .= "<tr> <td><label>Entrada: </label></td> <td>$entrada</td> </tr>";
        $html .= "<tr> <td><label>Salida: </label></td> <td>$salida</td> </tr>";
        $html .= "<tr> <td><label>Personas: </label></td> <td>$personas</td> </tr>";
        $html .= "<tr> <td><label>Total reservación $habitacion: </label></td> <td>$ $totalReserva</td> </tr>";
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
        <nav>
            <a href="principal.php">Regresar</a>
        </nav>

        <section>
            <h2>Reservaci&oacute;nes : </h2>
            <h3>
                <?php echo reservar(); ?>
            </h3>

                <form>
                    <h2>Detalles del pago: </h2>
                        <table>
                        <tr>
                            <td><p>Titular</p></td><td><input type="text" id="titular"><td>
                        <tr>
                        <tr>
                            <td><p>Numero de tarjeta:</p></td><td><input type="number" maxlength="22" id="numeroTarjeta"></td>
                        </tr>
                        <tr>
                            <td><p>Mes de vencimiento:</p></td><td><input type="month"></td>
                        <tr>
                        <tr>
                            <td><p>CVV</p></td><td><input type="number" min="000" maxlength="3" max="999" id="cvv"><td>
                        </tr>
                        </table>
                </form>
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