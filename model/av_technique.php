<?php
	
	require_once(ROOT_PATH . "/dao/av_technique.php");
	
	class av_techniqueModel {
	
		// Propriétés
		private $id;
		private $av_technique;
		
		// Constructeur
		public function __construct() {}
		
		// Getters
		public function get_id() { return $this->id; }
		public function get_av_technique() { return $this->av_technique; }
		
		// Setters
		public function set_id($valeur) { $this->id = $valeur; }
		public function set_av_technique($valeur) { $this->av_technique = $valeur; }
		
		// Récupération de tous les états d'av_technique
		public function getAll() {
			
			// On renvoie le résultat de la requête
			$av_technique = new av_techniqueDAO();
			return $av_technique->getAll();
		}
		
		// Récupération de l'état d'av_technique par l'identifiant
		public function getAv_techniquebyId($id) {
			
			// On renvoie le résultat de la requête
			$av_technique = new av_techniqueDAO();
			return $av_technique->getav_techniquebyId($id);
		}
	}

?>