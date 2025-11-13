<?php
session_start();
$rutas = $_SESSION['climbing'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Listado de Vías - MountainConnect</title>
        <!-- Enlace a tu CSS -->
        <link rel="stylesheet" href="../../assets/css/styleprincipal.css">
    </head>
    <body>

        <div class="text-center">
            <h2 style="margin-top:20px;">Listado de Vías de Escalada 🧱</h2>

            <!-- Botón siempre visible -->
            <a href="create.php" class="btn btn-success mb-4">Registrar nueva vía</a>

            <?php if (empty($rutas)): ?>
                <p style="text-align:center;">Aún no se han registrado vías.</p>
            <?php else: ?>
                <div class="routes-list">
                    <?php foreach ($rutas as $via): ?>
                        <div class="route-card">
                            <?php if (!empty($via['fotos'])): ?>
                                <img src="../../uploads/photos/<?= htmlspecialchars($via['fotos'][0]) ?>" alt="Foto de <?= htmlspecialchars($via['nombre']) ?>">
                            <?php else: ?>
                                <img src="../../assets/img/no-image.png" alt="Sin foto">
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($via['nombre']) ?></h3>
                            <p><strong>Grado:</strong> <?= htmlspecialchars($via['grado']) ?></p>
                            <p><strong>Altura:</strong> <?= htmlspecialchars($via['altura']) ?> m</p>
                            <p><strong>Tipo:</strong> <?= htmlspecialchars($via['tipo']) ?></p>
                            <p><strong>Provincia:</strong> <?= htmlspecialchars($via['provincia']) ?></p>
                            <p><strong>Descripción:</strong> <?= htmlspecialchars($via['descripcion']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </body>
</html>
