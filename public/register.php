<?php
session_start();

#si no existe $_SESSION['users'], entonces creará la variable.
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

$errors = []; #Creamos una variable para los errores
$success = "";

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recogemos y sanitizamos los datos
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $experiencia = $_POST['experiencia'] ?? '';
    $especialidad = trim($_POST['especialidad'] ?? '');
    $provincia = $_POST['provincia'] ?? '';

    // Validaciones
    if (empty($username)) $errors['username'] = "El nombre de usuario es obligatorio.";
    if (empty($email)) {
        $errors['email'] = "El email es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "El email no tiene un formato válido.";
    }

    if (empty($password)) { # Si la linea está vacía mostramos el error
        $errors['password'] = "La contraseña es obligatoria.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "La contraseña debe tener mínimo 8 caracteres."; # Si la contraseña tiene menos de 8 caracteres mostramos el error
    }
    # Linea donde validamos la confirmación de la contraseña
    if (empty($confirm_password)) { # Si la linea está vacía mostramos el error 
        $errors['confirm_password'] = "Debe confirmar la contraseña.";
    } elseif ($password !== $confirm_password) { # Si las contraseñas no coinciden mostramos el error
        $errors['confirm_password'] = "Las contraseñas no coinciden.";
    }# Si todo es correcto no mostramos ningún error

    if (empty($experiencia)) $errors['experiencia'] = "Seleccione su nivel de experiencia.";
    if (empty($especialidad)) $errors['especialidad'] = "La especialidad es obligatoria.";
    if (empty($provincia)) $errors['provincia'] = "Seleccione una provincia.";

    # evitar duplicados en nombre de usuario
    if (empty($errors)){
        foreach ($_SESSION['users'] as $user){
            if ($user['username'] === $username) {
                $errors['username'] = "El nombre del usuario ya está en uso.";
                break;
            }

            if (strtolower ($user['email']) === strtolower($email)) { # ignorando las mayusculas y las minusculas, si ya hay un usuario con ese correo, ejecuta un error
                $errors['email']= "El email ya está registrado / en uso";
                break;
            }
        }
    }


    // Si no hay errores → guardamos el usuario
    if (empty($errors)) {
      # Almacenamiento temporal en array (sin BD aún)  
        $_SESSION['users'][] = [
            'username' => $username,
            'email' => $email,
            'password' => $password, // (Temporal, sin hash hasta BD)
            'experiencia' => $experiencia,
            'especialidad' => $especialidad,
            'provincia' => $provincia
        ];

        $success = "Registro completado con éxito";

        // Limpiamos valores del formulario
        $username = $email = $password = $confirm_password = $especialidad = $experiencia = $provincia = "";
        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../assets/css/style.css">


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