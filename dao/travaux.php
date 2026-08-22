<?php

require_once(ROOT_PATH . "/dao/database.php");

class travauxDAO
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
            FROM travaux
            ORDER BY id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM travaux
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $travaux = $requete->fetch(PDO::FETCH_ASSOC);

        return $travaux ?: null;
    }

    public function getByInterventionId(int $id_inter): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM travaux
            WHERE id_inter = :id_inter
            LIMIT 1
        ");

        $requete->bindValue(":id_inter", $id_inter, PDO::PARAM_INT);
        $requete->execute();

        $travaux = $requete->fetch(PDO::FETCH_ASSOC);

        return $travaux ?: null;
    }

    public function add($travaux): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO travaux (
                id_inter,
                id_av_trav,
                passage_four,
                chang_resistance,
                nbr_chang_resistance,
                chang_sonde,
                nbr_chang_sonde,
                nettoyage,
                modif_cablage_elec,
                modif_cir_eau,
                modif_cir_huile,
                modif_cir_elec,
                modif_cir_air,
                modif_meca,
                modif_meca_tete,
                nbr_modif_meca_tete,
                modif_meca_rectif,
                nbr_modif_meca_rectif,
                modif_meca_corp,
                desc_modif_meca_corp
            )
            VALUES (
                :id_inter,
                :id_av_trav,
                :passage_four,
                :chang_resistance,
                :nbr_chang_resistance,
                :chang_sonde,
                :nbr_chang_sonde,
                :nettoyage,
                :modif_cablage_elec,
                :modif_cir_eau,
                :modif_cir_huile,
                :modif_cir_elec,
                :modif_cir_air,
                :modif_meca,
                :modif_meca_tete,
                :nbr_modif_meca_tete,
                :modif_meca_rectif,
                :nbr_modif_meca_rectif,
                :modif_meca_corp,
                :desc_modif_meca_corp
            )
        ");

        return $requete->execute([
            ":id_inter" => $travaux->get_id_inter(),
            ":id_av_trav" => $travaux->get_id_av_trav(),
            ":passage_four" => $travaux->get_passage_four(),
            ":chang_resistance" => $travaux->get_chang_resistance(),
            ":nbr_chang_resistance" => $travaux->get_nbr_chang_resistance(),
            ":chang_sonde" => $travaux->get_chang_sonde(),
            ":nbr_chang_sonde" => $travaux->get_nbr_chang_sonde(),
            ":nettoyage" => $travaux->get_nettoyage(),
            ":modif_cablage_elec" => $travaux->get_modif_cablage_elec(),
            ":modif_cir_eau" => $travaux->get_modif_cir_eau(),
            ":modif_cir_huile" => $travaux->get_modif_cir_huile(),
            ":modif_cir_elec" => $travaux->get_modif_cir_elec(),
            ":modif_cir_air" => $travaux->get_modif_cir_air(),
            ":modif_meca" => $travaux->get_modif_meca(),
            ":modif_meca_tete" => $travaux->get_modif_meca_tete(),
            ":nbr_modif_meca_tete" => $travaux->get_nbr_modif_meca_tete(),
            ":modif_meca_rectif" => $travaux->get_modif_meca_rectif(),
            ":nbr_modif_meca_rectif" => $travaux->get_nbr_modif_meca_rectif(),
            ":modif_meca_corp" => $travaux->get_modif_meca_corp(),
            ":desc_modif_meca_corp" => $travaux->get_desc_modif_meca_corp()
        ]);
    }

    public function update($travaux): bool
    {
        $requete = $this->db->prepare("
            UPDATE travaux
            SET
                id_av_trav = :id_av_trav,
                passage_four = :passage_four,
                chang_resistance = :chang_resistance,
                nbr_chang_resistance = :nbr_chang_resistance,
                chang_sonde = :chang_sonde,
                nbr_chang_sonde = :nbr_chang_sonde,
                nettoyage = :nettoyage,
                modif_cablage_elec = :modif_cablage_elec,
                modif_cir_eau = :modif_cir_eau,
                modif_cir_huile = :modif_cir_huile,
                modif_cir_elec = :modif_cir_elec,
                modif_cir_air = :modif_cir_air,
                modif_meca = :modif_meca,
                modif_meca_tete = :modif_meca_tete,
                nbr_modif_meca_tete = :nbr_modif_meca_tete,
                modif_meca_rectif = :modif_meca_rectif,
                nbr_modif_meca_rectif = :nbr_modif_meca_rectif,
                modif_meca_corp = :modif_meca_corp,
                desc_modif_meca_corp = :desc_modif_meca_corp
            WHERE id_inter = :id_inter
        ");

        return $requete->execute([
            ":id_inter" => $travaux->get_id_inter(),
            ":id_av_trav" => $travaux->get_id_av_trav(),
            ":passage_four" => $travaux->get_passage_four(),
            ":chang_resistance" => $travaux->get_chang_resistance(),
            ":nbr_chang_resistance" => $travaux->get_nbr_chang_resistance(),
            ":chang_sonde" => $travaux->get_chang_sonde(),
            ":nbr_chang_sonde" => $travaux->get_nbr_chang_sonde(),
            ":nettoyage" => $travaux->get_nettoyage(),
            ":modif_cablage_elec" => $travaux->get_modif_cablage_elec(),
            ":modif_cir_eau" => $travaux->get_modif_cir_eau(),
            ":modif_cir_huile" => $travaux->get_modif_cir_huile(),
            ":modif_cir_elec" => $travaux->get_modif_cir_elec(),
            ":modif_cir_air" => $travaux->get_modif_cir_air(),
            ":modif_meca" => $travaux->get_modif_meca(),
            ":modif_meca_tete" => $travaux->get_modif_meca_tete(),
            ":nbr_modif_meca_tete" => $travaux->get_nbr_modif_meca_tete(),
            ":modif_meca_rectif" => $travaux->get_modif_meca_rectif(),
            ":nbr_modif_meca_rectif" => $travaux->get_nbr_modif_meca_rectif(),
            ":modif_meca_corp" => $travaux->get_modif_meca_corp(),
            ":desc_modif_meca_corp" => $travaux->get_desc_modif_meca_corp()
        ]);
    }

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM travaux
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }

    public function deleteByInterventionId(int $id_inter): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM travaux
            WHERE id_inter = :id_inter
        ");

        $requete->bindValue(":id_inter", $id_inter, PDO::PARAM_INT);

        return $requete->execute();
    }
}

?>