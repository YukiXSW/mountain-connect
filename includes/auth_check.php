<?php 
# activar la sesión

function verificarSesion(){
    // Iniciar sesión si no está activa la sesion
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user'])) { # si no existe la sesión de usuario
        header('Location: ../login.php');# redirige a login
        exit();
    } # si existe, continúa al perfil
}

?>
