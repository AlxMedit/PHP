<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de cookies 2
 * Crear un script que permita detectar si el navegador soporta cookies
 */
// Nombre de la cookie de prueba
$test_cookie_name = "test_cookie";
$test_cookie_value = "test";
$cookie_supported = false;

// Intentar crear la cookie si no se ha creado antes
if (!isset($_COOKIE[$test_cookie_name])) {
    setcookie($test_cookie_name, $test_cookie_value, time() + 60, "/");
    header("Refresh:0"); // Recargar la página para comprobar si se establece la cookie
} else {
    // Si la cookie ya existe, el navegador soporta cookies
    if ($_COOKIE[$test_cookie_name] === $test_cookie_value) {
        $cookie_supported = true;
        // Eliminar la cookie de prueba
        setcookie($test_cookie_name, "", time() - 3600, "/");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detección de Cookies con PHP</title>
</head>
<body>
    <h1>¿El navegador permite crear cookies?</h1>
    <p>
        <?php
        if ($cookie_supported) {
            echo "El navegador permite crear cookies.";
        } else {
            echo "Estamos comprobando si el navegador permite crear cookies...";
        }
        ?>
    </p>
</body>
</html>
