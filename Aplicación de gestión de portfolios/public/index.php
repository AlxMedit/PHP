<?php

use App\Models\Trabajos;
// requerimos el boostrap y autoload
require_once("../bootstrap.php");
require_once("../vendor/autoload.php");

use App\Controllers\UsuariosController;
use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\PerfilController;
use App\Controllers\SkillController;
use App\Controllers\TrabajosController;
use App\Controllers\RRSSController;
use App\Controllers\ProyectosController;

$router = new Router();

$router->add(array(
    'name' => 'Inicio',
    'path' => '/^\/$/',
    'action' => [UsuariosController::class, 'IndexAction'],
    'perfil' => []
));
$router->add(array(
    'name' => 'Login',
    'path' => '/^\/login$/',
    'action' => [AuthController::class, 'loginAction'],
    'perfil' => [],
));
$router->add(array(
    'name' => 'Logout',
    'path' => '/^\/logout$/',
    'action' => [AuthController::class, 'logoutAction'],
    'perfil' => []
));
$router->add(array(
    'name' => 'Registro',
    'path' => '/^\/signup$/',
    'action' => [AuthController::class, 'signUpAction'],
    'perfil' => []
));
$router->add(array(
    'name' => 'Cuentas',
    'path' => '/^\/cuenta\/(\d+)$/',
    'action' => [PerfilController::class, 'perfilAction'],
    'perfil' => []
));

$router->add(array(
    'name' => 'Verificar',
    'path' => '/^\/verificar\/(.+)$/',
    'action' => [AuthController::class, 'verificarAction'],
    'perfil' => []
));


$router->add(array(
    'name' => 'MostrarCuenta',
    'path' => '/^\/mostrarCuenta\/(\d+)$/',
    'action' => [PerfilController::class, 'mostrarPerfilAction'],
    'perfil' => []
));

$router->add(array(
    'name' => 'OcultarCuenta',
    'path' => '/^\/ocultarCuenta\/(\d+)$/',
    'action' => [PerfilController::class, 'ocultarPerfilAction'],
    'perfil' => []
));
$router->add(array(
    'name' => 'OcultarCuenta',
    'path' => '/^\/error$/',
    'action' => [UsuariosController::class, 'errorAction'],
    'perfil' => []
));

// PARA MODIFICAR EL PORTFOLIO

$router->add(array(
    'name' => 'Cambair imagen perfil',
    'path' => '/^\/subirImagen$/',
    'action' => [PerfilController::class, 'cambiarImagenAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'SkillAnadir',
    'path' => '/^\/addSkill$/',
    'action' => [SkillController::class, 'addSkillAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'SkillEliminar',
    'path' => '/^\/eliminarSkill$/',
    'action' => [SkillController::class, 'eliminarSkillAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'SkillAnadir',
    'path' => '/^\/editarSkill$/',
    'action' => [SkillController::class, 'editarSkillAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'anadirTrabajo',
    'path' => '/^\/anadirTrabajo$/',
    'action' => [TrabajosController::class, 'addTrabajoAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'editarTrabajo',
    'path' => '/^\/editarTrabajo$/',
    'action' => [TrabajosController::class, 'editarTrabajoAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'eliminarTrabajo',
    'path' => '/^\/eliminarTrabajo$/',
    'action' => [TrabajosController::class, 'eliminarTrabajoAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'anadirRRSS',
    'path' => '/^\/anadirRRSS$/',
    'action' => [RRSSController::class, 'anadirRRSSAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'eliminarRRSS',
    'path' => '/^\/eliminarRRSS$/',
    'action' => [RRSSController::class, 'eliminarRRSSAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'editarRRSSS',
    'path' => '/^\/editarRRSS$/',
    'action' => [RRSSController::class, 'editarRRSSAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'anadirProyecto',
    'path' => '/^\/anadirProyecto$/',
    'action' => [ProyectosController::class, 'anadirProyectoAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'eliminarProyecto',
    'path' => '/^\/eliminarProyecto$/',
    'action' => [ProyectosController::class, 'eliminarProyectoAction'],
    'perfil' => ['usuario']
));
$router->add(array(
    'name' => 'editarProyecto',
    'path' => '/^\/editarProyecto$/',
    'action' => [ProyectosController::class, 'editarProyectoAction'],
    'perfil' => ['usuario']
));



$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);
if ($route) {
    if (!empty($route['perfil']) && !in_array($_SESSION['perfil'], $route['perfil'])) {
        header('Location: /error');
    }
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
?>