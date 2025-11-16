<?php
// includes/header.php

//funcion para ver si el usuario esta logueado.
function usuario_logueado(){
    
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    return isset($_SESSION['user']);
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>MountainConnect</title>
        <link rel="stylesheet" href="../assets/css/styleprincipal.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>

    <body>

    <header class="p-3">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="h3 mb-0">🏔️ MountainConnect</h1>

            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../public/index.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="../public/routes/list.php">Rutas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="../public/profile.php">Perfil</a>
                    </li>

                    <?php if (usuario_logueado()): ?> <!--Si el usuario esta logueado aparecerá las siguientes opciones-->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../public/logout.php">Cerrar sesión</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link text-warning">
                                👤 <?php echo htmlspecialchars($_SESSION['user']['username']); ?>
                            </span>
                        </li>
                    <?php else: ?>
                        <!-- Cuando NO hay usuario logueado solo aparecera las siguientes opciones -->
                        <li class="nav-item">
                            <a href="../public/login.php" class="btn btn-outline-light btn-sm me-2">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a href="../public/register.php" class="btn btn-success btn-sm">Registrarse</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mt-4">
