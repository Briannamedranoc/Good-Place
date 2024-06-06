<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AVAN6HnDuFlA5_oKOLMCewlC8hi0lEScFJQfqtz_Dvqi9Aghm6pcmX-gnlZ4ZzT0Vl-Y0_Qj-F56r3c-&currency=MXN"></script>

</head>
<body>
    <div id="paypal-button-container"></div>
    <script>paypal.Buttons({style:{
        color:'blue',
        shape:'pill',
        label:'pay'
        },
        createOrder: function(data,actions){
            return actions.order.create({
                purchase_units:[{
                    amount:{
                        value: 100  
                    }
                }]
            });
        },

        onApprove: function(data, actions){
            actions.order.capture().then(function (detalles){
                console.log(detalles);
                window.location.href="completado.php"
            });
        },

        onCancel:function(data){
            alert("Pago cancelado")
            console.log(data);
        }

    }).render('#paypal-button-container');</script>
    
</body>
</html>