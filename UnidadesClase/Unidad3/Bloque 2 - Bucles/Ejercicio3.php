<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de bucles 3
 * Tablas de multiplicar del 1 al 10 con estilos en filas/columnas.
 */

echo "<table border='1' style='border-collapse: collapse; text-align: center;'>";

// Cabecera de la tabla
echo "<tr><th></th>";
for ($i = 1; $i <= 10; $i++) {
    echo "<th style='background-color: #f2f2f2;'>$i</th>";
}
echo "</tr>";

// Filas de la tabla
for ($i = 1; $i <= 10; $i++) {
    echo "<tr>";
    echo "<th style='background-color: #f2f2f2;'>$i</th>"; // Primera columna
    for ($j = 1; $j <= 10; $j++) {
        $product = $i * $j;
        $style = ($i % 2 == 0) ? "background-color: #d9edf7;" : "background-color: #ffffff;";
        echo "<td style='$style'>$product</td>";
    }
    echo "</tr>";
}

echo "</table>";
