<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Función para cerrar sesión
function cerrarSesion() {
    // Destruir todas las variables de sesión
    $_SESSION = array();

    // Si se desea destruir la cookie de sesión, se debe establecer una fecha de expiración pasada
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    // Finalmente, destruir la sesión
    session_destroy();

    // Redirigir al usuario a la página de inicio de sesión
    header('Location: ../index.php');
    exit;
}

// Verificar si se ha enviado una solicitud para cerrar sesión
if (isset($_GET['logout'])) {
    cerrarSesion();
}
?>
