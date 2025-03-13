<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de condicionales 2
 * Carga fecha de nacimiento en variables y calcula la edad.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>footer {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #333;
    color: #fff;
    text-align: right;
    padding: 10px;
}

footer img {
    float: right; 
}</style>
    <title>Document</title>
    <style>
        <?php
        $month = date('n');
        $day = date('d');
        $hour = date('G');
        switch($hour){
            case 1:
                $color = '#00FF00';
                break;
            case 2:
                $color = '#0000FF';
                break;
            case 3:
                $color = '#FFFF00';
                break;
            case 4:
                $color = '#FFC0CB';
                break;
            case 5:
                $color = '#800080';
                break;
            case 6:
                $color = '#FFA500';
                break;
            case 7:
                $color = '#808080';
                break;
            case 8:
                $color = '#00FFFF';
                break;
            case 9:
                $color = '#FF00FF';
                break;
            case 10:
                $color = '#A52A2A';
                break;
            case 11:
                $color = '#808000';
                break;
            case 12:
                $color = '#40E0D0';
                break;
            case 13:
                $color = '#C0C0C0';
                break;
            case 14:
                $color = '#FFD700';
                break;
            case 15:
                $color = '#00FF00';
                break;
            case 16:
                $color = '#87CEEB';
                break;
            case 17:
                $color = '#228B22';
                break;
            case 18:
                $color = '#000080';
                break;
            case 19:
                $color = '#FFFF00';
                break;
            case 20:
                $color = '#E6E6FA';
                break;
            case 21:
                $color = '#FF0000';
                break;
            case 22:
                $color = '#D2691E';
                break;
            case 23:
                $color = '#0000CD';
                break;
            case 00:
                $color = '#008000';
                break;
        }
        
        echo "header {
            background-color: $color;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }";
        ?>
       
        img {
            max-width: 100px;
            height: auto; 
        }

        
        .titulo {
            font-size: 24px;
        }
    </style>
</head>
<body>
    <header>
        <?php
        switch(8){
            case 4:
            case 5:
                $season = "PRIMAVERA";
                break;
            case 7:
            case 8:
                $season = "VERANO";
                break;
            case 10:
            case 11:
                $season = "OTOÑO";
                break;
            case 1:
            case 2:
                $season = "INVIERNO";
                break;
            case 3:
                $season = "INVIERNO";
                if ($day >= 20) {
                    $season = "PRIMAVERA";
                }
                break;
            case 6:
                $season = "PRIMAVERA";
                if ($day >= 21) {
                    $season = "VERANO";
                }
                break;
            case 9:
                $season = "VERANO";
                if ($day >= 23) {
                    $season = "OTOÑO";
                }
                break;
            case 12:
                $season = "OTOÑO";
                if ($day >= 21) {
                    $season = "INVIERNO";
                }
                break;
        }
        $image = $season . '.jpg';
        echo '<img src="'.$image.'">';
        echo '<div class="titulo"> ESTACIÓN: ' . $season . '</div>';
        echo '<img src="'.$image.'">';
        ?>
    </header>
</body>
</html>