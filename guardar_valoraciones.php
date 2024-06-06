<?php
// Configura la conexión a la base de datos (cambia estos valores según tu configuración)


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config/config.php';
require 'config/database.php';

// Recibe los datos del formulario
$data = json_decode(file_get_contents('php://input'), true);

// Valida que los datos no sean nulos o vacíos
if (isset($data['name']) && !empty($data['name']) && isset($data['rating']) && !empty($data['rating']) && isset($data['comment']) && !empty($data['comment'])) {
    $name = $data['name'];
    $rating = $data['rating'];
    $comment = $data['comment'];

    // Crea una instancia de la clase de conexión a la base de datos
    $db = new Database();
    $conn = $db->conectar();

    // Prepara la consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO valoraciones (nombre, valoracion, comentario) VALUES (?, ?, ?)";

    try {
        // Prepara la declaración
        $stmt = $conn->prepare($sql);

        // Vincula los parámetros
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $rating);
        $stmt->bindParam(3, $comment);

        // Ejecuta la consulta
        $stmt->execute();

        // Si la inserción fue exitosa, devuelve un código de estado 200 (OK)
        http_response_code(200);
        echo json_encode(['message' => 'Valoración enviada con éxito.']);
    } catch (PDOException $e) {
        // Si hubo un error, devuelve un código de estado 500 (Error interno del servidor)
        http_response_code(500);
        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
    }
} else {
    // Si los datos están incompletos, devuelve un código de estado 400 (Solicitud incorrecta)
    http_response_code(400);
    echo json_encode(['error' => 'Todos los campos son obligatorios.']);
}
?>