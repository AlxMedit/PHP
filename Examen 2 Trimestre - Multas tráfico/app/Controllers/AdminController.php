<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Multas;

class AdminController extends BaseController
{
    public function mostrarAction()
    {
        if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['perfil'] == 'admin') {
            $usuarios = Usuarios::getInstancia();
            $multas = Multas::getInstancia();
            
            $conductores = $usuarios->getAllConductores();
            $data['conductores'] = $conductores;

            foreach ($conductores as $conductor){
                $idConductor = $conductor['id'];
                $data['sanciones'][$idConductor] = $multas->obtenerCantidadByConductor($idConductor);
            }



            $this->renderHTML('../Views/admin_view.php', $data);
        } else {
            $_SESSION['error'] = 'No eres administrador';
            header('location: /');  
            exit();
        }
    }
}