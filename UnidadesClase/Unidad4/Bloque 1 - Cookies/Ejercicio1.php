<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de cookies 1
 * Crear un script que permita crear, comprobar y eliminar una cookie
 */


// Nombre de la cookie
$cookie_name = "user_cookie";
// Duración de la cookie en segundos
$cookie_duration = 60; // 1 minuto

// Gestión de acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        // Crear la cookie
        setcookie($cookie_name, "active", time() + $cookie_duration, "/");
        $message = "Cookie creada con éxito.";
    } elseif (isset($_POST['check'])) {
        // Comprobar si la cookie existe
        if (isset($_COOKIE[$cookie_name])) {
            $message = "La cookie está activa.";
        } else {
            $message = "La cookie no existe o ha expirado.";
        }
    } elseif (isset($_POST['delete'])) {
        // Eliminar la cookie
        setcookie($cookie_name, "", time() - 3600, "/");
        $message = "Cookie eliminada con éxito.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Cookies en PHP</title>
</head>
<body>
    <h1>Gestor de Cookies</h1>
    <p>
        <?php echo $message ?? "No hay acciones realizadas."; ?>
    </p>
    <form method="POST" action="">
        <button name="create">Crear Cookie</button>
        <button name="check">Comprobar Cookie</button>
        <button name="delete">Eliminar Cookie</button>
    </form>
</body>
</html>


<?php 