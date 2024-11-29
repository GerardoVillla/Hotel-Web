<?php
require_once (__DIR__."/../../config.inc.php");

if(isset($_POST["action"])){
			$peticion = $_POST["action"];
	switch($peticion){
		case "crearVacia";
			crearHabitacionVacia();
			break;
		case "predeterminarImagen";
			$idImg = $_POST["idImagen"];
			cambiarImagenPredeterminada($idImg);
			break;
		case "eliminarImagen";
			$idImagen = $_POST["idImagen"];
			eliminarImagen($idImagen);
			break;
		case "actualizarImagenes";
			$idHabitacion = $_POST["id"];
			actualizarImagenes($idHabitacion);
			break;
		case "obtenerImagenes";
			$idUsuario = $_POST["id"];
			obtenerRutasImagenesDECliente($idUsuario);
			break;
		case "obtenerDescripcion";
			$idHabitacion = $_POST["id"];
			obtenerDescripcion($idHabitacion);
			break;
		case "listar";
			listar();
			break;
		case "filtrar";
			$categoria = $_POST["categoria"];
			filtrarPorCategoria($categoria);
			break;
		case "crear":
			$nombre = $_POST["nombre"];
			$categoria = $_POST["categoria"];
			$descripcion = $_POST["descripcion"];
			$habitaciones = $_POST["numHabitaciones"];
			$habitacionesDisp = $_POST["disponibles"];
			$capacidad = $_POST["capacidadDePersonas"];
			$costo = $_POST["costoPorNoche"];
			$img = $_POST["urlImagen"];
			crearHabitacion($nombre, $categoria, $descripcion, $habitaciones, $habitacionesDisp, $capacidad, $costo, $img);
			break;
		case "actualizar":
			$idHabitacion = $_POST["id"];
			$valor = $_POST["valor"];
			$campo = $_POST["campo"];
			actualizarHabitacion($idHabitacion, $campo, $valor);	
			break;
		case "eliminar":
			$idHabitacion = $_POST["id"];
			eliminarHabitacion($idHabitacion);
			break;
	}
}


function crearHabitacionVacia(){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();
	$peticion = "INSERT INTO habitaciones (nombre, categoria, descripcion, numHabitaciones, disponibles, capacidadDePersonas, costoPorNoche, urlImagen) VALUES ('', '', '', 0, 0, 0, 0, '')";
	$stmt = $conexionSql->prepare($peticion);
	$stmt->execute();
	$idHabitacion = $stmt->insert_id;
	$conexionSql->close();
	echo $idHabitacion;
	return;
}
function cambiarImagenPredeterminada($idImg){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();
	$peticion = "UPDATE habitaciones h
 	JOIN imageneshabitaciones i ON h.idhabitacion = i.idHabitacion
	SET h.urlImagen = i.urlImagen
	WHERE i.idImg = ?";
	$stmt = $conexionSql->prepare($peticion);
	$stmt->bind_param("i", $idImg);
	$stmt->execute();
	$stmt->close();
	$conexionSql->close();
	return;


}
function actualizarImagenes($idHabitacion){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();
	$numImagenes = count($_FILES);
	for($i=0; $i<$numImagenes; $i++){
		$nombreImagen = $_FILES["imagen$i"]["name"];
		$carpetaDestino = "../cliente/recursos/img/habitaciones";
		$rutaImagen = $carpetaDestino . $nombreImagen;
		$imagenSubida = move_uploaded_file($_FILES["imagen$i"]["tmp_name"], $rutaImagen);
		if(!$imagenSubida){
			echo "Error al subir imagen";
		}
		$peticion = "INSERT INTO imageneshabitaciones (idHabitacion, urlImagen) VALUES (?, ?)";
		$stmt = $conexionSql->prepare($peticion);
		$stmt->bind_param("is", $idHabitacion, $nombreImagen);
		$stmt->execute();
	}

}

function actualizarHabitacion($idHabitacion, $campo, $valorActualizado){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();

	if($campo == "urlImagen"){
		$valorActualizado = guardarImagenEnServidor($valorActualizado);
	}
	$peticion = "UPDATE habitaciones SET $campo = ? WHERE idhabitacion = ?";
	$stmt = $conexionSql->prepare($peticion);
	if(in_array($campo, ["numHabitaciones", "disponibles", "capacidadDePersonas", "costoPorNoche"])){
		$stmt->bind_param("ii", $valorActualizado, $idHabitacion);
	}else{
		$stmt->bind_param("si", $valorActualizado, $idHabitacion);
	}
	$stmt->execute();
	$stmt->close();
	$conexionSql->close();																																			
	return;
}

function eliminarHabitacion($idHabitacion){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$peticion = "DELETE FROM habitaciones WHERE idhabitacion = ?";
	$stmt = $conexionSql->prepare($peticion);
	$stmt->bind_param("i", $idHabitacion);
	
	if($stmt->execute()){
		echo "Habitación eliminada";
	}else{
		echo "Error al eliminar habitación" . $stmt->error;
	}	
	$stmt->close();
	$conexionSql->close();
	return;

}


function obtenerRutasImagenesDeCliente($idHabitacion){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();
	$consulta = "SELECT urlImagen, idImg FROM imageneshabitaciones WHERE idHabitacion = ?";
	$stmt = $conexionSql->prepare($consulta);
	$stmt->bind_param("i", $idHabitacion);
	$stmt->execute();
	$resultado = $stmt->get_result();
	$html = '';
	while($registro = $resultado->fetch_assoc()){
		$urlImagen = $registro['urlImagen'];
		$idImagen = $registro['idImg'];
		$directorio = "../../cliente/recursos/img/habitaciones/".$urlImagen;
			//<div class="swiper-slide"><img src="../recursos/img/habitaciones/artico-blanco.jpg" alt="Imagen 1"></div>;
		$html .= '<div class="swiper-slide" data-idimagen="'.$idImagen.'"><img src="'.$directorio.'" alt="Imagen de Habitación"></div>';	
	}

	$stmt->close();
	echo $html;
	return $html;
}


function eliminarImagen($idImagen){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();
	$peticion = "DELETE FROM imageneshabitaciones WHERE idImg = ?";
	$stmt = $conexionSql->prepare($peticion);
	$stmt->bind_param("i", $idImagen);
	$stmt->execute();
	$stmt->close();
	$conexionSql->close();
	return;
}




function listar(){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$peticion = "SELECT * FROM habitaciones";
	$resultado = $conexionSql->query($peticion);
	$consultaImagenes = "SELECT h.*, MIN(img.urlImagen) AS urlImagen
						FROM habitaciones h
						LEFT JOIN imageneshabitaciones img ON h.idhabitacion = img.idHabitacion
						GROUP BY h.idhabitacion;"; 
	$resultadoImg = $conexionSql->query($consultaImagenes);
	$html='';
	//Generar array de habitaciones obtenidas de la BD
	while($registro = $resultado->fetch_assoc()){
		$img = $resultadoImg->fetch_assoc();
		$html .= '<li class="habitacion-propiedades" onClick="selecc_cuarto(this)" data-tipo="' . $registro['categoria'] . '">';
		$rutaImg = "../recursos/img/habitaciones/".$registro['urlImagen'];
		$html .= '<div class="contenedor-img">';
        $html .= '<img src="' . $rutaImg . '" alt="">';
		$html .= '</div>';
        $html .= '<div class="detalles-habitacion">';
		$html .= '<h2 id="codigo-habitacion">' .$registro['idhabitacion'] . '</h2>';
        $html .= '<h2 id="nombre-habitacion">' . $registro['nombre'] . '</h2>';
        $html .= '<p><strong>Categoría:</strong> <span id="categoria-habitacion">' . $registro['categoria'] . '</span></p>';
        $html .= '<p><strong>Cap. personas:</strong> <span id="cantidad-personas">' . $registro['capacidadDePersonas'] . '</span></p>';
        $html .= '<p><strong>Total habitaciones:</strong> <span id="total-habitaciones">' . $registro['numHabitaciones'] . '</span></p>';
		$html .= '<p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">' . $registro['disponibles'] . '</span></p>';
        $html .= '<p><strong>Costo:</strong> <span id="costo-habitacion">' . $registro['costoPorNoche'] . '</span></p>';
        $html .= '</div>';
        $html .= '</li>';
	}
	$conexionSql->close();
	echo $html;
	return $html;
}

function filtrarPorCategoria($categoria){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$peticion = "SELECT * FROM habitaciones WHERE categoria = '$categoria'";
	$resultado = $conexionSql->query($peticion); 
	$consultaImagenes = "SELECT h.*, MIN(img.urlImagen) AS urlImagen
	FROM habitaciones h
	LEFT JOIN imageneshabitaciones img ON h.idhabitacion = img.idHabitacion
	GROUP BY h.idhabitacion;"; 
	$resultadoImg = $conexionSql->query($consultaImagenes);
	$html='';
	//Generar array de habitaciones obtenidas de la BD
	while($registro = $resultado->fetch_assoc()){
		$img = $resultadoImg->fetch_assoc();
		$html .= '<li class="habitacion-propiedades" onClick="selecc_cuarto(this)" data-tipo="' . $registro['categoria'] . '">';
		$rutaImg = "../recursos/img/habitaciones/".$registro['urlImagen'];
		$html .= '<div class="contenedor-img">';
        $html .= '<img src="' . $rutaImg . '" alt="">';
		$html .= '</div>';
        $html .= '<div class="detalles-habitacion">';
		$html .= '<h2 id="codigo-habitacion">' .$registro['idhabitacion'] . '</h2>';
        $html .= '<h2 id="nombre-habitacion">' . $registro['nombre'] . '</h2>';
        $html .= '<p><strong>Categoría:</strong> <span id="categoria-habitacion">' . $registro['categoria'] . '</span></p>';
        $html .= '<p><strong>Cap. personas:</strong> <span id="cantidad-personas">' . $registro['capacidadDePersonas'] . '</span></p>';
		$html .= '<p><strong>Total habitaciones:</strong> <span id="total-habitaciones">' . $registro['numHabitaciones'] . '</span></p>';
        $html .= '<p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">' . $registro['disponibles'] . '</span></p>';
        $html .= '<p><strong>Costo:</strong> <span id="costo-habitacion">' . $registro['costoPorNoche'] . '</span></p>';
        $html .= '</div>';
        $html .= '</li>';
	}
	$conexionSql->close();
	echo $html;
	return;
}


function obtenerDescripcion($idHabitacion){
    $conexionSql = new Conexiondb();
    $conexionSql = $conexionSql->getConnection();

    $consulta = "SELECT descripcion FROM habitaciones WHERE idhabitacion = ?";
    $stmt = $conexionSql->prepare($consulta);
    $stmt->bind_param("i", $idHabitacion);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows <= 0) {
        $stmt->close();
        $conexionSql->close();
        return "No se encontró la habitación";
    }

    $registro = $resultado->fetch_assoc();
    $descripcionHab = $registro['descripcion'];
    $stmt->close();
    $conexionSql->close();
	echo $descripcionHab;
    return $descripcionHab;
}

function crearHabitacion($nombre, $categoria, $descripcion, $habitaciones, $habitacionesDisp, $capacidad, $costo, $img){
	try{
	// Habilitar informes de errores
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	// Configurar mysqli para lanzar excepciones
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$peticion = "INSERT INTO habitaciones (nombre, categoria, descripcion, numHabitaciones, disponibles, capacidadDePersonas, costoPorNoche, urlImagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $conexionSql->prepare($peticion);
	$stmt->bind_param("sssiiiis", $nombre, $categoria, $descripcion, $habitaciones, $habitacionesDisp, $capacidad, $costo, $img);
	
	if($stmt->execute()){
		echo "Habitación creada";
	}else{
		echo "Error al crear habitación" . $stmt->error;
	}	
	$stmt->close();
	$conexionSql->close();
	}catch(Exception $e){
		echo "Error al crear habitación" . $e->getMessage();
	}
	return;
}