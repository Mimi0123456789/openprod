<?php
	
	require_once(ROOT_PATH . "/dao/avancements.php");
	
	class avancementsModel {
	
		// Propriétés
		private $id;
		private $avancements;
		
		// Constructeur
		public function __construct() {}
		
		// Getters
		public function get_id() { return $this->id; }
		public function get_avancements() { return $this->avancements; }
		
		// Setters
		public function set_id($valeur) { $this->id = $valeur; }
		public function set_avancements($valeur) { $this->avancements = $valeur; }
		
		// Récupération de tous les états d'avancements
		public function getAll() {
			
			// On renvoie le résultat de la requête
			$avancements = new avancementsDAO();
			return $avancements->getAll();
		}
		
		// Récupération de l'état d'avancements par l'identifiant
		public function getavancementsbyId($id) {
			
			// On renvoie le résultat de la requête
			$avancements = new avancementsDAO();
			return $avancements->getavancementsbyId($id);
		}
	}

?>