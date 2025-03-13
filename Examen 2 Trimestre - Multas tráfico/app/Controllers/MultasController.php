<?php

namespace App\Controllers;
use App\Models\Multas;
use \DateTime;
use App\Models\Conductores;

class MultasController extends BaseController
{
    public function mostrarMultasAction()
    {
        if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['perfil'] == 'conductor') {
            $id = $_SESSION['usuario']['id'];
            $multas = Multas::getInstancia();
            $multas->setIdConductor($id);
            $data = $multas->getMultas();

            $this->renderHTML('../Views/multas_view.php', $data);
        } else {
            $_SESSION['error'] = 'No eres un conductor';
            header('location: /');
            exit();
        }
        ;
    }

    public function mostrarMultaAction($id)
    {
        $multas = Multas::getInstancia();
        $partes = explode('/', $id);
        $idObtenida = $partes[2];
        $multas->setIdMulta($idObtenida);
        $multaExiste = $multas->multaExiste();
        if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['perfil'] == 'conductor' && $multaExiste) {
            $data = $multas->get();

            // https://programacion.net/articulo/calcular_la_diferencia_entre_dos_fechas_con_php_1566

            $hoy = new DateTime(datetime: date('Y-m-d'));
            $fechaMulta = new DateTime(datetime: $data[0]['fecha']);
            $interval = $hoy->diff($fechaMulta);
            if ($interval->days < 30) {
                $data[0]['descuento'] = 50;
                $_SESSION['descuento'] = 'Si la pagas en menos de 30 días, tienes un descuento del 50%';
            } else {
                $data[0]['descuento'] = 0;
                $_SESSION['descuento'] = 'Han pasado 30 días, ya no puedes optar a la bonificación del 50%';
            }
            if ($data[0]['estado'] == 'Pendiente'){
                $_SESSION['pagada'] = 0;
            } else {
                $_SESSION['pagada'] = 1;
            }
            $this->renderHTML('../Views/pagarMulta_view.php', $data);
        } else {
            $_SESSION['error'] = 'No eres un conductor o la multa no existe';
            header('location: /');
            exit();
        }
        die();

    }

    public function anadirMulta(){
        if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['perfil'] == 'agente') {
            if (isset($_POST['addMulta']) && $_POST['addMulta']) {
                $conductores = Conductores::getInstancia();
                $data = $conductores->getAll();
                $this->renderHTML('../Views/ponerMulta_view.php', $data);
                exit();
            } elseif ($_POST['addMultaFilled']) {
                $conductores = Conductores::getInstancia();
                $conductor = $_POST['conductor'];
                $conductores->setNombreConductor($conductor);
                $idConductor = $conductores->getIdByName();
                $idConductor = $idConductor[0]['id'];
                $matricula = $_POST['matricula'];
                $fecha = $_POST['fecha'];
                $tipoSancion = $_POST['sancion'];
                $descripcion = $_POST['descripcion'];
                $multas = Multas::getInstancia();
                $multas->setAgenteId($_SESSION['usuario']['id']);
                $multas->setMatricula($matricula);
                $multas->setFecha($fecha);
                $multas->setConductor($idConductor);
                $multas->setTipoSancion($tipoSancion);
                $multas->setDescripcion($descripcion);
                $sanciones = $multas->obtenerSancion();
                $multas->setImporte($sanciones[0]['importe']);

                $multas->set();
                header ('location: /');
            }
        } else {
            $_SESSION['error'] = 'No eres un agente';
            header('location: /');
            exit();
        }
    }
}