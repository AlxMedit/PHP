<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de formularios 5
 * Suma de números
 */

// Inicializar el resultado
$resultado = 0;

// Procesar el formulario cuando se envía
if (isset($_POST['sumar'])) {
    // Obtener la cantidad de números a sumar
    $cantidad = $_POST['cantidad'];

    // Sumar los números ingresados
    for ($i = 1; $i <= $cantidad; $i++) {
        if (isset($_POST["numero$i"])) {
            $resultado += $_POST["numero$i"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Números</title>
</head>

<body>
    <h2>Suma de Números</h2>
    
    <!-- Formulario para ingresar la cantidad de números a sumar -->
    <?php
    if (!isset($_POST['cantidad']) || isset($_POST['sumar'])) {
    ?>
        <form action="" method="post">
            <label for="cantidad">¿Cuántos números quieres sumar?</label>
            <input type="number" id="cantidad" name="cantidad" min="1" required><br><br>
            <button type="submit">Siguiente</button>
        </form>
    <?php
    }
    ?>

    <!-- Formulario para ingresar los números a sumar -->
    <?php
    if (isset($_POST['cantidad']) && !isset($_POST['sumar'])) {
    ?>
        <h3>Introduce los números:</h3>
        <form action="" method="post">
            <?php
            $cantidad = $_POST['cantidad'];
            for ($i = 1; $i <= $cantidad; $i++) {
                echo "<label for='numero$i'>Número $i:</label>";
                echo "<input type='number' id='numero$i' name='numero$i' required><br><br>";
            }
            ?>
            <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
            <button type="submit" name="sumar">Sumar</button>
        </form>
    <?php
    }
    ?>

    <!-- Mostrar el resultado -->
    <?php
    if (isset($_POST['sumar'])) {
    ?>
        <h3>El resultado de la suma es: <?php echo $resultado; ?></h3>
    <?php
    }
    ?>

</body>
</html>