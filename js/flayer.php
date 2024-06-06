<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Flyer Interactivo con Bootstrap y jQuery</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<style>
    .flyer {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 9999;
}

.hidden {
  display: none;
}

</style>

<div id="flyer" class="flyer">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Promoción Especial</h5>
            <p class="card-text">¡Solo por hoy!<br> En reservacion de habitacion mayor a <b>$ 3,000.00</b>, Le obsequiamos una botella de vino.</p>
            <button id="closeFlyer" class="btn btn-danger">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>
