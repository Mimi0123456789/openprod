<?php

require_once(ROOT_PATH . "/dao/database.php");

class tt_obtuDAO
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
            FROM tt_obtu
            ORDER BY id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM tt_obtu
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        return $resultat ?: null;
    }

    public function getByEtatInit(int $id_eta_init): array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM tt_obtu
            WHERE id_eta_init = :id_eta_init
            ORDER BY num_obtu ASC
        ");

        $requete->bindValue(":id_eta_init", $id_eta_init, PDO::PARAM_INT);
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($tt_obtu): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO tt_obtu (
                id_eta_init,
                num_obtu,
                jeu_guide,
                etat_obtu,
                etat_guide,
                attel_etat
            )
            VALUES (
                :id_eta_init,
                :num_obtu,
                :jeu_guide,
                :etat_obtu,
                :etat_guide,
                :attel_etat
            )
        ");

        return $requete->execute([
            ":id_eta_init" => $tt_obtu->get_id_eta_init(),
            ":num_obtu" => $tt_obtu->get_num_obtu(),
            ":jeu_guide" => $tt_obtu->get_jeu_guide(),
            ":etat_obtu" => $tt_obtu->get_etat_obtu(),
            ":etat_guide" => $tt_obtu->get_etat_guide(),
            ":attel_etat" => $tt_obtu->get_attel_etat()
        ]);
    }

    public function update($tt_obtu): bool
    {
        $requete = $this->db->prepare("
            UPDATE tt_obtu
            SET
                id_eta_init = :id_eta_init,
                num_obtu = :num_obtu,
                jeu_guide = :jeu_guide,
                etat_obtu = :etat_obtu,
                etat_guide = :etat_guide,
                attel_etat = :attel_etat
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $tt_obtu->get_id(),
            ":id_eta_init" => $tt_obtu->get_id_eta_init(),
            ":num_obtu" => $tt_obtu->get_num_obtu(),
            ":jeu_guide" => $tt_obtu->get_jeu_guide(),
            ":etat_obtu" => $tt_obtu->get_etat_obtu(),
            ":etat_guide" => $tt_obtu->get_etat_guide(),
            ":attel_etat" => $tt_obtu->get_attel_etat()
        ]);
    }

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM tt_obtu
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }

    public function deleteByEtatInit(int $id_eta_init): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM tt_obtu
            WHERE id_eta_init = :id_eta_init
        ");

        $requete->bindValue(":id_eta_init", $id_eta_init, PDO::PARAM_INT);

        return $requete->execute();
    }
}

?>