<?php
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
        <nav class="nav">
            <a href="reservar.php">regresar</a>
        </nav>

        <aside class="aside">
        <?php obtenerImagen($_GET['id']) ?>    

        </aside>

        <section class="section">
            <h2>Añadir al carrito</h2><br>
            <form id="reservaForm">
                <?php reservar($_GET['id'], $entrada, $salida, $personas) ?>
                <input type="button" value="añadir" id="btn_anadir">
            </form>
            <div id="mensaje"></div>
        </section>

        <footer>
            <p>&copy; Derechos reservados a un tal fulano</p>
        </footer>
    </div>
    <script type="module" src="../scripts/carrito.js"></script>
    </body>
</html>