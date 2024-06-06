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