<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    $destino = 'cotizaciones@himlaguna.com';
    $nombre = $_POST["Nombre"];
    $email = $_POST["Email"];
    $telefono = $_POST["Telefono"];
    $mensaje = $_POST["Mensaje"];
    $header = "Ventas Web - Contacto\r\n ".$nombre;
    $contenido = "Nombre del cliente:\r".$nombre. "\nEmail:\r".$email."\nTelefono:\r".$telefono."\Mensaje:\r".$mensaje;
    @mail($destino, $header, $contenido);

    if($contenido){
        echo "<script>alert('El correo fue enviado')</script>";
    }else{
        echo "<script>alert('Correo no enviado')</script>";
    }


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include 'navbar.php'; ?>


<style type="text/css">
           
        	input[type="submit"]
            {
              width:100%;
              height:45px;
              background:#FF5506;
              font-size:15px;
              color: #fff;
              opacity:1;
              border-radius:50px;
              margin-bottom:0;
              border:0px;
              margin:0px 0px 0px;
              margin-bottom:10px;
              
              

            }
            input[type="submit"]:hover{
                opacity: 0.95;
                background:#EA9519;
                transition: 0.5s;
            }
        
        </style>
<br>
<div class="margen">    
<div class="container">
    <div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-4">
            <form method="POST">
                    <label for="exampleFormControlInput1" class="form-label">Nombre del cliente</label>
                    <input type="text" class="form-control" id="" placeholder="" name="Nombre">
                    <label for="exampleFormControlInput1" class="form-label">Correo electronico</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="Email">
                    <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="" name="Telefono">
                    <label for="exampleFormControlTextarea1" class="form-label">Informacion adicional</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="Mensaje"></textarea>
                    <br>
                <input type="submit" value="Enviar">
            </form>
        </div>
            <div class="col-md-3">
                <h5><b>Sucursal</b></h5>
                <p>Avenida bravo #5140 Oriente, Colonia nueva california, Torreon, Coahuila, Mexico.</p>
                <p>+52 (871) 298.58.15</p><br>
                <h5><b>Horario</b></h5>
                <p>Lunes a Viernes de 08:00am - 18:00pm</p>
                <p>Sabado de 09:00am - 14:00pm</p>
            </div>
            <div class="col-md-3">
            <h5><b>Telefono</b></h5>
                        <p>+52 (871) 462.93.93</p>
                        <p>+52 (871) 298.58.15</p>
                        <p>+52 (871) 485.29.03</p>
                        <br>
                      <h5><b>Correos</b></h5>
                        <p>cotizaciones@himlaguna.com</p>
                        <p>compras@himlaguna.com</p>
                    </div>
                </div>
            </div>
        </main>
    
        </div>


<?php include 'footer.php'; ?>
</body>
</html>