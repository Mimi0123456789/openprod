<?php

require_once(ROOT_PATH . "/dao/database.php");

class clientsDAO
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
            FROM clients
            ORDER BY nom
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM clients
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $client = $requete->fetch(PDO::FETCH_ASSOC);

        return $client ?: null;
    }

    public function add($client): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO clients (
                nom,
                adresse,
                c_postal,
                ville,
                num_tel,
                mail,
                representant
            )
            VALUES (
                :nom,
                :adresse,
                :c_postal,
                :ville,
                :num_tel,
                :mail,
                :representant
            )
        ");

        return $requete->execute([
            ":nom" => $client->get_nom(),
            ":adresse" => $client->get_adresse(),
            ":c_postal" => $client->get_c_postal(),
            ":ville" => $client->get_ville(),
            ":num_tel" => $client->get_num_tel(),
            ":mail" => $client->get_mail(),
            ":representant" => $client->get_representant()
        ]);
    }

    public function update($client): bool
    {
        $requete = $this->db->prepare("
            UPDATE clients
            SET
                nom = :nom,
                adresse = :adresse,
                c_postal = :c_postal,
                ville = :ville,
                num_tel = :num_tel,
                mail = :mail,
                representant = :representant
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $client->get_id(),
            ":nom" => $client->get_nom(),
            ":adresse" => $client->get_adresse(),
            ":c_postal" => $client->get_c_postal(),
            ":ville" => $client->get_ville(),
            ":num_tel" => $client->get_num_tel(),
            ":mail" => $client->get_mail(),
            ":representant" => $client->get_representant()
        ]);
    }

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM clients
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }
}