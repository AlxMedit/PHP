<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de bucles 5
 * Mostrar un calendario mensual con el día actual en verde y festivos en rojo.
 */

// Establecer la zona horaria
date_default_timezone_set('Europe/Madrid');

// Incluir el archivo de configuración de festivos
include('config.php');

// Configurar el mes y año
$mes = 2; // Mes especificado
$año = 2027; // Año especificado

// Crear una fecha para el primer día del mes
$fecha = new DateTime("$año-$mes-01");
$primerDia = $fecha->format('w'); // Día de la semana del primer día del mes (0=domingo)
$diasDelMes = cal_days_in_month(CAL_GREGORIAN, $mes, $año); // Total de días en el mes

// Ajustar el día para que lunes sea el primer día (0=Lun, 6=Dom)
$primerDia = ($primerDia + 6) % 7; // Cambiar para que 0=lunes, 6=domingo

// Obtener la fecha actual
$hoy = date('Y-m-d');

// Generar el calendario
echo "<table border='1' style='border-collapse:collapse;'>";
echo "<tr><th colspan='7'>" . $fecha->format('F Y') . "</th></tr>";
echo "<tr>
        <th>Lun</th>
        <th>Mar</th>
        <th>Mié</th>
        <th>Jue</th>
        <th>Vie</th>
        <th>Sáb</th>
        <th>Dom</th>
      </tr><tr>";

// Rellenar los días vacíos antes del primer día del mes
for ($i = 0; $i < $primerDia; $i++) {
    echo "<td></td>";
}

// Mostrar los días del mes
for ($dia = 1; $dia <= $diasDelMes; $dia++) {
    $fechaDia = "$año-" . str_pad($mes, 2, '0', STR_PAD_LEFT) . "-" . str_pad($dia, 2, '0', STR_PAD_LEFT);
    
    // Verificar si es hoy
    if ($fechaDia === $hoy) {
        echo "<td style='background-color: green; color: white;'><strong>$dia</strong></td>";
    } 
    // Verificar si es festivo
    elseif (in_array($fechaDia, $festivos)) {
        echo "<td style='background-color: red; color: white;'><strong>$dia</strong></td>";
    } 
    // Días normales
    else {
        echo "<td>$dia</td>";
    }
    
    // Saltar a la nueva línea después de cada semana
    if (($dia + $primerDia) % 7 == 0) {
        echo "</tr><tr>";
    }
}

// Cerrar la última fila si es necesario
if (($diasDelMes + $primerDia) % 7 != 0) {
    echo str_repeat("<td></td>", 7 - ($diasDelMes + $primerDia) % 7);
}

echo "</tr>";
echo "</table>";
?>
