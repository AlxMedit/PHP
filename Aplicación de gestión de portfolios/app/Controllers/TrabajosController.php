<?php

namespace App\Controllers;
use App\Models\Trabajos;

class TrabajosController extends BaseController{
    public function addTrabajoAction(){
        $trabajo = Trabajos::getInstancia();
        if (!isset($_POST['anadirTrabajo'])){
            $data[] = [];
            $this->renderHTML('../views/addTrabajoView.php', $data);
        } else {
            $trabajo->setTitulo($_POST['titulo']);
            $trabajo->setDescripcion($_POST['descripcion']);
            $trabajo->setFechaInicio($_POST['fecha_inicio']);
            $trabajo->setFechaFinal($_POST['fecha_final']);
            $trabajo->setLogros($_POST['logros']);
            $trabajo->setUsuariosId($_SESSION['usuarioActivo']['id']);
            $trabajo->set();
            $_SESSION['data'] = "Trabajo añadido correctamente";
            header ('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] .'');
            return;
        }
    }

    public function editarTrabajoAction(){
        // Corregimos la condición para verificar que al menos uno de los parámetros esté presente
        if (!isset($_POST['idTrabajo']) && !isset($_POST['confirmarEdit'])){
            $data['errorMessage'] = "No estás habilitado para editar este trabajo";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }
    
        // Instanciamos el objeto de trabajo y establecemos el ID
        $trabajo = Trabajos::getInstancia();
        $trabajo->setIdTrabajo($_POST['idTrabajo']);
        $infoTrabajo = $trabajo->get();
        
        // Verificamos que el trabajo exista y que el usuario sea el dueño
        if (!$infoTrabajo || $infoTrabajo['usuarios_id'] != $_SESSION['usuarioActivo']['id']){
            header ('Location: /error');
            return;
        }
    
        // Si no se ha confirmado la edición, mostramos el formulario con la información actual
        if (!isset($_POST['confirmarEdit'])){
            $trabajo->setIdTrabajo($_POST['idTrabajo']);
            $data['trabajo'] = $trabajo->get();
            $this->renderHTML('../views/editTrabajoView.php', $data);
        } else {
            // Si se confirma la edición, actualizamos el trabajo en la base de datos
            $trabajo->setIdTrabajo($_POST['idTrabajo']);
            $trabajo->setTitulo($_POST['titulo']);
            $trabajo->setDescripcion($_POST['descripcion']);
            $trabajo->setFechaInicio($_POST['fecha_inicio']);
            $trabajo->setFechaFinal($_POST['fecha_final']);
            $trabajo->setLogros($_POST['logros']);
            $trabajo->edit();
            // Mensaje de éxito y redirección a la cuenta del usuario
            $_SESSION['data'] = "Trabajo editado correctamente";
            header ('Location: /cuenta/' . $_SESSION['usuarioActivo']['id']);
            return;
        }
    }
    
    public function eliminarTrabajoAction(){
        $trabajo = Trabajos::getInstancia();
        if (!isset($_POST['eliminarTrabajo'])){
            $data['errorMessage'] = "No estás habilitado para eliminar este trabajo";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }

        $idTrabajo = $_POST['idTrabajo'];
        $idUsuario = $_SESSION['usuarioActivo']['id'];

        $trabajo->setIdTrabajo($idTrabajo);
        $existeTrabajo = $trabajo->get();
        if (!$existeTrabajo || $existeTrabajo['usuarios_id'] != $idUsuario){
            header ('Location: /error');
            return;
        }
        
        $trabajo->setIdTrabajo($idTrabajo);
        $resultado = $trabajo->delete();

        if ($resultado){
            $data['success'] = "Trabajo eliminado correctamente";
            if (isset($data['success'])) {
                $_SESSION['error'] = $data['success'];
                header('Location: /cuenta/' . $idUsuario .'');
                exit();
            }
        } else {
            $data['errorMessage'] = "No se ha podido eliminar el trabajo";
            $this->renderHTML('../views/error_view.php', $data);
        }
    }
}
?>