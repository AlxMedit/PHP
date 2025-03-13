<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Iniciar sesión</title>
</head>

<body class="bodyColores">
    <?php include 'include/header.php';
    if (isset($data['errorMessage'])) {
        echo "<div class='alert alert-danger' role='alert'>";
        echo $data['errorMessage'];
        echo "</div>";
    }
    ?>

    <form action="/login" method="POST" class="formLogin">
        <h1 class="fw-bold"> Inicia sesión </h1>
        <label for="email">Correo electrónico: </label>
        <input type="email" name="email" class="form-control">

        <label for="password">Contraseña: </label>
        <input type="password" name="password" class="form-control">

        <input type="submit" value="Iniciar sesión" name="iniciarSesion" class="botonInicioSesion mt-3">
        <p class="text-center">¿No estás registrado? <a href="/signup" class="registro">Registrate</a></p>
    </form>

</body>

</html>