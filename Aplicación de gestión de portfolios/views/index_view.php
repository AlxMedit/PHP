<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Inicio</title>
</head>

<body>
    <?php include 'include/header.php'; ?>
    <?php
    if (isset($_SESSION['data'])) {
        echo "<div class='alert alert-success' role='alert'>";
        echo $_SESSION['data'];
        unset($_SESSION['data']);
        echo "</div>";
    }
    ?>

    <!-- CAMBIALO -->
    <div class="mt-4">
        <form method="post" action="/" class="d-flex justify-content-center">
            <label for="user" class="my-auto me-3">Usuario: </label>
            <input type="text" class="form-control w-25 me-3" name="valorUsuario">
            <input type="submit" class="btn btn-dark" value="Enviar" name="buscarUsuario">
        </form>
    </div>


    <div class="contenidoUsuarios mt-5">
        <?php
        if (gettype($data['usuariosAll']) != 'array' || count($data['usuariosAll']) == 0) {
            echo "<h2>No se han encontrado usuarios</h2>";
        } else { // PONER TRES CARDS EN CADA FILA
            echo "<div class='container'>";
            echo "<div class='row'>";
            $counter = 0;

            foreach ($data['usuariosAll'] as $usuario) {
                if ($usuario['visible'] == 1) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='card h-100'>"; // Clase para asegurar altura completa
                    echo "<img class=\"card-img-top\" src=\"/img/$usuario[foto]\" alt=\"Card image\">";
                    echo "<div class=\"card-body d-flex flex-column\">"; // Flexbox para alineación
                    echo "<h4 class=\"card-title\">" . $usuario['nombre'] . " " . $usuario['apellidos'] . "</h4>";
                    echo "<p class=\"card-text clamp-text\">" . $usuario['categoria_profesional'] . "</p>"; // Clase especial para el recorte
                    echo "<p class=\"card-text clamp-text flex-grow-1\">" . $usuario['resumen_perfil'] . "</p>"; // Clase con recorte dinámico
                    echo "<a href='http://portfolio.local/cuenta/" . $usuario['id'] . "' class='mt-auto'><button class='btn btn-dark'>Ver perfil</button></a>"; // Botón abajo
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";


                    $counter++;
                    if ($counter % 3 == 0) {
                        echo "</div>";
                        echo "<div class='row mt-4'>";
                    }
                }
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>