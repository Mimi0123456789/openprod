<?php
	
	require_once(ROOT_PATH . "/dao/presences.php");
	
	class presencesModel {
	
		// Propriétés
		private $id;
		private $presences;
		
		// Constructeur
		public function __construct() {}
		
		// Getters
		public function get_id() { return $this->id; }
		public function get_presences() { return $this->presences; }
		
		// Setters
		public function set_id($valeur) { $this->id = $valeur; }
		public function set_presences($valeur) { $this->presences = $valeur; }
		
		// Récupération de tous les états d'presences
		public function getAll() {
			
			// On renvoie le résultat de la requête
			$presences = new presencesDAO();
			return $presences->getAll();
		}
		
		// Récupération de l'état d'presences par l'identifiant
		public function getpresencesbyId($id) {
			
			// On renvoie le résultat de la requête
			$presences = new presencesDAO();
			return $presences->getpresencesbyId($id);
		}
	}

?>