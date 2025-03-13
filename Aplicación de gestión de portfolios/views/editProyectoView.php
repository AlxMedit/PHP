<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Editar proyecto</title>
</head>

<body>
    <?php include 'include/header.php'; ?>

    <form action="/editarProyecto" method="POST" class="formLogin">
        <h1> Editar proyecto </h1>
        <?php
        if (isset($data['errorMessage'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $data['errorMessage'];
            echo "</div>";
        }
        ?>
        <label for="titulo">Título: </label>
        <input type="text" name="titulo" value="<?php echo $data['proyecto']['titulo'] ?>">
        <label for="descripcion">Descripción: </label>
        <input type="text" name="descripcion" value="<?php echo $data['proyecto']['descripcion'] ?>">
        <label for="tecnologias">Tecnologías: </label>
        <input type="text" name="tecnologias" value="<?php echo $data['proyecto']['tecnologias'] ?>">
        <input type="hidden" name="id_proyecto" value="<?php echo $data['proyecto']['id'] ?>">
        <input type="submit" value="Editar proyecto" name="confirmarEditar" class="botonInicioSesion mt-4">
    </form>

</body>

</html>