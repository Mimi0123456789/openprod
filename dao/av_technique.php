<?php

	require_once("dao/database.php");
	
	class av_techniqueDAO {
		
		private $db ;
		
		// Constructeur
		public function __construct() {
			// Connexion à la base
			$this->db = new database;
			$this->db = $this->db->connexion();
		}
		
		// Récupération de tous les avancements techniques
		public function getAll() {
			
			// Préparation de la requête
			$requete = $this->db->prepare("SELECT * FROM av_technique order by id");
			
			// Exécution de la requête
			try {
				
				$requete->execute();
				return $requete->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e) {
				echo "Erreur lors de la requête SQL : ".$e->getMessage();
			}
		}
		
		// Récupération d'un avancement technique à partir de son identifiant
		public function getAv_techniqueById($id) {
			
			// Préparation de la requête
			$requete = $this->db->prepare("SELECT * FROM av_technique WHERE id=:identifiant");
			
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