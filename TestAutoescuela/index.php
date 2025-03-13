<?php
/**
 * 
 * @author Alejandro Vaquero Abad
 * @date 04/11/2023
 * @activity Evaluable 1
 * 
 */
include 'config/tests_cnf.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alejandro Vaquero Abad</title>
</head>

<body>
    <h1>Actividad test conducir</h1>

    <form action="generartest.php" method="post">
        <label for="SeleccionarTest">Selecciona el test que quieres resolver: </label>
        <select name="testelegido">
            <?php
            foreach ($aTests as $test) {
                echo '<option value=' . $test["idTest"] . '>' . $test["Permiso"] . ' Categoría: ' . $test["Categoria"] . ' Examen ' . $test["idTest"] . '</option>';
            }
            ?>
        </select><br><br>
        <input type="submit" name="generatest" value="Realizar test">
    </form>

</body>

</html>