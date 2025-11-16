<?php
session_start();

// Validación de credenciales contra array temporal
$users_registered = $_SESSION['users'] ?? [];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # recoger los datos de usuario y contraseña
    $login_input = trim($_POST['login'] ?? '');
    $password_input = trim($_POST['password'] ?? '');

    $authenticated = false; # En principio la autenticación aun no está ok

    foreach ($users_registered as $user) {
        $user_login_match = ($user['username'] === $login_input) || strtolower($user['email']) === strtolower($login_input); # comprueba datos de usuario o correo correctos

        if($user_login_match && $user['password'] === $password_input) { # $user['password'] === $password_input comprobamos que el usuario escriba la misma contraseña q el registro
            $_SESSION['user'] = $user; # Creación de sesión de usuario
            $user_found = true; # si encuentra el usuario, accede a profile.php
            header('Location: profile.php');
            exit;
        }
    }
    if (!$authenticated){ # si falla muestra el siguiente mensaje
        $error = 'Error: Usuario/contraseña incorrectos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../assets/css/styleprincipal.css">
        <title>Login - MountainConnect</title>
    </head>
    <body>
        <h2>Iniciar sesión</h2>

        <?php if ($error): ?>
            <p style="color:red;"><?= $error ?></p> <!--si hay algun error muestra el mensaje en color rojo -->
        <?php endif; ?>
        <!-- Formulario de login -->
         <div class="profile-card">
            <form method="POST" action="">
                <label>Usuario o Email:</label><br>
                <input type="text" name="login" required><br><br>

                <label>Contraseña:</label><br>
                <input type="password" name="password" required><br><br>

                <button type="submit">Entrar</button>
            </form>
        </div>
    </body>
</html>
