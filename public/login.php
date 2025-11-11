<?php
session_start();

// Validación de credenciales contra array temporal
$usuarios = [
    ['username' => 'lili', 'email' => 'lili@gmail.com', 'password' => '12345678'],
    ['username' => 'ale', 'email' => 'ale@gmail.com', 'password' => 'abcdefgh']
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    foreach ($usuarios as $user) {
        if (($user['username'] === $login || $user['email'] === $login) && $user['password'] === $password) {
            $_SESSION['user'] = $user; # Creación de sesión de usuario
            header('Location: profile.php');
            exit;
        }
    }
    $error = 'Credenciales incorrectas. Intenta de nuevo.';
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../assets/css/stylelogin.css">
        <title>Login - MountainConnect</title>
    </head>
    <body>
        <h2>Iniciar sesión</h2>

        <?php if ($error): ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
        <!-- Formulario de login -->
        <form method="POST" action="">
            <label>Usuario o Email:</label><br>
            <input type="text" name="login" required><br><br>

            <label>Contraseña:</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit">Entrar</button>
        </form>
    </body>
</html>
