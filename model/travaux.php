<?php

require_once(ROOT_PATH . "/dao/travaux.php");

class travauxModel
{
    private $id;
    private $id_inter;
    private $id_av_trav;
    private $passage_four;
    private $chang_resistance;
    private $nbr_chang_resistance;
    private $chang_sonde;
    private $nbr_chang_sonde;
    private $nettoyage;
    private $modif_cablage_elec;
    private $modif_cir_eau;
    private $modif_cir_huile;
    private $modif_cir_elec;
    private $modif_cir_air;
    private $modif_meca;
    private $modif_meca_tete;
    private $nbr_modif_meca_tete;
    private $modif_meca_rectif;
    private $nbr_modif_meca_rectif;
    private $modif_meca_corp;
    private $desc_modif_meca_corp;

    private $dao;

    public function __construct()
    {
        $this->dao = new travauxDAO();
    }

    public function get_id() { return $this->id; }
    public function get_id_inter() { return $this->id_inter; }
    public function get_id_av_trav() { return $this->id_av_trav; }
    public function get_passage_four() { return $this->passage_four; }
    public function get_chang_resistance() { return $this->chang_resistance; }
    public function get_nbr_chang_resistance() { return $this->nbr_chang_resistance; }
    public function get_chang_sonde() { return $this->chang_sonde; }
    public function get_nbr_chang_sonde() { return $this->nbr_chang_sonde; }
    public function get_nettoyage() { return $this->nettoyage; }
    public function get_modif_cablage_elec() { return $this->modif_cablage_elec; }
    public function get_modif_cir_eau() { return $this->modif_cir_eau; }
    public function get_modif_cir_huile() { return $this->modif_cir_huile; }
    public function get_modif_cir_elec() { return $this->modif_cir_elec; }
    public function get_modif_cir_air() { return $this->modif_cir_air; }
    public function get_modif_meca() { return $this->modif_meca; }
    public function get_modif_meca_tete() { return $this->modif_meca_tete; }
    public function get_nbr_modif_meca_tete() { return $this->nbr_modif_meca_tete; }
    public function get_modif_meca_rectif() { return $this->modif_meca_rectif; }
    public function get_nbr_modif_meca_rectif() { return $this->nbr_modif_meca_rectif; }
    public function get_modif_meca_corp() { return $this->modif_meca_corp; }
    public function get_desc_modif_meca_corp() { return $this->desc_modif_meca_corp; }

    public function set_id($valeur) { $this->id = $valeur; }
    public function set_id_inter($valeur) { $this->id_inter = $valeur; }
    public function set_id_av_trav($valeur) { $this->id_av_trav = $valeur; }
    public function set_passage_four($valeur) { $this->passage_four = $valeur; }
    public function set_chang_resistance($valeur) { $this->chang_resistance = $valeur; }
    public function set_nbr_chang_resistance($valeur) { $this->nbr_chang_resistance = $valeur; }
    public function set_chang_sonde($valeur) { $this->chang_sonde = $valeur; }
    public function set_nbr_chang_sonde($valeur) { $this->nbr_chang_sonde = $valeur; }
    public function set_nettoyage($valeur) { $this->nettoyage = $valeur; }
    public function set_modif_cablage_elec($valeur) { $this->modif_cablage_elec = $valeur; }
    public function set_modif_cir_eau($valeur) { $this->modif_cir_eau = $valeur; }
    public function set_modif_cir_huile($valeur) { $this->modif_cir_huile = $valeur; }
    public function set_modif_cir_elec($valeur) { $this->modif_cir_elec = $valeur; }
    public function set_modif_cir_air($valeur) { $this->modif_cir_air = $valeur; }
    public function set_modif_meca($valeur) { $this->modif_meca = $valeur; }
    public function set_modif_meca_tete($valeur) { $this->modif_meca_tete = $valeur; }
    public function set_nbr_modif_meca_tete($valeur) { $this->nbr_modif_meca_tete = $valeur; }
    public function set_modif_meca_rectif($valeur) { $this->modif_meca_rectif = $valeur; }
    public function set_nbr_modif_meca_rectif($valeur) { $this->nbr_modif_meca_rectif = $valeur; }
    public function set_modif_meca_corp($valeur) { $this->modif_meca_corp = $valeur; }
    public function set_desc_modif_meca_corp($valeur) { $this->desc_modif_meca_corp = $valeur; }

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

    public function add($travaux)
    {
        return $this->dao->add($travaux);
    }

    public function update($travaux)
    {
        return $this->dao->update($travaux);
    }

    public function delete($id)
    {
        return $this->dao->delete((int)$id);
    }

    public function deleteByInterventionId($id_inter)
    {
        return $this->dao->deleteByInterventionId((int)$id_inter);
    }
}

?>