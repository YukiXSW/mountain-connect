<?php
session_start();
$rutas = $_SESSION['rutas'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Rutas - MountainConnect</title>
  <link rel="stylesheet" href="../../assets/css/styleprincipal.css">
</head>
<body>

<h2 style="text-align:center; margin-top:20px;">Listado de Rutas</h2>

<?php if (empty($rutas)): ?>
  <p style="text-align:center;">Aún no se han registrado rutas.</p>
<?php else: ?>
  <div class="routes-list">
    <?php foreach ($rutas as $ruta): ?>
      <div class="route-card">
        <?php if (!empty($ruta['fotos'])): ?>
          <img src="../../uploads/photos/<?= htmlspecialchars($ruta['fotos'][0]) ?>" alt="Foto de <?= htmlspecialchars($ruta['nombre']) ?>">
        <?php else: ?>
          <img src="../../assets/images/no-photo.jpg" alt="Sin foto">
        <?php endif; ?>
        <h3><?= htmlspecialchars($ruta['nombre']) ?></h3>
        <p><strong>Dificultad:</strong> <?= htmlspecialchars($ruta['dificultad']) ?></p>
        <p><strong>Distancia:</strong> <?= htmlspecialchars($ruta['distancia']) ?> km</p>
        <p><strong>Provincia:</strong> <?= htmlspecialchars($ruta['provincia']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
  
<?php endif; ?>

</body>
</html>
