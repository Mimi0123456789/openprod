<?php
	
	require_once(ROOT_PATH . "/dao/priorites.php");
	
	class prioritesModel {
	
		// Propriétés
		private $id;
		private $priorites;
		
		// Constructeur
		public function __construct() {}
		
		// Getters
		public function get_id() { return $this->id; }
		public function get_priorites() { return $this->priorites; }
		
		// Setters
		public function set_id($valeur) { $this->id = $valeur; }
		public function set_priorites($valeur) { $this->priorites = $valeur; }
		
		// Récupération de tous les états d'priorites
		public function getAll() {
			
			// On renvoie le résultat de la requête
			$priorites = new prioritesDAO();
			return $priorites->getAll();
		}
		
		// Récupération de l'état d'priorites par l'identifiant
		public function getprioritesbyId($id) {
			
			// On renvoie le résultat de la requête
			$priorites = new prioritesDAO();
			return $priorites->getprioritesbyId($id);
		}
	}

?>