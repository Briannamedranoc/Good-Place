<?php
include '../config/database.php';

if (isset($_GET['producto_id'])) {
    $producto_id = filter_var($_GET['producto_id'], FILTER_VALIDATE_INT);

    if ($producto_id !== false) {
        $db = new Database();
        $conn = $db->conectar();
        $query = "SELECT * FROM productos WHERE producto_id = :producto_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            echo json_encode($producto);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID de producto inválido.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de producto no proporcionado.']);
}
?>
