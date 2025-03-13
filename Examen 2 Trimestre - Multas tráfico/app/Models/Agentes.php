<?php

namespace App\Models;
require_once('DBAbstractModel.php');

class Agentes extends DBAbstractModel
{
    private static $instancia;
    private $agenteId;
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

    public function getMultas()
    {
        return $this->multas;
    }
    public function setMultas($multa)
    {
        $this->multas[] = $multa;
    }

    public function getAgenteId(){
        return $this->agenteId;
    }

    public function setAgenteId($agenteId)
    {
        $this->agenteId = $agenteId;
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

    public function getMultasByAgente(){
    }
}