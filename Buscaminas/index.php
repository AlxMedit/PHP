<?php
include("config/config.php");
session_start();

function generaMinas()
{
    for ($i = 0; $i < NUMEROMINAS; $i++) {
        do {
            $fila = mt_rand(0, 9);
            $columna = mt_rand(0, 9);

        } while ($_SESSION["tablero"][$fila][$columna] == 9);
        $_SESSION["tablero"][$fila][$columna] = 9;
        for ($f = max(0, $fila - 1); $f <= min(TAMANOTABLERO - 1, $fila + 1); $f++) {
            for ($c = max(0, $columna - 1); $c <= min(TAMANOTABLERO - 1, $columna + 1); $c++) {
                if ($_SESSION["tablero"][$f][$c] != 9) {
                    $_SESSION["tablero"][$f][$c]++;
                }
            }
        }
    }
}
function mostrarTablero(array $tablero)
{
    for ($f = 0; $f < TAMANOTABLERO; $f++) {
        for ($c = 0; $c < TAMANOTABLERO; $c++) {
            echo $tablero[$f][$c];
        }
        echo "<br/>";
    }
}

function jugadaGanadora(){
    $num_invisible = 0;
    $bool =  false;
    foreach ($_SESSION["visible"] as $fila => $columna) {
        foreach ($columna as $casilla) {
            if ($casilla == 0){
                $num_invisible++;
            }
        }
    }
    if($num_invisible == NUMEROMINAS){
        $bool =  true;
    }
    return $bool;
}
function clickCasilla($f, $c)
{
    if ($_SESSION["visible"][$f][$c] == 0) {
        $_SESSION["visible"][$f][$c] = 1;
        if ($_SESSION["tablero"][$f][$c] == 9) {
            return 0;
        } else if (jugadaGanadora()) {
            return 1;
        } else if ($_SESSION["tablero"][$f][$c] == 0) {
            for ($fila = max(0, $f - 1); $fila <= min(TAMANOTABLERO - 1, $f + 1); $fila++) {
                for ($columna = max(0, $c - 1); $columna <= min(TAMANOTABLERO - 1, $c + 1); $columna++) {
                    if ($_SESSION["tablero"][$f][$c] != 9) {
                        clickCasilla($fila, $columna);
                    }
                }
            }
        }
    }
}

if (!isset($_SESSION["tablero"])) {
    $_SESSION["tablero"] = array();
    $_SESSION["visible"] = array();

    for ($f = 0; $f < TAMANOTABLERO; $f++) {
        for ($c = 0; $c < TAMANOTABLERO; $c++) {

            $_SESSION["tablero"][$f][$c] = 0; // Tablero no visible, valores que oscilan del 0 al 8 (9 reservado para la mina)
            $_SESSION["visible"][$f][$c] = 0; // Tablero visible, valores 0 y 1.
        }
    }
    generaMinas();
}

echo "<a href=\"cerrarsesion.php\"> CERRAR SESION </a>";
if (isset($_GET["f"]) && isset($_GET["c"])) {
    $resp = clickCasilla($_GET["f"], $_GET["c"])?? "";
    echo $resp;
}
echo "<br/>";

mostrarTablero($_SESSION["tablero"]);
echo "<br/>";

for ($f = 0; $f < TAMANOTABLERO; $f++) {
    for ($c = 0; $c < TAMANOTABLERO; $c++) {
        if ($_SESSION["visible"][$f][$c] == 0){
            echo "<a href=\"index.php?f=$f&c=$c\"> C </a>";
        }else {
            echo $_SESSION["tablero"][$f][$c];
        }
    }
    echo "<br/>";
}