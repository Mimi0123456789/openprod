<?php

require_once(ROOT_PATH . "/dao/database.php");

class systemesDAO
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
            FROM systemes
            ORDER BY id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM systemes
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $systeme = $requete->fetch(PDO::FETCH_ASSOC);

        return $systeme ?: null;
    }

    public function getByInterventionId(int $id_inter): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM systemes
            WHERE id_inter = :id_inter
            LIMIT 1
        ");

        $requete->bindValue(":id_inter", $id_inter, PDO::PARAM_INT);
        $requete->execute();

        $systeme = $requete->fetch(PDO::FETCH_ASSOC);

        return $systeme ?: null;
    }

    public function add($systeme): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO systemes (
                id_inter,
                reference,
                marque,
                type,
                num_immat_sys,
                nbr_pt,
                mat_inject,
                temp_inject,
                obturation,
                nbr_obtu,
                type_obturation,
                embout,
                nbr_resistance,
                nbr_sonde,
                nbr_prise,
                description
            )
            VALUES (
                :id_inter,
                :reference,
                :marque,
                :type,
                :num_immat_sys,
                :nbr_pt,
                :mat_inject,
                :temp_inject,
                :obturation,
                :nbr_obtu,
                :type_obturation,
                :embout,
                :nbr_resistance,
                :nbr_sonde,
                :nbr_prise,
                :description
            )
        ");

        return $requete->execute([
            ":id_inter" => $systeme->get_id_inter(),
            ":reference" => $systeme->get_reference(),
            ":marque" => $systeme->get_marque(),
            ":type" => $systeme->get_type(),
            ":num_immat_sys" => $systeme->get_num_immat_sys(),
            ":nbr_pt" => $systeme->get_nbr_pt(),
            ":mat_inject" => $systeme->get_mat_inject(),
            ":temp_inject" => $systeme->get_temp_inject(),
            ":obturation" => $systeme->get_obturation(),
            ":nbr_obtu" => $systeme->get_nbr_obtu(),
            ":type_obturation" => $systeme->get_type_obturation(),
            ":embout" => $systeme->get_embout(),
            ":nbr_resistance" => $systeme->get_nbr_resistance(),
            ":nbr_sonde" => $systeme->get_nbr_sonde(),
            ":nbr_prise" => $systeme->get_nbr_prise(),
            ":description" => $systeme->get_description()
        ]);
    }

    public function update($systeme): bool
    {
        $requete = $this->db->prepare("
            UPDATE systemes
            SET
                id_inter = :id_inter,
                reference = :reference,
                marque = :marque,
                type = :type,
                num_immat_sys = :num_immat_sys,
                nbr_pt = :nbr_pt,
                mat_inject = :mat_inject,
                temp_inject = :temp_inject,
                obturation = :obturation,
                nbr_obtu = :nbr_obtu,
                type_obturation = :type_obturation,
                embout = :embout,
                nbr_resistance = :nbr_resistance,
                nbr_sonde = :nbr_sonde,
                nbr_prise = :nbr_prise,
                description = :description
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $systeme->get_id(),
            ":id_inter" => $systeme->get_id_inter(),
            ":reference" => $systeme->get_reference(),
            ":marque" => $systeme->get_marque(),
            ":type" => $systeme->get_type(),
            ":num_immat_sys" => $systeme->get_num_immat_sys(),
            ":nbr_pt" => $systeme->get_nbr_pt(),
            ":mat_inject" => $systeme->get_mat_inject(),
            ":temp_inject" => $systeme->get_temp_inject(),
            ":obturation" => $systeme->get_obturation(),
            ":nbr_obtu" => $systeme->get_nbr_obtu(),
            ":type_obturation" => $systeme->get_type_obturation(),
            ":embout" => $systeme->get_embout(),
            ":nbr_resistance" => $systeme->get_nbr_resistance(),
            ":nbr_sonde" => $systeme->get_nbr_sonde(),
            ":nbr_prise" => $systeme->get_nbr_prise(),
            ":description" => $systeme->get_description()
        ]);
    }

    public function updateByInterventionId($systeme): bool
    {
        $requete = $this->db->prepare("
            UPDATE systemes
            SET
                reference = :reference,
                marque = :marque,
                type = :type,
                num_immat_sys = :num_immat_sys,
                nbr_pt = :nbr_pt,
                mat_inject = :mat_inject,
                temp_inject = :temp_inject,
                obturation = :obturation,
                nbr_obtu = :nbr_obtu,
                type_obturation = :type_obturation,
                embout = :embout,
                nbr_resistance = :nbr_resistance,
                nbr_sonde = :nbr_sonde,
                nbr_prise = :nbr_prise,
                description = :description
            WHERE id_inter = :id_inter
        ");

        return $requete->execute([
            ":id_inter" => $systeme->get_id_inter(),
            ":reference" => $systeme->get_reference(),
            ":marque" => $systeme->get_marque(),
            ":type" => $systeme->get_type(),
            ":num_immat_sys" => $systeme->get_num_immat_sys(),
            ":nbr_pt" => $systeme->get_nbr_pt(),
            ":mat_inject" => $systeme->get_mat_inject(),
            ":temp_inject" => $systeme->get_temp_inject(),
            ":obturation" => $systeme->get_obturation(),
            ":nbr_obtu" => $systeme->get_nbr_obtu(),
            ":type_obturation" => $systeme->get_type_obturation(),
            ":embout" => $systeme->get_embout(),
            ":nbr_resistance" => $systeme->get_nbr_resistance(),
            ":nbr_sonde" => $systeme->get_nbr_sonde(),
            ":nbr_prise" => $systeme->get_nbr_prise(),
            ":description" => $systeme->get_description()
        ]);
    }

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM systemes
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }
}
?>