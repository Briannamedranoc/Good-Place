<?php
include '../config/database.php';

$db = new Database();
$conn = $db->conectar();

$query = "SELECT * FROM productos";
$stmt = $conn->prepare($query);
$stmt->execute();

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($productos);
?>
