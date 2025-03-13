<?php
namespace App\Controllers;
use App\Models\Usuarios;

class PerfilController extends BaseController
{
    public function perfilAction($id)
    {
        // Validar y obtener el ID del usuario desde la URL
        $partes = explode('/', $id);
        $id = $partes[2] ?? null;
        $usuario = Usuarios::getInstancia();

        $visible = $usuario->esVisible($id);

        if (!$visible && $_SESSION['usuarioActivo']['id'] != $id) {
            $data['errorMessage'] = "Este usuario no existe o no es visible";
            $this->renderHTML('../views/error_view.php', $data);
            return;
        }

        $data['usuario'] = $usuario->getUsuarioById($id);
        if (isset($data['usuario']['errorMessage']) && $data['usuario']['errorMessage']) {
            header('Location: /');
            exit();
        }
        $data['proyectos'] = $usuario->getProyectosByUsuarioId($id);
        $data['redesSociales'] = $usuario->getRedesSocialesByUsuarioId($id);
        $data['skills'] = $usuario->getSkillsByUsuarioId($id);
        $data['trabajos'] = $usuario->getTrabajosByUsuarioId($id);

        $this->renderHTML('../views/cuenta_view.php', $data);
    }

    public function cambiarImagenAction(){
        $usuario = Usuarios::getInstancia();
        if (isset($_POST['subirImagen'])){
            $usuario->cambiarImagen($_FILES['imagen'], $_SESSION['usuarioActivo']['id']);
            header('Location: /cuenta/' . $_SESSION['usuarioActivo']['id']);
        }
    }

    public function mostrarPerfilAction($id)
    {
        $cadena = $id;
        $partes = explode('/', $cadena);
        $id = $partes[2];
        $usuario = Usuarios::getInstancia();
        $usuario->ponerCuentaVisible($id);
    }

    public function ocultarPerfilAction($id)
    {
        $cadena = $id;
        $partes = explode('/', $cadena);
        $id = $partes[2];
        $usuario = Usuarios::getInstancia();
        $usuario->ponerCuentaOculta($id);
    }
}