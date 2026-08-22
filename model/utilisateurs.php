<?php
	
	require_once(ROOT_PATH . "/dao/utilisateurs.php");
	
	class utilisateursModel {
	
		// Propriétés
		private $id;
		private $login;
		private $password;
		private $nom;
		private $prenom;
		private $id_fonctions;
		
		// Constructeur
		public function __construct() {}
		
		// Getters
		public function get_id() { return $this->id; }
		public function get_login() { return $this->login; }
		public function get_password() { return $this->password; }
		public function get_nom() { return $this->nom; }
		public function get_prenom() { return $this->prenom; }
		public function get_id_fonctions() { return $this->id_fonctions; }
		
		// Setters
		public function set_id($valeur) { $this->id = $valeur; }
		public function set_login($valeur) { $this->login = $valeur; }
		public function set_password($valeur) { $this->password = $valeur; }
		public function set_nom($valeur) { $this->nom = $valeur; }
		public function set_prenom($valeur) { $this->prenom = $valeur; }
		public function set_id_fonctions($valeur) { $this->id_fonctions = $valeur; }

		
		// Récupération de tous les utilisateurs
		public function getAll() {
			
			// On renvoie le résultat de la requête
			$utilisateurs= new utilisateursDAO();
			return $utilisateurs->getAll();
		}
		
		// Connexion utilisateurs
		public function seConnecter($login, $password) {
			
			// On renvoie le résultat de la requête
			$utilisateurs= new utilisateursDAO();
			return $utilisateurs->seConnecter($login, $password);
		}
				
		// Récupération de l'utilisateursà partir de son identifiant
		public function getutilisateursById($id) {
			
			// On renvoie le résultat de la requête
			$utilisateurs= new utilisateursDAO();
			return $utilisateurs->getutilisateursById($id);
		}
		
		
		// Récupération des utilisateurs avec sa fonction
		public function getutilisateursEtFonction() {
			
			// On renvoie le résultat de la requête
			$utilisateurs= new utilisateursDAO();
			return $utilisateurs->getutilisateursEtFonction();
		}

		
		// Modification du mot de passe
		public function reinitMotdepasse($id, $password) {
			
			// On renvoie le résultat de la requête
			$utilisateurs = new utilisateursDAO();
			$utilisateurs->reinitMotdepasse($id, $password);
		}

		// Modification du mot de passe
		public function modifierMotDePasse($element) {
			
			// On renvoie le résultat de la requête
			$utilisateurs = new utilisateursDAO();
			$utilisateurs->modifierMotDePasse($element);
		}
		
		// Récupération des FCIS pour l'état d'avancement après filtrage
		public function getUtilisateursFiltrage($filtrage_utilisateurs, $filtrage_fonction) {
			
			// On renvoie le résultat de la requête
			$utilisateurs = new utilisateursDAO();
			return $utilisateurs->getUtilisateursFiltrage($filtrage_utilisateurs, $filtrage_fonction);
		}

		// Ajout d'un utilisateur
		public function add($utilisateur) {
		    $utilisateurs = new utilisateursDAO();
		    return $utilisateurs->add($utilisateur);
		}

		// Modification d'un utilisateur
		public function update($utilisateur) {
		    $utilisateurs = new utilisateursDAO();
		    return $utilisateurs->update($utilisateur);
		}

		// Suppression d'un utilisateur
		public function delete($id) {
		    $utilisateurs = new utilisateursDAO();
		    return $utilisateurs->delete((int)$id);
		}
	}

?>