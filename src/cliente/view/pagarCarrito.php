<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Carrito</title>
    <link rel="stylesheet" href="../css/pagarCarrito.css">
</head>
<body>
    <div class="container">
        <h1>Pago del Carrito</h1>
        <div class="desgloce de precios">
        <!--ingresar mediante js un desgloce de los precios-->
        </div>
        <form id="formPago">
            <div class="form-group">
                <label for="titular">Titular de la tarjeta</label>
                <input type="text" id="titular" name="titular" placeholder="Nombre del titular" required>
            </div>
            <div class="form-group">
                <label for="numeroTarjeta">Número de tarjeta</label>
                <input type="text" id="numeroTarjeta" name="numeroTarjeta" placeholder="0000 0000 0000 0000" maxlength="16" required>
            </div>
            <div class="form-group">
                <label for="cvv">Mes de vencimiento</label>
                <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3" required>
            </div>
            <div class="form-group">
                <input type="hidden" id="idUsuario" value="1"> <!-- Cambiar con el valor real del usuario -->
            </div>
            <div class="actions">
                <button type="button" id="btnPagar">Pagar</button>
                <button type="button" id="btnCancelar">Cancelar</button>
            </div>
        </form>
    </div>
    <script type="module" src="./pagar.js"></script>
</body>
</html>
