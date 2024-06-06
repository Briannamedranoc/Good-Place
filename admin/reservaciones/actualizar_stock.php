<!-- update_stock.php -->
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <title>Administrador</title>
</head>
<body>
<?php include 'header.php';?>
<!--confirmar datos
tuve que confirmar que se estaban guardando en el arreglo, ay que me aparecia
que el arreglo estaba vacio, una vez verificandolo ya supe en donde estaba el error
-->
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5 mt-5 p-5" style="background-color:#E6E8E8; border-radius:15px;">
                <h2>Update Stock Habitaciones</h2>
                
                <form action="update_stock.php" method="POST">
                    <label for="habitacion">Seleccione la habitacion a modificar:</label>
                    <select class="form-select" name="habitacion" id="habitacion">
                        <?php foreach ($habitaciones as $habitacion) : ?>
                            <option value="<?php echo $habitacion['producto_id'];?>">
                                <?php echo $habitacion['producto_nombre']; ?> (Stock actual: <?php echo $habitacion['stock']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label for="nuevo_stock">Ingrese el nuevo stock:</label><br>
                    <input type="number" name="nuevo_stock" id="nuevo_stock" required min="0" max="100">
                    <br><br>
                    <button class="btn btn-primary btn-md" type="submit"><i class='bx bx-cloud-upload' style='color:#ffffff'></i> Actualizar</button>
                </form>
            </div>
            <div class="col-md-5">
                <?php include 'tabla_habitaciones.php' ?>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>

</body>
</html>
