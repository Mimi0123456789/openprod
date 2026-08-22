<?php
	
	require_once(ROOT_PATH . "/dao/matieres.php");
	
	class matieresModel {
	
		// Propriétés
		private $id;
		private $matieres;
		
		// Constructeur
		public function __construct() {}
		
		// Getters
		public function get_id() { return $this->id; }
		public function get_matieres() { return $this->matieres; }
		
		// Setters
		public function set_id($valeur) { $this->id = $valeur; }
		public function set_matieres($valeur) { $this->matieres = $valeur; }
		
		// Récupération de tous les états d'matieres
		public function getAll() {
			
			// On renvoie le résultat de la requête
			$matieres = new matieresDAO();
			return $matieres->getAll();
		}
		
		// Récupération de l'état d'matieres par l'identifiant
		public function getmatieresbyId($id) {
			
			// On renvoie le résultat de la requête
			$matieres = new matieresDAO();
			return $matieres->getmatieresbyId($id);
		}
	}

?>