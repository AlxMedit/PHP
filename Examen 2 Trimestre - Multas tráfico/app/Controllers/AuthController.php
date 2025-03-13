<?php

namespace App\Controllers;
require __DIR__ . "/../lib/function.php";

use App\Controllers\BaseController;
use App\Models\Usuarios;


class AuthController extends BaseController
{
    public function loginAction()
    {
        if (!isset($_POST['iniciarSesion'])) {
            header('location: /');
            exit();
        }
        if (!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['resCaptcha']) && isset($_POST['iniciarSesion'])) {
            $usuarioInput = clearData($_POST['usuario']);
            $password = clearData($_POST['password']);
            $captcha = clearData($_POST['captcha']);
            $resCaptcha = $_POST['resCaptcha'];
            if ($resCaptcha == $captcha) {
                $usuario = Usuarios::getInstancia();
                $usuario->setContrasena($password);
                $usuario->setUsuario($usuarioInput);
                $data = $usuario->login();
                if (isset($data['usuario'])) {
                    $_SESSION['usuario'] = $data['usuario'];
                    $_SESSION['perfil'] = $data['usuario']['perfil'];
                    header('location: /');
                    exit();
                } else {
                    $_SESSION['error'] = 'Usuario o contraseña incorrectos';
                    header('location: /');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Captcha incorrecto';
                header('location: /');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Faltan datos';
            header('location: /');
            exit();
        }
    }

    public function logoutAction()
    {
        session_start();
        session_destroy();
        session_abort();
        session_unset();
        header('Location: /');
    }
}