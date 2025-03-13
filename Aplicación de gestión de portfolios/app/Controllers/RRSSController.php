<?php

namespace App\Controllers;
use App\Models\RRSS;

class RRSSController extends BaseController
{
    public function anadirRRSSAction()
    {
        $rrss = RRSS::getInstancia();
        if (!isset($_POST['anadirRRSS'])) {
            $this->renderHTML('../views/addRRSSView.php');
        } else {
            $rrss->setRedSocial($_POST['red_social']);
            $rrss->setUrl($_POST['url']);
            $rrss->setUsuariosId($_SESSION['usuarioActivo']['id']);
            $rrss->set();
            $_SESSION['data'] = "Red social añadida correctamente";
            header('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] . '');
            return;
        }
    }

    public function eliminarRRSSAction()
    {
        $rrss = RRSS::getInstancia();
        if (!isset($_POST['eliminarRRSS'])) {
            $data['errorMessage'] = "No estás habilitado para eliminar esta red social";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }
        $rrssId = $_POST['idRRSS'];
        $rrss->setIdRRSS($rrssId);
        $rrssInfo = $rrss->get();
        if (!$rrssInfo || $rrssInfo['usuarios_id'] != $_SESSION['usuarioActivo']['id']) {
            header('Location: /error');
            return;
        }
        $rrss->setIdRRSS($rrssId);
        $rrss->delete();
        $_SESSION['error'] = "Red social eliminada correctamente";
        header('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] . '');
        return;
    }

    public function editarRRSSAction()
    {
        
        if (!isset($_POST['idRRSS']) && !isset($_POST['confirmarEdit'])) {
            $data['errorMessage'] = "No estás habilitado para editar esta red social";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }
        $rrss = RRSS::getInstancia();
        
        $rrss->setIdRRSS($_POST['idRRSS']);
        
        
        $rrssInfo = $rrss->get();
        
        if (!$rrssInfo || $rrssInfo['usuarios_id'] != $_SESSION['usuarioActivo']['id']) {
            header('Location: /error');
            return;
        }
        
        if (!isset($_POST['confirmarEdit'])) {
            $rrss->setIdRRSS($_POST['idRRSS']);
            $data['rrss'] = $rrss->get();
            $this->renderHTML('../views/editRRSSView.php', $data);
        } else {
            $rrss->setRedSocial($_POST['red_social']);
            $rrss->setUrl($_POST['url']);
            $rrss->setId($_POST['idRRSS']);
            $rrss->edit();
            $_SESSION['data'] = "Red social editada correctamente";
            header('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] . '');
            return;
        }
    }
}