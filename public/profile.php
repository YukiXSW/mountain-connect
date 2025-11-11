<?php
include '../includes/auth_check.php';
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../assets/css/styleprofile.css">
        <title>Perfil - MountainConnect</title>
    </head>
    <body>
        <h2>Bienvenido, <?= htmlspecialchars($user['username']) ?> 👋</h2>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <button><p><a href="logout.php">Cerrar sesión</a></p></button> <!--Boton para cerrar sesion-->
        
    </body>
</html>
