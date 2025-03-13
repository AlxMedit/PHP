<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Añadir trabajo</title>
</head>

<body>
    <?php include 'include/header.php'; ?>
    <form action="/anadirTrabajo" method="POST" class="formLogin">
        <h1> Añadir trabajo </h1>
        <?php
        if (isset($data['errorMessage'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $data['errorMessage'];
            echo "</div>";
        }
        ?>
        <label for="titulo">Empresa: </label>
        <input type="text" name="titulo">

        <label for="descripcion">Descripción: </label>
        <input type="text" name="descripcion">

        <label for="fecha_inicio">Fecha de inicio: </label>
        <input type="date" name="fecha_inicio">

        <label for="fecha_final">Fecha de finalización: </label>
        <input type="date" name="fecha_final">

        <label for="logros">Logros: </label>
        <input type="text" name="logros">

        <input type="submit" value="Añadir trabajo" name="anadirTrabajo" class="botonInicioSesion mt-4">
    </form>

</body>

</html>