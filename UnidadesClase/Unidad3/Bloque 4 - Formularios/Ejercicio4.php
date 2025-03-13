<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de formularios 4
 * Información de países
 */

$paises = [
    'España' => [
        'capital' => 'Madrid',
        'bandera' => 'espana.jpg'
    ],
    'Francia' => [
        'capital' => 'París',
        'bandera' => 'francia.jpg'
    ],
    'Italia' => [
        'capital' => 'Roma',
        'bandera' => 'italia.jpg'
    ],
    'Yugoslavia' => [
        'capital' => 'Belgrado',
        'bandera' => 'yugoslavia.jpg'
    ],
    'Macedonia' => [
        'capital' => 'Skopje',
        'bandera' => 'macedonia.jpg'
    ]
];

// Mostrar la información si se ha enviado el formulario
$capital = '';
$bandera = '';
if (isset($_POST['pais']) && array_key_exists($_POST['pais'], $paises)) {
    $paisSeleccionado = $_POST['pais'];
    $capital = $paises[$paisSeleccionado]['capital'];
    $bandera = $paises[$paisSeleccionado]['bandera'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Países</title>
</head>
<body>
    <h2>Selecciona un País</h2>
    <form action="" method="post">
        <label for="pais">Elige un país:</label>
        <select name="pais" id="pais">
            <?php
            foreach ($paises as $pais => $info) {
                echo "<option value='$pais'>$pais</option>";
            }
            ?>
        </select><br><br>
        <button type="submit" name="enviar">Mostrar Información</button>
    </form>

    <?php if ($capital && $bandera): ?>
        <h3>Información de <?= htmlspecialchars($paisSeleccionado) ?>:</h3>
        <p><strong>Capital:</strong> <?= htmlspecialchars($capital) ?></p>
        <p><strong>Bandera:</strong> <img src="images/<?= htmlspecialchars($bandera) ?>" alt="Bandera de <?= htmlspecialchars($paisSeleccionado) ?>" width="200"></p>
    <?php endif; ?>

</body>
</html>
