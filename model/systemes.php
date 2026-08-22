<?php

require_once(ROOT_PATH . "/dao/systemes.php");

class systemesModel
{
    private $id;
    private $id_inter;
    private $reference;
    private $marque;
    private $type;
    private $num_immat_sys;
    private $nbr_pt;
    private $mat_inject;
    private $temp_inject;
    private $obturation;
    private $nbr_obtu;
    private $type_obturation;
    private $embout;
    private $nbr_resistance;
    private $nbr_sonde;
    private $nbr_prise;
    private $description;

    private $dao;

    public function __construct()
    {
        $this->dao = new systemesDAO();
    }

    public function get_id() { return $this->id; }
    public function get_id_inter() { return $this->id_inter; }
    public function get_reference() { return $this->reference; }
    public function get_marque() { return $this->marque; }
    public function get_type() { return $this->type; }
    public function get_num_immat_sys() { return $this->num_immat_sys; }
    public function get_nbr_pt() { return $this->nbr_pt; }
    public function get_mat_inject() { return $this->mat_inject; }
    public function get_temp_inject() { return $this->temp_inject; }
    public function get_obturation() { return $this->obturation; }
    public function get_nbr_obtu() { return $this->nbr_obtu; }
    public function get_type_obturation() { return $this->type_obturation; }
    public function get_embout() { return $this->embout; }
    public function get_nbr_resistance() { return $this->nbr_resistance; }
    public function get_nbr_sonde() { return $this->nbr_sonde; }
    public function get_nbr_prise() { return $this->nbr_prise; }
    public function get_description() { return $this->description; }

    public function set_id($valeur) { $this->id = $valeur; }
    public function set_id_inter($valeur) { $this->id_inter = $valeur; }
    public function set_reference($valeur) { $this->reference = $valeur; }
    public function set_marque($valeur) { $this->marque = $valeur; }
    public function set_type($valeur) { $this->type = $valeur; }
    public function set_num_immat_sys($valeur) { $this->num_immat_sys = $valeur; }
    public function set_nbr_pt($valeur) { $this->nbr_pt = $valeur; }
    public function set_mat_inject($valeur) { $this->mat_inject = $valeur; }
    public function set_temp_inject($valeur) { $this->temp_inject = $valeur; }
    public function set_obturation($valeur) { $this->obturation = $valeur; }
    public function set_nbr_obtu($valeur) { $this->nbr_obtu = $valeur; }
    public function set_type_obturation($valeur) { $this->type_obturation = $valeur; }
    public function set_embout($valeur) { $this->embout = $valeur; }
    public function set_nbr_resistance($valeur) { $this->nbr_resistance = $valeur; }
    public function set_nbr_sonde($valeur) { $this->nbr_sonde = $valeur; }
    public function set_nbr_prise($valeur) { $this->nbr_prise = $valeur; }
    public function set_description($valeur) { $this->description = $valeur; }

    public function getAll()
    {
        return $this->dao->getAll();
    }

    public function getById($id)
    {
        return $this->dao->getById((int)$id);
    }

    public function getByInterventionId($id_inter)
    {
        return $this->dao->getByInterventionId((int)$id_inter);
    }

    public function add($systeme)
    {
        return $this->dao->add($systeme);
    }

    public function update($systeme)
    {
        return $this->dao->update($systeme);
    }

    public function updateByInterventionId($systeme)
    {
        return $this->dao->updateByInterventionId($systeme);
    }

    public function delete($id)
    {
        return $this->dao->delete((int)$id);
    }
}
?>