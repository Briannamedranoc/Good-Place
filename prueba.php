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
                echo "Fechas guardadas correctamente.";
            } else {
                echo "Error al guardar las fechas.";
            }
        } else {
            echo "Compra no encontrada.";
        }
    } else {
        echo "Datos inválidos proporcionados.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>



<div class="container">
      <div class="row">
        <div class="col-md-3">
          <h2>Selecciona tu fecha de llegada</h2>
          <form id="fechaForm" method="POST" action="fecha.php">
                <input type="hidden" name="id_compra" value="<?php echo $idCompra; ?>"> <!-- Asumiendo que id_compra se pasa como parámetro -->
                <div class="form-group">
                <label for="fecha_llegada">Fecha de Llegada</label>
                <input type="date" class="form-control" id="fecha_llegada" name="fecha_llegada" required>
                </div><br>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
        <div class="col-md-9"></div>
      </div>
    </div>