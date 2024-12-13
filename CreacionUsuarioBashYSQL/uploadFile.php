<?php
if (!isset($_POST['enviar'])) {
    header("Location: index.php");
}

include "Function/function.php";
$procesaFichero = false;

define("DIR_UPLOAD", "filesdir/");
define("MAX_SIZE", "200000");
$extensiones_aceptadas = array("csv");
$formatos_aceptados = array("text/csv");

$aux = explode(".", $_FILES["archivo"]["name"]);
$extension = end($aux);

if ($_FILES['archivo']['size'] <= MAX_SIZE && in_array($extension, $extensiones_aceptadas) && in_array($_FILES['archivo']['type'], $formatos_aceptados)) {
    if ($_FILES['archivo']['error'] > 0) {
        echo "Se ha producido un error: " . $_FILES['archivo']['error'] . ".";
    } else {
        $file_name = "listado_alumnos.csv";
        move_uploaded_file($_FILES["archivo"]["tmp_name"], DIR_UPLOAD . $file_name);
        $procesaFichero = true;
    }
} else {
    echo "Error en el tamaño máximo permitido o formato de archivo no aceptado";
}

if ($procesaFichero) {
    $file = fopen(DIR_UPLOAD . "listado_alumnos.csv", "r");
    if ($file) {
        // Saltar la primera línea del archivo
        fgets($file);
        
        $array_usuarios = array();

        while (!feof($file)) {
            $line = fgets($file);
            if ($line === false) continue; // Saltar líneas vacías
            $line = sanearlinea($line);
            $arrayUsuarios = explode(" ", $line);

            // Comprobamos si existen los índices antes de usarlos
            $nombre_usuario = (isset($arrayUsuarios[0]) ? substr($arrayUsuarios[0], 0, 2) : '') .
                              (isset($arrayUsuarios[1]) ? substr($arrayUsuarios[1], 0, 2) : '') .
                              (isset($arrayUsuarios[2]) ? substr($arrayUsuarios[2], 0, 2) : '');

            $usuario = $nombre_usuario;
            $contador = 1;
            while (in_array($usuario, $array_usuarios)) {
                $usuario = $nombre_usuario . $contador;
                $contador++;
            }

            $array_usuarios[] = $usuario;
        }
        fclose($file);

        // Generar el archivo en el formato seleccionado
        if ($_POST['SO'] === 'SQL') {
            crearUsuarioSQL($array_usuarios);
            echo "Script de usuarios SQL generado correctamente.";
        } else {
            crearUsuarioLinux($array_usuarios);
            echo "Script de usuarios Linux (Bash) generado correctamente.";
        }
    } else {
        echo "Error al abrir el archivo para lectura.";
    }
}

echo '<br><a href="index.php">Vuelve a inicio</a>';

