<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Registrarse</title>
</head>

<body class="bodyColores">
    <?php include 'include/header.php';
    if (isset($data['errorMessage'])) {
        echo "<div class='alert alert-danger' role='alert'>";
        echo $data['errorMessage'];
        echo "</div>";
    }
    ?>
    <form action="/signup" method="POST" class="formLogin">
        <h1> Registrate </h1>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre">

        <label for="apellidos">Apellido: </label>
        <input type="text" name="apellidos">

        <label for="email">Correo electrónico: </label>
        <input type="text" name="email">

        <label for="password">Contraseña: </label>
        <input type="password" name="password">

        <label for="categoriaProfesional">Categoría profesional: </label>
        <select name="categoriaProfesional" id="categoriaProfesional">
            <option value="Desarrollador">Desarrollador</option>
            <option value="Diseñador">Diseñador</option>
            <option value="Administrador">Administrador</option>
            <option value="Estudiante">Estudiante</option>
        </select>

        <label for="resumenPerfil">Resumen del perfil: </label>
        <textarea name="resumenPerfil" id="resumenPerfil" cols="30" rows="10"></textarea>

        <input type="submit" value="Registrarse" name="registrarse" class="botonInicioSesion">
        <a href="/login" class="registro">¿Estás registrado? Inicia sesión</a>
    </form>

</body>

</html>