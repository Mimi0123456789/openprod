<?php

require_once(ROOT_PATH . "/dao/prises_init.php");

class prises_initModel
{
    private $id;
    private $id_eta_init;
    private $num_prise;

    private $type1;
    private $etat1;
    private $iso1;

    private $type2;
    private $etat2;
    private $iso2;

    private $type3;
    private $etat3;
    private $iso3;

    private $type4;
    private $etat4;
    private $iso4;

    private $type5;
    private $etat5;
    private $iso5;

    private $type6;
    private $etat6;
    private $iso6;

    private $type7;
    private $etat7;
    private $iso7;

    private $type8;
    private $etat8;
    private $iso8;

    private $dao;

    public function __construct()
    {
        $this->dao = new prises_initDAO();
    }

    // =========================
    // GETTERS
    // =========================

    public function get_id() { return $this->id; }
    public function get_id_eta_init() { return $this->id_eta_init; }
    public function get_num_prise() { return $this->num_prise; }

    public function get_type1() { return $this->type1; }
    public function get_etat1() { return $this->etat1; }
    public function get_iso1() { return $this->iso1; }

    public function get_type2() { return $this->type2; }
    public function get_etat2() { return $this->etat2; }
    public function get_iso2() { return $this->iso2; }

    public function get_type3() { return $this->type3; }
    public function get_etat3() { return $this->etat3; }
    public function get_iso3() { return $this->iso3; }

    public function get_type4() { return $this->type4; }
    public function get_etat4() { return $this->etat4; }
    public function get_iso4() { return $this->iso4; }

    public function get_type5() { return $this->type5; }
    public function get_etat5() { return $this->etat5; }
    public function get_iso5() { return $this->iso5; }

    public function get_type6() { return $this->type6; }
    public function get_etat6() { return $this->etat6; }
    public function get_iso6() { return $this->iso6; }

    public function get_type7() { return $this->type7; }
    public function get_etat7() { return $this->etat7; }
    public function get_iso7() { return $this->iso7; }

    public function get_type8() { return $this->type8; }
    public function get_etat8() { return $this->etat8; }
    public function get_iso8() { return $this->iso8; }

    // =========================
    // SETTERS
    // =========================

    public function set_id($valeur) { $this->id = $valeur; }
    public function set_id_eta_init($valeur) { $this->id_eta_init = $valeur; }
    public function set_num_prise($valeur) { $this->num_prise = $valeur; }

    public function set_type1($valeur) { $this->type1 = $valeur; }
    public function set_etat1($valeur) { $this->etat1 = $valeur; }
    public function set_iso1($valeur) { $this->iso1 = $valeur; }

    public function set_type2($valeur) { $this->type2 = $valeur; }
    public function set_etat2($valeur) { $this->etat2 = $valeur; }
    public function set_iso2($valeur) { $this->iso2 = $valeur; }

    public function set_type3($valeur) { $this->type3 = $valeur; }
    public function set_etat3($valeur) { $this->etat3 = $valeur; }
    public function set_iso3($valeur) { $this->iso3 = $valeur; }

    public function set_type4($valeur) { $this->type4 = $valeur; }
    public function set_etat4($valeur) { $this->etat4 = $valeur; }
    public function set_iso4($valeur) { $this->iso4 = $valeur; }

    public function set_type5($valeur) { $this->type5 = $valeur; }
    public function set_etat5($valeur) { $this->etat5 = $valeur; }
    public function set_iso5($valeur) { $this->iso5 = $valeur; }

    public function set_type6($valeur) { $this->type6 = $valeur; }
    public function set_etat6($valeur) { $this->etat6 = $valeur; }
    public function set_iso6($valeur) { $this->iso6 = $valeur; }

    public function set_type7($valeur) { $this->type7 = $valeur; }
    public function set_etat7($valeur) { $this->etat7 = $valeur; }
    public function set_iso7($valeur) { $this->iso7 = $valeur; }

    public function set_type8($valeur) { $this->type8 = $valeur; }
    public function set_etat8($valeur) { $this->etat8 = $valeur; }
    public function set_iso8($valeur) { $this->iso8 = $valeur; }

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

    public function add($prise)
    {
        return $this->dao->add($prise);
    }

    public function update($prise)
    {
        return $this->dao->update($prise);
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