<?php
include '../config/database.php';

$db = new Database();
$conn = $db->conectar();

$query = "SELECT producto_id, producto_nombre, stock FROM productos";
$stmt = $conn->prepare($query);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($productos);
?>
