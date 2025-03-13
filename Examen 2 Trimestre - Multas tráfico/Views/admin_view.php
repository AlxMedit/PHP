<?php

$videos = ['https://www.youtube.com/watch?v=GRR8QT2Bpz4', 'https://www.youtube.com/watch?v=XyHdFT1OQr4', 'https://www.youtube.com/watch?v=_CJ_7dFShQE'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <?php
    $conductores = $data['conductores'];
    $sanciones = $data['sanciones'];
    include('include/header_view.php');

    ?>
    <h1> Listado de conductores </h1>
    <table>
    <tr>
        <td style="padding: 0 20px">Usuario</td>
        <td style="padding: 0 20px">Cantidad de Sanciones</td>
        <td style="padding: 0 20px">Puntos restantes</td>
    </tr>
    <?php
    foreach ($conductores as $conductor) {
        echo '<tr>';
        echo '<td style="padding: 0 20px">' . $conductor['usuario'] . '</td>';
        echo '<td style="padding: 0 20px">' . $data['sanciones'][$conductor['id']][0]['cantidad'] . '</td>';
        echo '<td style="padding: 0 20px">' . "No me da tiempo". '</td>';
        echo '</tr>';
    }
    ?>
    </table>

</body>

</html>