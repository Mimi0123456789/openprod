<?php

require_once(ROOT_PATH . "/dao/obturateurs_init.php");

class obturateurs_initModel
{
    private $id;
    private $id_eta_init;
    private $num_obtu;
    private $jeu_obtu;
    private $jeu_guide;
    private $etat_obtu;
    private $etat_guide;
    private $attel_etat;

    private $dao;

    public function __construct()
    {
        $this->dao = new obturateurs_initDAO();
    }

    // =========================
    // GETTERS
    // =========================

    public function get_id() { return $this->id; }
    public function get_id_eta_init() { return $this->id_eta_init; }
    public function get_num_obtu() { return $this->num_obtu; }
    public function get_jeu_obtu() { return $this->jeu_obtu; }
    public function get_jeu_guide() { return $this->jeu_guide; }
    public function get_etat_obtu() { return $this->etat_obtu; }
    public function get_etat_guide() { return $this->etat_guide; }
    public function get_attel_etat() { return $this->attel_etat; }

    // =========================
    // SETTERS
    // =========================

    public function set_id($valeur) { $this->id = $valeur; }
    public function set_id_eta_init($valeur) { $this->id_eta_init = $valeur; }
    public function set_num_obtu($valeur) { $this->num_obtu = $valeur; }
    public function set_jeu_obtu($valeur) { $this->jeu_obtu = $valeur; }
    public function set_jeu_guide($valeur) { $this->jeu_guide = $valeur; }
    public function set_etat_obtu($valeur) { $this->etat_obtu = $valeur; }
    public function set_etat_guide($valeur) { $this->etat_guide = $valeur; }
    public function set_attel_etat($valeur) { $this->attel_etat = $valeur; }

    // =========================
    // DAO METHODS
    // =========================

    public function getAll()
    {
        return $this->dao->getAll();
    }

    public function getById($id)
    {
        return $this->dao->getById((int)$id);
    }

    public function getByEtatInit($id_eta_init)
    {
        return $this->dao->getByEtatInit((int)$id_eta_init);
    }

    public function add($obturateur)
    {
        return $this->dao->add($obturateur);
    }

    public function update($obturateur)
    {
        return $this->dao->update($obturateur);
    }

    public function delete($id)
    {
        return $this->dao->delete((int)$id);
    }

    public function deleteByEtatInit($id_eta_init)
    {
        return $this->dao->deleteByEtatInit((int)$id_eta_init);
    }
}

?>