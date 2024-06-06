$(document).ready(function(){
    $('#update-stock-form').on('submit', function(event){
        event.preventDefault(); // Evitar el envío tradicional del formulario

        $.ajax({
            url: '../reservaciones/obtener_habitaciones.php', // Cambia a update_stock_process.php para manejar la lógica del lado del servidor
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Stock actualizado correctamente.');
                } else {
                    alert(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Hubo un error al actualizar el stock: ' + textStatus);
            }
        });
    });
});