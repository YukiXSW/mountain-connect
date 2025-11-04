<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro - MountainConnect</title>
    </head>
    <body>

    <h2>Registro de Usuario</h2>

    

    <form action="" method="POST">

        <label>Nombre de usuario:</label><br>
        <input type="text" name="username" value="<?= $username ?? '' ?>">
        <span style="color:red;"><?= $errors['username'] ?? '' ?></span><br><br>

        <label>Email:</label><br>
        <input type="text" name="email" value="<?= $email ?? '' ?>">
        <span style="color:red;"><?= $errors['email'] ?? '' ?></span><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password">
        <span style="color:red;"><?= $errors['password'] ?? '' ?></span><br><br>

        <label>Confirmar contraseña:</label><br>
        <input type="password" name="confirm_password">
        <span style="color:red;"><?= $errors['confirm_password'] ?? '' ?></span><br><br>

        <label>Nivel de experiencia:</label><br>
        <select name="experiencia">
            <option value="">Seleccione...</option>
            <option value="Principiante" <?= (isset($experiencia) && $experiencia === "Principiante") ? "selected" : "" ?>>Principiante</option>
            <option value="Intermedio" <?= (isset($experiencia) && $experiencia === "Intermedio") ? "selected" : "" ?>>Intermedio</option>
            <option value="Avanzado" <?= (isset($experiencia) && $experiencia === "Avanzado") ? "selected" : "" ?>>Avanzado</option>
        </select>
        <span style="color:red;"><?= $errors['experiencia'] ?? '' ?></span><br><br>

        <label>Especialidad:</label><br>
        <input type="text" name="especialidad" value="<?= $especialidad ?? '' ?>">
        <span style="color:red;"><?= $errors['especialidad'] ?? '' ?></span><br><br>

        <label>Provincia:</label><br>
        <select name="provincia">
            <option value="">Seleccione...</option>
            <option value="Madrid" <?= (isset($provincia) && $provincia === "Madrid") ? "selected" : "" ?>>Madrid</option>
            <option value="Barcelona" <?= (isset($provincia) && $provincia === "Barcelona") ? "selected" : "" ?>>Barcelona</option>
            <option value="Valencia" <?= (isset($provincia) && $provincia === "Valencia") ? "selected" : "" ?>>Valencia</option>
        </select>
        <span style="color:red;"><?= $errors['provincia'] ?? '' ?></span><br><br>

        <button type="submit">Registrarse</button>
    </form>

    </body>
</html>