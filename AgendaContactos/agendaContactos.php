<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de agenda de contactos
 * Generas una agenda y puedes exportarla a PDF o TXT
 */

// Incluir el archivo para manejar sesiones y contactos
include_once('sessionHandler.php');
include_once('exporter.php');

// Verificar si hay errores al añadir un contacto
$error = "";
if (isset($_POST["enviar"])) {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $tfno = trim($_POST["tfno"]);

    // Validar y añadir el contacto
    $error = addContact($nombre, $email, $tfno);
}

// Obtener los contactos actuales de la sesión
$data = getContacts();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
</head>
<body>
    <h1>Agenda</h1>
    <h2>Nuevo Contacto</h2>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" id="nombre">
        Email: <input type="text" name="email" id="email">
        Teléfono: <input type="text" name="tfno" id="tfno">
        <input type="submit" value="Añadir Contacto" name="enviar">
        <input type="submit" value="Exportar a PDF" name="exportar_pdf">
        <input type="submit" value="Exportar a TXT" name="exportar_txt">
    </form>

    <h2>Lista de Contactos</h2>
    <?php
        foreach ($data as $clave => $valor) {
            echo $valor["nombre"] . " - " . $valor["email"] . " - " . $valor["tfno"];
            echo "<br/>";
        }
    ?>

    <br/>
    <a href="cierrasesion.php">Cerrar sesión</a>
</body>
</html>
