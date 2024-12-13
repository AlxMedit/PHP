<?php
/**
 * 
 * @author Alejandro Vaquero Abad
 * @actividad Verbos irregulares
 * @evaluable pr1ud3
 * 
 */

include("config/verbos.php");
$indexVerbos = [];
$solicitarniveles = isset($_POST['solicitartest']);
$resolvernivel = isset($_POST['resolvernivel']);
$inputs = [];

if ($solicitarniveles) {
    $cantidadverbos = $_POST['cantidadverbos'];
    $niveldificultad = $_POST['niveldificultad'];
}

if (isset($_POST['resolvernivel'])){
    for ($auxIndexVerbos = 0; $auxIndexVerbos < 208; $auxIndexVerbos++){
        for ($aiv = 0; $aiv <= 3; $aiv++){
            $input = 'input' . $auxIndexVerbos . $aiv;
            if (isset($_POST[$input])){
                $inputs[$input] = $_POST[$input];
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alejandro Vaquero Abad</title>
</head>

<body>
    <!-- Generamos el fomulario -->
    <h1> Actividad verbos irregulares</h1>
    <form action="" method="post">
        <label for="cantidadverbos">¿Cuántos verbos quieres adivinar? </label>
        <input type="number" name="cantidadverbos" value="<?php echo $cantidadverbos ?>"><br>
        <label for="niveldificultad">¿Qué nivel de dificultad quieres? </label>
        <select name="niveldificultad" value="<?php echo $niveldificultad ?>">
            <option value=1>1</option>
            <option value=2 selected>2</option>
            <option value=3>3</option>
        </select><br><br>
        <input type="submit" name="solicitartest" value="Generar test"><br><br>
    </form>
    <!-- Generamos el test -->
    <form action="" method="post">
        <table border='1px solid black;'>
            <?php
            if ($solicitarniveles) {
                if ($indexVerbos == []) {
                    while (count($indexVerbos) < $cantidadverbos) {
                        $aux = rand(0, 208);
                        if (!in_array($aux, $indexVerbos)) {
                            $indexVerbos[] = $aux;
                        }
                    }
                    for ($i = 0; $i < count($indexVerbos); $i++) {
                        echo "<tr>";
                        $valoresAdivinar = range(0, 3);
                        shuffle($valoresAdivinar);
                        $auxVerbos = array_slice($valoresAdivinar, 0, $niveldificultad);
                        for ($j = 0; $j <= 3; $j++) {
                            if (!in_array($j, $auxVerbos)) {
                                echo "<td>" . $verbosIrregulares[$indexVerbos[$i]][$j] . "</td>";
                            } else {
                                echo '<td><input type="text" name="input' . $indexVerbos[$i] . " " . $j . '"></td>';
                            }
                        }
                        echo '</tr>';
                    }
                }
                echo '</table><br><br>';
            }
            ;
            if ($resolvernivel) {
                echo "<table border='1px solid black'>";
                $correctas = 0;
                $incorrectas = 0;
                for ($auxIndexVerbos = 0; $auxIndexVerbos < 208; $auxIndexVerbos++) {
                    if (isset($inputs['input' . $auxIndexVerbos . '0']) || isset($inputs['input' . $auxIndexVerbos . '1']) || isset($inputs['input' . $auxIndexVerbos . '2']) || isset($inputs['input' . $auxIndexVerbos . '3'])) {
                        echo "<tr>";
                        foreach ($verbosIrregulares[$auxIndexVerbos] as $aiv => $verbo) {
                            $idClase = "";
                            $auxAciertoError = "";
                            $nombreInput = 'input' . $auxIndexVerbos . $aiv;

                            if (isset($inputs[$nombreInput])){
                                if ($verbosIrregulares[$auxIndexVerbos][$aiv]){
                                    $correctas++;
                                    $auxAciertoError = ":)";
                                    $idClase = "acierto";
                                } else {
                                    $incorrectas++;
                                    $auxAciertoError = ":(";
                                    $idClase = "error";
                                }
                            }else{
                                echo '<td id="' . $idClase . '">' . $verbo . " " . $auxAciertoError . "</td>";
                            }
                        }
                        echo '</tr>';
                    }
                }
                echo '<table>';
                echo '<div> Has acertado un total de ' . $correctas . ' formas verbales';
                echo '<div> Has fallado un total de ' . $correctas . ' formas verbales';
            }
            ?>
            <input type="submit" name="resolvernivel" value="Comprobar mi test">
    </form>
</body>

</html>