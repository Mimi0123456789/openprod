<?php

require_once(ROOT_PATH . "/dao/fonctions.php");

class fonctionsModel
{
    private $id;
    private $libelle_fct;

    private $dao;

    public function __construct()
    {
        $this->dao = new fonctionsDAO();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_libelle_fct()
    {
        return $this->libelle_fct;
    }

    public function set_id($valeur)
    {
        $this->id = $valeur;
    }

    public function set_libelle_fct($valeur)
    {
        $this->libelle_fct = $valeur;
    }

    public function getAll()
    {
        return $this->dao->getAll();
    }

    public function getById($id)
    {
        return $this->dao->getById($id);
    }

    public function add($libelle_fct)
    {
        return $this->dao->add($libelle_fct);
    }

    public function update($id, $libelle_fct)
    {
        return $this->dao->update($id, $libelle_fct);
    }

    public function delete($id)
    {
        return $this->dao->delete($id);
    }
}
?>