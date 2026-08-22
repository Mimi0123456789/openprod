<?php

require_once(ROOT_PATH . "/dao/database.php");

class prises_initDAO
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
            FROM prises_init
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
            FROM prises_init
            WHERE id = :id
        ");

        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();

        $prise = $requete->fetch(PDO::FETCH_ASSOC);

        return $prise ?: null;
    }

    // =========================
    // Récupération par état initial
    // =========================

    public function getByEtatInit(int $id_eta_init): array
    {
        $requete = $this->db->prepare("
            SELECT *
            FROM prises_init
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

    public function add($prise): bool
    {
        $requete = $this->db->prepare("
            INSERT INTO prises_init (
                id_eta_init,

                num_prise,

                type1, etat1, iso1,
                type2, etat2, iso2,
                type3, etat3, iso3,
                type4, etat4, iso4,
                type5, etat5, iso5,
                type6, etat6, iso6,
                type7, etat7, iso7,
                type8, etat8, iso8

            )
            VALUES (
                :id_eta_init,

                :num_prise,

                :type1, :etat1, :iso1,
                :type2, :etat2, :iso2,
                :type3, :etat3, :iso3,
                :type4, :etat4, :iso4,
                :type5, :etat5, :iso5,
                :type6, :etat6, :iso6,
                :type7, :etat7, :iso7,
                :type8, :etat8, :iso8
            )
        ");

        return $requete->execute([

            ":id_eta_init" => $prise->get_id_eta_init(),

            ":num_prise" => $prise->get_num_prise(),

            ":type1" => $prise->get_type1(),
            ":etat1" => $prise->get_etat1(),
            ":iso1" => $prise->get_iso1(),

            ":type2" => $prise->get_type2(),
            ":etat2" => $prise->get_etat2(),
            ":iso2" => $prise->get_iso2(),

            ":type3" => $prise->get_type3(),
            ":etat3" => $prise->get_etat3(),
            ":iso3" => $prise->get_iso3(),

            ":type4" => $prise->get_type4(),
            ":etat4" => $prise->get_etat4(),
            ":iso4" => $prise->get_iso4(),

            ":type5" => $prise->get_type5(),
            ":etat5" => $prise->get_etat5(),
            ":iso5" => $prise->get_iso5(),

            ":type6" => $prise->get_type6(),
            ":etat6" => $prise->get_etat6(),
            ":iso6" => $prise->get_iso6(),

            ":type7" => $prise->get_type7(),
            ":etat7" => $prise->get_etat7(),
            ":iso7" => $prise->get_iso7(),

            ":type8" => $prise->get_type8(),
            ":etat8" => $prise->get_etat8(),
            ":iso8" => $prise->get_iso8()
        ]);
    }

    // =========================
    // Modification
    // =========================

    public function update($prise): bool
    {
        $requete = $this->db->prepare("
            UPDATE prises_init
            SET
                id_eta_init = :id_eta_init,

                num_prise = :num_prise,

                type1 = :type1,
                etat1 = :etat1,
                iso1 = :iso1,

                type2 = :type2,
                etat2 = :etat2,
                iso2 = :iso2,

                type3 = :type3,
                etat3 = :etat3,
                iso3 = :iso3,

                type4 = :type4,
                etat4 = :etat4,
                iso4 = :iso4,

                type5 = :type5,
                etat5 = :etat5,
                iso5 = :iso5,

                type6 = :type6,
                etat6 = :etat6,
                iso6 = :iso6,

                type7 = :type7,
                etat7 = :etat7,
                iso7 = :iso7,

                type8 = :type8,
                etat8 = :etat8,
                iso8 = :iso8

            WHERE id = :id
        ");

        return $requete->execute([

            ":id" => $prise->get_id(),

            ":id_eta_init" => $prise->get_id_eta_init(),

            ":num_prise" => $prise->get_num_prise(),

            ":type1" => $prise->get_type1(),
            ":etat1" => $prise->get_etat1(),
            ":iso1" => $prise->get_iso1(),

            ":type2" => $prise->get_type2(),
            ":etat2" => $prise->get_etat2(),
            ":iso2" => $prise->get_iso2(),

            ":type3" => $prise->get_type3(),
            ":etat3" => $prise->get_etat3(),
            ":iso3" => $prise->get_iso3(),

            ":type4" => $prise->get_type4(),
            ":etat4" => $prise->get_etat4(),
            ":iso4" => $prise->get_iso4(),

            ":type5" => $prise->get_type5(),
            ":etat5" => $prise->get_etat5(),
            ":iso5" => $prise->get_iso5(),

            ":type6" => $prise->get_type6(),
            ":etat6" => $prise->get_etat6(),
            ":iso6" => $prise->get_iso6(),

            ":type7" => $prise->get_type7(),
            ":etat7" => $prise->get_etat7(),
            ":iso7" => $prise->get_iso7(),

            ":type8" => $prise->get_type8(),
            ":etat8" => $prise->get_etat8(),
            ":iso8" => $prise->get_iso8()
        ]);
    }

    // =========================
    // Suppression
    // =========================

    public function delete(int $id): bool
    {
        $requete = $this->db->prepare("
            DELETE FROM prises_init
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
            DELETE FROM prises_init
            WHERE id_eta_init = :id_eta_init
        ");

        $requete->bindValue(":id_eta_init", $id_eta_init, PDO::PARAM_INT);

        return $requete->execute();
    }
}