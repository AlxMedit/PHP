<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de bucles 2
 * Sumar los 3 primeros números pares.
 */

$sum = 0;
$contador = 0;
$i = 1;

while (true) {
    if ($i % 2 == 0) {
        $sum += $i;
        $contador++;
    }
    if ($contador == 3) {
        break;
    }
    $i++;
}

echo "La suma de los 3 primeros números pares es: $sum\n";
