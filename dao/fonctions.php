<?php

require_once(ROOT_PATH . "/dao/database.php");

class fonctionsDAO
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
            FROM fonctions
            ORDER BY libelle_fct
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM fonctions
            WHERE ID = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $fonction = $requete->fetch(PDO::FETCH_ASSOC);

        return $fonction ?: null;
    }

    public function add(string $libelle_fct): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO fonctions (libelle_fct)
            VALUES (:libelle_fct)
        ");

        $requete->bindValue(":libelle_fct", $libelle_fct, PDO::PARAM_STR);

        return $requete->execute();
    }

    public function update(int $id, string $libelle_fct): bool
    {
        $requete = $this->db->prepare("
            UPDATE fonctions
            SET libelle_fct = :libelle_fct
            WHERE ID = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->bindValue(":libelle_fct", $libelle_fct, PDO::PARAM_STR);

        return $requete->execute();
    }

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM fonctions
            WHERE ID = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }
}