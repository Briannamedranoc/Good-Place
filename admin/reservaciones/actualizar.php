<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar entradas
    if (isset($_POST['producto_id']) && isset($_POST['producto_codigo']) && isset($_POST['producto_nombre']) && 
        isset($_POST['producto_descripcion']) && isset($_POST['producto_precio']) && isset($_POST['producto_descuento']) && 
        isset($_POST['stock']) && isset($_POST['categoria_id']) && isset($_POST['producto_activo'])) {
        
        $producto_id = filter_var($_POST['producto_id'], FILTER_VALIDATE_INT);
        $producto_codigo = filter_var($_POST['producto_codigo'], FILTER_SANITIZE_STRING);
        $producto_nombre = filter_var($_POST['producto_nombre'], FILTER_SANITIZE_STRING);
        $producto_descripcion = filter_var($_POST['producto_descripcion'], FILTER_SANITIZE_STRING);
        $producto_precio = filter_var($_POST['producto_precio'], FILTER_VALIDATE_FLOAT);
        $producto_descuento = filter_var($_POST['producto_descuento'], FILTER_VALIDATE_FLOAT);
        $stock = filter_var($_POST['stock'], FILTER_VALIDATE_INT);
        $categoria_id = filter_var($_POST['categoria_id'], FILTER_VALIDATE_INT);
        $producto_activo = filter_var($_POST['producto_activo'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

        // Verificar si las entradas son válidas
        if ($producto_id !== false && $producto_codigo !== false && $producto_nombre !== false && $producto_descripcion !== false && 
            $producto_precio !== false && $producto_descuento !== false && $stock !== false && $categoria_id !== false && $producto_activo !== false) {
            
            // Conectar a la base de datos
            $db = new Database();
            $conn = $db->conectar();

            // Preparar la consulta
            $query = "UPDATE productos SET producto_codigo = :producto_codigo, producto_nombre = :producto_nombre, 
                      producto_descripcion = :producto_descripcion, producto_precio = :producto_precio, 
                      producto_descuento = :producto_descuento, stock = :stock, categoria_id = :categoria_id, 
                      producto_activo = :producto_activo WHERE producto_id = :producto_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
            $stmt->bindParam(':producto_codigo', $producto_codigo, PDO::PARAM_STR);
            $stmt->bindParam(':producto_nombre', $producto_nombre, PDO::PARAM_STR);
            $stmt->bindParam(':producto_descripcion', $producto_descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':producto_precio', $producto_precio, PDO::PARAM_STR);
            $stmt->bindParam(':producto_descuento', $producto_descuento, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            $stmt->bindParam(':producto_activo', $producto_activo, PDO::PARAM_BOOL);

            // Ejecutar la consulta
            try {
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el producto.']);
                }
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error en la consulta: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos inválidos proporcionados.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Por favor complete todos los campos.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido.']);
}
?>
