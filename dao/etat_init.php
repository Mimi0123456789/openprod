<?php

require_once(ROOT_PATH . "/dao/database.php");

class etat_initDAO
{
    private PDO $db;

    public function __construct()
    {
        $database = new database();
        $this->db = $database->connexion();
    }

    public function getAll(): array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM etat_init
            ORDER BY id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM etat_init
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $etat = $requete->fetch(PDO::FETCH_ASSOC);

        return $etat ?: null;
    }

    public function getByInterventionId(int $id_inter): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM etat_init
            WHERE id_inter = :id_inter
            LIMIT 1
        ");

        $requete->bindValue(":id_inter", $id_inter, PDO::PARAM_INT);
        $requete->execute();

        $etat = $requete->fetch(PDO::FETCH_ASSOC);

        return $etat ?: null;
    }

    public function add($etat): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO etat_init (
                id_inter,
                eg_propre,
                eg_ancien,
                eg_etatgene,
                eg_aspectgene,
                eg_aspectdesc,
                eg_rouille,
                eg_demontage,
                eg_fuite_mat,
                eg_avis_etatgene,
                mec_etatgene,
                mec_eta_entre_mat,
                mec_eta_entre_mat_pre,
                mec_eta_sorti_mat,
                mec_eta_sorti_mat_pre,
                mec_huile_fuit,
                mec_avis_tech,
                ele_etatgene,
                ele_etatcable,
                ele_etatprotec,
                ele_avis_tech,
                ele_resis_hs,
                ele_sonde_hs,
                th_etatgene,
                th_stable,
                th_inerti,
                th_test,
                th_temp_test,
                th_pilotage,
                th_avis_therm
            )
            VALUES (
                :id_inter,
                :eg_propre,
                :eg_ancien,
                :eg_etatgene,
                :eg_aspectgene,
                :eg_aspectdesc,
                :eg_rouille,
                :eg_demontage,
                :eg_fuite_mat,
                :eg_avis_etatgene,
                :mec_etatgene,
                :mec_eta_entre_mat,
                :mec_eta_entre_mat_pre,
                :mec_eta_sorti_mat,
                :mec_eta_sorti_mat_pre,
                :mec_huile_fuit,
                :mec_avis_tech,
                :ele_etatgene,
                :ele_etatcable,
                :ele_etatprotec,
                :ele_avis_tech,
                :ele_resis_hs,
                :ele_sonde_hs,
                :th_etatgene,
                :th_stable,
                :th_inerti,
                :th_test,
                :th_temp_test,
                :th_pilotage,
                :th_avis_therm
            )
        ");

        return $requete->execute([
            ":id_inter" => $etat->get_id_inter(),
            ":eg_propre" => $etat->get_eg_propre(),
            ":eg_ancien" => $etat->get_eg_ancien(),
            ":eg_etatgene" => $etat->get_eg_etatgene(),
            ":eg_aspectgene" => $etat->get_eg_aspectgene(),
            ":eg_aspectdesc" => $etat->get_eg_aspectdesc(),
            ":eg_rouille" => $etat->get_eg_rouille(),
            ":eg_demontage" => $etat->get_eg_demontage(),
            ":eg_fuite_mat" => $etat->get_eg_fuite_mat(),
            ":eg_avis_etatgene" => $etat->get_eg_avis_etatgene(),
            ":mec_etatgene" => $etat->get_mec_etatgene(),
            ":mec_eta_entre_mat" => $etat->get_mec_eta_entre_mat(),
            ":mec_eta_entre_mat_pre" => $etat->get_mec_eta_entre_mat_pre(),
            ":mec_eta_sorti_mat" => $etat->get_mec_eta_sorti_mat(),
            ":mec_eta_sorti_mat_pre" => $etat->get_mec_eta_sorti_mat_pre(),
            ":mec_huile_fuit" => $etat->get_mec_huile_fuit(),
            ":mec_avis_tech" => $etat->get_mec_avis_tech(),
            ":ele_etatgene" => $etat->get_ele_etatgene(),
            ":ele_etatcable" => $etat->get_ele_etatcable(),
            ":ele_etatprotec" => $etat->get_ele_etatprotec(),
            ":ele_avis_tech" => $etat->get_ele_avis_tech(),
            ":ele_resis_hs" => $etat->get_ele_resis_hs(),
            ":ele_sonde_hs" => $etat->get_ele_sonde_hs(),
            ":th_etatgene" => $etat->get_th_etatgene(),
            ":th_stable" => $etat->get_th_stable(),
            ":th_inerti" => $etat->get_th_inerti(),
            ":th_test" => $etat->get_th_test(),
            ":th_temp_test" => $etat->get_th_temp_test(),
            ":th_pilotage" => $etat->get_th_pilotage(),
            ":th_avis_therm" => $etat->get_th_avis_therm()
        ]);
    }

    public function update($etat): bool
    {
        $requete = $this->db->prepare("
            UPDATE etat_init
            SET
                eg_propre = :eg_propre,
                eg_ancien = :eg_ancien,
                eg_etatgene = :eg_etatgene,
                eg_aspectgene = :eg_aspectgene,
                eg_aspectdesc = :eg_aspectdesc,
                eg_rouille = :eg_rouille,
                eg_demontage = :eg_demontage,
                eg_fuite_mat = :eg_fuite_mat,
                eg_avis_etatgene = :eg_avis_etatgene,
                mec_etatgene = :mec_etatgene,
                mec_eta_entre_mat = :mec_eta_entre_mat,
                mec_eta_entre_mat_pre = :mec_eta_entre_mat_pre,
                mec_eta_sorti_mat = :mec_eta_sorti_mat,
                mec_eta_sorti_mat_pre = :mec_eta_sorti_mat_pre,
                mec_huile_fuit = :mec_huile_fuit,
                mec_avis_tech = :mec_avis_tech,
                ele_etatgene = :ele_etatgene,
                ele_etatcable = :ele_etatcable,
                ele_etatprotec = :ele_etatprotec,
                ele_avis_tech = :ele_avis_tech,
                ele_resis_hs = :ele_resis_hs,
                ele_sonde_hs = :ele_sonde_hs,
                th_etatgene = :th_etatgene,
                th_stable = :th_stable,
                th_inerti = :th_inerti,
                th_test = :th_test,
                th_temp_test = :th_temp_test,
                th_pilotage = :th_pilotage,
                th_avis_therm = :th_avis_therm
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $etat->get_id(),
            ":eg_propre" => $etat->get_eg_propre(),
            ":eg_ancien" => $etat->get_eg_ancien(),
            ":eg_etatgene" => $etat->get_eg_etatgene(),
            ":eg_aspectgene" => $etat->get_eg_aspectgene(),
            ":eg_aspectdesc" => $etat->get_eg_aspectdesc(),
            ":eg_rouille" => $etat->get_eg_rouille(),
            ":eg_demontage" => $etat->get_eg_demontage(),
            ":eg_fuite_mat" => $etat->get_eg_fuite_mat(),
            ":eg_avis_etatgene" => $etat->get_eg_avis_etatgene(),
            ":mec_etatgene" => $etat->get_mec_etatgene(),
            ":mec_eta_entre_mat" => $etat->get_mec_eta_entre_mat(),
            ":mec_eta_entre_mat_pre" => $etat->get_mec_eta_entre_mat_pre(),
            ":mec_eta_sorti_mat" => $etat->get_mec_eta_sorti_mat(),
            ":mec_eta_sorti_mat_pre" => $etat->get_mec_eta_sorti_mat_pre(),
            ":mec_huile_fuit" => $etat->get_mec_huile_fuit(),
            ":mec_avis_tech" => $etat->get_mec_avis_tech(),
            ":ele_etatgene" => $etat->get_ele_etatgene(),
            ":ele_etatcable" => $etat->get_ele_etatcable(),
            ":ele_etatprotec" => $etat->get_ele_etatprotec(),
            ":ele_avis_tech" => $etat->get_ele_avis_tech(),
            ":ele_resis_hs" => $etat->get_ele_resis_hs(),
            ":ele_sonde_hs" => $etat->get_ele_sonde_hs(),
            ":th_etatgene" => $etat->get_th_etatgene(),
            ":th_stable" => $etat->get_th_stable(),
            ":th_inerti" => $etat->get_th_inerti(),
            ":th_test" => $etat->get_th_test(),
            ":th_temp_test" => $etat->get_th_temp_test(),
            ":th_pilotage" => $etat->get_th_pilotage(),
            ":th_avis_therm" => $etat->get_th_avis_therm()
        ]);
    }

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM etat_init
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }
}