<?php
header('Content-Type: application/json');
include_once "config/conexiondb.php";

$idImagen = $_GET['idImagen'] ?? null;

if ($idImagen) {
    // Crear conexión
    $conexionSql = new Conexiondb();
    $conexion = $conexionSql->getConnection();

    // Usar consulta preparada para evitar inyección SQL
    $stmt = $conexion->prepare("SELECT urlImagen FROM habitaciones WHERE idhabitacion = ?");
    $stmt->bind_param("i", $idImagen);  // 'i' indica que el parámetro es un entero
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontró un resultado
    if ($fila = $resultado->fetch_assoc()) {
        // Obtener la URL de la imagen
        $urlImagen = $fila['urlImagen'];
        echo json_encode(["url" => $urlImagen]);
    } else {
        echo json_encode(["error" => "Imagen no encontrada"]);
    }
    
    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["error" => "ID de imagen no proporcionado"]);
}
?>
