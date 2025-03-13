<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de bucles 4
 * Menu
 */

// Array con los platos de primero, segundo y postre
$primeros = [
    ['nombre' => 'Ensalada César', 'foto' => 'ensalada.jpg', 'precio' => 8],
    ['nombre' => 'Sopa de Tomate', 'foto' => 'sopa.jpg', 'precio' => 6],
    ['nombre' => 'Crema de Calabaza', 'foto' => 'crema_calabaza.jpg', 'precio' => 7]
];

$segundos = [
    ['nombre' => 'Pollo Asado', 'foto' => 'pollo.jpg', 'precio' => 12],
    ['nombre' => 'Filete de Ternera', 'foto' => 'filete_ternera.jpg', 'precio' => 15],
    ['nombre' => 'Merluza a la Plancha', 'foto' => 'merluza.jpg', 'precio' => 14],
    ['nombre' => 'Paella Valenciana', 'foto' => 'paella.jpg', 'precio' => 18],
    ['nombre' => 'Tortilla de Patatas', 'foto' => 'tortilla.jpg', 'precio' => 10]
];

$postres = [
    ['nombre' => 'Tarta de Queso', 'foto' => 'tarta_queso.jpg', 'precio' => 5],
    ['nombre' => 'Flan Casero', 'foto' => 'flan.jpg', 'precio' => 4],
    ['nombre' => 'Helado', 'foto' => 'helado.jpg', 'precio' => 3]
];

// Mostrar todos los menús disponibles
echo "<h2>Menús disponibles</h2>";
foreach ($primeros as $primer) {
    foreach ($segundos as $segundo) {
        foreach ($postres as $postre) {
            // Calcular el precio total del menú con descuento del 20%
            $precioMenu = $primer['precio'] + $segundo['precio'] + $postre['precio'];
            $precioConDescuento = $precioMenu * 0.8;

            // Mostrar la información del menú
            echo "<div>";
            echo "<h3>Menú: {$primer['nombre']} - {$segundo['nombre']} - {$postre['nombre']}</h3>";
            echo "<p><strong>Precio Original:</strong> €{$precioMenu}</p>";
            echo "<p><strong>Precio con 20% de descuento:</strong> €" . number_format($precioConDescuento, 2) . "</p>";
            echo "<img src='{$primer['foto']}' alt='{$primer['nombre']}' style='width: 100px;'><br>";
            echo "<img src='{$segundo['foto']}' alt='{$segundo['nombre']}' style='width: 100px;'><br>";
            echo "<img src='{$postre['foto']}' alt='{$postre['nombre']}' style='width: 100px;'><br>";
            echo "</div><br>";
        }
    }
}
?>
