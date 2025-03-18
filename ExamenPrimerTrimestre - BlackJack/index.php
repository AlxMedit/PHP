<?php

session_start();

// Incluir configuraciones de cartas
include "config/aCartas.php";

// Inicializar variables de resultado del juego
$lose = false;
$draw = false;
$win = false;

// Configurar cookie de música (apagada por defecto)
setcookie('musica', 'off', time() + 3600);
if (isset($_POST['enviarCookieMusica'])) {
    setcookie('musica', isset($_POST['musica']) ? 'on' : 'off', time() + 3600);
}

// Crear sesión de cartas del usuario si no existe
if (!isset($_SESSION['cartasUsuario'])) {
    $_SESSION['cartasUsuario'] = [random_int(0, 51), random_int(0, 51)];
}

// Crear sesión de cartas de la máquina si no existe
if (!isset($_SESSION['cartasMaquina'])) {
    $_SESSION['cartasMaquina'] = [random_int(0, 51), random_int(0, 51)];
}

// Función para calcular el valor total de las cartas, ajustando el valor del As
function calcularValorCartas($cartas, $asignarCartas, $valoresCartas) {
    $valor = 0;
    $numAses = 0;

    foreach ($cartas as $key) {
        $carta = $asignarCartas[$key];
        $valor += $valoresCartas[$carta];
        if (strpos($carta, 'ace') !== false) {
            $numAses++;
        }
    }

    // Ajustar el valor del As (1 u 11) si es necesario
    while ($valor > 21 && $numAses > 0) {
        $valor -= 10;
        $numAses--;
    }

    return $valor;
}

// Mostrar cartas del usuario
if (isset($_POST['pedirCarta'])) {
    $_SESSION['cartasUsuario'][] = random_int(0, 51);
}

echo "<p><strong>Tus cartas son:</strong></p>";
$valorUsuario = calcularValorCartas($_SESSION['cartasUsuario'], $asignarCartas, $valoresCartas);
foreach ($_SESSION['cartasUsuario'] as $key) {
    echo "<img src='imgs/Playing-Cards/PNG-cards-1.3/{$asignarCartas[$key]}.png' alt='{$asignarCartas[$key]}' height='180'>";
}

// Verificar si el usuario pierde por superar 21 puntos
if ($valorUsuario > 21) {
    $lose = true;
}

echo "<p>Tienes un <strong>valor de cartas</strong> de: $valorUsuario</p><br>";

// Decisión de la máquina: tomar o no una carta
$valorMaquina = calcularValorCartas($_SESSION['cartasMaquina'], $asignarCartas, $valoresCartas);
if (isset($_POST['pedirCarta']) && !$lose) {
    $factorRiesgo = 17; // Umbral de riesgo de la máquina
    while ($valorMaquina < $factorRiesgo) {
        $_SESSION['cartasMaquina'][] = random_int(0, 51);
        $valorMaquina = calcularValorCartas($_SESSION['cartasMaquina'], $asignarCartas, $valoresCartas);
    }
}

// Mostrar primera carta de la máquina
if (!$win && !$lose && !$draw) {
    echo "<p>La primera carta de la <strong>máquina</strong> es:</p>";
    echo "<img src='imgs/Playing-Cards/PNG-cards-1.3/{$asignarCartas[$_SESSION['cartasMaquina'][0]]}.png' alt='{$asignarCartas[$_SESSION['cartasMaquina'][0]]}' height='180'>";
    echo "<img src='imgs/Playing-Cards/PNG-cards-1.3/back.png' alt='back' height='180'>";

    echo "<p>Tienen un valor de {$valoresCartas[$asignarCartas[$_SESSION['cartasMaquina'][0]]]}</p>";
}

// Acción al plantarse
if (isset($_POST['plantarse']) || $valorUsuario > 21) {
    // Verificar el estado del juego
    if ($valorUsuario > 21) {
        $lose = true;
    } elseif ($valorMaquina > 21) {
        $win = true;
    } elseif ($valorUsuario > $valorMaquina) {
        $win = true;
    } elseif ($valorUsuario == $valorMaquina) {
        $draw = true;
    } else {
        $lose = true;
    }
}

// Mostrar todas las cartas de la máquina si el juego termina
if ($win || $lose || $draw) {
    echo "<p>Las cartas de la <strong>máquina</strong> son:</p>";
    foreach ($_SESSION['cartasMaquina'] as $key) {
        echo "<img src='imgs/Playing-Cards/PNG-cards-1.3/{$asignarCartas[$key]}.png' alt='{$asignarCartas[$key]}' height='180'>";
    }
    echo "<p>Tienen un valor de $valorMaquina</p>";
}

// Mostrar resultado del juego
echo "<h2>";
if ($win) {
    echo "Has ganado";
} elseif ($draw) {
    echo "Has empatado";
} elseif ($lose) {
    echo "Has perdido";
} else {
    // Opciones del usuario para continuar jugando
    echo "<form action='' method='post'>";
    echo "<input type='submit' value='Pedir carta' name='pedirCarta'>";
    echo "<input type='submit' value='Finalizar' name='plantarse'>";
    echo "</form>";
}
echo "</h2>";
?>

<br><br>
<a href="cierre.php">Otra partida</a>

<?php 
// Incluir preferencias del usuario
include('preferencias.php');

// Reproducir música si está activada
if ($_COOKIE['musica'] == "on") {
    echo "<audio controls autoplay loop>";
    echo "<source src='Music.mp3' type='audio/mp3'>";
    echo "</audio><br>";
}
?>
