<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de condicionales 1
 * Almacena tres números en variables y escríbelos en pantalla de manera ordenada html
 */

 $num1 = 25;
 $num2 = 10;
 $num3 = 50;
 
 switch (true) {
     case ($num1 > $num2):
         $temp = $num1;
         $num1 = $num2;
         $num2 = $temp;
 }
 
 switch (true) {
     case ($num2 > $num3):
         $temp = $num2;
         $num2 = $num3;
         $num3 = $temp;
 }
 
 switch (true) {
     case ($num1 > $num2):
         $temp = $num1;
         $num1 = $num2;
         $num2 = $temp;
 }
 
 echo "Números ordenados: $num1, $num2, $num3";
 