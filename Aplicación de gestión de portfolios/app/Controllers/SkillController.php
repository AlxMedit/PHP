<?php

namespace App\Controllers;
use App\Models\Skill;

class SkillController extends BaseController
{
    public function addSkillAction()
    {
        $skill = Skill::getInstancia();
        if (!isset($_POST['anadirHabilidad'])){
            $data['categorias'] = $skill->getCategorias();
            $this->renderHTML('../views/addSkillView.php', $data);
        } else {
            $skill->setHabilidades($_POST['habilidades']);
            $skill->setCategoriasSkillsCategoria($_POST['categorias_skills_categoria']);
            $skill->setUsuariosId($_SESSION['usuarioActivo']['id']);
            $skill->set();
            $_SESSION['data'] = "Habilidad añadida correctamente";
            header ('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] .'');
            return;
        }
    }

    public function eliminarSkillAction(){
        $skill = Skill::getInstancia();
        if (!isset($_POST['id_skill'])){
            $data['errorMessage'] = "No estás habilitado para eliminar esta habilidad";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }

        $idSkill = $_POST['id_skill'];
        $idUsuario = $_SESSION['usuarioActivo']['id'];

        $skill->setIdSkill($idSkill);
        $habilidad = $skill->get();
        if (!$habilidad || $habilidad['usuarios_id'] != $idUsuario){
            header ('Location: /error');
            return;
        }

        $skill->setIdSkill($idSkill);       
        $resultado = $skill->delete();
        if ($resultado){
            $data['success'] = "Habilidad eliminada correctamente";
            if (isset($data['success'])) {
                $_SESSION['data'] = $data['success'];
                header('Location: /cuenta/' . $idUsuario .'');
                exit();
            }
        } else {
            $data['errorMessage'] = "No se ha podido eliminar la habilidad";
            $this->renderHTML('../views/error_view.php', $data);
        }
    }

    public function editarSkillAction(){
        if (!isset($_POST['id_skill']) && !isset($_POST['editarHabilidad'])){
            $data['errorMessage'] = "No estás habilitado para editar esta habilidad";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }
        $skill = Skill::getInstancia();
        $skill->setIdSkill($_POST['id_skill']);
        $habilidad = $skill->get();
        if (!$habilidad || $habilidad['usuarios_id'] != $_SESSION['usuarioActivo']['id']){
            header ('Location: /error');
            return;
        }
        if (!isset($_POST['editarHabilidad'])){
            $data['idSkill'] = $_POST['id_skill'];
            $data['usuario'] = $_SESSION['usuarioActivo']['id'];
            $data['categoria'] = $_POST['categoria'];
            $data['categorias'] = $skill->getCategorias();
            $data['habilidad'] = $_POST['habilidad'];
            $this->renderHTML('../views/editSkillView.php', $data);
        } else {
            $skill->setIdSkill($_POST['id_skill']);
            $skill->setHabilidades($_POST['habilidad']);
            $skill->setCategoriasSkillsCategoria($_POST['categoria']);
            $skill->edit();
            $_SESSION['data'] = "Habilidad editada correctamente";
            header('Location: /cuenta/' . $_SESSION['usuarioActivo']['id'] .'');
        }

    }
}