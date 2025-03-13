<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Añadir proyecto</title>
</head>

<body>
    <?php include 'include/header.php'; ?>
    <form action="/anadirProyecto" method="post" class="formLogin">
        <h1> Añadir proyecto </h1>
        <?php
        if (isset($data['errorMessage'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $data['errorMessage'];
            echo "</div>";
        }
        ?>
        <label for="titulo">Titulo: </label>
        <input type="text" name="titulo">
        <label for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion">
        <label for="tecnologias">Tecnologias: </label>
        <input type="text" name="tecnologias">
        <input type="hidden" name="usuarios_id" value="<?php echo $_SESSION['usuarioActivo']['id'] ?>">

        <input type="submit" name="anadirProyecto" value="Añadir proyecto" class="botonInicioSesion mt-4">
    </form>


</body>

</html>