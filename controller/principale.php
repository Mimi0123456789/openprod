<?php

	require_once("./controller/transverse.php");
	require_once("./controller/administration.php");

	class principale {
			
		// CONSTRUCTEUR
		public function __construct() {}
		
		// Controle de l'appel de la page et appel du contrôleur concerné
		public function afficher($controleur, $vue) {
			
			/* contrôles à faire */
			if(!isset($_SESSION["utilisateurs"])) {
				//header("Location:index.php");
				$redirection = new transverse;
				$redirection->etat_avancement();
			}
			else {
				// On appelle le controleur concerné avec la vue à afficher
				$redirection = new $controleur;
				$redirection->$vue();
			}
		}
	}

?>