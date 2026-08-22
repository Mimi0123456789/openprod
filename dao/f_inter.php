<?php

require_once(ROOT_PATH . "/dao/database.php");

class f_interDAO
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
            FROM f_inter
            ORDER BY id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM f_inter
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $intervention = $requete->fetch(PDO::FETCH_ASSOC);

        return $intervention ?: null;
    }

    public function getEnCours(): array
    {
        $requete = $this->db->prepare("
            SELECT 
                f_inter.*,
                clients.nom AS nom_client,
                utilisateurs.nom AS nom_utilisateur,
                avancements.libelle_avance,
                priorites.libelle_ct_prio AS libelle_prio
            FROM f_inter
            INNER JOIN clients ON f_inter.id_clients = clients.id
            INNER JOIN utilisateurs ON f_inter.id_responsable = utilisateurs.id
            INNER JOIN avancements ON f_inter.id_avancements = avancements.ID
            INNER JOIN priorites ON f_inter.id_priorite = priorites.ID
            WHERE f_inter.id_avancements < 8
            ORDER BY f_inter.id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCloturees(): array
    {
        $requete = $this->db->prepare("
            SELECT 
                f_inter.*,
                clients.nom AS nom_client,
                utilisateurs.nom AS nom_utilisateur,
                avancements.libelle_avance,
                priorites.libelle_ct_prio AS libelle_prio
            FROM f_inter
            INNER JOIN clients ON f_inter.id_clients = clients.id
            INNER JOIN utilisateurs ON f_inter.id_responsable = utilisateurs.id
            INNER JOIN avancements ON f_inter.id_avancements = avancements.ID
            INNER JOIN priorites ON f_inter.id_priorite = priorites.ID
            WHERE f_inter.id_avancements = 8
            ORDER BY f_inter.id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($intervention): int|false
    {
        $requete = $this->db->prepare("
            INSERT INTO f_inter (
                id_clients,
                id_responsable,
                id_priorite,
                date_crea,
                facturation,
                date_max,
                id_avancements,
                visa_intervenant,
                demande,
                lieu,
                num_devis,
                anomalie,
                date_debut,
                date_fin,
                id_intervenant,
                desc_travaux,
                conclu,
                duree_init,
                duree_trav,
                duree_cont,
                visa_client,
                comm_client,
                comm_inter
            )
            VALUES (
                :id_clients,
                :id_responsable,
                :id_priorite,
                :date_crea,
                :facturation,
                :date_max,
                :id_avancements,
                :visa_intervenant,
                :demande,
                :lieu,
                :num_devis,
                :anomalie,
                :date_debut,
                :date_fin,
                :id_intervenant,
                :desc_travaux,
                :conclu,
                :duree_init,
                :duree_trav,
                :duree_cont,
                :visa_client,
                :comm_client,
                :comm_inter
            )
        ");

        $ok = $requete->execute([
            ":id_clients" => $intervention->get_id_clients(),
            ":id_responsable" => $intervention->get_id_responsable(),
            ":id_priorite" => $intervention->get_id_priorite(),
            ":date_crea" => $intervention->get_date_crea(),
            ":facturation" => $intervention->get_facturation(),
            ":date_max" => $intervention->get_date_max(),
            ":id_avancements" => $intervention->get_id_avancements(),
            ":visa_intervenant" => $intervention->get_visa_intervenant(),
            ":demande" => $intervention->get_demande(),
            ":lieu" => $intervention->get_lieu(),
            ":num_devis" => $intervention->get_num_devis(),
            ":anomalie" => $intervention->get_anomalie(),
            ":date_debut" => $intervention->get_date_debut(),
            ":date_fin" => $intervention->get_date_fin(),
            ":id_intervenant" => $intervention->get_id_intervenant(),
            ":desc_travaux" => $intervention->get_desc_travaux(),
            ":conclu" => $intervention->get_conclu(),
            ":duree_init" => $intervention->get_duree_init(),
            ":duree_trav" => $intervention->get_duree_trav(),
            ":duree_cont" => $intervention->get_duree_cont(),
            ":visa_client" => $intervention->get_visa_client() ?: "vise",
            ":comm_client" => $intervention->get_comm_client(),
            ":comm_inter" => $intervention->get_comm_inter()
        ]);

        if (!$ok) {
            return false;
        }

        return (int)$this->db->lastInsertId();
    }

    public function update($intervention): bool
    {
        $requete = $this->db->prepare("
            UPDATE f_inter
            SET
                id_clients = :id_clients,
                id_responsable = :id_responsable,
                id_priorite = :id_priorite,
                date_crea = :date_crea,
                facturation = :facturation,
                date_max = :date_max,
                id_avancements = :id_avancements,
                visa_intervenant = :visa_intervenant,
                demande = :demande,
                lieu = :lieu,
                num_devis = :num_devis,
                anomalie = :anomalie,
                date_debut = :date_debut,
                date_fin = :date_fin,
                id_intervenant = :id_intervenant,
                desc_travaux = :desc_travaux,
                conclu = :conclu,
                duree_init = :duree_init,
                duree_trav = :duree_trav,
                duree_cont = :duree_cont,
                visa_client = :visa_client,
                comm_client = :comm_client,
                comm_inter = :comm_inter
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $intervention->get_id(),
            ":id_clients" => $intervention->get_id_clients(),
            ":id_responsable" => $intervention->get_id_responsable(),
            ":id_priorite" => $intervention->get_id_priorite(),
            ":date_crea" => $intervention->get_date_crea(),
            ":facturation" => $intervention->get_facturation(),
            ":date_max" => $intervention->get_date_max(),
            ":id_avancements" => $intervention->get_id_avancements(),
            ":visa_intervenant" => $intervention->get_visa_intervenant(),
            ":demande" => $intervention->get_demande(),
            ":lieu" => $intervention->get_lieu(),
            ":num_devis" => $intervention->get_num_devis(),
            ":anomalie" => $intervention->get_anomalie(),
            ":date_debut" => $intervention->get_date_debut(),
            ":date_fin" => $intervention->get_date_fin(),
            ":id_intervenant" => $intervention->get_id_intervenant(),
            ":desc_travaux" => $intervention->get_desc_travaux(),
            ":conclu" => $intervention->get_conclu(),
            ":duree_init" => $intervention->get_duree_init(),
            ":duree_trav" => $intervention->get_duree_trav(),
            ":duree_cont" => $intervention->get_duree_cont(),
            ":visa_client" => $intervention->get_visa_client(),
            ":comm_client" => $intervention->get_comm_client(),
            ":comm_inter" => $intervention->get_comm_inter()
        ]);
    }

    public function updateGeneral($intervention): bool
    {
        $requete = $this->db->prepare("
            UPDATE f_inter
            SET
                id_clients = :id_clients,
                id_responsable = :id_responsable,
                id_priorite = :id_priorite,
                date_crea = :date_crea,
                facturation = :facturation,
                date_max = :date_max,
                id_avancements = :id_avancements,
                demande = :demande,
                lieu = :lieu,
                num_devis = :num_devis,
                anomalie = :anomalie,
                date_debut = :date_debut,
                date_fin = :date_fin,
                id_intervenant = :id_intervenant,
                desc_travaux = :desc_travaux,
                duree_init = :duree_init,
                comm_client = :comm_client
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $intervention->get_id(),
            ":id_clients" => $intervention->get_id_clients(),
            ":id_responsable" => $intervention->get_id_responsable(),
            ":id_priorite" => $intervention->get_id_priorite(),
            ":date_crea" => $intervention->get_date_crea(),
            ":facturation" => $intervention->get_facturation(),
            ":date_max" => $intervention->get_date_max(),
            ":id_avancements" => $intervention->get_id_avancements(),
            ":demande" => $intervention->get_demande(),
            ":lieu" => $intervention->get_lieu(),
            ":num_devis" => $intervention->get_num_devis(),
            ":anomalie" => $intervention->get_anomalie(),
            ":date_debut" => $intervention->get_date_debut(),
            ":date_fin" => $intervention->get_date_fin(),
            ":id_intervenant" => $intervention->get_id_intervenant(),
            ":desc_travaux" => $intervention->get_desc_travaux(),
            ":duree_init" => $intervention->get_duree_init(),
            ":comm_client" => $intervention->get_comm_client()
        ]);
    }

    public function updateValidation($intervention): bool
    {
        $requete = $this->db->prepare("
            UPDATE f_inter
            SET
                id_avancements = :id_avancements,
                duree_trav = :duree_trav,
                duree_cont = :duree_cont,
                comm_inter = :comm_inter,
                comm_client = :comm_client,
                visa_client = :visa_client
            WHERE id = :id
        ");

        return $requete->execute([
            ":id" => $intervention->get_id(),
            ":id_avancements" => $intervention->get_id_avancements(),
            ":duree_trav" => $intervention->get_duree_trav(),
            ":duree_cont" => $intervention->get_duree_cont(),
            ":comm_inter" => $intervention->get_comm_inter(),
            ":comm_client" => $intervention->get_comm_client(),
            ":visa_client" => $intervention->get_visa_client()
        ]);
    }

    public function getEnCoursAvecDetails(): array
    {
        $requete = $this->db->prepare("
            SELECT 
                f_inter.*,
                clients.nom AS nom_client,
                utilisateurs.nom AS nom_utilisateur,
                avancements.libelle_avance,
                priorites.libelle_ct_prio AS libelle_prio
            FROM f_inter
            INNER JOIN clients 
                ON f_inter.id_clients = clients.id
            INNER JOIN utilisateurs 
                ON f_inter.id_responsable = utilisateurs.id
            INNER JOIN avancements 
                ON f_inter.id_avancements = avancements.ID
            INNER JOIN priorites 
                ON f_inter.id_priorite = priorites.ID
            WHERE f_inter.id_avancements < 7
            ORDER BY f_inter.id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClotureAvecDetails(): array
    {
        $requete = $this->db->prepare("
            SELECT 
                f_inter.*,
                clients.nom AS nom_client,
                utilisateurs.nom AS nom_utilisateur,
                avancements.libelle_avance,
                priorites.libelle_ct_prio AS libelle_prio
            FROM f_inter
            INNER JOIN clients 
                ON f_inter.id_clients = clients.id
            INNER JOIN utilisateurs 
                ON f_inter.id_responsable = utilisateurs.id
            INNER JOIN avancements 
                ON f_inter.id_avancements = avancements.ID
            INNER JOIN priorites 
                ON f_inter.id_priorite = priorites.ID
            WHERE f_inter.id_avancements = 8 OR f_inter.id_avancements = 7
            ORDER BY f_inter.id DESC
        ");

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM f_inter
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        return $requete->execute();
    }

    public function getEtatAvancementClient(int $id_inter, string $c_postal, ?string $client_num = null ): ?array
    {
        $sql = "
            SELECT
                f_inter.id,
                f_inter.id_clients,
                f_inter.id_avancements,
                avancements.libelle_avance,
                clients.nom,
                clients.c_postal
            FROM f_inter

            INNER JOIN clients
                ON clients.id = f_inter.id_clients

            INNER JOIN avancements
                ON avancements.ID = f_inter.id_avancements

            WHERE f_inter.id = :id_inter
            AND clients.c_postal = :c_postal
        ";

        /*
        * Si l'identifiant client est renseigné,
        * on l'ajoute à la vérification.
        */
        if ($client_num !== null && $client_num !== '') {
            $sql .= " AND clients.nom = :client_num";
        }

        $sql .= " LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':id_inter',
            $id_inter,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':c_postal',
            $c_postal,
            PDO::PARAM_STR
        );

        if ($client_num !== null && $client_num !== '') {
            $stmt->bindValue(
                ':client_num',
                $client_num,
                PDO::PARAM_STR
            );
        }

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }
}