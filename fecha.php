<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_compra = filter_var($_POST['id_compra'], FILTER_VALIDATE_INT);
    $fecha_llegada = $_POST['fecha_llegada']; // No necesita sanitización extra ya que es de tipo date en el HTML

    if ($id_compra !== false && !empty($fecha_llegada)) {
        // Conectar a la base de datos
        $db = new Database();
        $conn = $db->conectar();

        // Obtener la cantidad comprada desde la base de datos
        $query = "SELECT cantidad FROM detalle_compra WHERE id_compra = :id_compra";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $cantidad_comprada = $result['cantidad'];

            // Calcular la fecha de salida
            $fecha_salida = date('Y-m-d', strtotime($fecha_llegada . ' + ' . $cantidad_comprada . ' days'));

            // Insertar en la tabla fecha_detalle
            $query = "INSERT INTO fecha_detalle (id_compra, fecha_llegada, fecha_salida) VALUES (:id_compra, :fecha_llegada, :fecha_salida)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_llegada', $fecha_llegada, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_salida', $fecha_salida, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'fecha_salida' => $fecha_salida]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al guardar las fechas.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Compra no encontrada.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos proporcionados.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido.']);
}
?>

