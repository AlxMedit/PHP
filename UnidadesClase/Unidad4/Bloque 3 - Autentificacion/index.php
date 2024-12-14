<?php
session_start();

require_once 'config/aUsuarios.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($usuarios[$username]) && $usuarios[$username]['password'] === $password) {
        $_SESSION['usuario'] = $username;
        $_SESSION['rol'] = $usuarios[$username]['rol'];
        $_SESSION['inicio_sesion'] = date('Y-m-d H:i:s');
    } else {
        echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvenido a gestión de usuarios</h1>
    <?php
    if (isset($_SESSION['usuario'])) {
        echo "<p>Hola, <strong>" . htmlspecialchars($_SESSION['usuario']) . "</strong></p>";
        echo "<p>Inicio de sesión: " . $_SESSION['inicio_sesion'] . "</p>";
        echo '<form method="POST" action="">
            <button type="submit" name="logout">Cerrar sesión</button>
          </form>';
    } else {
        include 'lib/login.php';
    }
    ?>

    <nav>
        <h3>Menú</h3>
        <ul>
            <li><a href="public.php">Pagina pública</a></li>
            <?php
            if (isset($_SESSION['usuario'])) {
                echo '<li><a href="private.php">Página privada</a></li>';
                if ($_SESSION['rol'] === 'admin') {
                    echo '<li><a href="panel_control.php">Panel de control</a></li>';
                }
                echo '<li><a href="cerrarSesion.php">Cerrar sesión</a></li>';
            }
            ?>
        </ul>
    </nav>
</body>

</html>
