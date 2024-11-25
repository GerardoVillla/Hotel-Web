<?php
    include_once("../../servidor/sesion.php");
    include_once("../../servidor/reservacion.php");
    validarSesionCliente();
    $idUsuario = $_SESSION['idUsuario'];
?>

<html>
    <head>
        <title>Mis reservaciones</title>
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
                <?php echo misReservaciones($idUsuario); ?>
            </h3>

        </section>

        <footer>
            <p>&copy; Todos los derechos reservados</p>
        </footer>
    </div>
    <script type="module" src="../scripts/pagar.js"></script>
    </body>
</html>