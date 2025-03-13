<?php
include 'config/tests_cnf.php';

if (isset($_POST['generatest'])) {
    $numtest = ($_POST['testelegido']) - 1;
    echo '<form action="resolvertest.php" method="post">';

    foreach ($aTests[$numtest]["Preguntas"] as $id => $pregunta) {
        echo "<h2>" . $pregunta["Pregunta"] . "</h2>";
        $rutaimage = 'dir_img_test' . ($numtest + 1) . '/img' . ($id + 1) . '.jpg';

        if (file_exists($rutaimage)) {
            echo '<img src="' . $rutaimage . '"><br>';
        }
        echo '<input type="hidden" name="numtest" value="' . $numtest . '">';


        foreach ($pregunta["respuestas"] as $id => $respuesta) {
            if ($id == 0) {
                $valorrespuesta = "a";
            } elseif ($id == 1) {
                $valorrespuesta = "b";
            } elseif ($id == 2) {
                $valorrespuesta = "c";
            }
            echo '<input type="radio" name="respuesta' . $numtest . $pregunta['idPregunta'] . '" value="' . $valorrespuesta . '">' . $respuesta . '<br>';
        }
    }
    echo '<br><input type="submit" name="resolvertest" value="Comprobar el test">';
} else {
    header("Location: index.php");
}



?>