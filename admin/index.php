<?php
    require 'config/database.php';
    require 'clases/adminFunciones.php';
    $db = new Database();
    $con = $db->conectar();

    /*$password = password_hash('admin',PASSWORD_DEFAULT);
    $sql = "INSERT INTO admin (usuario, password, nombre, email, activo, fecha_alta)
    values ('admin','$password','Administrador', 'brianna@himlaguna.com','1',NOW())";
    $con->query($sql);*/
    
    $errors = [];

    if(!empty($_POST)){
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);

        if(esNulo([$usuario,$password])){
            $errors[] = "Debe llenar todos los campos";
        }

        if(count($errors) == 0){
           $errors[] = login($usuario,$password,$con);
        }

    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <style>
        i{
            font-size: 120px;
        }
    </style>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
            <center>
            <i class='bx bxs-user-circle' style='color:#0584f9'></i>
            </center>
          <h4 class="text-center">Iniciar sesión</h4>
        </div>
        <div class="card-body">
          <form action="index.php" method="post" autocomplete="off" >
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
            </div>
            <?php mostrarMensajes($errors);?>
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
