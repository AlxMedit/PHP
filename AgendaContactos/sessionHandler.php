<?php
// Iniciar sesión
session_start();

// Verificar si la sesión de contactos ya existe
if (!isset($_SESSION["contacts"])) {
    $_SESSION["contacts"] = array();
}

// Función para añadir un nuevo contacto a la sesión
function addContact($nombre, $email, $tfno) {
    if (empty($nombre) || empty($email) || empty($tfno)) {
        return "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "El email no tiene un formato válido.";
    } else {
        // Añadir el contacto a la sesión
        $_SESSION["contacts"][] = array(
            "nombre" => $nombre,
            "email" => $email,
            "tfno" => $tfno
        );
        return ""; // No hay error
    }
}

// Función para obtener los contactos actuales en la sesión
function getContacts() {
    return $_SESSION["contacts"];
}
?>
