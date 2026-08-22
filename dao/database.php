<?php

	class database {

		// Paramètres de connexion
		private $bdd;
		private $jawsdbUrl = getenv('JAWSDB_URL');
		private $host = $url['host'];
		private $port = $url['port'] ?? 3306;
		private $user = $url['user'];
		private $password = $url['pass'];
		$db_name = ltrim($url['path'], '/');
		private $charset = "utf8";
		private $collate = 'utf8_unicode_ci';

		// Fonction de connexion - Méthode PDO
		public function __construct() {

			try {
				$this->bdd = new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->db_name.";charset=".$this->charset, $this->user, $this->password,
					array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_PERSISTENT => false,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $this->charset COLLATE $this->collate"
					)
				);
			}
			catch(PDOException $e) {
				echo("Erreur de connexion à la base !");
			}
		}

		public function connexion() {

			if($this->bdd instanceof PDO) {
				return $this->bdd;
			}
		}
	}

?>
