<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$id_transaccion = isset($_GET['key']) ? $_GET['key'] : '0';

$error = '';
if($id_transaccion == ''){
$error = 'Error al procesar la peticion';
}else{
    $sql = $con -> prepare("SELECT count(id) FROM compra WHERE id_transaccion=? AND estatus=?");
        $sql -> execute([$id_transaccion,'COMPLETED']);
        if($sql -> fetchColumn() > 0){
            $sql = $con -> prepare("SELECT id,fecha,email,total FROM compra WHERE id_transaccion=? AND estatus=? LIMIT 1");
            $sql -> execute([$id_transaccion,'COMPLETED']);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
        
            $idCompra=$row['id'];
            $total=$row['total'];
            $fecha=$row['fecha'];

            $sqlDet = $con->prepare("SELECT nombre,precio,cantidad FROM detalle_compra WHERE id_compra=?");
            $sqlDet->execute([$idCompra]);
            
        }else{
            $error = 'Error al comprobar la compra';
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
  <body>
     
<?php include 'navbar.php';?>
<br><br>

<style class="text/css">
  .movimiento {
  color:#000;
    animation: fadeIn 2s ease-in-out forwards;
    
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.container .h1{
  margin:20px;
}
</style>


<main>
<div class="container">
  <?php if(strlen($error) > 0 ){ ?>
    <div class="row">
      <div class="col">
        <h3><?php echo $error;?></h3>
      </div>
    </div>
  <?php } else {?>
    <div class="row">
      <div class="col">
        <div class="movimiento">
        <center>
        <img src="imagenes/emotes/IMG_2791.jpg" width="15%" alt=""><br><br>
        <img src="imagenes/logos/exito.jpeg" width="5%"alt="" >
        </center>
        <h1 style="text-align:center;">¡Felicidades!</h1>
        <h3 style="text-align:center;"> Su compra ha sido exitosa</h3>
        <p style="text-align:center;">En algunos momentos recibira un correo con los siguientes datos</p>
        <h4><b>Detalles</b></h4>
        <b>Folio de la compra: </b><?php echo $id_transaccion; ?><br>
        <b>Fecha y hora de compra: </b><?php echo $fecha; ?><br>
        <b>El total de su compra es: </b><?php echo MONEDA . number_format($total,2,'.',','); ?><br><br>
    

        <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2>Selecciona tu fecha de llegada</h2>
          <form id="fechaForm">
                <input type="hidden" name="id_compra" value="<?php echo $idCompra; ?>"> <!-- Asumiendo que id_compra se pasa como parámetro -->
                <div class="form-group">
                <label for="fecha_llegada">Fecha de Llegada</label>
                <input type="date" class="form-control" id="fecha_llegada" name="fecha_llegada" required>
                </div><br>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
              <div id="mensaje" class="mt-3"></div>
            </div>
        <div class="col-md-8"></div>
      </div>
    </div>

    <div class="row">
      <div class="col">
          <table class="table">
            <thead>
              <tr>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>Importe</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)) {
                $importe = $row_det['precio'] * $row_det['cantidad']; ?>
                <tr>
                  <td><?php echo $row_det['cantidad'];?></td>
                  <td><?php echo $row_det['nombre'];?></td>
                  <td>$<?php echo $row_det['precio'];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div></div>
      <?php } ?>
    </div>
  </main>
  <br><br>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-2">
          <a href="valoracion.php"><button class="btn btn-warning btn-md"><i class='bx bxs-bookmark-plus' style='color:#fffbfb'> Calificanos</a></i></button>
        </div>
        <div class="col-md-2">
          <a href="index.php"><button type="button" class="btn btn-primary btn-md"><i class='bx bx-arrow-back'> Regresarme</i></button></a><br><br>
        </div>
        <div class="col-md-2">
          <a href="fpdf/PruebaV.php?id_transaccion=<?php echo $id_transaccion;?>" target="_blank"><button type="button" class="btn btn-danger btn-md"><i class='bx bxs-file-pdf' style='color:#fdfbfb;'> Genera PDF</i></a></button>
        </div> 
      </div>
    </div>
<br><br><br><br><br><br>
<?php include 'footer.php'; ?>
<script>
        $(document).ready(function(){
            $('#fechaForm').submit(function(event) {
                event.preventDefault(); // Evitar el envío estándar del formulario

                var formData = $(this).serialize(); // Serializar los datos del formulario

                $.ajax({
                    url: 'fecha.php', // Archivo PHP para manejar la solicitud
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        var mensaje = '';
                        if (response.status === 'success') {
                            mensaje = '<div class="alert alert-success" role="alert">Fechas guardadas correctamente. Tu fecha de salida es ' + response.fecha_salida + '.</div>';
                        } else {
                            mensaje = '<div class="alert alert-danger" role="alert">Error: ' + response.message + '</div>';
                        }
                        $('#mensaje').html(mensaje);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var mensaje = '<div class="alert alert-danger" role="alert">Error al guardar las fechas: ' + textStatus + '</div>';
                        $('#mensaje').html(mensaje);
                    }
                });
            });
        });
    </script>

</body>
</html>