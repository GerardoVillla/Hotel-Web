<?php
include_once "config/conexiondb.php";
include_once "config/config.inc.php";

function agregarReservacionDB($idHabitacion, $idCliente, $fechaReservacion, $inicioEstadia, $finEstadia, $subtotal) {
    $conexionSql = new Conexiondb();
    $conexionSql = $conexionSql->getConnection();

    // Crea la consulta SQL
    $peticion = "INSERT INTO reservaciones (idHabitacion, idCliente, fechaReservacion, inicioEstadia, finEstadia, subtotal) 
                 VALUES ('$idHabitacion', '$idCliente', '$fechaReservacion', '$inicioEstadia', '$finEstadia', '$subtotal')";

    // Ejecuta la consulta
    if ($conexionSql->query($peticion) === TRUE) {
        $respuesta = "Reservación agregada correctamente.";
    } else {
        $respuesta = "Error al agregar la reservación: " . $conexionSql->error;
    }

    // Cierra la conexión
    $conexionSql->close();

    actualizarDisponibilidad($idHabitacion);

    return $respuesta; // Devuelve el resultado
}

function actualizarDisponibilidad($idHabitacion){
    //TODO
    $conexionSql = new Conexiondb();
    $conexionSql = $conexionSql->getConnection();

    $peticion = "UPDATE idhabitacion ";

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén el valor enviado desde JS
    $idHabitacion = $_POST['idHabitacion'];
    $idCliente = $_POST['idCliente'];
    $fechaReservacion = $_POST['fechaReservacion'];
    $inicioEstadia = $_POST['inicioEstadia'];
    $finEstadia = $_POST['finEstadia'];
    $subtotal = $_POST['subtotal'];

    // Llama a la función y captura el resultado
    $resultado = agregarReservacionDB($idHabitacion, $idCliente, $fechaReservacion, $inicioEstadia, $finEstadia, $subtotal);

    // Envía el resultado de vuelta al cliente en formato JSON
    echo json_encode(["mensaje" => $resultado]);
}
?>
