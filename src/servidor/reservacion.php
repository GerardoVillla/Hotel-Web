<?php
require_once (__DIR__."/../../config.inc.php");
include_once "config/config.inc.php";

function listar($orden = "") {
    $conexionSql = new Conexiondb();
    $conexionSql = $conexionSql->getConnection();

    // Construir la consulta SQL con base en el criterio de ordenación
    $peticion = "SELECT * FROM habitaciones";

    switch ($orden) {
        case "precioMayor":
            $peticion .= " ORDER BY costoPorNoche DESC";
            break;
        case "precioMenor":
            $peticion .= " ORDER BY costoPorNoche ASC";
            break;
        case "alfabetico":
            $peticion .= " ORDER BY nombre ASC";
            break;
    }

    $resultado = $conexionSql->query($peticion);

    $html = '';
    while ($registro = $resultado->fetch_assoc()) {
        if ($registro['disponibles'] >= 1) {
            $html .= '<li class="habitacion-propiedades" data-tipo="' . $registro['categoria'] . '">';
            $rutaImg = "../recursos/img/habitaciones/" . $registro['urlImagen'];
            $html .= '<img src="' . $rutaImg . '" alt="">';
            $html .= '<div class="detalles-habitacion">';
            $html .= '<h2 id="nombre-habitacion">' . $registro['nombre'] . '</h2>';
            $html .= '<p><strong>Categoría:</strong> <span id="categoria-habitacion">' . $registro['categoria'] . '</span></p>';
            $html .= '<p><strong>Cap. personas:</strong> <span id="cantidad-personas">' . $registro['capacidadDePersonas'] . '</span></p>';
            $html .= '<p><strong>Costo:</strong> <span id="costo-habitacion">' . $registro['costoPorNoche'] . '</span></p>';
            $html .= '<p><strong>Descripcion: </strong> <span id="descripcion"> ' . $registro['descripcion'] . ' <span></p> <br>';
            $html .= '<a href="' . $GLOBALS["raiz_sitio"] . '/src/cliente/view/carrito.php?id=' . $registro['idhabitacion'] . '">Reservar esta habitacion</a>';
            $html .= '</div>';
            $html .= '</li>';
        } else {
            $html .= '<li class="habitacion-propiedades" data-tipo="' . $registro['categoria'] . '">';
            $rutaImg = "../recursos/img/habitaciones/" . $registro['urlImagen'];
            $html .= '<img src="' . $rutaImg . '" alt="">';
            $html .= '<div class="detalles-habitacion">';
            $html .= '<h2 id="nombre-habitacion">' . $registro['nombre'] . '</h2>';
            $html .= '<p><strong>Categoría:</strong> <span id="categoria-habitacion">' . $registro['categoria'] . '</span></p>';
            $html .= '<p><strong>Cap. personas:</strong> <span id="cantidad-personas">' . $registro['capacidadDePersonas'] . '</span></p>';
            $html .= '<p><strong>Costo:</strong> <span id="costo-habitacion">' . $registro['costoPorNoche'] . '</span></p>';
            $html .= 'NO DISPONIBLE</div>';
            $html .= '</li>';
        }
    }
    $conexionSql->close();
    return $html;
}

    function reservar($id, $entrada, $salida, $personas){
        $conexionSql = new Conexiondb();
        $conexionSql = $conexionSql->getConnection();

        $peticion = "SELECT * FROM habitaciones WHERE idhabitacion = $id";
        $resultado = $conexionSql->query($peticion); 
        $html = '';
        while($registro = $resultado->fetch_assoc()){
            $html .= '<input type="hidden" id="idhabitacion" value="'.$registro['idhabitacion'].'">';
            $html .= '<h3><label>Habitacion: '.$registro['nombre'].'</label></h3> <br><br>';
            $html .= '<label>Dia de entrada: </label>';
            $html .= '<input type="date" id="entrada" value='.$entrada.'>';
            $html .= '<label>Dia de salida: </label>';
            $html .= '<input type="date" id="salida" value='.$salida.'>';
            $html .= '<label>Numero de personas:</label>';
            $html .= '<input type="number" min="1" max="10" maxlength="3" id="numPersonas" value='.$personas.'>';
            $html .= '<label>Costo por noche: <div id="costoPorNoche">'.$registro['costoPorNoche'].'</div></label><br>';
            $html .= '<input type="hidden" id="capacidad" value="'.$registro['capacidadDePersonas'].'"><br>';
            $html .= '<label>Total: <div id="total"></div></label>';
        }
        echo $html;
        return $html;

    }

    function misReservaciones($idUsuario){
        $conexionSql = new Conexiondb();
        $conexionSql = $conexionSql->getConnection();

        $peticion = "SELECT habitaciones.nombre AS nombreHabitacion, 
                    reservaciones.inicioEstadia AS inicioEstadia, 
                    reservaciones.finEstadia AS finEstadia,
                    reservaciones.fechaReservacion AS fechaReservacion, 
                    reservaciones.subtotal AS subtotal
             FROM reservaciones
             JOIN habitaciones ON reservaciones.idHabitacion = habitaciones.idHabitacion
             WHERE reservaciones.idCliente = $idUsuario";
        $resultado = $conexionSql->query($peticion);

        if (!$resultado) {
            die("Error en la consulta: " . $conexionSql->error);
        }
        if ($resultado->num_rows === 0) {
            return "<p>No hay reservaciones disponibles.</p>";
        }        

        $html = '';
        while($registro = $resultado->fetch_assoc()){
            $html .= "<div id=\"tabla\"><table>";
            $html .= "<tr> <td><label>Habitación: </label></td> <td> ".$registro['nombreHabitacion']." </td> </tr>";
            $html .= "<tr> <td><label>Entrada: </label></td> <td> ".$registro['inicioEstadia']." </td> </tr>";
            $html .= "<tr> <td><label>Salida: </label></td> <td> ".$registro['finEstadia']." </td> </tr>";
            $html .= "<tr> <td><label>Fecha de reservacion: </label></td> <td> ".$registro['fechaReservacion']." </td> </tr>";
            $html .= "<tr> <td><label>Total reservación: </label></td> <td>$ ".$registro['subtotal']."</td> </tr>";
            $html .= "</table></div><hr>";
        }
        return $html;
    }

    function obtenerImagen($id){
        $conexionSql = new Conexiondb();
        $conexionSql = $conexionSql->getConnection();

        $peticion = "SELECT urlImagen FROM habitaciones WHERE idhabitacion = $id";
        $resultado = $conexionSql->query($peticion);

        if ($resultado && $fila = $resultado->fetch_assoc()) {
            $urlImagen = $fila['urlImagen'];
            $imagenHtml = '<img src="../recursos/img/habitaciones/' . $urlImagen . '" alt="imagen de fondo" id="idImagenFondo">';
            echo $imagenHtml;
            return $urlImagen;
        } else {
            echo "No se encontró la imagen.";
            return null;
        }

    }
?>