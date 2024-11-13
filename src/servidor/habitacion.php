<?php
include_once "config/conexiondb.php";


if(isset($_GET["action"])){
	$peticion = $_GET["action"];
	switch($peticion){
		case "listar";
			listar();
			break;
		case "filtrar";
			$categoria = $_GET["categoria"];
			filtrarPorCategoria($categoria);
			break;
		case "crear":
			$categoria = $_GET["txt_categoria"];
			$habitaciones = $_GET["txt_habitaciones"];
			$habitacionesDisp = $_GET["txt_habdisponibles"];
			$costo = $_GET["txt_costo"];
			$img = $_GET["btn_cambiarimg"];
			$descripcion = $_GET["txt_descripcion"];
			insertar();
			break;
		case "editar":
			break;
		case "eliminar":
			break;
	}
}

function insertar(){
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
        $html .= '<h2 id="nombre-habitacion">' . $registro['nombre'] . '</h2>';
        $html .= '<p><strong>Categoría:</strong> <span id="categoria-habitacion">' . $registro['categoria'] . '</span></p>';
        $html .= '<p><strong>Cap. personas:</strong> <span id="cantidad-habitacion">' . $registro['capacidadDePersonas'] . '</span></p>';
        $html .= '<p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">' . $registro['disponibilidad'] . '</span></p>';
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
        $html .= '<h2 id="nombre-habitacion">' . $registro['nombre'] . '</h2>';
        $html .= '<p><strong>Categoría:</strong> <span id="categoria-habitacion">' . $registro['categoria'] . '</span></p>';
        $html .= '<p><strong>Cap. personas:</strong> <span id="cantidad-habitacion">' . $registro['capacidadDePersonas'] . '</span></p>';
        $html .= '<p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">' . $registro['disponibilidad'] . '</span></p>';
        $html .= '<p><strong>Costo:</strong> <span id="costo-habitacion">' . $registro['costoPorNoche'] . '</span></p>';
        $html .= '</div>';
        $html .= '</li>';
	}
	$conexionSql->close();
	echo $html;
	return $html;
}