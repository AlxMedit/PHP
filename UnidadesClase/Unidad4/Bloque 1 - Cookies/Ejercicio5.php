<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de cookies 5
 * Crear un contador de visitas con cookies que muestre la fecha y hora de la última conexión
 */

// Nombre de la cookie
$cookie_name = "last_visit";

// Obtener la fecha y hora actual
$current_time = time();
$last_visit_message = "";

// Comprobar si la cookie ya existe
if (isset($_COOKIE[$cookie_name])) {
    $last_visit_time = (int)$_COOKIE[$cookie_name];
    $diff_seconds = $current_time - $last_visit_time;
    $years = floor($diff_seconds / (365 * 86400)); 
    $remaining = $diff_seconds % (365 * 86400);
    $months = floor($remaining / (30 * 86400)); 
    $remaining %= (30 * 86400);
    $days = floor($remaining / 86400); 
    $remaining %= 86400;
    $hours = floor($remaining / 3600); 
    $remaining %= 3600;
    $minutes = floor($remaining / 60); 
    $seconds = $remaining % 60;

    // Formatear la fecha de la última conexión
    $last_visit_date = date("d-m-Y H:i:s", $last_visit_time);
    $last_visit_message = "Tu última conexión fue el $last_visit_date, hace $years años, $months meses, $days días, $hours horas, $minutes minutos y $seconds segundos.";
} else {
    $last_visit_message = "Esta es tu primera visita.";
}

// Actualizar la cookie con la fecha y hora actuales
setcookie($cookie_name, $current_time, time() + (86400 * 30), "/"); // Cookie válida por 30 días
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>Bienvenido</h1>
    <p><?php echo $last_visit_message; ?></p>
</body>
</html>
