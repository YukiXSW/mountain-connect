<?php
session_start();

if (!isset($_SESSION['climbing'])) {
    $_SESSION['climbing'] = [];
}

$errors = [];
$success = "";
$uploadDir = __DIR__ . "/../../uploads/photos/";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $grado = $_POST["grado"] ?? "";
    $altura = trim($_POST["altura"] ?? "");
    $tipo = $_POST["tipo"] ?? "";
    $descripcion = trim($_POST["descripcion"] ?? "");
    $provincia = $_POST["provincia"] ?? "";

    if (empty($nombre)) $errors["nombre"] = "El nombre de la vía es obligatorio.";
    if (empty($grado)) $errors["grado"] = "Seleccione el grado de dificultad.";
    if (empty($altura) || !is_numeric($altura)) $errors["altura"] = "Ingrese una altura válida.";
    if (empty($tipo)) $errors["tipo"] = "Seleccione el tipo de vía.";
    if (empty($provincia)) $errors["provincia"] = "Seleccione una provincia.";
    if (empty($descripcion)) $errors["descripcion"] = "Agregue una descripción.";

    $fotos_guardadas = [];
    if (!empty($_FILES["fotos"]["name"][0])) {
        foreach ($_FILES["fotos"]["tmp_name"] as $key => $tmp_name) {
            $nombreArchivo = $_FILES["fotos"]["name"][$key];
            $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
            $tamañoArchivo = $_FILES["fotos"]["size"][$key];
            $nuevoNombre = uniqid("climb_") . "." . $ext;
            $destino = $uploadDir . $nuevoNombre;

            if (!in_array($ext, ["jpg", "jpeg", "png"])) {
                $errors["fotos"] = "Solo se permiten archivos JPG, JPEG o PNG.";
            } elseif ($tamañoArchivo > 2 * 1024 * 1024) {
                $errors["fotos"] = "El tamaño máximo permitido es 2 MB.";
            } elseif (empty($errors)) {
                move_uploaded_file($tmp_name, $destino);
                $fotos_guardadas[] = $nuevoNombre;
            }
        }
    }

    if (empty($errors)) {
        $_SESSION["climbing"][] = [
            "nombre" => $nombre,
            "grado" => $grado,
            "altura" => $altura,
            "tipo" => $tipo,
            "descripcion" => $descripcion,
            "provincia" => $provincia,
            "fotos" => $fotos_guardadas
        ];
        $success = "Vía de escalada registrada correctamente ✅";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registrar Vía de Escalada - MountainConnect</title>
        <link rel="stylesheet" href="../../assets/css/styleprincipal.css">
    </head>
    <body>
        <div class="route-form-container">
            <h2>Registrar Vía de Escalada</h2>

            <?php if ($success): ?>
                <p class="success"><?= $success ?></p>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <label>Nombre de la vía:</label>
                <input type="text" name="nombre" value="<?= $_POST['nombre'] ?? '' ?>">
                <div class="error"><?= $errors['nombre'] ?? '' ?></div>

                <label>Grado de dificultad:</label>
                <select name="grado">
                    <option value="">Seleccione...</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                    <option value="6a">6a</option>
                    <option value="6b">6b</option>
                    <option value="6c">6c</option>
                    <option value="7a">7a</option>
                    <option value="7b">7b</option>
                </select>
                <div class="error"><?= $errors['grado'] ?? '' ?></div>

                <label>Altura (metros):</label>
                <input type="text" name="altura" value="<?= $_POST['altura'] ?? '' ?>">
                <div class="error"><?= $errors['altura'] ?? '' ?></div>

                <label>Tipo de vía:</label>
                <select name="tipo">
                    <option value="">Seleccione...</option>
                    <option value="Deportiva">Deportiva</option>
                    <option value="Clásica">Clásica</option>
                    <option value="Boulder">Boulder</option>
                </select>
                <div class="error"><?= $errors['tipo'] ?? '' ?></div>

                <label>Provincia:</label>
                <select name="provincia">
                    <option value="">Seleccione...</option>
                    <option value="A Coruna">A Coruña</option>
                    <option value="Alava">Alava</option>
                    <option value="Albacete">Albacete</option>
                    <option value="Alicante">Alicante</option>
                    <option value="Almería">Almería</option>
                    <option value="Asturias">Asturias</option>
                    <option value="Avila">Avila</option>
                    <option value="Badajoz">Badajoz</option>
                    <option value="Barcelona">Barcelona</option> 
                    <option value="Burgos">Burgos</option>
                    <option value="Cáceres">Cáceres</option>
                    <option value="Cádiz">Cádiz</option>
                    <option value="Cantabria">Cantabria</option>
                    <option value="Castellón">Castellón</option>
                    <option value="Ceuta">Ceuta</option>
                    <option value="Ciudad Real">Ciudad Real</option>
                    <option value="Córdoba">Córdoba</option>
                    <option value="Cuenca">Cuenca</option>
                    <option value="Formentera">Formentera</option>
                    <option value="Girona">Girona</option>
                    <option value="Granada">Granada</option>
                    <option value="Guadalajara">Guadalajara</option>
                    <option value="Guipuzcoa">Guipuzcoa</option>
                    <option value="Huelva">Huelva</option>
                    <option value="Huesca">Huesca</option>
                    <option value="Ibiza">Ibiza</option>
                    <option value="Jaén">Jaén</option>
                    <option value="La Rioja">La Rioja</option>
                    <option value="León">León</option>
                    <option value="Lérida">Lérida</option>
                    <option value="Lugo">Lugo</option>
                    <option value="Madrid">Madrid</option>
                    <option value="Málaga">Málaga</option>
                    <option value="Mallorca">Mallorca</option>
                    <option value="Menorca">Menorca</option>
                    <option value="Murcia">Murcia</option>
                    <option value="Navarra">Navarra</option>
                    <option value="Orense">Orense</option>
                    <option value="Palencia">Palencia</option>
                    <option value="Pontevedra">Pontevedra</option>
                    <option value="Salamanca">Salamanca</option>           
                    <option value="Segovia">Segovia</option>
                    <option value="Sevilla">Sevilla</option>
                    <option value="Soria">Soria</option>
                    <option value="Tarragona">Tarragona</option>
                    <option value="Teruel">Teruel</option>
                    <option value="Toledo">Toledo</option>
                    <option value="Valencia">Valencia</option>
                    <option value="Valladolid">Valladolid</option>
                    <option value="Vizcaya">Vizcaya</option>
                    <option value="Zamora">Zamora</option>
                    <option value="Zaragoza">Zaragoza</option>                   
                </select>
                <div class="error"><?= $errors['provincia'] ?? '' ?></div>

                <label>Descripción:</label>
                <textarea name="descripcion"><?= $_POST['descripcion'] ?? '' ?></textarea>
                <div class="error"><?= $errors['descripcion'] ?? '' ?></div>

                <label>Subir fotografías:</label>
                <input type="file" name="fotos[]" multiple accept=".jpg, .jpeg, .png">
                <div class="error"><?= $errors['fotos'] ?? '' ?></div>

                <button type="submit">Guardar Vía</button>
            </form>
        </div>
    </body>
</html>
