<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Añadir skill</title>
</head>

<body>
    <?php include 'include/header.php'; ?>
    <form action="/addSkill" method="POST" class="formLogin">
        <h1> Añadir habilidad </h1>
        <?php
        if (isset($data['errorMessage'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $data['errorMessage'];
            echo "</div>";
        }
        ?>
        <label for="habilidades">Habilidad: </label>
        <input type="text" name="habilidades">

        <label for="categorias_skills_categoria">Categoria: </label>
        <select name="categorias_skills_categoria">
            <?php
            foreach ($data['categorias'] as $categoria) {
                echo "<option value='" . $categoria['categoria'] . "'>" . $categoria['categoria'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Añadir habilidad" name="anadirHabilidad" class="botonInicioSesion mt-4">
    </form>

</body>

</html>