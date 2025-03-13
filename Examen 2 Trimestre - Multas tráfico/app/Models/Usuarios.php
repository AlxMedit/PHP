<?php

namespace App\Models;
require_once('DBAbstractModel.php');

class Usuarios extends DBAbstractModel
{
    private static $instancia;
    private $nombre;
    private $usuario;
    private $contrasena;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación no es permitida!', E_USER_ERROR);
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getContrasena()
    {
        return $this->contrasena;
    }
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function set()
    {

    }
    public function delete()
    {
    }
    public function edit()
    {
    }
    public function get()
    {
    }

    public function login(){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :contrasena";
        $this->parametros['usuario'] = $this->usuario;
        $this->parametros['contrasena'] = $this->contrasena;  
        $this->get_results_from_query();
        if (count($this->rows) == 1){
            $data['usuario'] = $this->rows[0];
        } else {
            $data = null;
        }
        return $data;
    }

    public function getAllConductores(){
        $this->query = "SELECT * FROM usuarios WHERE perfil = 'conductor'";
        $this->get_results_from_query();
        return $this->rows;
    }

}