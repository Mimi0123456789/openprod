<?php

require_once(ROOT_PATH . "/dao/etat_init.php");

class etat_initModel
{
    private $id;
    private $id_inter;

    private $eg_propre;
    private $eg_ancien;
    private $eg_etatgene;
    private $eg_aspectgene;
    private $eg_aspectdesc;
    private $eg_rouille;
    private $eg_demontage;
    private $eg_fuite_mat;
    private $eg_avis_etatgene;

    private $mec_etatgene;
    private $mec_eta_entre_mat;
    private $mec_eta_entre_mat_pre;
    private $mec_eta_sorti_mat;
    private $mec_eta_sorti_mat_pre;
    private $mec_huile_fuit;
    private $mec_avis_tech;

    private $ele_etatgene;
    private $ele_etatcable;
    private $ele_etatprotec;
    private $ele_avis_tech;
    private $ele_resis_hs;
    private $ele_sonde_hs;

    private $th_etatgene;
    private $th_stable;
    private $th_inerti;
    private $th_test;
    private $th_temp_test;
    private $th_pilotage;
    private $th_avis_therm;

    private $dao;

    public function __construct()
    {
        $this->dao = new etat_initDAO();
    }
    
    public function getByInterventionId($id_inter)
    {
        return $this->dao->getByInterventionId((int)$id_inter);
    }

    // =========================
    // GETTERS
    // =========================

    public function get_id() { return $this->id; }
    public function get_id_inter() { return $this->id_inter; }
    public function get_eg_propre() { return $this->eg_propre; }
    public function get_eg_ancien() { return $this->eg_ancien; }
    public function get_eg_etatgene() { return $this->eg_etatgene; }
    public function get_eg_aspectgene() { return $this->eg_aspectgene; }
    public function get_eg_aspectdesc() { return $this->eg_aspectdesc; }
    public function get_eg_rouille() { return $this->eg_rouille; }
    public function get_eg_demontage() { return $this->eg_demontage; }
    public function get_eg_fuite_mat() { return $this->eg_fuite_mat; }
    public function get_eg_avis_etatgene() { return $this->eg_avis_etatgene; }

    public function get_mec_etatgene() { return $this->mec_etatgene; }
    public function get_mec_eta_entre_mat() { return $this->mec_eta_entre_mat; }
    public function get_mec_eta_entre_mat_pre() { return $this->mec_eta_entre_mat_pre; }
    public function get_mec_eta_sorti_mat() { return $this->mec_eta_sorti_mat; }
    public function get_mec_eta_sorti_mat_pre() { return $this->mec_eta_sorti_mat_pre; }
    public function get_mec_huile_fuit() { return $this->mec_huile_fuit; }
    public function get_mec_avis_tech() { return $this->mec_avis_tech; }

    public function get_ele_etatgene() { return $this->ele_etatgene; }
    public function get_ele_etatcable() { return $this->ele_etatcable; }
    public function get_ele_etatprotec() { return $this->ele_etatprotec; }
    public function get_ele_avis_tech() { return $this->ele_avis_tech; }
    public function get_ele_resis_hs() { return $this->ele_resis_hs; }
    public function get_ele_sonde_hs() { return $this->ele_sonde_hs; }

    public function get_th_etatgene() { return $this->th_etatgene; }
    public function get_th_stable() { return $this->th_stable; }
    public function get_th_inerti() { return $this->th_inerti; }
    public function get_th_test() { return $this->th_test; }
    public function get_th_temp_test() { return $this->th_temp_test; }
    public function get_th_pilotage() { return $this->th_pilotage; }
    public function get_th_avis_therm() { return $this->th_avis_therm; }
    


    // =========================
    // SETTERS
    // =========================

    public function set_id($valeur) { $this->id = $valeur; }

    public function set_eg_propre($valeur) { $this->eg_propre = $valeur; }
    public function set_eg_ancien($valeur) { $this->eg_ancien = $valeur; }
    public function set_eg_etatgene($valeur) { $this->eg_etatgene = $valeur; }
    public function set_eg_aspectgene($valeur) { $this->eg_aspectgene = $valeur; }
    public function set_eg_aspectdesc($valeur) { $this->eg_aspectdesc = $valeur; }
    public function set_eg_rouille($valeur) { $this->eg_rouille = $valeur; }
    public function set_eg_demontage($valeur) { $this->eg_demontage = $valeur; }
    public function set_eg_fuite_mat($valeur) { $this->eg_fuite_mat = $valeur; }
    public function set_eg_avis_etatgene($valeur) { $this->eg_avis_etatgene = $valeur; }

    public function set_mec_etatgene($valeur) { $this->mec_etatgene = $valeur; }
    public function set_mec_eta_entre_mat($valeur) { $this->mec_eta_entre_mat = $valeur; }
    public function set_mec_eta_entre_mat_pre($valeur) { $this->mec_eta_entre_mat_pre = $valeur; }
    public function set_mec_eta_sorti_mat($valeur) { $this->mec_eta_sorti_mat = $valeur; }
    public function set_mec_eta_sorti_mat_pre($valeur) { $this->mec_eta_sorti_mat_pre = $valeur; }
    public function set_mec_huile_fuit($valeur) { $this->mec_huile_fuit = $valeur; }
    public function set_mec_avis_tech($valeur) { $this->mec_avis_tech = $valeur; }

    public function set_ele_etatgene($valeur) { $this->ele_etatgene = $valeur; }
    public function set_ele_etatcable($valeur) { $this->ele_etatcable = $valeur; }
    public function set_ele_etatprotec($valeur) { $this->ele_etatprotec = $valeur; }
    public function set_ele_avis_tech($valeur) { $this->ele_avis_tech = $valeur; }
    public function set_ele_resis_hs($valeur) { $this->ele_resis_hs = $valeur; }
    public function set_ele_sonde_hs($valeur) { $this->ele_sonde_hs = $valeur; }

    public function set_th_etatgene($valeur) { $this->th_etatgene = $valeur; }
    public function set_th_stable($valeur) { $this->th_stable = $valeur; }
    public function set_th_inerti($valeur) { $this->th_inerti = $valeur; }
    public function set_th_test($valeur) { $this->th_test = $valeur; }
    public function set_th_temp_test($valeur) { $this->th_temp_test = $valeur; }
    public function set_th_pilotage($valeur) { $this->th_pilotage = $valeur; }
    public function set_th_avis_therm($valeur) { $this->th_avis_therm = $valeur; }
    public function set_id_inter($valeur) { $this->id_inter = $valeur; }

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

    public function add($etat)
    {
        return $this->dao->add($etat);
    }

    public function update($etat)
    {
        return $this->dao->update($etat);
    }

    public function delete($id)
    {
        return $this->dao->delete((int)$id);
    }
}

?>