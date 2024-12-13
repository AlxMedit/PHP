<?php
/**
 * 
 * @author Alex Abad
 * @Guiada Procesar lo subido
 * 
 */

if (!isset($_POST['submit'])) {
    header("Location: index.php");
}
define("DIR_UPLOAD", "upload/");
define("MAX_SIZE", "200000");
$extensiones_aceptadas = array("gif", "jpg", "png", "jpeg", "pdf", "txt");
$formatos_aceptados = array("image/gif", "image/jpg", "image/png", "image/jpeg", "image/pdf", "image/txt");

$aux = explode(".", $_FILES["file"]["name"]);
$extension = end($aux);

if ($_FILES['file']['size'] <= MAX_SIZE && in_array($extension, $extensiones_aceptadas) && in_array($_FILES['file']['type'], $formatos_aceptados)) {
    if ($_FILES['file']['error']){
    echo "Se ha producido un error" . $_FILES['file']['error'] . ".";
    } else {
        $file_name = uniqid() . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (file_exists(DIR_UPLOAD . $file_name)) {
        echo "El fichero ya existe";
        } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], DIR_UPLOAD . $file_name);
        echo "Se ha subido el fichero correctamente a upload";
        }
    }
 } else {
    echo "Error en el tamaño máximo permitido";
    }

echo '<br><a href="index.php"> Vuelve a inicio </a>';
?>