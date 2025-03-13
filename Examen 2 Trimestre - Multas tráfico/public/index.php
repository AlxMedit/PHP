<?php

use App\Controllers\AgentesController;

require_once('../bootstrap.php');
require_once('../vendor/autoload.php');

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\AuthController;
use App\Controllers\MultasController;
use App\Controllers\AdminController;

$router = new Router();

$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action'=> [IndexController::class, 'indexAction'],
    'perfil' => []
));
$router->add(array(
    'name'=> 'Login',
    'path' => '/^\/login$/',
    'action'=> [AuthController::class, 'loginAction'],
    'perfil' => []
));
$router->add(array(
    'name'=> 'LogOut',
    'path' => '/^\/logout$/',
    'action'=> [AuthController::class, 'logoutAction'],
    'perfil' => []
));
$router->add(array(
    'name'=> 'Listado multas',
    'path' => '/^\/multas$/',
    'action'=> [MultasController::class, 'mostrarMultasAction'],
    'perfil' => []
));
$router->add(array(
    'name'=> 'Pagar multas',
    'path' => '/^\/pagarMulta\/(\d+)$/',
    'action'=> [MultasController::class, 'mostrarMultaAction'],
    'perfil' => []
));
$router->add(array(
    'name'=> 'Multas Agentes',
    'path' => '/^\/multasAgente$/',
    'action'=> [AgentesController::class, 'listarMultasAction'],
    'perfil' => []
));
$router->add(array(
    'name'=> 'Multas Agentes',
    'path' => '/^\/ponerMulta$/',
    'action'=> [MultasController::class, 'anadirMulta'],
    'perfil' => []
));
$router->add(array(
    'name'=> 'Multas Agentes',
    'path' => '/^\/adminPanel$/',
    'action'=> [AdminController::class, 'mostrarAction'],
    'perfil' => []
));



$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);
if ($route) {
    // if (!empty($route['perfil']) && !in_array($_SESSION['perfil'], $route['perfil'])) {
    //     header('Location: /error');
    // }
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
?>