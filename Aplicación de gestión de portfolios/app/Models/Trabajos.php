<?php

namespace App\Models;
require_once("DBAbstractModel.php");

class Trabajos extends DBAbstractModel
{

    private static $instancia;
    private $id;
    private $titulo;
    private $descripcion;
    private $fechaInicio;
    private $fechaFinal;
    private $logros;
    private $usuariosId;
    private $idTrabajo;
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
    public function getId()
    {
        return $this->id;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }
    public function getLogros()
    {
        return $this->logros;
    }
    public function getUsuariosId()
    {
        return $this->usuariosId;
    }
    public function getIdTrabajo()
    {
        return $this->idTrabajo;
    }

    // Setters
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;
    }
    public function setLogros($logros)
    {
        $this->logros = $logros;
    }
    public function setUsuariosId($usuariosId)
    {
        $this->usuariosId = $usuariosId;
    }
    public function setIdTrabajo($idTrabajo)
    {
        $this->idTrabajo = $idTrabajo;
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM trabajos";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set()
    {
        $this->query = "INSERT INTO trabajos (titulo, descripcion, fecha_inicio, fecha_final, logros, usuarios_id) VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_final, :logros, :usuarios_id)";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['fecha_inicio'] = $this->fechaInicio;
        $this->parametros['fecha_final'] = $this->fechaFinal;
        $this->parametros['logros'] = $this->logros;
        $this->parametros['usuarios_id'] = $this->usuariosId;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function get()
    {
        $this->query = "SELECT * FROM trabajos WHERE id = :idTrabajo";
        $this->parametros['idTrabajo'] = $this->idTrabajo;
        $this->get_results_from_query();
        return $this->rows ? $this->rows[0] : null;
    }

    public function delete()
    {
        $this->query = "DELETE FROM trabajos WHERE id = :idTrabajo";
        $this->parametros['idTrabajo'] = $this->idTrabajo;
        $this->get_results_from_query();
        return true;
    }

    public function edit()
    {
        $this->query = "UPDATE trabajos SET titulo = :titulo, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_final = :fecha_final, logros = :logros WHERE id = :idTrabajo";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['fecha_inicio'] = $this->fechaInicio;
        $this->parametros['fecha_final'] = $this->fechaFinal;
        $this->parametros['logros'] = $this->logros;
        $this->parametros['idTrabajo'] = $this->idTrabajo;
        $this->get_results_from_query();
        return true;
    }


}
?>