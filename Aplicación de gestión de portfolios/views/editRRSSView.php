<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Editar RRSS</title>
</head>


<body>
    <?php include 'include/header.php'; ?>

    <form action="/editarRRSS" method="POST" class="formLogin">
        <h1> Editar red social </h1>
        <?php
        if (isset($data['errorMessage'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $data['errorMessage'];
            echo "</div>";
        }

        ?>

        <label for="red_social">Red Social: </label>
        <input type="text" name="red_social" value="<?php echo $data['rrss']['red_social'] ?>">

        <label for="url">Enlace: </label>
        <input type="url" name="url" value="<?php echo $data['rrss']['url'] ?>">

        <input type="hidden" name="idRRSS" value="<?php echo $data['rrss']['id'] ?>">

        <input type="submit" value="Editar red social" name="confirmarEdit" class="botonInicioSesion mt-4">
    </form>
</body>

</html>