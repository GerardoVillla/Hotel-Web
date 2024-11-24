<?php
require_once (__DIR__."/../../config.inc.php");

header('Content-Type: application/json');

// Crear una instancia de la conexión
$conexiondb = new Conexiondb();
$conn = $conexiondb->getConnection();

// Consulta para obtener las habitaciones
$sql = "SELECT idhabitacion, nombre, categoria, disponibles, numHabitaciones, descripcion, costoPorNoche, capacidadDePersonas, URLImagen FROM habitaciones";
$result = $conn->query($sql);

// Verificar si hay resultados
$habitaciones = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $habitaciones[] = $row;
    }
}

// Devolver los resultados como JSON
echo json_encode($habitaciones);

// Cerrar la conexión
$conn->close();
?>
