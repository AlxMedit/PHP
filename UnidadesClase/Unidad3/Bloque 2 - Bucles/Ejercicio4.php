<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de bucles 4
 * Mostrar paleta de colores en una tabla con enlaces a páginas que muestran el color seleccionado.
 */
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paleta de Colores en PHP</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        td {
            width: 100px;
            height: 100px;
            text-align: center;
            vertical-align: middle;
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: white;
        }

        a {
            text-decoration: none;
            color: white;
            display: block;
            height: 100%;
            width: 100%;
            text-align: center;
            line-height: 100px;
        }
    </style>
</head>

<body>

    <h1 style="text-align: center;">Paleta de Colores en PHP</h1>

    <table border="1">
        <?php
        $colsPerRow = 20;  // Número de columnas por fila
        $count = 0;

        for ($red = 0; $red <= 255; $red += 51) {
            for ($green = 0; $green <= 255; $green += 51) {
                for ($blue = 0; $blue <= 255; $blue += 51) {
                    // Inicio de una nueva fila cada vez que se alcancen $colsPerRow columnas
                    if ($count % $colsPerRow == 0) {
                        echo "<tr>";
                    }

                    // Convertir RGB a hexadecimal
                    $color = sprintf("%02x%02x%02x", $red, $green, $blue);

                    // Mostrar celda con color y enlace
                    echo "<td style='background-color: #$color;'>
                        <a href='paginadecolor.php?color=$color'>#$color</a>
                      </td>";

                    // Cerrar la fila cuando lleguemos al número de columnas por fila
                    if ($count % $colsPerRow == ($colsPerRow - 1)) {
                        echo "</tr>";
                    }

                    $count++;
                }
            }
        }

        // Cerrar la última fila si es necesario
        if ($count % $colsPerRow != 0) {
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>