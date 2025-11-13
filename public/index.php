<?php
session_start();
include '../includes/header.php';
?>

<div class="text-center">
    <h2 class="mb-4">Bienvenido a MountainConnect 🏔️</h2>

    <?php if (isset($_SESSION['user'])): ?>
        <!-- Si el usuario está logueado -->
        <p class="lead">
            ¡Hola, <strong><?php echo htmlspecialchars($_SESSION['user']['username']); ?></strong>!
            Nos alegra verte de nuevo. Explora nuevas rutas o comparte tus aventuras.
        </p>
        <!--Lo que ve el usuario ya logueado-->
        <div class="mt-4">
            <a href="routes/list.php" class="btn btn-primary me-2">Ver rutas</a>
            <a href="ferratas/list.php" class="btn btn-success me-2">Ver ferratas</a>
            <a href="climbing/list.php" class="btn btn-warning me-2">Ver vías de escalada</a>
            <a href="routes/create.php" class="btn btn-outline-light me-2">Crear ruta</a>
            <a href="profile.php" class="btn btn-secondary">Mi perfil</a>
        </div>
        <!--Usuario logueado (codigo de arriba)-->
    <?php else: ?>
        <!-- Si el usuario NO está logueado -->
        <p class="lead">
            Conecta con montañeros, descubre rutas, ferratas y vías de escalada.  
            Comparte tus experiencias y forma parte de la comunidad.
        </p>

        <div class="mt-4">
            <!-- Botones disponibles para TODOS -->
            <a href="routes/list.php" class="btn btn-primary me-2">Ver rutas</a>
            <a href="ferratas/list.php" class="btn btn-success me-2">Ver ferratas</a>
            <a href="climbing/list.php" class="btn btn-warning me-2">Ver vías de escalada</a>
        </div>

        <div class="mt-4">
            <!-- Solo si NO está logueado -->
            <a href="register.php" class="btn btn-outline-light me-2">Registrarse</a>
            <a href="login.php" class="btn btn-secondary">Iniciar sesión</a>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
