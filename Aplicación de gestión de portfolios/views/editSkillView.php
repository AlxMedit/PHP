<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Editar skill</title>
</head>


<body>
    <?php include 'include/header.php'; ?>

    <form action="/editarSkill" method="POST" class="formLogin">
        <h1> Editar habilidad </h1>
        <?php
        if (isset($data['errorMessage'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $data['errorMessage'];
            echo "</div>";
        }
        ?>
        <label for="habilidad">Habilidad: </label>
        <input type="text" name="habilidad" value="<?php echo $data['habilidad'] ?>">

        <label for="categoria">Categoria: </label>
        <select name="categoria">
            <?php
            foreach ($data['categorias'] as $categoria) {
                if ($categoria['categoria'] == $data['categoria']) {
                    echo "<option value='" . $categoria['categoria'] . "' selected>" . $categoria['categoria'] . "</option>";
                } else {
                    echo "<option value='" . $categoria['categoria'] . "'>" . $categoria['categoria'] . "</option>";
                }
            }
            ?>
        </select>
        <input type="hidden" name="id_skill" value="<?php echo $data['idSkill'] ?>">

        <input type="submit" value="Editar habilidad" name="editarHabilidad" class="botonInicioSesion mt-4">

</body>

</html>