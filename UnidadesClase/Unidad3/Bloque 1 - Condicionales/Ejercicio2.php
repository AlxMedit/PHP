<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de condicionales 2
 * Carga en variables mes y año e indica el número de días del mes. Utiliza la estructura de control switch
 */

$mes = 2;
$anio = 2025;
$dias = 0;

switch (true) {
    case ($mes == 1 || $mes == 3 || $mes == 5 || $mes == 7 || $mes == 8 || $mes == 10 || $mes == 12):
        $dias = 31;
        break;

    case ($mes == 4 || $mes == 6 || $mes == 9 || $mes == 11):
        $dias = 30;
        break;

    case ($mes == 2):
        $dias = ($anio % 4 == 0 && ($anio % 100 != 0 || $anio % 400 == 0)) ? 29 : 28;
        break;

    default:
        echo "Mes inválido.";
        exit;
}

echo "El mes $mes del año $anio tiene $dias días.";
?>
