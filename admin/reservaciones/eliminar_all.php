<?php
session_start();

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Producto</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4 mt-5">
            <h2>Eliminar Producto</h2>
                    <form id="eliminarProductoForm" action="eliminar.php" method="post">
                        <div class="form-group">
                            <label for="producto_id">ID del Producto:</label>
                            <input type="number" class="form-control" id="producto_id" name="producto_id" required max="1000" min="1">
                        </div>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>  
            <div class="col-md-6">
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
</div>
    <div class="col-md-1"></div>
    
    </div>  
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

            // Manejar el envío del formulario para eliminar un producto
            $('#eliminarProductoForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'eliminar.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Si la eliminación fue exitosa, cargar y mostrar los productos nuevamente
                            cargarProductos();
                        } else {
                            // Si hay un error, mostrar el mensaje de error
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error al eliminar el producto: ' + textStatus);
                    }
                });
            });
        });
    </script>
    <?php include 'footer.php';?>
</body>
</html>