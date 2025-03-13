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
    include('include/header_view.php');
    ?>

    <h1>Videos sobre la educación víal</h1>

    <?php
    foreach ($videos as $video) {
        // Ya que Youtube rechaza la conexion del iframe, descomentando la variable de abajo puedes comprobar que coge bien las URL
        // var_dump($video); 
        echo "<iframe src=\"$video\" title=\"Titulo\"></iframe><br/>";
    }
    ?>

</body>

</html>