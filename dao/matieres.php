<?php

	require_once(ROOT_PATH . "/dao/database.php");
	
	class matieresDAO {
		
		private $db ;
		
		// Constructeur
		public function __construct() {
			// Connexion à la base
			$this->db = new database;
			$this->db = $this->db->connexion();
		}
		
		// Récupération de tous états d'matieres
		public function getAll() {
			
			// Préparation de la requête
			$requete = $this->db->prepare("SELECT * FROM matieres order by id");
			
			// Exécution de la requête
			try {
				
				$requete->execute();
				return $requete->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e) {
				echo "Erreur lors de la requête SQL : ".$e->getMessage();
			}
		}
		
		// Récupération d'un état d'matieres à partir de son identifiant
		public function getmatieresById($id) {
			
			// Préparation de la requête
			$requete = $this->db->prepare("SELECT * FROM matieres WHERE id=:identifiant");
			
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