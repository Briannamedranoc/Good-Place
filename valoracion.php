<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valoraciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'navbar.php';?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h2><i class='bx bx-star' style='color:#101010'> Danos tu calificacion</h2></i>
                    <p>Estaremos muy agradecidos si nos pones que experiencia tuviste con nuestro sitio web.</p>
                    <!---Iniciamos el formulario de valoracion-->
                    <form id="ratingForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Valoración (1-5)</label>
                        <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comentario</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                        <button type="submit" class="btn btn-warning btn-md"><i class='bx bxl-go-lang' style='color:#fdf9f9'> Registrar</i></button>
                    </form>
                <div id="response" class="mt-3"></div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#ratingForm').on('submit', function(event) {
                event.preventDefault();
                
                let name = $('#name').val();
                let rating = $('#rating').val();
                let comment = $('#comment').val();
                
                // Validar que los campos no estén vacíos
                if(name === '' || rating === '' || comment === '') {
                    $('#response').html('<div class="alert alert-danger">Todos los campos son obligatorios.</div>');
                    return;
                }

                $.ajax({
                    url: 'guardar_valoraciones.php',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        name: name,
                        rating: rating,
                        comment: comment
                    }),
                    success: function(response) {
                        $('#response').html('<div class="alert alert-success">!Tu Valoración enviada con éxito¡</div>');
                        $('#ratingForm')[0].reset();
                    },
                    error: function(error) {
                        $('#response').html('<div class="alert alert-danger">Hubo un error al enviar tu valoración. Inténtalo de nuevo.</div>');
                    }
                });
            });
        });
    </script>
    <br>
    <?php include 'footer.php';?>
</body>
</html>
