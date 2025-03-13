<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de bucles 2
 * Crear un array con las actividades de condicionales y bucles,
 * y redirigir a la carpeta seleccionada por el usuario.
 */

// Array con las actividades y su redirección a las carpetas
$actividades = [
    "Actividades de condicionales" => "Bloque 1 - Condicionales",
    "Actividades de bucles" => "Bloque 2 - Bucles"
];

// Verificar si se ha recibido la opción de actividad
if (isset($_GET['actividad']) && array_key_exists($_GET['actividad'], $actividades)) {
    // Obtener la actividad seleccionada
    $actividad_seleccionada = $_GET['actividad'];
    $directorio = $actividades[$actividad_seleccionada];
    
    // Redirigir a la carpeta correspondiente
    header("Location: ../$directorio"); // Redirigir a la carpeta superior y luego la carpeta indicada
    exit; // Detener el script después de la redirección
} else {
    // Mostrar opciones para elegir
    echo "<h3>Selecciona una actividad:</h3>";
    echo "<ul>";
    foreach ($actividades as $actividad => $directorio) {
        echo "<li><a href=\"?actividad=" . urlencode($actividad) . "\">$actividad</a></li>";
    }
    echo "</ul>";
}
?>
