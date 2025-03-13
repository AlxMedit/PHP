<?php
function eliminar_acentos($cadena){
    $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
    );

    $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena
    );

    $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena
    );

    $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena
    );

    $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena
    );

    $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç'),
        array('N', 'n', 'C', 'c'),
        $cadena
    );
    
    return $cadena;
}

function sanearlinea($linea) : String {
    $linea = eliminar_acentos($linea);
    $linea = str_replace(",", "", $linea);
    $linea = str_replace("\"", "", $linea);
    return strtolower($linea);
}

function crearUsuarioLinux($datos){
    $file = fopen('usuarios.sh', 'w');
    foreach($datos as $value){
        $user = sanearlinea($value);
        $salida = "useradd " . $user . "\n";
        $salida .= "mkdir /home/" . $user . "\n";
        $salida .= "chown " . $user . ":" . $user . " /home/" . $user . "\n";
        fputs($file, $salida);
    }
    fclose($file);
}

function crearUsuarioSQL($datos) {
    $file = fopen('usuarios.sql', 'w');
    foreach($datos as $value){
        $user = sanearlinea($value);
        $salida = "CREATE USER '" . $user . "'@'localhost' IDENTIFIED BY 'password';\n";
        $salida .= "GRANT ALL PRIVILEGES ON *.* TO '" . $user . "'@'localhost';\n";
        fputs($file, $salida);
    }
    fclose($file);
}
