<?php
    include_once("../../servidor/sesion.php");
    validarSesionCliente();
    $idUsuario = $_SESSION['idUsuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Carrito</title>
    <link rel="stylesheet" href="../css/pagarCarrito.css">
</head>
<body>
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
    <div class="container-wrapper">
    <div class="container">
        <h1>Pago del Carrito</h1>
        <div class="desgloce de precios">
        <!--ingresar mediante js un desgloce de los precios-->
        </div>
        <form id="formPago">
            <input type="hidden" value= <?php echo $idUsuario ?> id="idUsuario">
            <div class="form-group">
                <label for="titular">Titular de la tarjeta</label>
                <input type="text" id="titular" name="titular" placeholder="Nombre del titular" required>
            </div>
            <div class="form-group">
                <label for="numeroTarjeta">Número de tarjeta</label>
                <input type="text" id="numeroTarjeta" name="numeroTarjeta" placeholder="0000 0000 0000 0000" maxlength="16" required>
            </div>
            <div class="form-group">
                <label for="mes">Mes de vencimiento</label>
                <input type="month" id="mes" name="mes" placeholder="123" maxlength="3" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3" required>
            </div>
            <div class="form-group">
                <input type="hidden" id="idUsuario" value="1"> <!-- Cambiar con el valor real del usuario -->
            </div>
            <div class="form-group">
                <label for="Total">Total: </label>
                <input type="text" id="total" name="total" value="" maxlength="16" readonly>
            </div>
            <div class="actions">
                <button type="button" id="btnPagar">Pagar</button>
                <button type="button" id="btnCancelar">Cancelar</button>
            </div>
        </form>
    </div>
    </div>
    <script type="module" src="../scripts/pagarCarrito.js"></script>
</body>
</html>
