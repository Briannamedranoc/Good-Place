<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'header.php';?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
            <h2><i class='bx bx-cloud-upload'></i> Actualizar Habitacion</h2>
                <form id="selectProductForm">
                    <div class="form-group">
                        <label for="producto_id_select">Seleccione Producto</label>
                        <select class="form-control" id="producto_id_select" name="producto_id_select" required>
                            <option value="">Seleccione...</option>
                            <?php
                            include '../config/database.php';
                            $db = new Database();
                            $conn = $db->conectar();
                            $query = "SELECT producto_id, producto_nombre FROM productos";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($productos as $producto) {
                                echo "<option value='{$producto['producto_id']}'>{$producto['producto_id']} - {$producto['producto_nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
                <form id="updateProductForm" method="POST" action="update_product.php">
                    <input type="hidden" id="producto_id" name="producto_id">
                    <div class="form-group">
                        <label for="producto_codigo">Código</label>
                        <input type="text" class="form-control" id="producto_codigo" name="producto_codigo" required>
                    </div>
                    <div class="form-group">
                        <label for="producto_nombre">Nombre</label>
                        <input type="text" class="form-control" id="producto_nombre" name="producto_nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="producto_descripcion">Descripción</label>
                        <textarea class="form-control" id="producto_descripcion" name="producto_descripcion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="producto_precio">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="producto_precio" name="producto_precio" required>
                    </div>
                    <div class="form-group">
                        <label for="producto_descuento">Descuento</label>
                        <input type="number" step="0.01" class="form-control" id="producto_descuento" name="producto_descuento" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria_id">Categoría ID</label>
                        <input type="number" class="form-control" id="categoria_id" name="categoria_id" required>
                    </div>
                    <div class="form-group">
                        <label for="producto_activo">Activo</label>
                        <input type="checkbox" id="producto_activo" name="producto_activo">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
        </div>
            <div class="col-md-5">
            <?php include 'tabla_actualizacion.php'; ?>
            <div class="col-md-1"></div>
        </div>
        <?php include 'footer.php';?>
       

    <script>
        $(document).ready(function() {
            $('#producto_id_select').change(function() {
                var producto_id = $(this).val();
                if (producto_id) {
                    $.ajax({
                        url: 'obtener_datos.php', // Asegúrate de que la ruta sea correcta
                        type: 'GET',
                        data: { producto_id: producto_id },
                        dataType: 'json',
                        success: function(data) {
                            $('#producto_id').val(data.producto_id);
                            $('#producto_codigo').val(data.producto_codigo);
                            $('#producto_nombre').val(data.producto_nombre);
                            $('#producto_descripcion').val(data.producto_descripcion);
                            $('#producto_precio').val(data.producto_precio);
                            $('#producto_descuento').val(data.producto_descuento);
                            $('#stock').val(data.stock);
                            $('#categoria_id').val(data.categoria_id);
                            $('#producto_activo').prop('checked', data.producto_activo);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error al cargar los datos del producto: ' + textStatus);
                        }
                    });
                }
            });

            $('#updateProductForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'actualizar.php', // Asegúrate de que la ruta sea correcta
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Producto actualizado correctamente.');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error al actualizar el producto: ' + textStatus);
                    }
                });
            });
        });
        
        


    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
