<?php
// Incluir el archivo que contiene la lógica para obtener las habitaciones
include 'obtener_habitaciones.php';

// Verificar si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectar a la base de datos
    $db = new Database();
    $conn = $db->conectar();
    
    // Validar y sanitizar entradas
    if (isset($_POST['habitacion']) && isset($_POST['nuevo_stock'])) {
        $id_habitacion = filter_var($_POST['habitacion'], FILTER_VALIDATE_INT);
        $nuevo_stock = filter_var($_POST['nuevo_stock'], FILTER_VALIDATE_INT);

        // Verificar si las entradas son válidas
        if ($id_habitacion !== false && $nuevo_stock !== false) {
            // Preparar la consulta
            $query = "UPDATE productos SET stock = :stock WHERE producto_id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':stock', $nuevo_stock, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id_habitacion, PDO::PARAM_INT);

            // Ejecutar la consulta
            try {
                if ($stmt->execute()) {
                    echo "Stock actualizado correctamente.";
                } else {
                    echo "Error al actualizar el stock.";
                }
            } catch (PDOException $e) {
                echo 'Error en la consulta: ' . $e->getMessage();
            }
        } else {
            echo "Datos inválidos proporcionados.";
        }
    } else {
        echo "Por favor complete todos los campos.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
