<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
//extraer todos los productos seleccionados en la seccion


$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){
        $sql = $con->prepare("SELECT producto_id,producto_nombre,producto_precio,producto_descuento, $cantidad as cantidad FROM productos WHERE producto_id=? AND producto_activo = 1");
        $sql->execute([$clave]);
        $lista_carrito[]=$sql->fetch(PDO::FETCH_ASSOC);
    }
}else{
  header ("Location: index.php");
  exit;
}
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
     
<header>
 <?php include 'navbar.php';?>
</header>

<main>
  <br><br>
<div class="container">
  <div class="row">
    <div class="col-6">
      <h1>Detalles del pago</h1>  
      <div id="paypal-button-container"></div>
    </div>
    <div class="col-6">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Total</th>
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
                        
                        
                        ?>
                <tr>
                    <td><?php echo $nombre; ?></td>
                    <td>
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2,'.',','); ?></div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>
            <tr>
              
              <td colspan="2">
                <p class="text-end" id="total">Total Neto: <?php echo MONEDA . number_format($total,2,'.',',');?></p>
              </td>
            </tr>
        </table>
    </div>
  </div>
</div>  
</div>
</main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
  crossorigin="anonymous"></script>

  <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>

  <script>
  
        paypal.Buttons({style:{
        color:'blue',
        shape:'pill',
        label:'pay'
        },
        createOrder: function(data,actions){
            return actions.order.create({
                purchase_units:[{
                    amount:{
                        value: <?php echo $total; ?>  
                    }
                }]
            });
        },

        onApprove: function(data, actions){
          let URL = 'clases/captura.php'
            actions.order.capture().then(function(detalles){
                console.log(detalles)
                let url = 'clases/captura.php'
                return fetch(url, {
                  method: 'post',
                  headers: {
                    'content-type': 'application/json'
                  },
                  body: JSON.stringify({
                    detalles: detalles
                  })
                }).then(function(response){
                  window.location.href = "completado.php?key=" + detalles['id'];
            })
                
            });
        },

        onCancel:function(data){
            alert("Pago cancelado")
            console.log(data)
        }

    }).render('#paypal-button-container')
    
    </script>

  </body>
</html>