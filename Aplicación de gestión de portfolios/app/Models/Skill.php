<?php

namespace App\Models;
require_once("DBAbstractModel.php");

class Skill extends DBAbstractModel
{
    private static $instancia;
    private $id;
    private $habilidades;
    private $categorias_skills_categoria;
    private $usuarios_id;
    private $visible;
    private $created_at;
    private $updated_at;
    private $idSkill;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación no está permitida!', E_USER_ERROR);
    }

    // Getters
    public function getId() { return $this->id; }
    public function getHabilidades() { return $this->habilidades; }
    public function getCategoriasSkillsCategoria() { return $this->categorias_skills_categoria; }
    public function getUsuariosId() { return $this->usuarios_id; }
    public function getVisible() { return $this->visible; }
    public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }
    public function getIdSkill() { return $this->idSkill; }

    // Setters
    public function setHabilidades($habilidades) { $this->habilidades = $habilidades; }
    public function setCategoriasSkillsCategoria($categoria) { $this->categorias_skills_categoria = $categoria; }
    public function setUsuariosId($usuarios_id) { $this->usuarios_id = $usuarios_id; }
    public function setVisible($visible) { $this->visible = $visible; }
    public function setCreatedAt($created_at) { $this->created_at = $created_at; }
    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; }
    public function setIdSkill($idSkill) { $this->idSkill = $idSkill; }

    // Métodos de base de datos
    public function getAll()
    {
        $this->query = "SELECT * FROM skills";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getCategorias()
    {
        $this->query = "SELECT * FROM categorias_skills";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set()
    {
        $this->query = "INSERT INTO skills (habilidades, visible, categorias_skills_categoria, created_at, updated_at, usuarios_id) 
                        VALUES (:habilidades, 1, :categorias_skills_categoria, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :usuarios_id)";
        $this->parametros['habilidades'] = $this->habilidades;
        $this->parametros['categorias_skills_categoria'] = $this->categorias_skills_categoria;
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
    }

    public function get()
    {
        $this->query = "SELECT * FROM skills WHERE id = :idSkill";
        $this->parametros['idSkill'] = $this->idSkill;
        $this->get_results_from_query();
        return $this->rows ? $this->rows[0] : null;
    }

    public function delete()
    {
        $this->query = "DELETE FROM skills WHERE id = :idSkill";
        $this->parametros['idSkill'] = $this->idSkill;
        $this->get_results_from_query();
        return true;
    }

    public function edit()
    {
        $this->query = "UPDATE skills SET habilidades = :habilidades, categorias_skills_categoria = :categorias_skills_categoria WHERE id = :idSkill";
        $this->parametros['idSkill'] = $this->idSkill;
        $this->parametros['habilidades'] = $this->habilidades;
        $this->parametros['categorias_skills_categoria'] = $this->categorias_skills_categoria;
        $this->get_results_from_query();
        return true;
    }
}
?>
