<?php

namespace App\Models;
require_once('DBAbstractModel.php');

class Multas extends DBAbstractModel
{
    private static $instancia;
    private $idConductor;
    private $idMulta;
    private $agenteId;
    private $matricula;
    private $fecha;
    private $tipoSancion;
    private $descripcion;
    private $conductor;
    private $importe;   
    private $idTipoSancion;
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

    public function getIdConductor()
    {
        return $this->idConductor;
    }
    public function setIdConductor($id)
    {
        $this->idConductor = $id;
    }

    public function getIdMulta()
    {
        return $this->idMulta;
    }
    public function setIdMulta($idMulta)
    {
        $this->idMulta = $idMulta;
    }
    public function getAgenteId()
    {
        return $this->agenteId;
    }

    public function setAgenteId($agenteId)
    {
        $this->agenteId = $agenteId;
    }

    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }
    public function getMatricula()
    {
        return $this->matricula;
    }

    public function setConductor($conductor)
    {
        $this->conductor = $conductor;
    }

    public function getConductor()
    {
        return $this->conductor;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setTipoSancion($tipoSancion)
    {
        $this->tipoSancion = $tipoSancion;
    }
    public function getTipoSancion()
    {
        return $this->tipoSancion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setImporte($importe){
        $this->importe = $importe;
    }
    public function getImporte(){
        return $this->importe;
    }

    public function set()
    {
        $this->query = "INSERT INTO multas (id_agente, id_conductor, matricula, id_tipo_sanciones, descripcion, fecha, importe, descuento, estado) VALUES (:idAgente, :idConductor, :matricula, :idTipoSanciones, :descripcion, :fecha, :importe, 0, 'Pendiente')";
        $this->parametros['idAgente'] = $this->agenteId;
        $this->parametros['idConductor'] = $this->conductor;
        $this->parametros['matricula'] = $this->matricula;
        $this->parametros['idTipoSanciones'] = $this->tipoSancion;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['fecha'] = $this->fecha;
        $this->parametros['importe'] = $this->importe;

        $this->get_results_from_query();
    }   

    public function obtenerSancion(){
        $this->query = "SELECT * FROM tipo_sanciones WHERE id = :idTipoSancion";
        $this->parametros['idTipoSancion'] = $this->tipoSancion;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function delete()
    {
    }
    public function edit()
    {
    }
    public function get()
    {
        $this->query = "SELECT * FROM multas WHERE id = :idMulta";
        $this->parametros['idMulta'] = $this->idMulta;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return $this->rows;
        } else {
            return null;
        }
    }
    public function getMultas()
    {
        $this->query = "SELECT * FROM multas WHERE id_conductor = :idConductor";
        $this->parametros['idConductor'] = $this->idConductor;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return $this->rows;
        } else {
            return null;
        }
    }

    public function multaExiste()
    {
        $this->query = "SELECT * FROM multas where id = :idMulta";
        $this->parametros['idMulta'] = $this->idMulta;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function multasAgente()
    {
        $this->query = "SELECT * FROM multas where id_agente = :idAgente";
        $this->parametros["idAgente"] = $this->agenteId;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return $this->rows;
        } else {
            return null;
        }
    }

    public function getAll(){
        $this->query = "SELECT * FROM multas";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function obtenerCantidadByConductor($id){
        $this->query = "SELECT COUNT(*) as cantidad FROM multas WHERE id_conductor = $id";
        $this->get_results_from_query();
        return $this->rows;
    }

}