<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de cookies 4
 * Crear un contador de visitas con cookies.
 */

// Nombre de la cookie
$cookie_name = "visit_count";

// Reiniciar el contador si se presiona el botón
if (isset($_POST['reset'])) {
    setcookie($cookie_name, "", time() - 3600, "/"); // Eliminar cookie
    $visit_count = 0;
} else {
    // Incrementar el contador de visitas
    if (isset($_COOKIE[$cookie_name])) {
        $visit_count = (int)$_COOKIE[$cookie_name] + 1;
    } else {
        $visit_count = 1;
    }
    setcookie($cookie_name, $visit_count, time() + (86400 * 30), "/"); // Guardar la cookie por 30 días
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Visitas</title>
</head>
<body>
    <h1>Bienvenido a la web</h1>
    <p>Has visitado esta página <strong><?php echo $visit_count; ?></strong> veces.</p>
    <form method="POST" action="">
        <button type="submit" name="reset">Reiniciar contador</button>
    </form>
</body>
</html>

