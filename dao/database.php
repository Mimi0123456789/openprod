<?php

class database
{
    private $bdd;

    public function __construct()
    {
        try {
            $jawsdbUrl = getenv('JAWSDB_URL');

            if (!empty($jawsdbUrl)) {
                $url = parse_url($jawsdbUrl);

                $host = $url['host'];
                $port = $url['port'] ?? 3306;
                $user = $url['user'];
                $password = $url['pass'];
                $db_name = ltrim($url['path'], '/');
            } else {
                // Local / Docker
                $host = "host.docker.internal";
                $port = "3306";
                $user = "root";
                $password = "";
                $db_name = "openprod";
            }

            $charset = "utf8mb4";
            $collate = "utf8mb4_unicode_ci";

            $dsn = "mysql:host={$host};port={$port};dbname={$db_name};charset={$charset}";

            $this->bdd = new PDO(
                $dsn,
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND =>
                        "SET NAMES {$charset} COLLATE {$collate}"
                ]
            );

        } catch (PDOException $e) {
            error_log("Erreur connexion BDD : " . $e->getMessage());
            $this->bdd = null;
        }
    }

    public function connexion()
    {
        if ($this->bdd instanceof PDO) {
            return $this->bdd;
        }

        return null;
    }
}