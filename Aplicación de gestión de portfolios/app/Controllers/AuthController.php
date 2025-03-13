<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuarios;
use App\Core\SendEmail;


class AuthController extends BaseController
{
    public function loginAction()
    {
        if (!isset($_POST['iniciarSesion'])){
            if ($_SESSION['perfil'] !== 'invitado') {
                header('Location: /');
                exit();
            } else {
                $this->renderHTML('../views/login_view.php');
            } 
        } elseif(isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $usuario = Usuarios::getInstancia();
            $data = $usuario->logIn($email, $password);

            if (isset($data['usuario'])) {
                // Verificar si la cuenta está activa
                if ($data['usuario']['cuenta_activa'] == 1) {
                    $_SESSION['usuarioActivo'] = $data['usuario'];
                    $_SESSION['perfil'] = "usuario";
                    header('Location: /');
                    exit();
                } else {
                    // Si la cuenta no está activa
                    $data['errorMessage'] = "Tu cuenta no está activa. Contacta con el administrador.";
                    $this->renderHTML('../views/login_view.php', $data);
                }
            } else {
                $data['errorMessage'] = "Usuario o contraseña incorrectos";
                $this->renderHTML('../views/login_view.php', $data);
            }
        } else {
            $this->renderHTML('../views/login_view.php');
        }
    }


    public function signUpAction()
    {
        if (!isset($_POST['registrarse'])) {
            if ($_SESSION['perfil'] !== 'invitado') {
                header('Location: /');
                exit();
            } else {
                $this->renderHTML('../views/signup_view.php');
            }
        } else {
            function generarToken()
            {
                $rb = random_bytes(32);
                $token = base64_encode($rb);
                $secureToken = uniqid('', true) . $token;
                return $secureToken;
            }

            $requiredFields = ['email', 'password', 'nombre', 'apellidos', 'categoriaProfesional', 'resumenPerfil'];
            if (!array_diff_key(array_flip($requiredFields), $_POST)) {
                $email = $_POST['email'] ?? null;
                $password = $_POST['password'] ?? null;
                $nombre = $_POST['nombre'] ?? null;
                $apellidos = $_POST['apellidos'] ?? null;
                $categoriaProfesional = $_POST['categoriaProfesional'] ?? null;
                $resumenPerfil = $_POST['resumenPerfil'] ?? null;
                $foto = 'defaultPic.jpg';
                $usuario = Usuarios::getInstancia();

                $usuarioExistente = $usuario->checkEmailExists($email);

                if ($usuarioExistente) {
                    $data['errorMessage'] = "El correo electrónico ya está registrado.";
                    $this->renderHTML('../views/signup_view.php', $data);
                } else {
                    $token = generarToken();
                    $sendEmail = new SendEmail();
                    $sendEmail->enviarCorreoVerificacion($email, $token);
                    $usuario->setEmail($email);
                    $usuario->setContrasena($password);
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setCategoriaProfesional($categoriaProfesional);
                    $usuario->setResumenPerfil($resumenPerfil);
                    $usuario->setFoto($foto);
                    $usuario->setToken($token);

                    $data = $usuario->set();

                    if (isset($data['success'])) {
                        session_start();
                        $_SESSION['data'] = $data['success'];
                        header('Location: /');
                        exit();
                    } else {
                        $this->renderHTML('../views/signup_view.php', $data);
                    }
                }
            } else {
                $data['errorMessage'] = "Por favor, completa todos los campos requeridos.";
                $this->renderHTML('../views/signup_view.php', $data);
            }
        }
    }



    public function verificarAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (preg_match('/^\/verificar\/(.+)$/', $uri, $matches)) {
            $token = $matches[1];
        } else {
            throw new \Exception("Token no válido o no encontrado.");
        }
        $usuario = Usuarios::getInstancia();
        $data = $usuario->verificarCuenta($token);
        $_SESSION['data'] = $data;

        header('Location: /');
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