<?php

namespace App\Models;
require_once('DBAbstractModel.php');

class Conductores extends DBAbstractModel
{
    private static $instancia;
    private $agenteId;
    private $nombreConductor;
    private $multas = [];

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

    public function getNombreConductor()
    {
        return $this->nombreConductor;
    }

    public function setNombreConductor($nombreConductor)
    {
        $this->nombreConductor = $nombreConductor;
    }

    public function getIdByName(){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuarioConductor";
        $this->parametros['usuarioConductor'] = $this->nombreConductor;
        $this->get_results_from_query();
        return $this->rows;
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

    public function getAll(){
        $this->query = "SELECT * FROM usuarios WHERE perfil = 'conductor'";
        $this->get_results_from_query();
        return $this->rows;
    }
}