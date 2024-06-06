<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';  
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
    echo 'Error al procesar la peticion.';
    exit;
}else{
    $token_tmp = hash_hmac('sha1',$id, KEY_TOKEN);

    if($token == $token_tmp){

        $sql = $con -> prepare("SELECT count(producto_id) FROM productos WHERE producto_id=? AND producto_activo = 1");
        $sql -> execute([$id]);
        if($sql -> fetchColumn() > 0){
            
            $sql = $con -> prepare("SELECT producto_codigo,producto_nombre,producto_descripcion,producto_precio,producto_descuento,categoria_id FROM productos WHERE producto_id=? AND producto_activo = 1 LIMIT 1");
            $sql -> execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['producto_nombre'];
            $descripcion = $row['producto_descripcion'];
            $precio = $row['producto_precio'];
            $codigo = $row['producto_codigo'];
            $descuento = $row['producto_descuento'];
            $precio_descuento = $precio-(($precio * $descuento) / 100);
            $categoria = $row['categoria_id'];

            $dir_imagenes = "imagenes/habitaciones/" . $categoria . ".jpg";
            //si la imagen existe se imprime y si no sale la imagen que no tenemos foto
            if(!file_exists($dir_imagenes)){
                $dir_imagenes = "imagenes/no-photo.jpeg";
            }

            /*while(($archivo = $dir->read()) != false){
              if($archivo != $categoria && (strpos($archivo, 'jpeg'))){
                $imagenes[]=$dir_imagenes . $archivo;
              }
           }
           $dir->close();*/
        }
      }else{
        echo 'Error al procesar la peticion.';
    exit;
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
  <body>
     
<header>
  <?php include 'navbar.php' ?>
</header>
<br><br><br>
<main>
    <div class="container">
      <a href="reservacion.php"><button class="btn btn-dark btn-md"><i class='bx bx-caret-left' style="color:#fff;"> Regresar</a></i></button>
        <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-5">
                <img src="<?php echo $dir_imagenes;?>" width="400" height="400"alt="">
            </div>
            <div class="col-md-5">
                <h2><?php echo $nombre; ?></h2>
                <!---aplicar descuento--->
                <?php if($descuento > 0){?>
                  <p><del><?php echo MONEDA . number_format($precio,2,'.', ','); ?></del></p>
                  <h2>
                    <?php echo MONEDA . number_format($precio_descuento,2,'.', ','); ?>
                    <small class="text-success"><?php echo $descuento; ?>% Descuento</small>
                  </h2>

                  <?php } else { ?>
                  
                    <h2><?php echo MONEDA . number_format($precio,2,'.', ','); ?> Precio mas iva</h2>
                
                   <?php } ?>
                
                <p class="lead">
                  <?php echo $descripcion; ?>
                </p>
                <div class="d-grid gap-3 col-10 mx-auto">
                    <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
                  </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</main>
<br><br><br><br>
<?php include 'footer.php';?>
 
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