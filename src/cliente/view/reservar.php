<?php
include_once("../../servidor/reservacion.php");
?>
<html>
    <head>
        <title>Reservar habitaci&oacute;n</title>
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
                    <ul>
                        <li>
                            <p>ordenar por:</p>
                            <select>
                                <option>precio: mayor-menor</option>
                                <option>precio: menor-mayor</option>
                                <option>alfabetico</option>
                            </select>
                        </li>
                        <li>
                            <h1>Habitaci&oacute;nes disponibles: </h1>
                        </li>
                        <?php echo listar();?>
                    </ul>
            </div>
        </section>

        <aside class="aside">
            <h1>Reservar</h1>
            <form>
                <label>Dia de entrada</label>
                <input type="date">
                <label>Dia de salida</label>
                <input type="date">
                <label>Numero de personas</label>
                <input type="number" min="1" max="10" maxlength="3">
            </form>
            <input type="submit" value="actualizar búsqueda">
        </aside>

        <footer>
            <p>&copy; Derechos reservados a un tal fulano</p>
        </footer>
    </div>
    </body>
</html>