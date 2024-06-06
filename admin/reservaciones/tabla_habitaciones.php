<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
</head>
<body>
    <table class="table table-striped m-5" id="productos-table">
    <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($habitaciones as $habitacion) : ?>
            <tr>
                <td><?php echo htmlspecialchars($productos['producto_id']); ?></td>
                <td><?php echo htmlspecialchars($productos['producto_nombre']); ?></td>
                <td><?php echo htmlspecialchars($productos['stock']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            // Función para cargar y mostrar los productos
            function cargarProductos() {
                $.ajax({
                    url: 'json.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tbody = $('#productos-table tbody');
                        tbody.empty(); // Limpiar la tabla existente
                        data.forEach(function(producto) {
                            var row = '<tr>' +
                                      '<td>' + producto.producto_id + '</td>' +
                                      '<td>' + producto.producto_nombre + '</td>' +
                                      '<td>' + producto.stock + '</td>' +
                                      '</tr>';
                            tbody.append(row);
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error al cargar los productos: ' + textStatus);
                    }
                });
            }

            // Cargar los productos al cargar la página
            cargarProductos();
        });
    </script>
</body>
</html>

