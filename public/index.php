<?php include '../includes/header.php'; ?>

<div class="text-center">
    <h2 class="mb-4">Bienvenido a MountainConnect 🏞️</h2>

    <?php if (isset($_SESSION['usuario'])): ?>
        <p class="lead">
            ¡Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario']['username']); ?></strong>!
            Nos alegra verte de nuevo. Explora nuevas rutas o comparte tus aventuras.
        </p>

        <div class="mt-4">
            <a href="routes/list.php" class="btn btn-primary me-2">Ver rutas</a>
            <a href="routes/create.php" class="btn btn-success me-2">Crear ruta</a>
            <a href="profile.php" class="btn btn-secondary">Mi perfil</a>
        </div>

    <?php else: ?>
        <p class="lead">
            Conecta con montañeros, descubre rutas y comparte tus experiencias.
        </p>

        <div class="mt-4">
            <a href="register.php" class="btn btn-success me-2">Crear cuenta</a>
            <a href="login.php" class="btn btn-primary">Iniciar sesión</a>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
