<?php
/**
 * 
 * @author Alex Abad
 * @Guiada Mostrar las imágenes subidas
 * 
 */

define("DIR_UPLOAD", "upload/");

// Comprobar si la carpeta existe
if (!is_dir(DIR_UPLOAD)) {
    die("La carpeta de subida no existe.");
}

// Leer el contenido de la carpeta
$archivos = array_diff(scandir(DIR_UPLOAD), array('..', '.'));

// Filtrar solo imágenes
$extensiones_aceptadas = array("gif", "jpg", "png", "jpeg");
$imagenes = array_filter($archivos, function ($archivo) use ($extensiones_aceptadas) {
    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    return in_array(strtolower($extension), $extensiones_aceptadas);
});
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Imágenes</title>
</head>

<body>
    <h1>Imágenes Subidas</h1>

    <?php
    if (count($imagenes) > 0) {
        echo '<div>';
        foreach ($imagenes as $imagen) {
            echo '<div style="margin-bottom: 20px;">';
            echo '<p>' . htmlspecialchars($imagen) . '</p>';
            echo '<img src="' . DIR_UPLOAD . $imagen . '" alt="Imagen subida" style="max-width: 300px; max-height: 300px; display: block;">';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No hay imágenes en la carpeta de subida.</p>';
    }
    ?>

    <br>
    <a href="index.php">Subir más archivos</a>
</body>

</html>
