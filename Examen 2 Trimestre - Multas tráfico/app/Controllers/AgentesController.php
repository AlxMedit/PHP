<?php

namespace App\Controllers;
use App\Models\Multas;
use App\Models\Agentes;

class AgentesController extends BaseController
{
    public function listarMultasAction()
    {
        if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['perfil'] == 'agente') {
            $id = $_SESSION['usuario']['id'];
            $multas = Multas::getInstancia();
            $agente = Agentes::getInstancia();
            $agente->setAgenteId($id);
            $multas->setAgenteId($id);

            $multasArray = $multas->multasAgente();


            foreach ($multasArray as $multa) {
                $agente->setMultas($multa);
            }
            $data['info'] = $agente->getMultas();

            $agente = count($multasArray);
            $multasTotales = $multas->getAll();
            $total = count($multasTotales);


            $data['promedio'] = 'Has puesto ' . $agente . ' multas, de un total de ' . $total . ' multas, por lo que tu media es de ' . round(($agente / $total) * 100, 2) . '%';

            $this->renderHTML('../Views/multasAgente_view.php', $data);
        } else {
            $_SESSION['error'] = 'No eres un agente';
            header('location: /');
            exit();
        }
    }

    
}