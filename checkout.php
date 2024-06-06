<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;


$lista_carrito = array();
if($productos != null){
    foreach($productos as $clave => $cantidad){
        $sql = $con->prepare("SELECT producto_id,producto_codigo,producto_nombre,producto_precio,categoria_id,producto_descuento, $cantidad as cantidad FROM productos WHERE producto_id=? AND producto_activo = 1");
        $sql->execute([$clave]);
        $lista_carrito[]=$sql->fetch(PDO::FETCH_ASSOC);
    }
}
//session_destroy();

$sql = $con -> prepare("SELECT producto_id,producto_codigo,producto_nombre,producto_precio,categoria_id FROM productos WHERE producto_descuento=35");
$sql -> execute();
$resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);

//session_destroy();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<?php include 'navbar.php'; ?>

<br><br>




<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="movimiento-texto">
      <h1 style="color:orange;"><i class='bx bxs-shopping-bag' style='color:#000'><b>CARRITO</b></h1></i>
    <img src="imagenes/emotes/IMG_2783.jpg" width="45%" alt="">
        <br><br>
        <h3>¡Holaa!</h3>
        <p>Si ya estas seguro de tu compra podrias proceder al pago dando click al boton azul, De lo contrario, checa las ofertas calientes que tenemos ahora mismo.</p>
    </div>
  </div>
    <div class="col-md-8">
      <div class="row row-cols- row-cols-sm-3 row-cols-md-4 g-3">
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
                      <a href="reservacion.php"><button type="button" class="btn btn-primary">Mas info &raquo;</button></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
  </div>
  
<div class="row">
  <div class="col-md-12">
    <br><br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if($lista_carrito == null){
                    echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                }else{
                    $total = 0;
                    foreach($lista_carrito as $producto){
                        $_id = $producto['producto_id'];
                        $nombre = $producto['producto_nombre'];
                        $precio = $producto['producto_precio'];
                        $descuento = $producto['producto_descuento'];
                        $cantidad = $producto['cantidad'];
                        $precio_descuento = $precio - (($precio * $descuento) / 100);
                        $subtotal = $cantidad * $precio_descuento;
                        $total += $subtotal;

                        foreach($resultado as $row){
                          $categoria = $row['categoria_id'];
                          $imagen = "imagenes/productos/".$categoria.".jpeg";

                          

                        }
                        if(!file_exists($imagen)){
                            $imagen = "imagenes/no-photo.jpeg";
                          }

                        ?>
                <tr>
                    <td><?php echo $_id  ; ?></td>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo MONEDA . number_format($precio_descuento,2,'.',','); ?></td>
                    <td>
                        <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)"></td>
                    <td> 
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2,'.',','); ?></div>
                    </td>
                    <td>
                      <a href="#" id="eliminar" class="btn btn-danger btn-sm" data-bs-id="<?php echo $_id;?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">
                      <i class='bx bx-trash' style='color:#fffcfc' > Eliminar</i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
          <?php } ?>
            <tr>
              <td colspan="5"></td>
              <td colspan="3">
                <p id="total" class="h5"><?php echo MONEDA . number_format($total,2,'.',',');?></p>
              </td>
            </tr>
        </table>
      </div>
    </div>
  </div>
    <?php if($lista_carrito != null){?>
    <div class="row">
      <div class="col-md-3 offset-md-9 d-grid gap-2">
        <a href="pago.php" class="btn btn-primary btn-md"><i class='bx bx-money-withdraw' style='color:#fffcfc' > Pagar</i></a>
      </div>
    </div>
    <?php }?>
  </div>




<br><br>



<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Alerta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Esta seguro de eliminar el producto del carrito?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()"><i class='bx bx-trash' style='color:#fffcfc' > Eliminar</i></button>
      </div>
    </div>
  </div>
</div>





  <script>
      let eliminaModal = document.getElementById('eliminaModal')
      eliminaModal.addEventListener('show.bs.modal', function(event){
        let button = event.relatedTarget
        let id = button.getAttribute('data-bs-id')
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
        buttonElimina.value=id  

      })


      function actualizarCantidad(cantidad, id){
          let url = 'clases/actualizar_carrito.php'
          let formData =  new FormData()
          formData.append('action','agregar');
          formData.append('id',id)
          formData.append('cantidad',cantidad)

          fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
          }).then(response => response.json())
          .then(data => {
            if(data.ok){
              let divsubtotal = document.getElementById('subtotal_' + id)
              divsubtotal.innerHTML = data.sub

              let total = 0.00
              let list = document.getElementsByName('subtotal[]')

              for(let i = 0; i < list.length; i++){
                total +=parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
              }
              total = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2
              }).format(total)
              document.getElementById('total').innerHTML = '<?php echo MONEDA;?>' + total
            }
          })
      }

      function eliminar(){
        let botonElimina = document.getElementById('btn-elimina')
        let id = botonElimina.value


          let url = 'clases/actualizar_carrito.php'
          let formData =  new FormData()
          formData.append('action','eliminar');
          formData.append('id',id)

          fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
          }).then(response => response.json())
          .then(data => {
            if(data.ok){
              location.reload()

              
            }
          })
      }

     




      </script>
 <?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
  crossorigin="anonymous"></script>
  </body>
</html>