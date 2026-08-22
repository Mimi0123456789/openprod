<?php

require_once(ROOT_PATH . "/dao/database.php");

class photos_finDAO
{
    private $db;

    public function __construct()
    {
        $this->db = new database;
        $this->db = $this->db->connexion();
    }

    public function getByInterventionId(int $id_inter): array
    {
        $sql = "SELECT * FROM photos_fin WHERE id_inter = :id_inter ORDER BY date_ajout DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":id_inter" => $id_inter
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function add(array $photo): bool
    {
        $sql = "
            INSERT INTO photos_fin (
                id_inter,
                nom_fichier,
                titre,
                chemin
            ) VALUES (
                :id_inter,
                :nom_fichier,
                :titre,
                :chemin
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":id_inter"    => (int) ($photo["id_inter"] ?? 0),
            ":nom_fichier" => $photo["nom_fichier"] ?? "",
            ":titre"       => $photo["titre"] ?? "",
            ":chemin"      => $photo["chemin"] ?? ""
        ]);
    }

    public function updateTitre(int $id, string $titre): bool
    {
        $sql = "UPDATE photos_fin SET titre = :titre WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":id"    => $id,
            ":titre" => $titre
        ]);
    }

    public function delete(int $id): bool
    {
        $photo = $this->getById($id);

        if ($photo && file_exists(ROOT_PATH . "/" . $photo["chemin"])) {
            unlink(ROOT_PATH . "/" . $photo["chemin"]);
        }

        $sql = "DELETE FROM photos_fin WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }

    public function getByIntervention(int $id_inter): array
    {
        $sql = "SELECT * FROM photos_fin WHERE id_inter = :id_inter ORDER BY id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_inter", $id_inter, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    private function getById(int $id): ?array
    {
        $sql = "SELECT * FROM photos_fin WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        $photo = $stmt->fetch(PDO::FETCH_ASSOC);

        return $photo ?: null;
    }
}