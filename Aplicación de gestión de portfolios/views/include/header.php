<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Inicio</title>
</head>

<body>
    <div class="contentIndex sticky-top">
        <a href="/"><img src="../../img/logo.png"></img></a>
        <?php
        if ($_SESSION['perfil'] == 'usuario') {
            ?>
            <li class="nav-item dropdown list-unstyled">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="../../img/<?php echo $_SESSION['usuarioActivo']['foto']; ?>" alt="Usuario"
                        class="rounded-circle" width="75" height="75">
                    <?php echo $_SESSION['usuarioActivo']['nombre']; ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/cuenta/<?php echo $_SESSION['usuarioActivo']['id']?>">Mi cuenta</a></li>
                    <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                </ul>
            </li>


            <?php
        } else {
            echo "<div class='logReg my-auto'><a href='/login' class='btn btn-basic'>Iniciar sesión</a>  <a href='/signup' class='btn btn-basic''>Registrarse</a></div>";
        }
        ?>
    </div>

</body>

</html>