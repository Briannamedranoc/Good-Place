<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
    <title>Good Place</title>
</head>
<body>

  <header>
  <div class="navbar navbar-expand-lg navbar-ligth bg-ligth shadow-sm">
    <div class="container">
        <a href="#" class="navbar-brand">
          <img src="imagenes/res/logo2.png" width="25%" height="auto" alt="">
        <strong></strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
       data-bs-target="#navbarHeader" aria-controls="navbarHeader" 
       aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarHeader">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a href="index.php" class="nav-link active"><i class='bx bx-home' style='color:#000' ></i> Inicio</a>
        </li>
        <li class="nav-item">
        <a href="reservacion.php" class="nav-link active"><i class='bx bx-notepad'></i> Reservaciones</a>
        </li>
        <li class="nav-item">
            <a href="paquetes.php" class="nav-link active"><i class='bx bxs-package' ></i> Paquetes</a>
        <li class="nav-item">
            <a href="soporte.php" class="nav-link"><i class='bx bx-support'></i> Soporte</a>
        </li>
      </ul>
      <a href="checkout.php" class="btn btn-primary"><i class='bx bxs-shopping-bag' style='color:#fbf8f8'></i> <?php echo $num_cart;?>
      </a>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
  crossorigin="anonymous"></script>
    
</body>
</html>