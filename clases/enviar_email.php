<?php
use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'no-reply@himlaguna.com';                     //SMTP username
    $mail->Password = 'Kr1373lag$$';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port= 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@himlaguna.com','Reservaciones Good Place');
    $mail->addAddress('compras@himlaguna.com', ''); 

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Detalles de su compra';
    
    $cuerpo = '<h2>Su compra fue exitosa</h2>';
    $cuerpo .= '<p>El ID de su compra es: <b>'. $id_transaccion .'</b></p>';
    $cuerpo .= '<p>Fecha de compra: <b>'.$fecha_nueva. '</b></p>';
    $cuerpo .= '<p>Productos: <b>'.$row_prod['producto_nombre'].'</b></p>';
    $cuerpo .= '<p>Total de <b>$'.$total.'</b></p>';
    

    $mail->Body = utf8_decode($cuerpo);
    $mail->AltBody = 'Le enviamos los detalles de su compra.';

    $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
    
}
