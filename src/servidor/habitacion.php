<?php
if(isset($_SERVER["action"])){
	$peticion = $_SERVER["action"];
	switch($peticion){
		case "listar":
			break;
		case "crear":
			$categoria = $_GET["txt_categoria"];
			$habitaciones = $_GET["txt_habitaciones"];
			$habitacionesDisp = $_GET["txt_habdisponibles"];
			$costo = $_GET["txt_costo"];
			$img = $_GET["btn_cambiarimg"];
			$descripcion = $_GET["txt_descripcion"];
			insertarHabitacion();
			break;
		case "editar":
			break;
		case "eliminar":
			break;
	}
}

function insertarHabitacion(){

}