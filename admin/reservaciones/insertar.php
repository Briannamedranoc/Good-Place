<?php
// Verificar si se envió un formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Incluir el archivo de configuración de la base de datos
    include '../config/database.php';

    // Conectar a la base de datos
    $db = new Database();
    $conn = $db->conectar();

    // Validar y sanitizar las entradas del formulario
    $producto_id = isset($_POST['producto_id']) ? $_POST['producto_id'] : null;
    $producto_codigo = filter_input(INPUT_POST, 'producto_codigo', FILTER_SANITIZE_STRING);
    $producto_nombre = filter_input(INPUT_POST, 'producto_nombre', FILTER_SANITIZE_STRING);
    $producto_descripcion = filter_input(INPUT_POST, 'producto_descripcion', FILTER_SANITIZE_STRING);
    $producto_precio = filter_input(INPUT_POST, 'producto_precio', FILTER_VALIDATE_FLOAT);
    $producto_descuento = filter_input(INPUT_POST, 'producto_descuento', FILTER_VALIDATE_FLOAT);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
    $categoria_id = filter_input(INPUT_POST, 'categoria_id', FILTER_VALIDATE_INT);
    $producto_activo = isset($_POST['producto_activo']) ? 1 : 0;

    // Verificar si las entradas son válidas
    if ($producto_id !== null && $producto_codigo && $producto_nombre && $producto_descripcion && $producto_precio !== false && $producto_descuento !== false && $stock !== false && $categoria_id !== false) {
        // Preparar la consulta SQL
        $query = "INSERT INTO productos (producto_id, producto_codigo, producto_nombre, producto_descripcion, producto_precio, producto_descuento, stock, categoria_id, producto_activo) VALUES (:producto_id, :producto_codigo, :producto_nombre, :producto_descripcion, :producto_precio, :producto_descuento, :stock, :categoria_id, :producto_activo)";
        $stmt = $conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_codigo', $producto_codigo, PDO::PARAM_STR);
        $stmt->bindParam(':producto_nombre', $producto_nombre, PDO::PARAM_STR);
        $stmt->bindParam(':producto_descripcion', $producto_descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':producto_precio', $producto_precio, PDO::PARAM_STR);
        $stmt->bindParam(':producto_descuento', $producto_descuento, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_activo', $producto_activo, PDO::PARAM_INT);

        // Ejecutar la consulta
        try {
            if ($stmt->execute()) {
                echo "Producto insertado correctamente.";
            } else {
                echo "Error al insertar el producto.";
            }
        } catch (PDOException $e) {
            echo 'Error en la consulta: ' . $e->getMessage();
        }
    } else {
        echo "Datos inválidos proporcionados.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
