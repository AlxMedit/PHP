<?php

namespace App\Models;
require_once("DBAbstractModel.php");

class RRSS extends DBAbstractModel
{
    private static $instancia;
    private $id;
    private $red_social;
    private $url;
    private $usuarios_id;
    private $created_at;
    private $idRRSS;

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

    public function setRedSocial($red_social)
    {
        $this->red_social = $red_social;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setUsuariosId($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function setIdRRSS($idRRSS)
    {
        $this->idRRSS = $idRRSS;
    }

    // Getters

    public function getId()
    {
        return $this->id;
    }

    public function getRedSocial()
    {
        return $this->red_social;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getUsuariosId()
    {
        return $this->usuarios_id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getIdRRSS()
    {
        return $this->idRRSS;
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM redes_sociales";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function get()
    {
        $this->query = "SELECT * FROM redes_sociales WHERE id = :idRRSS";
        $this->parametros['idRRSS'] = $this->idRRSS;
        $this->get_results_from_query();
     
        return $this->rows ? $this->rows[0] : null;
    }

    public function set()
    {
        $this->query = "INSERT INTO redes_sociales (red_social, url, created_at, usuarios_id) 
                        VALUES (:red_social, :url, CURRENT_TIMESTAMP, :usuarios_id)";
        $this->parametros['red_social'] = $this->red_social;
        $this->parametros['url'] = $this->url;
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
        return true;
    }

    public function delete()
    {
        $this->query = "DELETE FROM redes_sociales WHERE id = :idRRSS";
        $this->parametros['idRRSS'] = $this->idRRSS;
        $this->get_results_from_query();
        return true;
    }

    public function edit()
    {
        $this->query = "UPDATE redes_sociales 
                        SET red_social = :red_social, url = :url 
                        WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->parametros['red_social'] = $this->red_social;
        $this->parametros['url'] = $this->url;
        $this->get_results_from_query();
        return true;
    }
}