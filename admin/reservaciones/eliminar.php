<?php  

        include '../config/database.php';
        $db = new Database();
        $conn = $db->conectar();
// Verificar si se está realizando una solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se recibió el ID del producto
    if (isset($_POST['producto_id'])) {
        // Conectar a la base de datos (asegúrate de incluir el archivo de conexión)
      

        // Eliminar el producto utilizando el ID recibido
        $query = "DELETE FROM productos WHERE producto_id = :producto_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':producto_id', $_POST['producto_id'], PDO::PARAM_INT);

        // Ejecutar la consulta y devolver el resultado
        echo $stmt->execute() ? json_encode(['status' => 'success']) : json_encode(['status' => 'error', 'message' => 'Error al eliminar el producto.']);
    } else {
        // No se proporcionó el ID del producto en la solicitud
        echo json_encode(['status' => 'error', 'message' => 'ID del producto no proporcionado.']);
    }
} else {
    // No se está utilizando el método de solicitud POST
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido.']);
}
?>
