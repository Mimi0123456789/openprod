<?php

require_once(ROOT_PATH . "/dao/database.php");

class obturateurs_initDAO
{
    private PDO $db;

    public function __construct()
    {
        $database = new database();
        $this->db = $database->connexion();
    }

    // =========================
    // Récupération complète
    // =========================

    public function getAll(): array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM obturateurs_init
            ORDER BY id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================
    // Récupération par ID
    // =========================

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM obturateurs_init
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $obturateur = $requete->fetch(PDO::FETCH_ASSOC);

        return $obturateur ?: null;
    }

    // =========================
    // Récupération par état initial
    // =========================

    public function getByEtatInit(int $id_eta_init): array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM obturateurs_init
            WHERE id_eta_init = :id_eta_init
            ORDER BY id ASC
        ");

        $requete->bindValue(":id_eta_init", $id_eta_init, PDO::PARAM_INT);
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================
    // Ajout
    // =========================

    public function add($obturateur): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO obturateurs_init (
                id_eta_init,
                num_obtu,
                jeu_obtu,
                jeu_guide,
                etat_obtu,
                etat_guide,
                attel_etat
            )
            VALUES (
                :id_eta_init,
                :num_obtu,
                :jeu_obtu,
                :jeu_guide,
                :etat_obtu,
                :etat_guide,
                :attel_etat
            )
        ");

        return $requete->execute([
            ":id_eta_init" => $obturateur->get_id_eta_init(),
            ":num_obtu" => $obturateur->get_num_obtu(),
            ":jeu_obtu" => $obturateur->get_jeu_obtu(),
            ":jeu_guide" => $obturateur->get_jeu_guide(),
            ":etat_obtu" => $obturateur->get_etat_obtu(),
            ":etat_guide" => $obturateur->get_etat_guide(),
            ":attel_etat" => $obturateur->get_attel_etat()
        ]);
    }

    // =========================
    // Modification
    // =========================

    public function update($obturateur): bool
    {
        $requete = $this->db->prepare("
            UPDATE obturateurs_init
            SET
                id_eta_init = :id_eta_init,
                num_obtu = :num_obtu,
                jeu_obtu = :jeu_obtu,
                jeu_guide = :jeu_guide,
                etat_obtu = :etat_obtu,
                etat_guide = :etat_guide,
                attel_etat = :attel_etat
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $obturateur->get_id(),
            ":id_eta_init" => $obturateur->get_id_eta_init(),
            ":num_obtu" => $obturateur->get_num_obtu(),
            ":jeu_obtu" => $obturateur->get_jeu_obtu(),
            ":jeu_guide" => $obturateur->get_jeu_guide(),
            ":etat_obtu" => $obturateur->get_etat_obtu(),
            ":etat_guide" => $obturateur->get_etat_guide(),
            ":attel_etat" => $obturateur->get_attel_etat()
        ]);
    }

    // =========================
    // Suppression
    // =========================

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM obturateurs_init
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }

    // =========================
    // Suppression par état initial
    // =========================

    public function deleteByEtatInit(int $id_eta_init): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM obturateurs_init
            WHERE id_eta_init = :id_eta_init
        ");

        $requete->bindValue(":id_eta_init", $id_eta_init, PDO::PARAM_INT);

        return $requete->execute();
    }
}