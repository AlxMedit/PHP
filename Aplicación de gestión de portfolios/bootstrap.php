<?php
require 'vendor/autoload.php'; 
use Dotenv\Dotenv; 
session_start();
if (!isset($_SESSION['usuarioActivo'])) {
    $_SESSION['usuarioActivo'] = [
        'nombre' => 'invitado',
        'id' => null,
    ];
    $_SESSION['perfil'] = 'invitado';
}
$dotenv = Dotenv::createImmutable(__DIR__); 
$dotenv->load();
define('DBHOST', $_ENV['DBHOST']); 
define('DBNAME', $_ENV['DBNAME']); 
define('DBUSER', $_ENV['DBUSER']); 
define('DBPASS', $_ENV['DBPASS']); 
define('DBPORT', $_ENV['DBPORT']); 
