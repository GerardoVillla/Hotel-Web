<?php
include_once("../../servidor/reservacion.php");

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
        <nav class="nav">
            <a href="principal.php">regresar</a>
        </nav>

        <section class="section">
            <div class="lista_habitaciones">
                <form method="GET" action="reservar.php">
                    <label for="orden">Ordenar por:</label>
                    <select name="orden" id="orden" onchange="this.form.submit()">
                        <option value="">Seleccione</option>
                        <option value="precioMayor" <?= $orden == "precioMayor" ? "selected" : "" ?>>Precio: mayor a menor</option>
                        <option value="precioMenor" <?= $orden == "precioMenor" ? "selected" : "" ?>>Precio: menor a mayor</option>
                        <option value="alfabetico" <?= $orden == "alfabetico" ? "selected" : "" ?>>Alfabético</option>
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
    </body>
</html>
