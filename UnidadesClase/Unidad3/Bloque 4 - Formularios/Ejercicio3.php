<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de formularios 3
 * Formulario para crear un currículum
 */
if (isset($_POST['enviar'])) {
    // Variables para recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $sexo = $_POST['sexo'];
    $terminos = isset($_POST['terminos']) ? "Aceptado" : "No Aceptado";
    $estudios = $_POST['estudios'];
    $habilidades = isset($_POST['habilidades']) ? implode(", ", $_POST['habilidades']) : "Ninguna habilidad seleccionada";

    // Mostrar los datos recibidos
    echo "<h3>Resumen del Currículum</h3>";
    echo "Nombre Completo: " . htmlspecialchars($nombre) . "<br>";
    echo "Correo Electrónico: " . htmlspecialchars($email) . "<br>";
    echo "Teléfono: " . htmlspecialchars($telefono) . "<br>";
    echo "Sexo: " . htmlspecialchars($sexo) . "<br>";
    echo "Nivel de Estudios: " . htmlspecialchars($estudios) . "<br>";
    echo "Habilidades: " . htmlspecialchars($habilidades) . "<br>";
    echo "Términos: " . $terminos . "<br>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Currículum</title>
</head>
<body>
    <h2>Formulario para Crear un Currículum</h2>
    <form action="" method="post">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required><br><br>

        <fieldset>
            <legend>Sexo:</legend>
            <input type="radio" id="masculino" name="sexo" value="Masculino" required>
            <label for="masculino">Masculino</label><br>
            <input type="radio" id="femenino" name="sexo" value="Femenino" required>
            <label for="femenino">Femenino</label><br>
            <input type="radio" id="otro" name="sexo" value="Otro" required>
            <label for="otro">Otro</label>
        </fieldset><br>
        
        <label for="estudios">Nivel de Estudios:</label>
        <select id="estudios" name="estudios" required>
            <option value="secundario">Secundario</option>
            <option value="universitario">Universitario</option>
            <option value="postgrado">Postgrado</option>
            <option value="ninguno">Ninguno</option>
        </select><br><br>
        
        <label for="habilidades">Habilidades:</label><br>
        <select id="habilidades" name="habilidades[]" multiple size="5">
            <option value="programacion">Programación</option>
            <option value="gestion_de_proyectos">Gestión de Proyectos</option>
            <option value="diseno_grafico">Diseño Gráfico</option>
            <option value="marketing_digital">Marketing Digital</option>
            <option value="idiomas">Idiomas</option>
        </select><br><br>
        
        <label for="terminos">
            <input type="checkbox" id="terminos" name="terminos" required>
            Acepto los términos y condiciones
        </label><br><br>

        <button type="submit" name="enviar">Enviar</button>
        <button type="reset">Reiniciar</button>
    </form>
</body>
</html>
