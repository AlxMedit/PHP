<?php

namespace App\Controllers;
use App\Models\Usuarios;


class UsuariosController extends BaseController
{
    public function IndexAction()
    {
        if (!isset($_POST['buscarUsuario'])) {
            $usuario = Usuarios::getInstancia();
            $data['usuariosAll'] = $usuario->getAll();
            $this->renderHTML('../views/index_view.php', $data);
        } else {
            $usuario = Usuarios::getInstancia();
            $usuario->setUsuario($_POST['valorUsuario']);
            $data['usuariosAll'] = $usuario->get();
            $this->renderHTML('../views/index_view.php', $data);
        }
    }

    public function errorAction(){
        $this->renderHTML('../views/error_view.php');
    }

}