<?php 
require "vendor/autoload.php";
use Dotenv\Dotenv;

session_start();
if (!isset($_SESSION['perfil'])){
    $_SESSION['perfil'] = 'invitado';
}

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('DBHOST', $_ENV['DBHOST']);
define('DBUSER', $_ENV['DBUSER']);
define('DBPASS', $_ENV['DBPASS']);
define('DBNAME', $_ENV['DBNAME']);
define('DBPORT', $_ENV['DBPORT']);

