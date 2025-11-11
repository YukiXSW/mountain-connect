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
        <div class="profile-card">
            <img src="../assets/images/xiao.jpg" alt="Avatar" class="avatar">
            <h2>Bienvenido, <?= htmlspecialchars($user['username']) ?> 👋</h2>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <button class="logout-btn"><a href="logout.php">Cerrar sesión</a></button>
        </div>
    </body>
</html>
