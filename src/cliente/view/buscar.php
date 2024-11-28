<?php
$busqueda = '';
$filtroPrincipal = 'todo';
$filtroSecundario = '';
$habitaciones = [];
$errorMsj = "";
$busquedaRealizada = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $busquedaRealizada = true;
    $busqueda = $_POST['busqueda'] ?? '';
    $filtroPrincipal = $_POST['filtroPrincipal'] ?? 'todo';
    $filtroSecundario = $_POST['filtroSecundario'] ?? '';

    if (empty(trim($busqueda))) {
        $errorMsj = 'Por favor, escribe algo en la barra de búsqueda.';
    } else {
        include '../../servidor/config/config.inc.php';
        $conexion = mysqli_connect(
            $GLOBALS["servidor"],
            $GLOBALS["usuario"],
            $GLOBALS["contrasena"],
            $GLOBALS["base_datos"]
        );

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Construir consulta base
        $query = "SELECT * FROM habitaciones WHERE disponibles >= 1";

        // Filtrar por palabras clave en nombre o descripción
        $busquedaPalabras = explode(' ', $busqueda);
        foreach ($busquedaPalabras as $palabra) {
            $palabra = mysqli_real_escape_string($conexion, $palabra);
            $query .= " AND (nombre LIKE '%$palabra%' OR descripcion LIKE '%$palabra%')";
        }

        // Aplicar filtros
        if ($filtroPrincipal === 'precio' && $filtroSecundario === 'asc') {
            $query .= " ORDER BY costoPorNoche ASC";
        } elseif ($filtroPrincipal === 'precio' && $filtroSecundario === 'desc') {
            $query .= " ORDER BY costoPorNoche DESC";
        } elseif ($filtroPrincipal === 'alfabetico' && $filtroSecundario === 'asc') {
            $query .= " ORDER BY nombre ASC";
        } elseif ($filtroPrincipal === 'alfabetico' && $filtroSecundario === 'desc') {
            $query .= " ORDER BY nombre DESC";
        } elseif ($filtroPrincipal === 'categoria' && !empty($filtroSecundario)) {
            $query .= " AND categoria = '$filtroSecundario'";
        }

        // Ejecutar consulta
        $result = mysqli_query($conexion, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $habitaciones[] = $row;
            }
        } else {
            $errorMsj = 'No se encontraron resultados.';
        }
        mysqli_close($conexion);
    }
}

function generarOpcionesFiltroSecundario($filtroPrincipal, $filtroSecundario) {
    $opciones = '';
    switch ($filtroPrincipal) {
        case 'precio':
            $opciones .= '<option value="asc" ' . ($filtroSecundario === 'asc' ? 'selected' : '') . '>De menor a mayor</option>';
            $opciones .= '<option value="desc" ' . ($filtroSecundario === 'desc' ? 'selected' : '') . '>De mayor a menor</option>';
            break;
        case 'alfabetico':
            $opciones .= '<option value="asc" ' . ($filtroSecundario === 'asc' ? 'selected' : '') . '>De la A a la Z</option>';
            $opciones .= '<option value="desc" ' . ($filtroSecundario === 'desc' ? 'selected' : '') . '>De la Z a la A</option>';
            break;
        case 'categoria':
            $opciones .= '<option value="Estandar" ' . ($filtroSecundario === 'Estandar' ? 'selected' : '') . '>Estándar</option>';
            $opciones .= '<option value="Suite" ' . ($filtroSecundario === 'Suite' ? 'selected' : '') . '>Suite</option>';
            $opciones .= '<option value="Deluxe" ' . ($filtroSecundario === 'Deluxe' ? 'selected' : '') . '>Deluxe</option>';
            break;
    }
    return $opciones;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/buscar.css">
    <title>Hotel ecológico</title>
</head>
<body>
    <header>
    <h1 class="playfair-display-titulo"><img id="logo" src="../recursos/img/iconos/logopng.png" alt="">Ek' Balam</h1>
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
    <div class="contenido">
        <div class="barra_busqueda">
            <form method="post" id="formBusqueda">
                <div class="barra">
                    <input type="text" id="busquedaentrada" name="busqueda" placeholder="Buscar..." size="50" maxlength="50" value="<?php echo htmlspecialchars($busqueda); ?>"/>
                    <button class="enviar" type="submit">
                        <img class="icono-busqueda" src="../recursos/img/iconos/lupa.png">
                    </button>
                </div>
                <div class="filtros">
                    <select id="filtroPrincipal" name="filtroPrincipal">
                        <option value="" disabled <?php echo $filtroPrincipal === '' ? 'selected' : ''; ?>>Seleccionar filtro...</option>
                        <option value="todo" <?php echo $filtroPrincipal === 'todo' ? 'selected' : ''; ?>>Todo</option>
                        <option value="precio" <?php echo $filtroPrincipal === 'precio' ? 'selected' : ''; ?>>Precio</option>
                        <option value="alfabetico" <?php echo $filtroPrincipal === 'alfabetico' ? 'selected' : ''; ?>>Alfabético</option>
                        <option value="categoria" <?php echo $filtroPrincipal === 'categoria' ? 'selected' : ''; ?>>Categoría</option>
                    </select>
                    <select id="filtroSecundario" name="filtroSecundario" style="display: <?php echo $filtroPrincipal !== 'todo' ? 'block' : 'none'; ?>;">
                        <?php echo generarOpcionesFiltroSecundario($filtroPrincipal, $filtroSecundario); ?>
                    </select>
                </div>
            </form>
        </div>
        <div class="resultados">
            <div class="resultadosScroller">
                <?php if (!empty($habitaciones)): ?>
                        <?php foreach ($habitaciones as $habitacion): ?>
                <div class="habitacion">
                    <img src="<?php echo "../recursos/img/habitaciones/" . $habitacion['urlImagen']; ?>" class="ImgHab">
                <div class="HabCarac">
                            <h2><?php echo $habitacion['nombre']; ?></h2>
                            <p><?php echo $habitacion['descripcion']; ?></p>
                            <p>N&uacute;mero de personas: <?php echo $habitacion['capacidadDePersonas'];?> </p>
                            <p><strong>Precio por noche:</strong> $<?php echo $habitacion['costoPorNoche']; ?> </p> 
                            <p>Disponibles: <b><?php echo $habitacion['disponibles']?> 
                            </b>
                            <p> 
                            <a href="reservar.php?id=<?php echo $habitacion['idhabitacion']; ?>&personas=<?php echo $personas; ?>&entrada=<?php echo $fecha_entrada; ?>&salida=<?php echo $fecha_salida; ?>">
                                    Reservar
                            </a>    
                            </p>
                            </b>
                    </div>
                </div>
                    <?php endforeach; ?>
                    <?php elseif ($busquedaRealizada): ?>
                        <b><p class="Noresultados">No se encontraron coincidencias, ¡Prueba con otros terminos o filtros!</p></b>

                    <?php else: ?>
                        <b><p class="Noresultados">Aun sin resultados, ¿Por qué no pruebas buscar algo?</p></b>
                <?php endif; ?>

            </div>
        </div>
    </div>     
    <footer>
        <p>&copy; Todos los derechos reservados</p>
    </footer>
    <script src="../scripts/buscar.js"></script>
</body>
</html>