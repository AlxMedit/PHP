<?php
namespace App\Controllers;
use App\Models\Proyectos;

class ProyectosController extends BaseController
{
    public function anadirProyectoAction()
    {
        $proyecto = Proyectos::getInstancia();
        if (!isset($_POST['anadirProyecto'])){
            $this->renderHTML('../views/addProyectoView.php');
        } else {
            $proyecto->setTitulo($_POST['titulo']);
            $proyecto->setDescripcion($_POST['descripcion']);
            $proyecto->setTecnologias($_POST['tecnologias']);
            $proyecto->setUsuariosId($_SESSION['usuarioActivo']['id']);
            $proyecto->set();
            $_SESSION['data'] = "Habilidad añadida correctamente";
            header ('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] .'');
            return;
        }
    }

    public function eliminarProyectoAction(){
        $proyecto = Proyectos::getInstancia();
        if (!isset($_POST['id_proyecto'])){
            $data['errorMessage'] = "No estás habilitado para eliminar este proyecto";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }
        $idProyecto = $_POST['id_proyecto'];
        $proyecto->setIdProyecto($idProyecto);
        $infoProyecto = $proyecto->get();
        if (!$infoProyecto || $infoProyecto['usuarios_id'] != $_SESSION['usuarioActivo']['id']){
            header ('Location: /error');
            return;
        }
        $proyecto->setIdProyecto($idProyecto);
        $proyecto->delete();    
        $_SESSION['error'] = "Proyecto eliminado correctamente";
        header ('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] .'');
    }

    public function editarProyectoAction(){
        if (!isset($_POST['id_proyecto']) && !isset($_POST['editarProyecto'])){
            $data['errorMessage'] = "No estás habilitado para editar este proyecto";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }
        $proyecto = Proyectos::getInstancia();
        $proyecto->setIdProyecto($_POST['id_proyecto']);
        $infoProyecto = $proyecto->get();
        if (!$infoProyecto || $infoProyecto['usuarios_id'] != $_SESSION['usuarioActivo']['id']){
            header ('Location: /error');
            return;
        }
        if (!isset($_POST['confirmarEditar'])){
            $proyecto->setIdProyecto($_POST['id_proyecto']);
            $data['proyecto'] = $proyecto->get();
            $this->renderHTML('../views/editProyectoView.php', $data);
        } else   {
            $proyecto->setIdProyecto($_POST['id_proyecto']);
            $proyecto->setTitulo($_POST['titulo']);
            $proyecto->setDescripcion($_POST['descripcion']);
            $proyecto->setTecnologias($_POST['tecnologias']);
            $proyecto->setUsuariosId($_SESSION['usuarioActivo']['id']);
            $proyecto->edit();
            $_SESSION['data'] = "Proyecto editado correctamente";
            header ('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] .'');
            return;
        }
    }
}