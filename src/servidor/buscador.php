<?php
header('Content-Type: text/plain'); // Cambiamos el tipo de contenido a texto plano
require_once (__DIR__."/../../config.inc.php");

$idImagen = isset($_GET['idImagen']) ? intval($_GET['idImagen']) : null;

if (!$idImagen || $idImagen <= 0) {
    echo "Error: ID de imagen inválido o no proporcionado.";
    exit;
}

// Crear conexión
$conexionSql = new Conexiondb();
$conexion = $conexionSql->getConnection();

if ($conexion->connect_error) {
    echo "Error al conectar a la base de datos: " . $conexion->connect_error;
    exit;
}

// Usar consulta preparada para evitar inyección SQL
$stmt = $conexion->prepare("SELECT urlImagen FROM habitaciones WHERE idhabitacion = ?");
$stmt->bind_param("i", $idImagen);  // 'i' indica que el parámetro es un entero
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si se encontró un resultado
if ($fila = $resultado->fetch_assoc()) {
    // Obtener la URL de la imagen y devolverla como texto plano
    echo $fila['urlImagen'];
} else {
    echo "Error: Imagen no encontrada.";
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
?>
