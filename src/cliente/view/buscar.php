<?php
$habitaciones = [];
$errorM = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_habitacion = $_POST['TipoHab'] ?? '';
    $fecha_entrada = $_POST['FechaEntrada'] ?? '';
    $fecha_salida = $_POST['FechaSalida'] ?? '';
    $personas = (int)($_POST['Personas'] ?? 0);
    
    if(empty($fecha_entrada) || empty($fecha_salida) || empty($tipo_habitacion) || empty($personas)) {
        $errorM = 'Por favor, ingresa todos los datos';
    }elseif(strtotime($fecha_entrada) >= strtotime($fecha_salida)){
        $errorM = 'La fecha de entrada debe ser anterior a la fecha de salida';
    }else{
        include '../../servidor/config/config.inc.php';
        $conexion = mysqli_connect(
            $GLOBALS["servidor"],
            $GLOBALS["usuario"],
            $GLOBALS["contrasena"],
            $GLOBALS["base_datos"]);

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            $query = "
            SELECT h.idhabitacion, h.nombre, h.descripcion, h.urlImagen, h.costoPorNoche, h.capacidadDePersonas, h.disponibles 
            FROM habitaciones AS h
            WHERE h.disponibles >= 1
            ";
        
            // Filtrar por tipo de habitación
            if(!empty($tipo_habitacion)) {
                $query .= " AND h.categoria = '$tipo_habitacion'";
            }else{
                $errorM='Faltan datos';
            }

            // Filtrar por capacidad de personas
            if($personas > 0) {
                $query .= " AND h.capacidadDePersonas >= $personas";
            }else{
                $errorM='Faltan datos';
            }

            $result = mysqli_query($conexion, $query);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $habitaciones[] = $row;
                }
            } else {
                $errorM='No se encontraron habitaciones disponibles con los filtros seleccionados';
            }
            mysqli_close($conexion);
    }
        
}

?>

<html>
    <head>
        <title>Buscar habitaci&oacute;n</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="../css/buscar.css" rel="stylesheet" type="text/css">
    </head>

    <body>
    <div class="grid">
        <nav class="nav">
            <a href="principal.php">Regresar</a>
        </nav>

        <aside class="aside">
           <img src="../recursos/img/iniciosesion/IniciarSesionFoto.jpg" alt="imagen de fondo" class="ImgAside"> <!-- Cambiar imagen-->
        </aside>

        <section class="section">
            <h2>Buscar</h2><br>
            <form action="" method="post" id="Form">
                <label>Elige una habitaci&oacute;n</label>
                <select name="TipoHab">
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="Estandar">Est&aacute;ndar</option>
                    <option value="Suite">Suite</option>
                    <option value="Deluxe">Deluxe</option>
                </select>
                <label>Dia de entrada</label>
                <input type="date" name="FechaEntrada">
                <label>Dia de salida</label>
                <input type="date" name="FechaSalida">
                <label>Numero de personas</label>
                <input type="number" min="1" max="10" maxlength="3" name="Personas">
                <input type="submit" value="buscar" name="Buscar">
            </form>

            <?php if (!empty($errorM)): ?>
                    <div class="error-mensaje">
                    <p><?php echo $errorM; ?></p>
                    </div>
                <?php endif; ?>
           
        </section>
        <section class="resultados">
            <div class="habitacionesscroller">
                
                    <?php if (!empty($habitaciones)): ?>
                        <?php foreach ($habitaciones as $habitacion): ?>
                            <div class="habitacion">

                                <img src="<?php echo "../recursos/img/habitaciones/".$habitacion['urlImagen']; ?>" alt="Imagen de <?php echo $habitacion['nombre']; ?>" class="Imghab">

                                    <div class="HabCarac">
                                        <h2><?php echo $habitacion['nombre']; ?></h2>
                                        <p><?php echo $habitacion['descripcion']; ?></p>
                                        <p>N&uacute;mero de personas: <?php echo $habitacion['capacidadDePersonas'];?> </p>
                                        <p><strong>Precio por noche:</strong> $<?php echo $habitacion['costoPorNoche']; ?>  <!--Cambiar a php si es necesario--></p> 
                                        <p>Disponibles: <b><?php echo $habitacion['disponibles']?> </b></p> <a href="reservar.php?id=<?php echo $habitacion['idhabitacion']; ?>&personas=<?php echo $personas; ?>&entrada=<?php echo $fecha_entrada; ?>&salida=<?php echo $fecha_salida; ?>">
                                            Reservar
                                        </a>       
                                    </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="Noresultados">Sin resultados... </p>
                    <?php endif; ?>
            </div>
        </section>       
        <footer>
            <p>&copy; Todos los derechos reservados</p>
        </footer>
        <script src="/ecologico/src/cliente/scripts/buscar.js"></script>
    </body>
</html>