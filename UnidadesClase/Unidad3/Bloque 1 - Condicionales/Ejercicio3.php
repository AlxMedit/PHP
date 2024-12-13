<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de condicionales 2
 * Carga fecha de nacimiento en variables y calcula la edad.
 */

 $anioNacimiento = 2001;
 $mesNacimiento = 8;
 $diaNacimiento = 18;
 
 $hoy = new DateTime();
 $anioActual = $hoy->format('Y');
 $mesActual = $hoy->format('m');
 $diaActual = $hoy->format('d');
 
 $edad = $anioActual - $anioNacimiento;
 
 switch (true) {
     case ($mesActual < $mesNacimiento):
     case ($mesActual == $mesNacimiento && $diaActual < $diaNacimiento):
         $edad--;
         break;
 }
 
 echo "Tienes $edad años.";
 ?>
 