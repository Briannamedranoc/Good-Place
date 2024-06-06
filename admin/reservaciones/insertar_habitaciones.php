<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Producto</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <h2 class="mb-4">Insertar Nuevo Producto</h2>
                <form action="insertar.php" method="POST">
                    <div class="mb-3">
                        <label for="producto_id" class="form-label">ID de Producto:</label>
                        <input type="number" class="form-control" id="producto_id" name="producto_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="producto_codigo" class="form-label">Código de Producto:</label>
                        <input type="text" class="form-control" id="producto_codigo" name="producto_codigo" required>
                    </div>
                    <div class="mb-3">
                        <label for="producto_nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="producto_nombre" name="producto_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="producto_descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="producto_descripcion" name="producto_descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="producto_precio" class="form-label">Precio:</label>
                        <input type="number" class="form-control" id="producto_precio" name="producto_precio" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="producto_descuento" class="form-label">Descuento:</label>
                        <input type="number" class="form-control" id="producto_descuento" name="producto_descuento" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">ID de Categoría:</label>
                        <input type="number" class="form-control" id="categoria_id" name="categoria_id" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="producto_activo" name="producto_activo" value="1">
                        <label class="form-check-label" for="producto_activo">Activo</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Insertar Producto</button>
                </form>
            </div>
            <div class="col-md-7">
            <?php include 'tabla_actualizacion.php'; ?>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <br>
    <?php include 'footer.php';?>
</body>
</html>
