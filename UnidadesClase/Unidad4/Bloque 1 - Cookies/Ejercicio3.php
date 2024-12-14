<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de cookies 3
 * Crear un formulario de login con recordatorio de usuario y contraseña.
 */

// Inicializar variables
$username = "";
$password = "";

// Gestionar las cookies
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remember'])) {
        setcookie('username', $_POST['username'], time() + (86400 * 30), "/"); // 30 días
        setcookie('password', $_POST['password'], time() + (86400 * 30), "/");
    } elseif (isset($_POST['delete'])) {
        setcookie('username', "", time() - 3600, "/");
        setcookie('password', "", time() - 3600, "/");
        $username = $password = "";
    }
}

// Recuperar datos de las cookies si existen
if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
}
if (isset($_COOKIE['password'])) {
    $password = $_COOKIE['password'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login con Recordatorio</title>
</head>
<body>
    <h1>Formulario de Login</h1>
    <form method="POST" action="">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required><br><br>

        <label>
            <input type="checkbox" name="remember"> Recordar mis datos
        </label><br><br>

        <button type="submit">Iniciar sesión</button>
        <button type="submit" name="delete">Borrar datos almacenados</button>
    </form>
</body>
</html>