<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
$sql = $con -> prepare("SELECT producto_id,producto_codigo,producto_nombre,producto_precio,categoria_id FROM productos WHERE producto_descuento=3");
$sql -> execute();
$resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
//session_destroy();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Good Place</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
</head>
<body>
  <?php include 'navbar.php';?>

<br>

<style class="text/css">
.moving-text {
  color:#008FFF;
  animation:fadeIn 2s ease-in-out forwards;
 
}

.moving-text h3{
  color:#000;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

</style>

<center>
<?php include 'js/flayer.php'; ?>
</center>

<div class="container">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <center>
        <h2>Atracciones más populares</h2><br>
      </center>
    </div>
    <div class="col-md-1"></div>
  </div>
    <div class="row">
      <div class="col-md-1"><img src="imagenes/habitaciones/1.jpg"  width="100%"></div>
      <div class="col-md-2">
        <b>Riviera Maya</b>
        <p>La mejor playa de mexico</p>
      </div>
      <div class="col-md-1"><img src="imagenes/habitaciones/2.jpg" width="100%"></div>
      <div class="col-md-2">
        <b>Cancun QuintanaRoo</b>
        <p>Hermosas vistas</p>
      </div>
      <div class="col-md-1"><img src="imagenes/habitaciones/3.jpg" width="100%"></div>
      <div class="col-md-2">
        <b>Mazatlan, Sinaloa</b>
        <p>Agarra la fiesta</p>
      </div>
      <div class="col-md-1"><img src="imagenes/habitaciones/4.jpg" width="100%"></div>
      <div class="col-md-2">
        <b>Playa del carmen</b>
        <p>Tomate las iguanas</p>
      </div>
  </div>
  <br>
  <div class="row">
      <div class="col-md-1"><img src="imagenes/habitaciones/5.jpg"  width="100%"></div>
      <div class="col-md-2">
        <b>Madrid</b>
        <p>Rumaba con toda</p>
      </div>
      <div class="col-md-1"><img src="imagenes/habitaciones/6.jpg" width="100%"></div>
      <div class="col-md-2">
        <b>Italia</b>
        <p>Una gran panoramica</p>
      </div>
      <div class="col-md-1"><img src="imagenes/habitaciones/7.jpg" width="100%"></div>
      <div class="col-md-2">
        <b>Grecia</b>
        <p>La gran rueda</p>
      </div>
      <div class="col-md-1"><img src="imagenes/habitaciones/8.jpg" width="100%"></div>
      <div class="col-md-2">
        <b>Allende</b>
        <p>Ven por todo</p>
      </div>
  </div>
</div>
<br><br>


<div class="margen">
<center>
  <div class="moving-text">
<img src="imagenes/emotes/Asunto 3.png" width="18%">
<h1><b>¡RESERVA CON LOS MEJORES PRECIOS!</b></h1>
<h3>Las mejores habitaciones donde quiera que vayas, Hasta el <b style="color:red;"><i>-40%</i></b> de descuento para socios frecuentes</h3>
</div>
<br><br>
  <?php include 'slider.php';?>
</center>

<br><br>
<div class="container"> 
 <div class="row">
      <div class="col-lg-3">
      <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="imagenes/cards/imagen1.jpg" alt="Imagen" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
        <h4><i class='bx bx-medal'></i>Resort</h4>
        <p>Trabajamos para ti, en la mejor experiencia para tu vida.</p>
        <p><a class="btn btn-dark" href="marcas.php">Mas info &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-3">
      <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="imagenes/cards/imagen2.jpg" alt="Imagen" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
        <h4><i class='bx bx-money' ></i>Fast</h4>
        <p>Somos el mejor aliado para tu bolsillo, con <b>12 meses</b> sin intereses.</p>
        <p><a class="btn btn-dark" href="financiamiento.php">Mas info &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-3">
      <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="imagenes/cards/imagen3.jpg" alt="Imagen" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
        <h4><i class='bx bx-send' ></i>Transporte</h4>
        <p>Para tu comodida, en la reserva de 2 habitaciones, paseo <b>Gratis.</b></p>
        <p><a class="btn btn-dark" href="envios.php">Mas info &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-3">
      <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="imagenes/cards/imagen4.jpg" alt="Imagen" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
      <h4><i class='bx bx-support' ></i>Promociones</h4>
        <p>Los mejor precios en nuestro bar, cortesia todos los dias.</p>
        <p><a class="btn btn-dark" href="mantenimiento.php">Mas info &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
</div>

<br><br>

<img src="imagenes/publicidad/imagen1.jpg" width="100%" alt="">

  
<br><br>

<?php
include 'footer.php';
?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
  crossorigin="anonymous"></script>
  <script src="js/flayer.js"></script>

  </body>
</html>