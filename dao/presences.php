<?php

	require_once(ROOT_PATH . "/dao/database.php");
	
	class presencesDAO {
		
		private $db ;
		
		// Constructeur
		public function __construct() {
			// Connexion à la base
			$this->db = new database;
			$this->db = $this->db->connexion();
		}
		
		// Récupération de tous états d'presences
		public function getAll() {
			
			// Préparation de la requête
			$requete = $this->db->prepare("SELECT * FROM presences order by id");
			
			// Exécution de la requête
			try {
				
				$requete->execute();
				return $requete->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e) {
				echo "Erreur lors de la requête SQL : ".$e->getMessage();
			}
		}
		
		// Récupération d'un état d'presences à partir de son identifiant
		public function getpresencesById($id) {
			
			// Préparation de la requête
			$requete = $this->db->prepare("SELECT * FROM presences WHERE id=:identifiant");
			
			$requete->bindValue(":identifiant",$id, PDO::PARAM_INT);
			
			// Exécution de la requête
			try {
				$requete->execute();
				return $requete->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e) {
				echo "Erreur lors de la requête SQL : ".$e->getMessage();
			}
		}
	}

?>