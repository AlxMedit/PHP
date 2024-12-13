<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de condicionales 2
 * 5. Script que muestre una lista de enlaces en función del perfil de usuario:
 * Perfil Administrador: Pagina1, Pagina2, Pagina3, Pagina4
 * Perfil Usuario: Pagina1, Pagina2
 */

$perfil = "Usuario";

switch ($perfil) {
    case "Administrador":
        echo "<ul><li><a href=#>Pagina1</a></li><li><a href=#>Pagina2</a></li><li><a href=#>Pagina3</a></li><li><a href=#>Pagina4</a></li></ul>";
        break;
    case "Usuario":
        echo "<ul><li><a href=#>Pagina1</a></li><li><a href=#>Pagina2</a></li></ul>";
        break;
    default:
        echo "Perfil no válido.";
        break;
}
