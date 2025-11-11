<?php
session_start(); # Inicia la sesión PHP
# validación de sesion
if (!isset($_SESSION['user'])) { # si no existe la sesión de usuario
    header('Location: ../login.php'); # redirige a login
    exit; 
} # si existe, continúa al perfil
?>
