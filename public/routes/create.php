<?php
session_start();

// Inicializa el array de rutas si no existe
if (!isset($_SESSION['rutas'])) {
    $_SESSION['rutas'] = [];
}

$errors = [];
$success = "";

// Ruta de subida de fotos
$uploadDir = __DIR__ . "/../../uploads/photos/";

// Cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $dificultad = $_POST["dificultad"] ?? "";
    $distancia = trim($_POST["distancia"] ?? "");
    $desnivel = trim($_POST["desnivel"] ?? "");
    $duracion = trim($_POST["duracion"] ?? "");
    $provincia = $_POST["provincia"] ?? "";
    $epoca = $_POST["epoca"] ?? [];
    $descripcion = trim($_POST["descripcion"] ?? "");
    $nivel_tecnico = $_POST["nivel_tecnico"] ?? "";
    $nivel_fisico = $_POST["nivel_fisico"] ?? "";

    // validación completa de todos los campos
    if (empty($nombre)) $errors["nombre"] = "El nombre de la ruta es obligatorio.";
    if (empty($dificultad)) $errors["dificultad"] = "Seleccione una dificultad.";
    if (empty($distancia) || !is_numeric($distancia)) $errors["distancia"] = "Ingrese una distancia válida.";
    if (empty($desnivel) || !is_numeric($desnivel)) $errors["desnivel"] = "Ingrese un desnivel válido.";
    if (empty($duracion) || !is_numeric($duracion)) $errors["duracion"] = "Ingrese una duración válida.";
    if (empty($provincia)) $errors["provincia"] = "Seleccione una provincia.";
    if (empty($epoca)) $errors["epoca"] = "Seleccione al menos una época recomendada.";
    if (empty($descripcion)) $errors["descripcion"] = "Agregue una descripción.";
    if (empty($nivel_tecnico)) $errors["nivel_tecnico"] = "Seleccione nivel técnico.";
    if (empty($nivel_fisico)) $errors["nivel_fisico"] = "Seleccione nivel físico.";

    $fotos_guardadas = []; #Imagenes guardadas en un array

    // Procesar fotos si se subieron
    if (!empty($_FILES["fotos"]["name"][0])) { #comprueba que al menos hay una imagen
        foreach ($_FILES["fotos"]["tmp_name"] as $key => $tmp_name) { # recorre las imagenes
            $nombreArchivo = $_FILES["fotos"]["name"][$key]; # nombre del archivo
            $tipoArchivo = $_FILES["fotos"]["type"][$key]; # el tipo png, jpg , jpeg
            $tamañoArchivo = $_FILES["fotos"]["size"][$key]; # el tamaño de la imagen

            $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION)); #ext es la variable extension
            $nuevoNombre = uniqid("ruta_") . "." . $ext; 
            $destino = $uploadDir . $nuevoNombre; # extensión para convertirla en minusculas

            // Validaciones de tipo y tamaño
            if (!in_array($ext, ["jpg", "jpeg", "png"])) { # si en el array no hay jpg, jpeg o png
                $errors["fotos"] = "Solo se permiten archivos JPG, JPEG o PNG.";# saltara un error 
            } elseif ($tamañoArchivo > 2 * 1024 * 1024) { # si el tamaño es superior a 2MB
                $errors["fotos"] = "El tamaño máximo permitido es 2 MB.";# saltara error
            } elseif (empty($errors)) {# si no hay errores
                move_uploaded_file($tmp_name, $destino);#mueve archivo temporal a la que tiene que estar
                $fotos_guardadas[] = $nuevoNombre;# guarda el archivo con el nombre
            } 
        }
    }

    // Si no hay errores, guardamos la ruta
    if (empty($errors)) { # si el formulario entero esta bien rellenado, guarda todos los datos ingresados
        $_SESSION['rutas'][] = [
            "nombre" => $nombre,
            "dificultad" => $dificultad,
            "distancia" => $distancia,
            "desnivel" => $desnivel,
            "duracion" => $duracion,
            "provincia" => $provincia,
            "epoca" => implode(", ", $epoca),
            "descripcion" => $descripcion,
            "nivel_tecnico" => $nivel_tecnico,
            "nivel_fisico" => $nivel_fisico,
            "fotos" => $fotos_guardadas
        ];

        $success = "Ruta registrada correctamente ✅";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Crear Ruta - MountainConnect</title>
        <link rel="stylesheet" href="../../assets/css/styleprincipal.css">
    </head>
    <body>

        <div class="route-form-container">
        <h2>Crear Nueva Ruta</h2>

        <?php if ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <label>Nombre de la ruta:</label>
                <input type="text" name="nombre" value="<?= $_POST['nombre'] ?? '' ?>">
                <div class="error"><?= $errors['nombre'] ?? '' ?></div>

                <label>Dificultad:</label>
                <select name="dificultad">
                    <option value="">Seleccione...</option>
                    <option value="fácil">Fácil</option>
                    <option value="moderada">Moderada</option>
                    <option value="difícil">Difícil</option>
                    <option value="muy difícil">Muy Difícil</option>
                </select>
                <div class="error"><?= $errors['dificultad'] ?? '' ?></div>

                <label>Distancia (km):</label>
                <input type="text" name="distancia" value="<?= $_POST['distancia'] ?? '' ?>">
                <div class="error"><?= $errors['distancia'] ?? '' ?></div>

                <label>Desnivel positivo (m):</label>
                <input type="text" name="desnivel" value="<?= $_POST['desnivel'] ?? '' ?>">
                <div class="error"><?= $errors['desnivel'] ?? '' ?></div>

                <label>Duración estimada (horas):</label>
                <input type="text" name="duracion" value="<?= $_POST['duracion'] ?? '' ?>">
                <div class="error"><?= $errors['duracion'] ?? '' ?></div>

                <label>Provincia:</label>
                <select name="provincia">
                    <option value="">Seleccione...</option>
                    <option value="Madrid">Madrid</option>
                    <option value="Barcelona">Barcelona</option>
                    <option value="Valencia">Valencia</option>
                    <option value="Granada">Granada</option>
                </select>
                <div class="error"><?= $errors['provincia'] ?? '' ?></div>

                <label>Época recomendada:</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="epoca[]" value="Primavera">Primavera</label>
                    <label><input type="checkbox" name="epoca[]" value="Verano">Verano</label>
                    <label><input type="checkbox" name="epoca[]" value="Otoño">Otoño</label>
                    <label><input type="checkbox" name="epoca[]" value="Invierno">Invierno</label>
                </div>
                <div class="error"><?= $errors['epoca'] ?? '' ?></div>

                <label>Descripción:</label>
                <textarea name="descripcion"><?= $_POST['descripcion'] ?? '' ?></textarea>
                <div class="error"><?= $errors['descripcion'] ?? '' ?></div>

                <label>Nivel técnico (1–5):</label>
                <input type="number" name="nivel_tecnico" min="1" max="5" value="<?= $_POST['nivel_tecnico'] ?? '' ?>">
                <div class="error"><?= $errors['nivel_tecnico'] ?? '' ?></div>

                <label>Nivel físico (1–5):</label>
                <input type="number" name="nivel_fisico" min="1" max="5" value="<?= $_POST['nivel_fisico'] ?? '' ?>">
                <div class="error"><?= $errors['nivel_fisico'] ?? '' ?></div>

                <label>Subir fotografías:</label>
                <input type="file" name="fotos[]" multiple accept=".jpg, .jpeg, .png">
                <div class="error"><?= $errors['fotos'] ?? '' ?></div>

                <button type="submit">Guardar Ruta</button>
            </form>
        </div>

    </body>
</html>
