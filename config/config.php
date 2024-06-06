<?php

define("CLIENT_ID", "AVAN6HnDuFlA5_oKOLMCewlC8hi0lEScFJQfqtz_Dvqi9Aghm6pcmX-gnlZ4ZzT0Vl-Y0_Qj-F56r3c-");
define("CURRENCY", "MXN");
define ("KEY_TOKEN", "Bri1221$*");
define ("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart  = count($_SESSION['carrito']['productos']);

}

?>