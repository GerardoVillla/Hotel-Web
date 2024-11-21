<?php
include_once "config/conexiondb.php";
include_once "config/config.inc.php";

    function listar(){
        $conexionSql = new Conexiondb();
        $conexionSql = $conexionSql->getConnection();

        $peticion = "SELECT * FROM habitaciones";
        $resultado = $conexionSql->query($peticion); 
        
        $html='';
        //Generar array de habitaciones obtenidas de la BD
        while($registro = $resultado->fetch_assoc()){
            if($registro['disponibles'] >= 1){
                $html .= '<li class="habitacion-propiedades" data-tipo="' . $registro['categoria'] . '">';
                $rutaImg = "../recursos/img/habitaciones/".$registro['urlImagen'];
                $html .= '<img src="' . $rutaImg . '" alt="">';
                $html .= '<div class="detalles-habitacion">';
                $html .= '<h2 id="nombre-habitacion">' . $registro['nombre'] . '</h2>';
                $html .= '<p><strong>Categoría:</strong> <span id="categoria-habitacion">' . $registro['categoria'] . '</span></p>';
                $html .= '<p><strong>Cap. personas:</strong> <span id="cantidad-personas">' . $registro['capacidadDePersonas'] . '</span></p>';
                $html .= '<p><strong>Costo:</strong> <span id="costo-habitacion">' . $registro['costoPorNoche'] . '</span></p>';
                $html .= '<p><strong>Descripcion: </strong> <span id="descripcion"> '.$registro['descripcion'].' <span></p> <br>';
                $html .= '<a href="'.$GLOBALS["raiz_sitio"].'/src/cliente/view/carrito.php?id='.$registro['idhabitacion'].'">reservar esta habitacion</a>';
                $html .= '</div>';
                $html .= '</li>';
            }else{
                $html .= '<li class="habitacion-propiedades" data-tipo="' . $registro['categoria'] . '">';
                $rutaImg = "../recursos/img/habitaciones/".$registro['urlImagen'];
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
        //echo $html;
        return $html;
    }

    function reservar($id){
        $conexionSql = new Conexiondb();
        $conexionSql = $conexionSql->getConnection();

        $peticion = "SELECT * FROM habitaciones WHERE idhabitacion = $id";
        $resultado = $conexionSql->query($peticion); 
        $html = '';
        while($registro = $resultado->fetch_assoc()){
            $html .= '<input type="hidden" id="idhabitacion" value="'.$registro['idhabitacion'].'">';
            $html .= '<h3><label>Habitacion: '.$registro['nombre'].'</label></h3> <br><br>';
            $html .= '<label>Dia de entrada: </label>';
            $html .= '<input type="date" id="entrada">';
            $html .= '<label>Dia de salida: </label>';
            $html .= '<input type="date" id="salida">';
            $html .= '<label>Numero de personas:</label>';
            $html .= '<input type="number" min="1" max="10" maxlength="3" id="numPersonas" value="0">';
            $html .= '<label>Costo por noche: <div id="costoPorNoche">'.$registro['costoPorNoche'].'</div></label><br>';
            $html .= '<input type="hidden" id="capacidad" value="'.$registro['capacidadDePersonas'].'"><br>';
            $html .= '<label>Total: <div id="total"></div></label>';
        }
        echo $html;
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