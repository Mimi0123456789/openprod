<?php

require_once(ROOT_PATH . "/dao/tests.php");

class testsModel
{
    private $id;
    private $id_inter;

    private $tt_eg_propre;
    private $tt_eg_etatgene;
    private $tt_eg_avis_tech;

    private $tt_mec_etatgene;
    private $tt_mec_eta_entre_mat;
    private $tt_mec_eta_sorti_mat;
    private $tt_mec_huile_fuit;
    private $tt_mec_bleu;
    private $tt_mec_avis_tech;

    private $tt_ele_etatgene;
    private $tt_ele_etatcable;
    private $tt_ele_resit;
    private $tt_ele_sond;
    private $tt_ele_avis_tech;

    private $tt_th_etatgene;
    private $tt_th_stable;
    private $tt_th_inerti;
    private $tt_th_temp_test;
    private $tt_th_pilotage;
    private $tt_th_avis_therm;

    private $tt_date;
    private $tt_validation;
    private $tt_rec_obtu;
    private $tt_th_dur_mont;

    private $dao;

    public function __construct()
    {
        $this->dao = new testsDAO();
    }

    public function get_id() { return $this->id; }
    public function get_id_inter() { return $this->id_inter; }

    public function get_tt_eg_propre() { return $this->tt_eg_propre; }
    public function get_tt_eg_etatgene() { return $this->tt_eg_etatgene; }
    public function get_tt_eg_avis_tech() { return $this->tt_eg_avis_tech; }

    public function get_tt_mec_etatgene() { return $this->tt_mec_etatgene; }
    public function get_tt_mec_eta_entre_mat() { return $this->tt_mec_eta_entre_mat; }
    public function get_tt_mec_eta_sorti_mat() { return $this->tt_mec_eta_sorti_mat; }
    public function get_tt_mec_huile_fuit() { return $this->tt_mec_huile_fuit; }
    public function get_tt_mec_bleu() { return $this->tt_mec_bleu; }
    public function get_tt_mec_avis_tech() { return $this->tt_mec_avis_tech; }

    public function get_tt_ele_etatgene() { return $this->tt_ele_etatgene; }
    public function get_tt_ele_etatcable() { return $this->tt_ele_etatcable; }
    public function get_tt_ele_resit() { return $this->tt_ele_resit; }
    public function get_tt_ele_sond() { return $this->tt_ele_sond; }
    public function get_tt_ele_avis_tech() { return $this->tt_ele_avis_tech; }

    public function get_tt_th_etatgene() { return $this->tt_th_etatgene; }
    public function get_tt_th_stable() { return $this->tt_th_stable; }
    public function get_tt_th_inerti() { return $this->tt_th_inerti; }
    public function get_tt_th_temp_test() { return $this->tt_th_temp_test; }
    public function get_tt_th_pilotage() { return $this->tt_th_pilotage; }
    public function get_tt_th_avis_therm() { return $this->tt_th_avis_therm; }

    public function get_tt_date() { return $this->tt_date; }
    public function get_tt_validation() { return $this->tt_validation; }
    public function get_tt_rec_obtu() { return $this->tt_rec_obtu; }
    public function get_tt_th_dur_mont() { return $this->tt_th_dur_mont; }

    public function set_id($valeur) { $this->id = $valeur; }
    public function set_id_inter($valeur) { $this->id_inter = $valeur; }

    public function set_tt_eg_propre($valeur) { $this->tt_eg_propre = $valeur; }
    public function set_tt_eg_etatgene($valeur) { $this->tt_eg_etatgene = $valeur; }
    public function set_tt_eg_avis_tech($valeur) { $this->tt_eg_avis_tech = $valeur; }

    public function set_tt_mec_etatgene($valeur) { $this->tt_mec_etatgene = $valeur; }
    public function set_tt_mec_eta_entre_mat($valeur) { $this->tt_mec_eta_entre_mat = $valeur; }
    public function set_tt_mec_eta_sorti_mat($valeur) { $this->tt_mec_eta_sorti_mat = $valeur; }
    public function set_tt_mec_huile_fuit($valeur) { $this->tt_mec_huile_fuit = $valeur; }
    public function set_tt_mec_bleu($valeur) { $this->tt_mec_bleu = $valeur; }
    public function set_tt_mec_avis_tech($valeur) { $this->tt_mec_avis_tech = $valeur; }

    public function set_tt_ele_etatgene($valeur) { $this->tt_ele_etatgene = $valeur; }
    public function set_tt_ele_etatcable($valeur) { $this->tt_ele_etatcable = $valeur; }
    public function set_tt_ele_resit($valeur) { $this->tt_ele_resit = $valeur; }
    public function set_tt_ele_sond($valeur) { $this->tt_ele_sond = $valeur; }
    public function set_tt_ele_avis_tech($valeur) { $this->tt_ele_avis_tech = $valeur; }

    public function set_tt_th_etatgene($valeur) { $this->tt_th_etatgene = $valeur; }
    public function set_tt_th_stable($valeur) { $this->tt_th_stable = $valeur; }
    public function set_tt_th_inerti($valeur) { $this->tt_th_inerti = $valeur; }
    public function set_tt_th_temp_test($valeur) { $this->tt_th_temp_test = $valeur; }
    public function set_tt_th_pilotage($valeur) { $this->tt_th_pilotage = $valeur; }
    public function set_tt_th_avis_therm($valeur) { $this->tt_th_avis_therm = $valeur; }

    public function set_tt_date($valeur) { $this->tt_date = $valeur; }
    public function set_tt_validation($valeur) { $this->tt_validation = $valeur; }
    public function set_tt_rec_obtu($valeur) { $this->tt_rec_obtu = $valeur; }
    public function set_tt_th_dur_mont($valeur) { $this->tt_th_dur_mont = $valeur; }

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

    public function add($test)
    {
        return $this->dao->add($test);
    }

    public function update($test)
    {
        return $this->dao->update($test);
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