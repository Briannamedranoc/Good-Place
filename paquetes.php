<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Paquetes - Good Place</title>
</head>
<body>
<?php include 'navbar.php';?>
<style>
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


<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <br><br>
            <center>
                <h1>EL MEJOR FINANCIAMIENTO <b style="color:#009EFF;">FAMILIAR</b></h1>
                <img src="imagenes/emotes/b-asombro.PNG" width="10%" alt="">
                <br><br>
            </center>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <h3>Consulta el financiamieto</h3>
            <p>Ingresa los datos completos.</p>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="presupuesto">Presupuesto:</label>
                <input type="number" id="presupuesto" name="presupuesto" required><br><br>
                <label for="dias">Días de Estadía:</label>
                <input type="number" id="dias" name="dias" required><br><br>
                <input type="submit" class="btn btn-danger btn-sm" value="Calcular">
            </form>
            <br>
            <?php
            $tasaInteres = 1.40;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Validar los datos del formulario
                $presupuesto = $_POST['presupuesto'];
                $dias = $_POST['dias'];
                if (!empty($presupuesto) && !empty($dias)) {
                    // Calcular el costo total
                    $calculo = $presupuesto * $tasaInteres;
                    $calculo2 = $calculo / 12;
                    echo "La tasa de interes que manejamos es del <b>0.40%</b>, Los pagos serian a plazo de <b>12 meses</b>, y para los <b>" . $dias . " dias</b> en <b>$ " . $calculo2 . "</b>";
                } else {
                    echo "Por favor, completa todos los campos del formulario.";
                }
            }
            ?>
        </div>
        <div class="col-md-4">
            <h3>Requisitos para otorgar el credito</h3>
            <li>Credencial vigente (INE)</li>
            <li>Linea de credito activa (Buro de credito)</li>
            <li>Comprobante de vivienda</li>
            <li>Pagare firmado en blanco</li>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<br><br>


<?php include 'js/carrousel.php'; ?>
<?php include 'footer.php';?>
    
</body>
</html>