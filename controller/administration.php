<?php
	
	class administration {
			
		private $vue;
		
		// CONSTRUCTEUR
		public function __construct() {}
		
		// Affichage de la page de gestion des utilisateurs
		public function gestion_utilisateurs() {

			include "views/utilisateurs/utilisateurs.php";
		}

		// Ajout d'un utilisateur
		public function add_utilisateurs()
		{
		    if (
		        isset($_POST["nom"]) &&
		        isset($_POST["prenom"]) &&
		        isset($_POST["login"]) &&
		        isset($_POST["id_fonctions"])
		    ) {
		        $utilisateur = new utilisateursModel();

		        $utilisateur->set_nom(strtoupper(trim($_POST["nom"])));
		        $utilisateur->set_prenom(ucfirst(strtolower(trim($_POST["prenom"]))));
		        $utilisateur->set_login(trim($_POST["login"]));
		        $utilisateur->set_id_fonctions((int) $_POST["id_fonctions"]);

		        // Mot de passe par défaut
		        $utilisateur->set_password("EPALyon*2022");

		        $dao = new utilisateursDAO();
		        $dao->add($utilisateur);
		    }

		    $this->gestion_utilisateurs();
		}

		// Réinitialisation du mot de passe d'un utilisateur
		public function reinit_mdp_utilisateurs()
		{
		    if (isset($_POST["id_utilisateurs"])) {
		        $utilisateur = new utilisateursModel();

		        $utilisateur->reinitMotdepasse(
		            (int) $_POST["id_utilisateurs"],
		            "EPALyon*2022"
		        );
		    }

		    $this->gestion_utilisateurs();
		}

		// Suppression d'un utilisateur
		public function delete_utilisateurs()
		{
		    if (isset($_POST["id_utilisateurs"])) {
		        $dao = new utilisateursDAO();
		        $dao->delete((int) $_POST["id_utilisateurs"]);
		    }

		    $this->gestion_utilisateurs();
		}

		// Modification d'un utilisateur
		public function update_utilisateurs()
		{
		    if (
		        isset($_POST["id_utilisateurs"]) &&
		        isset($_POST["nom"]) &&
		        isset($_POST["prenom"]) &&
		        isset($_POST["login"]) &&
		        isset($_POST["id_fonctions"])
		    ) {
		        $utilisateur = new utilisateursModel();

		        $utilisateur->set_id((int) $_POST["id_utilisateurs"]);
		        $utilisateur->set_nom(strtoupper(trim($_POST["nom"])));
		        $utilisateur->set_prenom(ucfirst(strtolower(trim($_POST["prenom"]))));
		        $utilisateur->set_login(trim($_POST["login"]));
		        $utilisateur->set_id_fonctions((int) $_POST["id_fonctions"]);

		        $dao = new utilisateursDAO();
		        $dao->update($utilisateur);
		    }

		    $this->gestion_utilisateurs();
		}

		// Statistiques
		public function stats() {	
			include "views/stats/stats.php";
		}
	}



?>