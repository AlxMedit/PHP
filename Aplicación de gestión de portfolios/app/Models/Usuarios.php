<?php

namespace App\Models;
require_once("DBAbstractModel.php");

class Usuarios extends DBAbstractModel
{

    private static $instancia;
    private $id;
    private $email;
    private $contrasena;
    private $nombre;
    private $apellidos;
    private $categoriaProfesional;
    private $resumenPerfil;
    private $foto;
    private $token;
    private $fechaCreacionToken;
    private $cuentaActiva;
    private $visible;
    private $usuario;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone()
    {
        trigger_error('La clonacion no es permitida!', E_USER_ERROR);
    }

    // Getters
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getContrasena()
    {
        return $this->contrasena;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getCategoriaProfesional()
    {
        return $this->categoriaProfesional;
    }
    public function getResumenPerfil()
    {
        return $this->resumenPerfil;
    }
    public function getFoto()
    {
        return $this->foto;
    }
    public function getToken()
    {
        return $this->token;
    }
    public function getFechaCreacionToken()
    {
        return $this->fechaCreacionToken;
    }
    public function getCuentaActiva()
    {
        return $this->cuentaActiva;
    }
    public function getVisible()
    {
        return $this->visible;
    }

    // Setters
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setCategoriaProfesional($categoriaProfesional)
    {
        $this->categoriaProfesional = $categoriaProfesional;
    }
    public function setResumenPerfil($resumenPerfil)
    {
        $this->resumenPerfil = $resumenPerfil;
    }
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    public function setToken($token)
    {
        $this->token = $token;
    }
    public function setFechaCreacionToken($fechaCreacionToken)
    {
        $this->fechaCreacionToken = $fechaCreacionToken;
    }
    public function setCuentaActiva($cuentaActiva)
    {
        $this->cuentaActiva = $cuentaActiva;
    }
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function logIn($email, $pass)
    {
        $this->query = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$pass'";
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $data['usuario'] = $this->rows[0];
        } else {
            $data['errorMessage'] = "Usuario o contraseña incorrectos";
        }
        return $data;
    }


    public function esVisible($id)
    {
        $this->query = "SELECT visible FROM usuarios WHERE id = $id";
        $this->get_results_from_query();

        if (!empty($this->rows) && isset($this->rows[0]['visible'])) {
            return $this->rows[0]['visible'] == 1;
        }

        return false;
    }

    public function get()
    {
        $this->query = "SELECT * FROM usuarios WHERE CONCAT(nombre, ' ', apellidos) LIKE :usuario";
        $this->parametros['usuario'] = "%" . $this->usuario . "%";
        $this->get_results_from_query();

        return count($this->rows) ? $this->rows : "No se encontraron resultados";
    }


    public function checkEmailExists($email)
    {
        $this->query = "SELECT * FROM usuarios WHERE email = '$email'";
        $this->get_results_from_query();
        if (count($this->rows) != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUsuarioById($id)
    {
        $id = (int) $id;
        $this->query = "SELECT * FROM usuarios WHERE id = $id";
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $data['usuario'] = $this->rows[0];
        } else {
            $data['errorMessage'] = "Usuario no encontrado";
        }
        return $data;
    }


    public function getProyectosByUsuarioId($id)
    {
        $id = (int) $id;
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = $id";
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            $data['proyectos'] = $this->rows;
        } else {
            $data['errorMessage'] = "Este usuario no tiene proyectos";
        }
        return $data;
    }

    public function getRedesSocialesByUsuarioId($id)
    {
        $id = (int) $id;
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = $id";
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            $data['redesSociales'] = $this->rows;
        } else {
            $data['errorMessage'] = "Este usuario no tiene redes sociales";
        }
        return $data;
    }

    public function getSkillsByUsuarioId($id)
    {
        $id = (int) $id;
        $this->query = "SELECT * FROM skills WHERE usuarios_id = $id";
        $this->get_results_from_query();

        if (count($this->rows) > 0) {
            $data['skills'] = $this->rows;
        } else {
            $data['errorMessage'] = "Este usuario no tiene skills";
        }

        return $data;
    }

    public function getTrabajosByUsuarioId($id)
    {
        $id = (int) $id;
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = $id";
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            $data['trabajos'] = $this->rows;
        } else {
            $data['errorMessage'] = "No hay trabajos para este usuario";
        }
        return $data;
    }

    public function ponerCuentaOculta($id)
    {
        if ($_SESSION['usuarioActivo']['id'] == $id) {
            $id = (int) $id;
            $this->query = "UPDATE usuarios SET visible = 0 WHERE id = $id";
            $this->get_results_from_query();
            header('Location: /cuenta/' . $id);
            exit();
        } else {
            header('Location: /error');
            exit();
        }
    }

    public function ponerCuentaVisible($id)
    {
        if ($_SESSION['usuarioActivo']['id'] == $id) {
            $id = (int) $id;
            $this->query = "UPDATE usuarios SET visible = 1 WHERE id = $id";
            $this->get_results_from_query();
            header('Location: /cuenta/' . $id);
            exit();
        } else {
            header('Location: /error');
            exit();
        }
    }

    public function verificarCuenta($token)
    {
        $this->query = "SELECT fecha_creacion_token FROM usuarios WHERE token = '$token'";
        $this->get_results_from_query();
        if ($this->rows != 0) {
            $creada = $this->rows[0]['fecha_creacion_token'];
            $ahora = date('Y-m-d H:i:s');
            $diferencia = (strtotime($ahora) - strtotime($creada)) / 3600;
            if ($diferencia < 24) {
                $this->query = "UPDATE usuarios SET cuenta_activa = 1 WHERE token = '$token'";
                $this->get_results_from_query();
                return $data['success'] = "Cuenta activada correctamente";
            } else {
                return $data['errorMessage'] = "El token ha expirado";
            }
        } else {
            return "Token no válido.";
        }
    }

    public function cambiarImagen($imagen, $id)
    {
        $id = (int) $id;
        $nombreImagen = $imagen['name'];
        $tipoImagen = $imagen['type'];
        $tamanoImagen = $imagen['size'];
        $rutaImagen = $imagen['tmp_name'];
        var_dump($rutaImagen);
        $destino = "../public/img/" . $nombreImagen;
        var_dump($destino);
        if ($tamanoImagen <= 1000000) {
            if ($tipoImagen == "image/jpeg" || $tipoImagen == "image/jpg" || $tipoImagen == "image/png") {
                move_uploaded_file($rutaImagen, $destino);
                $this->query = "UPDATE usuarios SET foto = '$nombreImagen' WHERE id = $id";
                var_dump($this->query);
                $this->get_results_from_query();
                $_SESSION['data'] = "Imagen subida correctamente";
            } else {
                $_SESSION['error'] = "El formato de la imagen no es válido";
            }
        } else {
            $_SESSION['error'] = "La imagen es demasiado grande";
        }
    }

    // No se en qué caso se podría usar, preguntar a Jose (¿REGISTER?)

    public function set()
    {
        $this->query = "INSERT INTO usuarios (email, contrasena, nombre, apellidos, categoria_profesional, resumen_perfil, foto, fecha_creacion_token, cuenta_activa, token, visible) 
                        VALUES (:email, :contrasena, :nombre, :apellidos, :categoria_profesional, :resumen_perfil, :foto, CURRENT_TIMESTAMP, 0, :token, 1)";

        $this->parametros['email'] = $this->email;
        $this->parametros['contrasena'] = $this->contrasena;
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['apellidos'] = $this->apellidos;
        $this->parametros['categoria_profesional'] = $this->categoriaProfesional;
        $this->parametros['resumen_perfil'] = $this->resumenPerfil;
        $this->parametros['foto'] = $this->foto;
        $this->parametros['token'] = $this->token;

        try {
            $this->get_results_from_query();
            return ['success' => "Usuario creado correctamente"];
        } catch (\Exception $e) {
            return ['errorMessage' => "Error al crear el usuario: " . $e->getMessage()];
        }
    }

    // Por si se pudiese editar la información de un usuario
    public function edit()
    {
    }

    public function delete($id = '')
    {
        // $this->query = "DELETE FROM usuarios WHERE id = $id";
        // $this->get_results_from_query();
        // return true;
    }

}