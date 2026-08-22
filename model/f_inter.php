<?php

require_once(ROOT_PATH . "/dao/f_inter.php");

class f_interModel
{
    private $id;
    private $id_clients;
    private $id_responsable;
    private $id_priorite;
    private $date_crea;
    private $facturation;
    private $date_max;
    private $id_avancements;
    private $visa_intervenant;
    private $demande;
    private $lieu;
    private $num_devis;
    private $anomalie;
    private $date_debut;
    private $date_fin;
    private $id_intervenant;
    private $desc_travaux;
    private $conclu;
    private $duree_init;
    private $duree_trav;
    private $duree_cont;
    private $visa_client;
    private $comm_client;
    private $comm_inter;

    private $dao;

    public function __construct()
    {
        $this->dao = new f_interDAO();
    }

    // =========================
    // GETTERS
    // =========================

    public function get_id() { return $this->id; }
    public function get_id_clients() { return $this->id_clients; }
    public function get_id_responsable() { return $this->id_responsable; }
    public function get_id_priorite() { return $this->id_priorite; }
    public function get_date_crea() { return $this->date_crea; }
    public function get_facturation() { return $this->facturation; }
    public function get_date_max() { return $this->date_max; }
    public function get_id_avancements() { return $this->id_avancements; }
    public function get_visa_intervenant() { return $this->visa_intervenant; }
    public function get_demande() { return $this->demande; }
    public function get_lieu() { return $this->lieu; }
    public function get_num_devis() { return $this->num_devis; }
    public function get_anomalie() { return $this->anomalie; }
    public function get_date_debut() { return $this->date_debut; }
    public function get_date_fin() { return $this->date_fin; }
    public function get_id_intervenant() { return $this->id_intervenant; }
    public function get_desc_travaux() { return $this->desc_travaux; }
    public function get_conclu() { return $this->conclu; }
    public function get_duree_init() { return $this->duree_init; }
    public function get_duree_trav() { return $this->duree_trav; }
    public function get_duree_cont() { return $this->duree_cont; }
    public function get_visa_client() { return $this->visa_client; }
    public function get_comm_client() { return $this->comm_client; }
    public function get_comm_inter() { return $this->comm_inter; }

    // =========================
    // SETTERS
    // =========================

    public function set_id($valeur) { $this->id = $valeur; }
    public function set_id_clients($valeur) { $this->id_clients = $valeur; }
    public function set_id_responsable($valeur) { $this->id_responsable = $valeur; }
    public function set_id_priorite($valeur) { $this->id_priorite = $valeur; }
    public function set_date_crea($valeur) { $this->date_crea = $valeur; }
    public function set_facturation($valeur) { $this->facturation = $valeur; }
    public function set_date_max($valeur) { $this->date_max = $valeur; }
    public function set_id_avancements($valeur) { $this->id_avancements = $valeur; }
    public function set_visa_intervenant($valeur) { $this->visa_intervenant = $valeur; }
    public function set_demande($valeur) { $this->demande = $valeur; }
    public function set_lieu($valeur) { $this->lieu = $valeur; }
    public function set_num_devis($valeur) { $this->num_devis = $valeur; }
    public function set_anomalie($valeur) { $this->anomalie = $valeur; }
    public function set_date_debut($valeur) { $this->date_debut = $valeur; }
    public function set_date_fin($valeur) { $this->date_fin = $valeur; }
    public function set_id_intervenant($valeur) { $this->id_intervenant = $valeur; }
    public function set_desc_travaux($valeur) { $this->desc_travaux = $valeur; }
    public function set_conclu($valeur) { $this->conclu = $valeur; }
    public function set_duree_init($valeur) { $this->duree_init = $valeur; }
    public function set_duree_trav($valeur) { $this->duree_trav = $valeur; }
    public function set_duree_cont($valeur) { $this->duree_cont = $valeur; }
    public function set_visa_client($valeur) { $this->visa_client = $valeur; }
    public function set_comm_client($valeur) { $this->comm_client = $valeur; }
    public function set_comm_inter($valeur) { $this->comm_inter = $valeur; }

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

    public function getEnCours()
    {
        return $this->dao->getEnCours();
    }

    public function getCloturees()
    {
        return $this->dao->getCloturees();
    }

    public function add($intervention)
    {
        return $this->dao->add($intervention);
    }

    public function update($intervention)
    {
        return $this->dao->update($intervention);
    }

    public function updateGeneral($intervention)
    {
        return $this->dao->updateGeneral($intervention);
    }

    public function updateValidation($intervention)
    {
        return $this->dao->updateValidation($intervention);
    }

    public function getEnCoursAvecDetails()
    {
        return $this->dao->getEnCoursAvecDetails();
    }

    public function getClotureAvecDetails()
    {
        return $this->dao->getClotureAvecDetails();
    }

    public function delete($id)
    {
        return $this->dao->delete((int)$id);
    }

    public function getEtatAvancementClient(int $id_inter, string $c_postal, ?string $client_num = null ): ?array
    {
        return $this->dao->getEtatAvancementClient(
            $id_inter,
            $c_postal,
            $client_num
        );
    }
}
?>