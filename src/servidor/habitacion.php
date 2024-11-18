<?php
include_once "config/conexiondb.php";

if(isset($_POST["action"])){
	$peticion = $_POST["action"];
	switch($peticion){
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



function actualizarHabitacion($idHabitacion, $campo, $valorActualizado){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();

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


function listar(){
	$conexionSql = new Conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$peticion = "SELECT * FROM habitaciones";
	$resultado = $conexionSql->query($peticion); 
	
	$html='';
	//Generar array de habitaciones obtenidas de la BD
	while($registro = $resultado->fetch_assoc()){
		$html .= '<li class="habitacion-propiedades" onClick="selecc_cuarto(this)" data-tipo="' . $registro['categoria'] . '">';
		$rutaImg = "../recursos/img/habitaciones/".$registro['urlImagen'];
        $html .= '<img src="' . $rutaImg . '" alt="">';
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
	
	$html='';
	//Generar array de habitaciones obtenidas de la BD
	while($registro = $resultado->fetch_assoc()){
		$html .= '<li class="habitacion-propiedades" onClick="selecc_cuarto(this)" data-tipo="' . $registro['categoria'] . '">';
		$rutaImg = "../recursos/img/habitaciones/".$registro['urlImagen'];
        $html .= '<img src="' . $rutaImg . '" alt="">';
        $html .= '<div class="detalles-habitacion">';
		$html .= '<h2 id="codigo-habitacion">' .$registro['idhabitacion'] . '</h2>';
        $html .= '<h2 id="nombre-habitacion">' . $registro['nombre'] . '</h2>';
        $html .= '<p><strong>Categoría:</strong> <span id="categoria-habitacion">' . $registro['categoria'] . '</span></p>';
        $html .= '<p><strong>Cap. personas:</strong> <span id="cantidad-personas">' . $registro['capacidadDePersonas'] . '</span></p>';
		$html .= '<p><strong>Total habitaciones:</strong> <span id="total-habitacion">' . $registro['numHabitaciones'] . '</span></p>';
        $html .= '<p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">' . $registro['disponibles'] . '</span></p>';
        $html .= '<p><strong>Costo:</strong> <span id="costo-habitacion">' . $registro['costoPorNoche'] . '</span></p>';
        $html .= '</div>';
        $html .= '</li>';
	}
	$conexionSql->close();
	echo $html;
	return $html;
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