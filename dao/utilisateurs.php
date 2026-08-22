<?php

require_once(ROOT_PATH . "/dao/database.php");

class utilisateursDAO
{
    private PDO $db;

    public function __construct()
    {
        $database = new database();
        $this->db = $database->connexion();
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,
            'time_cost'   => 4,
            'threads'     => 2,
        ]);
    }

    public function getAll(): array
    {
        $requete = $this->db->prepare("SELECT * FROM utilisateurs ORDER BY nom");
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function seConnecter(string $login, string $password)
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM utilisateurs
            WHERE login = :login
            LIMIT 1
        ");

        $requete->bindValue(":login", $login, PDO::PARAM_STR);
        $requete->execute();

        $user = $requete->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if (
            strlen($user['password']) === 32 &&
            md5($password) === $user['password']
        ) {
            $newHash = $this->hashPassword($password);

            $update = $this->db->prepare("
                UPDATE utilisateurs
                SET password = :password
                WHERE id = :id
            ");

            $update->execute([
                ':password' => $newHash,
                ':id'       => $user['id']
            ]);

            $user['password'] = $newHash;

            return $user;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        if (password_needs_rehash($user['password'], PASSWORD_ARGON2ID)) {
            $this->reinitMotdepasse((int)$user['id'], $password);
        }

        return $user;
    }

    public function reinitMotdepasse(int $id, string $password): bool
    {
        $hash = $this->hashPassword($password);

        $requete = $this->db->prepare("
            UPDATE utilisateurs
            SET password = :password
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->bindValue(":password", $hash, PDO::PARAM_STR);

        return $requete->execute();
    }

    public function modifierMotDePasse($utilisateurs): bool
    {
        $hash = $this->hashPassword($utilisateurs->get_password());

        $requete = $this->db->prepare("
            UPDATE utilisateurs
            SET password = :password
            WHERE id = :id
        ");

        $requete->bindValue(":password", $hash, PDO::PARAM_STR);
        $requete->bindValue(":id", $utilisateurs->get_id(), PDO::PARAM_INT);

        return $requete->execute();
    }

    public function getutilisateursById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM utilisateurs
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $user = $requete->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function getutilisateursEtFonction(): array
    {
        $requete = $this->db->prepare("
            SELECT utilisateurs.*, fonctions.libelle_fct AS libelle_fonction
            FROM utilisateurs
            INNER JOIN fonctions ON utilisateurs.id_fonctions = fonctions.ID
            ORDER BY fonctions.ID, utilisateurs.nom
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUtilisateursFiltrage($filtrage_utilisateurs, $filtrage_fonction): array
    {
        $sql = "
            SELECT utilisateurs.*, fonctions.libelle_fct AS libelle_fct
            FROM utilisateurs
            INNER JOIN fonctions ON utilisateurs.id_fonctions = fonctions.ID
            WHERE 1 = 1
        ";

        $params = [];

        if ($filtrage_utilisateurs->get_nom() != 0) {
            $sql .= " AND utilisateurs.nom = :nom";
            $params[':nom'] = $filtrage_utilisateurs->get_nom();
        }

        if ($filtrage_utilisateurs->get_prenom() != 0) {
            $sql .= " AND utilisateurs.prenom = :prenom";
            $params[':prenom'] = $filtrage_utilisateurs->get_prenom();
        }

        if ($filtrage_utilisateurs->get_login() != 0) {
            $sql .= " AND utilisateurs.login = :login";
            $params[':login'] = $filtrage_utilisateurs->get_login();
        }

        if ($filtrage_fonction->get_fonction() != 0) {
            $sql .= " AND fonctions.ID = :id_fonctions";
            $params[':id_fonctions'] = $filtrage_fonction->get_fonction();
        }

        $sql .= " ORDER BY utilisateurs.ID DESC";

        $requete = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $type = ($key === ':id_fonctions') ? PDO::PARAM_INT : PDO::PARAM_STR;
            $requete->bindValue($key, $value, $type);
        }

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($utilisateur): bool
    {
        $hash = $this->hashPassword($utilisateur->get_password());

        $requete = $this->db->prepare("
            INSERT INTO utilisateurs (
                nom,
                prenom,
                login,
                password,
                id_fonctions
            )
            VALUES (
                :nom,
                :prenom,
                :login,
                :password,
                :id_fonctions
            )
        ");

        return $requete->execute([
            ":nom" => $utilisateur->get_nom(),
            ":prenom" => $utilisateur->get_prenom(),
            ":login" => $utilisateur->get_login(),
            ":password" => $hash,
            ":id_fonctions" => $utilisateur->get_id_fonctions()
        ]);
    }


    public function update($utilisateur): bool
    {
        $requete = $this->db->prepare("
            UPDATE utilisateurs
            SET
                nom = :nom,
                prenom = :prenom,
                login = :login,
                id_fonctions = :id_fonctions
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $utilisateur->get_id(),
            ":nom" => $utilisateur->get_nom(),
            ":prenom" => $utilisateur->get_prenom(),
            ":login" => $utilisateur->get_login(),
            ":id_fonctions" => $utilisateur->get_id_fonctions()
        ]);
    }


    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM utilisateurs
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }
}