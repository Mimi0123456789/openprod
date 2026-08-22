<?php

require_once(ROOT_PATH . "/dao/database.php");

class testsDAO
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
            FROM tests
            ORDER BY id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM tests
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $test = $requete->fetch(PDO::FETCH_ASSOC);

        return $test ?: null;
    }

    public function getByInterventionId(int $id_inter): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM tests
            WHERE id_inter = :id_inter
            LIMIT 1
        ");

        $requete->bindValue(":id_inter", $id_inter, PDO::PARAM_INT);
        $requete->execute();

        $test = $requete->fetch(PDO::FETCH_ASSOC);

        return $test ?: null;
    }

    public function add($test): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO tests (
                id_inter,
                tt_eg_propre,
                tt_eg_etatgene,
                tt_eg_avis_tech,
                tt_mec_etatgene,
                tt_mec_eta_entre_mat,
                tt_mec_eta_sorti_mat,
                tt_mec_huile_fuit,
                tt_mec_bleu,
                tt_mec_avis_tech,
                tt_ele_etatgene,
                tt_ele_etatcable,
                tt_ele_resit,
                tt_ele_sond,
                tt_ele_avis_tech,
                tt_th_etatgene,
                tt_th_stable,
                tt_th_inerti,
                tt_th_temp_test,
                tt_th_pilotage,
                tt_th_avis_therm,
                tt_date,
                tt_validation,
                tt_rec_obtu,
                tt_th_dur_mont
            )
            VALUES (
                :id_inter,
                :tt_eg_propre,
                :tt_eg_etatgene,
                :tt_eg_avis_tech,
                :tt_mec_etatgene,
                :tt_mec_eta_entre_mat,
                :tt_mec_eta_sorti_mat,
                :tt_mec_huile_fuit,
                :tt_mec_bleu,
                :tt_mec_avis_tech,
                :tt_ele_etatgene,
                :tt_ele_etatcable,
                :tt_ele_resit,
                :tt_ele_sond,
                :tt_ele_avis_tech,
                :tt_th_etatgene,
                :tt_th_stable,
                :tt_th_inerti,
                :tt_th_temp_test,
                :tt_th_pilotage,
                :tt_th_avis_therm,
                :tt_date,
                :tt_validation,
                :tt_rec_obtu,
                :tt_th_dur_mont
            )
        ");

        return $requete->execute([
            ":id_inter" => $test->get_id_inter(),

            ":tt_eg_propre" => $test->get_tt_eg_propre(),
            ":tt_eg_etatgene" => $test->get_tt_eg_etatgene(),
            ":tt_eg_avis_tech" => $test->get_tt_eg_avis_tech(),

            ":tt_mec_etatgene" => $test->get_tt_mec_etatgene(),
            ":tt_mec_eta_entre_mat" => $test->get_tt_mec_eta_entre_mat(),
            ":tt_mec_eta_sorti_mat" => $test->get_tt_mec_eta_sorti_mat(),
            ":tt_mec_huile_fuit" => $test->get_tt_mec_huile_fuit(),
            ":tt_mec_bleu" => $test->get_tt_mec_bleu(),
            ":tt_mec_avis_tech" => $test->get_tt_mec_avis_tech(),

            ":tt_ele_etatgene" => $test->get_tt_ele_etatgene(),
            ":tt_ele_etatcable" => $test->get_tt_ele_etatcable(),
            ":tt_ele_resit" => $test->get_tt_ele_resit(),
            ":tt_ele_sond" => $test->get_tt_ele_sond(),
            ":tt_ele_avis_tech" => $test->get_tt_ele_avis_tech(),

            ":tt_th_etatgene" => $test->get_tt_th_etatgene(),
            ":tt_th_stable" => $test->get_tt_th_stable(),
            ":tt_th_inerti" => $test->get_tt_th_inerti(),
            ":tt_th_temp_test" => $test->get_tt_th_temp_test(),
            ":tt_th_pilotage" => $test->get_tt_th_pilotage(),
            ":tt_th_avis_therm" => $test->get_tt_th_avis_therm(),

            ":tt_date" => $test->get_tt_date(),
            ":tt_validation" => $test->get_tt_validation(),
            ":tt_rec_obtu" => $test->get_tt_rec_obtu(),
            ":tt_th_dur_mont" => $test->get_tt_th_dur_mont()
        ]);
    }

    public function update($test): bool
    {
        $requete = $this->db->prepare("
            UPDATE tests
            SET
                tt_eg_propre = :tt_eg_propre,
                tt_eg_etatgene = :tt_eg_etatgene,
                tt_eg_avis_tech = :tt_eg_avis_tech,

                tt_mec_etatgene = :tt_mec_etatgene,
                tt_mec_eta_entre_mat = :tt_mec_eta_entre_mat,
                tt_mec_eta_sorti_mat = :tt_mec_eta_sorti_mat,
                tt_mec_huile_fuit = :tt_mec_huile_fuit,
                tt_mec_bleu = :tt_mec_bleu,
                tt_mec_avis_tech = :tt_mec_avis_tech,

                tt_ele_etatgene = :tt_ele_etatgene,
                tt_ele_etatcable = :tt_ele_etatcable,
                tt_ele_resit = :tt_ele_resit,
                tt_ele_sond = :tt_ele_sond,
                tt_ele_avis_tech = :tt_ele_avis_tech,

                tt_th_etatgene = :tt_th_etatgene,
                tt_th_stable = :tt_th_stable,
                tt_th_inerti = :tt_th_inerti,
                tt_th_temp_test = :tt_th_temp_test,
                tt_th_pilotage = :tt_th_pilotage,
                tt_th_avis_therm = :tt_th_avis_therm,

                tt_date = :tt_date,
                tt_validation = :tt_validation,
                tt_rec_obtu = :tt_rec_obtu,
                tt_th_dur_mont = :tt_th_dur_mont

            WHERE id_inter = :id_inter
        ");

        return $requete->execute([
            ":id_inter" => $test->get_id_inter(),

            ":tt_eg_propre" => $test->get_tt_eg_propre(),
            ":tt_eg_etatgene" => $test->get_tt_eg_etatgene(),
            ":tt_eg_avis_tech" => $test->get_tt_eg_avis_tech(),

            ":tt_mec_etatgene" => $test->get_tt_mec_etatgene(),
            ":tt_mec_eta_entre_mat" => $test->get_tt_mec_eta_entre_mat(),
            ":tt_mec_eta_sorti_mat" => $test->get_tt_mec_eta_sorti_mat(),
            ":tt_mec_huile_fuit" => $test->get_tt_mec_huile_fuit(),
            ":tt_mec_bleu" => $test->get_tt_mec_bleu(),
            ":tt_mec_avis_tech" => $test->get_tt_mec_avis_tech(),

            ":tt_ele_etatgene" => $test->get_tt_ele_etatgene(),
            ":tt_ele_etatcable" => $test->get_tt_ele_etatcable(),
            ":tt_ele_resit" => $test->get_tt_ele_resit(),
            ":tt_ele_sond" => $test->get_tt_ele_sond(),
            ":tt_ele_avis_tech" => $test->get_tt_ele_avis_tech(),

            ":tt_th_etatgene" => $test->get_tt_th_etatgene(),
            ":tt_th_stable" => $test->get_tt_th_stable(),
            ":tt_th_inerti" => $test->get_tt_th_inerti(),
            ":tt_th_temp_test" => $test->get_tt_th_temp_test(),
            ":tt_th_pilotage" => $test->get_tt_th_pilotage(),
            ":tt_th_avis_therm" => $test->get_tt_th_avis_therm(),

            ":tt_date" => $test->get_tt_date(),
            ":tt_validation" => $test->get_tt_validation(),
            ":tt_rec_obtu" => $test->get_tt_rec_obtu(),
            ":tt_th_dur_mont" => $test->get_tt_th_dur_mont()
        ]);
    }

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM tests
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }

    public function deleteByInterventionId(int $id_inter): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM tests
            WHERE id_inter = :id_inter
        ");

        $requete->bindValue(":id_inter", $id_inter, PDO::PARAM_INT);

        return $requete->execute();
    }
}