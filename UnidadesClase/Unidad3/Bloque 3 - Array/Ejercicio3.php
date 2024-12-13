<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de bucles 3
 * Elección aleatoria de un alumno y mostrar su nombre y fotografía.
 */

$alumnos = [
    [
        'nombre' => 'Jesus Frías',
        'foto' => 'frias.jpg'
    ],
    [
        'nombre' => 'Xexu',
        'foto' => 'xexu.jpg'
    ],
    [
        'nombre' => 'Alex Abad',
        'foto' => 'alex.jpg'
    ]
];

// Selección aleatoria de un alumno
$alumnoSeleccionado = $alumnos[array_rand($alumnos)];

// Mostrar el nombre y la fotografía del alumno seleccionado
echo "Nombre: " . $alumnoSeleccionado['nombre'] . "<br>";
echo "<img src='" . $alumnoSeleccionado['foto'] . "' alt='" . $alumnoSeleccionado['nombre'] . "'>";
?>