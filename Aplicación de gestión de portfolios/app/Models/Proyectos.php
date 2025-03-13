<?php

namespace App\Models;
require_once("DBAbstractModel.php");

class Proyectos extends DBAbstractModel
{
    private static $instancia;
    private $id;
    private $titulo;
    private $descripcion;
    private $tecnologias;
    private $usuarios_id;
    private $created_at;
    private $idProyecto;

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

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setTecnologias($tecnologias)
    {
        $this->tecnologias = $tecnologias;
    }

    public function setUsuariosId($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function setIdProyecto($idProyecto)
    {
        $this->idProyecto = $idProyecto;
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

    public function getTecnologias()
    {
        return $this->tecnologias;
    }

    public function getUsuariosId()
    {
        return $this->usuarios_id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getIdProyecto()
    {
        return $this->idProyecto;
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM proyectos";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function get()
    {
        $this->query = "SELECT * FROM proyectos WHERE id = :idProyecto";
        $this->parametros['idProyecto'] = $this->idProyecto;
        $this->get_results_from_query();
        return $this->rows ? $this->rows[0] : null;
    }

    public function set()
    {
        $this->query = "INSERT INTO proyectos (titulo, descripcion, tecnologias, created_at, usuarios_id) 
                        VALUES (:titulo, :descripcion, :tecnologias, CURRENT_TIMESTAMP, :usuarios_id)";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['tecnologias'] = $this->tecnologias;
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
        return true;
    }

    public function delete()
    {
        $this->query = "DELETE FROM proyectos WHERE id = :idProyecto";
        $this->parametros['idProyecto'] = $this->idProyecto;
        $this->get_results_from_query();
        return true;
    }

    public function edit()
    {
        $this->query = "UPDATE proyectos 
                        SET titulo = :titulo, descripcion = :descripcion, tecnologias = :tecnologias 
                        WHERE id = :idProyecto";
        $this->parametros['idProyecto'] = $this->idProyecto ;
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['tecnologias'] = $this->tecnologias;
        $this->get_results_from_query();
        return true;
    }
}
