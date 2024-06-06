<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con -> prepare("SELECT producto_id, producto_codigo, producto_nombre, producto_precio, categoria_id FROM productos WHERE producto_activo = 1");
$sql -> execute();
$resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Good Place</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
 <?php include 'navbar.php';?>
 <br>
<div class="container">
    <a href="index.php"><button class="btn btn-dark btn-md m-3"><i class='bx bx-caret-left' style="color:#fff;"> Regresar</a></i></button>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3">
        <?php foreach($resultado as $row) { ?>
            <div class="col">
                <div class="card shadow-sm">
                    <?php
                    $categoria = $row['categoria_id'];
                    $imagen = "imagenes/habitaciones/" . $categoria .".jpg";
                    if(!file_exists($imagen)){
                        $imagen = "imagenes/no-photo.jpeg";
                    }
                    ?>
                    <img src="<?php echo $imagen;?>" alt="">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['producto_nombre'];?></h5>
                        <p class="card-text">$<?php echo number_format($row['producto_precio'],2,'.',',');?> Precio mas iva </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="detalles.php?id=<?php echo $row['producto_id']; ?>&token=<?php echo
                                 hash_hmac('sha1',$row['producto_id'], KEY_TOKEN);?>" class="btn btn-sm btn-primary"><i class='bx bx-detail' style='color:#fffcfc' > Detalles</i></a>
                            </div>
                            <button class="btn btn-sm btn-success" type="button" onclick="addProducto(<?php echo $row['producto_id'];?>, '<?php echo hash_hmac('sha1',$row['producto_id'], KEY_TOKEN)?>')"><i class='bx bxs-cart-add' style='color:#fffcfc'> Agregar</i></button>
                            <div id="notification" class="notification"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
  crossorigin="anonymous"></script>

  <script>
      function addProducto(id, token){
          let url = 'clases/carrito.php'
          let formData =  new FormData()
          formData.append('id',id)
          formData.append('token',token)

          fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
          }).then(response => response.json())
          .then(data => {
            if(data.ok){
              let elemento = document.getElementById("num_cart")
              elemento.innerHTML = data.numero
            }
          })
      }
      </script>

  </body>
</html>