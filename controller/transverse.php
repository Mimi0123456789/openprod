<?php

	require_once(ROOT_PATH . "/model/utilisateurs.php");
	require_once(ROOT_PATH . "/model/fonctions.php");
	require_once(ROOT_PATH . "/model/clients.php");
	require_once(ROOT_PATH . "/model/f_inter.php");
	require_once(ROOT_PATH . "/model/travaux.php");
	require_once(ROOT_PATH . "/model/tests.php");
	require_once(ROOT_PATH . "/model/systemes.php");
    require_once(ROOT_PATH . "/model/etat_init.php");
    require_once(ROOT_PATH . "/model/prises_init.php");
    require_once(ROOT_PATH . "/model/obturateurs_init.php");
	require_once(ROOT_PATH . "/model/tt_prises.php");
	require_once(ROOT_PATH . "/model/tt_obtu.php");
	require_once(ROOT_PATH . "/model/photos_init.php");
	require_once(ROOT_PATH . "/model/photos_fin.php");

	class transverse {
		private $vue;

		private function jsonResponse(array $response, int $statusCode = 200): void
		{
		    if (ob_get_length()) {
		        ob_clean();
		    }

		    http_response_code($statusCode);
		    header('Content-Type: application/json; charset=utf-8');
		    echo json_encode($response);
		    exit;
		}

		private function exportNoSqlIntervention(int $id_inter): bool
		{
			if ($id_inter <= 0) {
				return false;
			}

			try {
				require_once(ROOT_PATH . '/services/InterventionNoSqlExporter.php');

				return InterventionNoSqlExporter::generate($id_inter);

			} catch (Throwable $e) {
				error_log(
					"Erreur export NoSQL intervention {$id_inter} : " .
					$e->getMessage() .
					PHP_EOL .
					$e->getTraceAsString()
				);

				return false;
			}
		}

		// CONSTRUCTEUR
		public function __construct() {}

		// Affichage de l'état d'avancement
		public function etat_avancement()
		{
			$reponse = null;
			$erreur = null;

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$id_inter = (int) ($_POST['id_inter'] ?? 0);

				$c_postal = trim(
					$_POST['c_postal'] ?? ''
				);

				$client_num = trim(
					$_POST['client_num'] ?? ''
				);

				if ($id_inter <= 0) {

					$erreur = "Le numéro d'intervention est invalide.";

				} elseif ($c_postal === '') {

					$erreur = "Le code postal est obligatoire.";

				} else {

					$fInterModel = new f_interModel();

					$intervention =
						$fInterModel->getEtatAvancementClient(
							$id_inter,
							$c_postal,
							$client_num !== ''
								? $client_num
								: null
						);

					if ($intervention) {

						$reponse =
							$intervention['libelle_avance']
							?? null;

					} else {

						$erreur =
							"Aucune correspondance n'a été trouvée, veuillez vérifier les informations saisies.";
					}
				}
			}

			include ROOT_PATH . "/views/etat_avancement.php";
		}

		// Affichage du listing des clients
		public function listing_clients() {

			include "views/clients/clients.php";
		}

		// Ajout ou modification d'un client
		public function add_clients()
		{
		    if (isset($_POST["nom"])) {

		        $client = new clientsModel();

		        if (isset($_POST["id_client"]) && $_POST["id_client"] !== "") {
		            $client->set_id((int) $_POST["id_client"]);
		        }

		        $client->set_nom(strtoupper(trim($_POST["nom"] ?? "")));
		        $client->set_adresse(strtoupper(trim($_POST["adresse"] ?? "")));
		        $client->set_c_postal(trim($_POST["c_postal"] ?? ""));
		        $client->set_ville(strtoupper(trim($_POST["ville"] ?? "")));
		        $client->set_num_tel(trim($_POST["num_tel"] ?? ""));
		        $client->set_mail(trim($_POST["mail"] ?? ""));
		        $client->set_representant(strtoupper(trim($_POST["representant"] ?? "")));

		        if ($client->get_id()) {
		            $client->update($client);
		            echo "<div class=\"succes\">Client modifié avec succès</div>";
		        } else {
		            $client->add($client);
		            echo "<div class=\"succes\">Client ajouté avec succès</div>";
		        }
		    }

		    $this->listing_clients();
		}

		// Suppression d'un client
		public function delete_clients()
		{
		    if (isset($_POST["id_client"])) {
		        $client = new clientsModel();
		        $client->delete((int) $_POST["id_client"]);

		        echo "<div class=\"succes\">Client supprimé avec succès</div>";
		    }

		    $this->listing_clients();
		}

		// Edition d'un client
		public function edit_clients()
		{
		    if (isset($_POST["id_client"])) {
		        $clientModel = new clientsModel();
		        $client = $clientModel->getById((int) $_POST["id_client"]);

		        include "views/clients/edit_clients.php";
		    }
		}

		// Modification d'un client
		public function update_clients()
		{
		    if (isset($_POST["id_client"])) {

		        $client = new clientsModel();

		        $client->set_id((int) $_POST["id_client"]);
		        $client->set_nom(strtoupper(trim($_POST["nom"] ?? "")));
		        $client->set_adresse(strtoupper(trim($_POST["adresse"] ?? "")));
		        $client->set_c_postal(trim($_POST["c_postal"] ?? ""));
		        $client->set_ville(strtoupper(trim($_POST["ville"] ?? "")));
		        $client->set_num_tel(trim($_POST["num_tel"] ?? ""));
		        $client->set_mail(trim($_POST["mail"] ?? ""));
		        $client->set_representant(strtoupper(trim($_POST["representant"] ?? "")));

		        $client->update($client);

		        echo "<div class=\"succes\">Client modifié avec succès</div>";
		    }

		    $this->listing_clients();
		}

		// Affichage du listing des interventions
		public function fprod_en_cours() {
			include "views/f_prod/inter.php";
		}

		// Ajout d'une intervention
		public function add_inter()
		{
		    $response = [
		        'success' => false,
		        'message' => 'Données incomplètes'
		    ];

		    if (
		        isset($_POST['id_clients']) &&
		        isset($_POST['id_avancements']) &&
		        isset($_POST['id_priorite']) &&
		        isset($_POST['id_responsable']) &&
		        isset($_POST['id_intervenant'])
		    ) {
		        $intervention = new f_interModel();

		        $intervention->set_id_clients((int) $_POST['id_clients']);
		        $intervention->set_id_avancements((int) $_POST['id_avancements']);
		        $intervention->set_duree_init((int) ($_POST['duree_init'] ?? 0));

		        $intervention->set_date_crea($_POST['date_crea'] ?? null);
		        $intervention->set_date_max($_POST['date_max'] ?? null);
		        $intervention->set_date_debut(!empty($_POST['date_debut']) ? $_POST['date_debut'] : null);
		        $intervention->set_date_fin(!empty($_POST['date_fin']) ? $_POST['date_fin'] : null);

		        $intervention->set_id_priorite((int) $_POST['id_priorite']);
		        $intervention->set_id_responsable((int) $_POST['id_responsable']);
		        $intervention->set_id_intervenant((int) $_POST['id_intervenant']);

		        $intervention->set_lieu(trim($_POST['lieu'] ?? ''));
		        $intervention->set_num_devis(trim($_POST['num_devis'] ?? ''));
		        $intervention->set_demande(trim($_POST['demande'] ?? ''));
		        $intervention->set_facturation(trim($_POST['facturation'] ?? ''));

		        $intervention->set_anomalie(trim($_POST['anomalie'] ?? ''));
		        $intervention->set_desc_travaux(trim($_POST['desc_travaux'] ?? ''));
		        $intervention->set_comm_client(trim($_POST['comm_client'] ?? ''));

		        $intervention->set_visa_intervenant('');
		        $intervention->set_conclu('');
		        $intervention->set_duree_trav(0);
		        $intervention->set_duree_cont(0);
		        $intervention->set_visa_client('vise');
		        $intervention->set_comm_inter('');

		        $id_inter = $intervention->add($intervention);

		        if ($id_inter) {
		            require_once(ROOT_PATH . '/services/InterventionNoSqlExporter.php');

		            $ok = InterventionNoSqlExporter::generate((int) $id_inter);

		            if (!$ok) {
		                error_log("Erreur export JSON intervention ID : " . $id_inter);
		            }

		            $response = [
		                'success' => true,
		                'message' => 'Intervention créée avec succès',
		                'id_inter' => (int) $id_inter
		            ];
		        } else {
		            $response['message'] = 'Erreur lors de la création';
		        }
		    }

		    echo json_encode(
		        $response,
		        JSON_UNESCAPED_UNICODE |
		        JSON_INVALID_UTF8_SUBSTITUTE
		    );

		    exit;
		}

		// Suppression d'une intervention
		public function delete_inter()
		{
		    if (isset($_POST["id"])) {
		        $intervention = new f_interModel();
		        $intervention->delete((int) $_POST["id"]);
		    }

		    header("Location: index.php?c=transverse&a=fprod_en_cours");
		    exit;
		}

		public function update_inter_syst()
		{
		    $response = [
		        'success' => false,
		        'message' => 'ID intervention manquant'
		    ];

		    if (isset($_POST["id_inter"])) {

		        $id_inter = (int) $_POST["id_inter"];

		        $systemesModel = new systemesModel();
		        $systemeExistant = $systemesModel->getByInterventionId($id_inter);

		        $systeme = new systemesModel();

		        if ($systemeExistant) {
		            $systeme->set_id((int) $systemeExistant["id"]);
		        }

		        $systeme->set_id_inter($id_inter);

		        $systeme->set_reference(trim($_POST["reference"] ?? ""));
		        $systeme->set_marque(trim($_POST["marque"] ?? ""));
		        $systeme->set_num_immat_sys(trim($_POST["num_immat_sys"] ?? ""));
		        $systeme->set_type(trim($_POST["type"] ?? ""));

		        $systeme->set_mat_inject((int) ($_POST["mat_inject"] ?? 1));

		        $systeme->set_temp_inject(
		            isset($_POST["temp_inject"]) && $_POST["temp_inject"] !== ""
		                ? (int) $_POST["temp_inject"]
		                : null
		        );

		        $systeme->set_nbr_pt((int) ($_POST["nbr_pt"] ?? 0));
		        $systeme->set_nbr_resistance((int) ($_POST["nbr_resistance"] ?? 0));
		        $systeme->set_nbr_sonde((int) ($_POST["nbr_sonde"] ?? 0));
		        $systeme->set_nbr_prise((int) ($_POST["nbr_prise"] ?? 0));
		        $systeme->set_nbr_obtu((int) ($_POST["nbr_obtu"] ?? 0));

		        $systeme->set_obturation(
		            ((int) ($_POST["nbr_obtu"] ?? 0) > 0) ? 1 : 0
		        );

		        $systeme->set_type_obturation(trim($_POST["type_obturation"] ?? ""));
		        $systeme->set_embout(trim($_POST["embout"] ?? ""));
		        $systeme->set_description(trim($_POST["description"] ?? ""));

		        if ($systemeExistant) {
		            $ok = $systemesModel->update($systeme);
		        } else {
		            $ok = $systemesModel->add($systeme);
		        }

		        $this->exportNoSqlIntervention($id_inter);

		        $response = [
		            'success' => true,
		            'message' => 'Système enregistré avec succès',
		            'id_inter' => $id_inter
		        ];
		    }

		    if (ob_get_length()) {
		        ob_clean();
		    }

		    header('Content-Type: application/json; charset=utf-8');
		    echo json_encode($response);
		    exit;
		}

		// Maj intervention général
		public function update_inter_general()
		{
		    if (!isset($_POST["id"])) {
		        $this->jsonResponse([
		            "success" => false,
		            "message" => "ID intervention manquant"
		        ], 400);
		    }

		    $id_inter = (int) $_POST["id"];

		    $intervention = new f_interModel();

		    $intervention->set_id($id_inter);
		    $intervention->set_id_clients((int) ($_POST["id_clients"] ?? 0));
		    $intervention->set_id_avancements((int) ($_POST["id_avancements"] ?? 0));
		    $intervention->set_duree_init((int) ($_POST["duree_init"] ?? 0));

		    $intervention->set_date_crea($_POST["date_crea"] ?? null);
		    $intervention->set_date_max($_POST["date_max"] ?? null);
		    $intervention->set_date_debut(!empty($_POST["date_debut"]) ? $_POST["date_debut"] : null);
		    $intervention->set_date_fin(!empty($_POST["date_fin"]) ? $_POST["date_fin"] : null);

		    $intervention->set_id_priorite((int) ($_POST["id_priorite"] ?? 0));
		    $intervention->set_id_responsable((int) ($_POST["id_responsable"] ?? 0));
		    $intervention->set_id_intervenant((int) ($_POST["intervenant"] ?? $_POST["id_intervenant"] ?? 0));

		    $intervention->set_lieu(trim($_POST["lieu"] ?? ""));
		    $intervention->set_num_devis(trim($_POST["num_devis"] ?? ""));
		    $intervention->set_demande(trim($_POST["demande"] ?? ""));
		    $intervention->set_facturation(trim($_POST["facturation"] ?? ""));
		    $intervention->set_anomalie(trim($_POST["anomalie"] ?? ""));
		    $intervention->set_desc_travaux(trim($_POST["desc_travaux"] ?? ""));
		    $intervention->set_comm_client(trim($_POST["comm_client"] ?? ""));

		    $intervention->updateGeneral($intervention);

		    $this->exportNoSqlIntervention($id_inter);

		    $this->jsonResponse([
		        "success" => true,
		        "message" => "Intervention modifiée avec succès",
		        "id_inter" => $id_inter
		    ]);
		}

		public function update_inter_etat_init()
		{
			if (!isset($_POST["id_inter"])) {
				$this->jsonResponse([
					"success" => false,
					"message" => "id_inter manquant"
				], 400);
			}

			$id_inter = (int) $_POST["id_inter"];

			if ($id_inter <= 0) {
				$this->jsonResponse([
					"success" => false,
					"message" => "id_inter invalide"
				], 400);
			}

			/*
			|--------------------------------------------------------------------------
			| État initial
			|--------------------------------------------------------------------------
			*/

			$etat = new etat_initModel();
			$etat->set_id_inter($id_inter);

			$etat->set_eg_propre($_POST["eg_propre"] ?? "");
			$etat->set_eg_ancien($_POST["eg_ancien"] ?? "");
			$etat->set_eg_etatgene($_POST["eg_etatgene"] ?? "");
			$etat->set_eg_aspectgene($_POST["eg_aspectgene"] ?? "");
			$etat->set_eg_aspectdesc($_POST["eg_aspectdesc"] ?? "");
			$etat->set_eg_rouille($_POST["eg_rouille"] ?? "");
			$etat->set_eg_demontage($_POST["eg_demontage"] ?? "");
			$etat->set_eg_fuite_mat($_POST["eg_fuite_mat"] ?? "");
			$etat->set_eg_avis_etatgene($_POST["eg_avis_etatgene"] ?? "");

			$etat->set_mec_etatgene($_POST["mec_etatgene"] ?? "");
			$etat->set_mec_eta_entre_mat($_POST["mec_eta_entre_mat"] ?? "");
			$etat->set_mec_eta_entre_mat_pre($_POST["mec_eta_entre_mat_pre"] ?? "");
			$etat->set_mec_eta_sorti_mat($_POST["mec_eta_sorti_mat"] ?? "");
			$etat->set_mec_eta_sorti_mat_pre($_POST["mec_eta_sorti_mat_pre"] ?? "");
			$etat->set_mec_huile_fuit($_POST["mec_huile_fuit"] ?? "");
			$etat->set_mec_avis_tech($_POST["mec_avis_tech"] ?? "");

			$etat->set_ele_etatgene($_POST["ele_etatgene"] ?? "");
			$etat->set_ele_etatcable($_POST["ele_etatcable"] ?? "");
			$etat->set_ele_etatprotec($_POST["ele_etatprotec"] ?? "");
			$etat->set_ele_avis_tech($_POST["ele_avis_tech"] ?? "");
			$etat->set_ele_resis_hs((int) ($_POST["ele_resis_hs"] ?? 0));
			$etat->set_ele_sonde_hs((int) ($_POST["ele_sonde_hs"] ?? 0));

			$etat->set_th_etatgene($_POST["th_etatgene"] ?? "");
			$etat->set_th_stable($_POST["th_stable"] ?? "");
			$etat->set_th_inerti($_POST["th_inerti"] ?? "");
			$etat->set_th_test($_POST["th_test"] ?? "");
			$etat->set_th_temp_test((int) ($_POST["th_temp_test"] ?? 0));
			$etat->set_th_pilotage($_POST["th_pilotage"] ?? "");
			$etat->set_th_avis_therm($_POST["th_avis_therm"] ?? "");

			$etatModel = new etat_initModel();
			$etatExistant = $etatModel->getByInterventionId($id_inter);

			if ($etatExistant) {
				$etat->set_id((int) $etatExistant["id"]);
				$etatModel->update($etat);
			} else {
				$etatModel->add($etat);
			}

			/*
			|--------------------------------------------------------------------------
			| Prises initiales
			|--------------------------------------------------------------------------
			*/

			$systemesModel = new systemesModel();
			$systeme = $systemesModel->getByInterventionId($id_inter);

			$nbr_prise = (int) ($systeme["nbr_prise"] ?? 0);
			$nbr_obtu = (int) ($systeme["nbr_obtu"] ?? 0);

			$prisesModel = new prises_initModel();
			$prisesModel->deleteByEtatInit($id_inter);

			for ($i = 1; $i <= $nbr_prise; $i++) {
				$prise = new prises_initModel();

				$prise->set_id_eta_init($id_inter);
				$prise->set_num_prise($i);

				for ($pin = 1; $pin <= 8; $pin++) {
					$typeSetter = "set_type" . $pin;
					$etatSetter = "set_etat" . $pin;
					$isoSetter = "set_iso" . $pin;

					$prise->$typeSetter($_POST["type_" . $pin . $i] ?? "non_cable");
					$prise->$etatSetter((int) ($_POST["etat_" . $pin . $i] ?? 0));
					$prise->$isoSetter((int) ($_POST["iso_" . $pin . $i] ?? 0));
				}

				$prisesModel->add($prise);
			}

			/*
			|--------------------------------------------------------------------------
			| Obturateurs initiaux
			|--------------------------------------------------------------------------
			*/

			$obturateursModel = new obturateurs_initModel();
			$obturateursModel->deleteByEtatInit($id_inter);

			for ($i = 1; $i <= $nbr_obtu; $i++) {
				$obtu = new obturateurs_initModel();

				$obtu->set_id_eta_init($id_inter);
				$obtu->set_num_obtu($i);
				$obtu->set_jeu_obtu((int) ($_POST["jeu_obtu_" . $i] ?? 0));
				$obtu->set_jeu_guide((int) ($_POST["jeu_guide_" . $i] ?? 0));
				$obtu->set_etat_obtu($_POST["eg_" . $i] ?? "correct");
				$obtu->set_etat_guide($_POST["e_guide_" . $i] ?? "correct");
				$obtu->set_attel_etat($_POST["e_attel_" . $i] ?? "correct");

				$obturateursModel->add($obtu);
			}

			/*
			|--------------------------------------------------------------------------
			| Photos initiales
			|--------------------------------------------------------------------------
			*/

			$photosInitModel = new photos_initModel();

			if (!empty($_POST["photos_titres"]) && is_array($_POST["photos_titres"])) {
				foreach ($_POST["photos_titres"] as $id_photo => $titre) {
					$photosInitModel->updateTitre((int) $id_photo, trim($titre));
				}
			}

			if (!empty($_POST["photos_delete"]) && is_array($_POST["photos_delete"])) {
				foreach ($_POST["photos_delete"] as $id_photo) {
					$photosInitModel->delete((int) $id_photo);
				}
			}

			if (isset($_FILES["photos_init"]) && !empty($_FILES["photos_init"]["name"][0])) {
				$uploadDir = ROOT_PATH . "/storage/images/init/" . $id_inter;
				$publicDir = "storage/images/init/" . $id_inter;

				if (!is_dir($uploadDir)) {
					if (!mkdir($uploadDir, 0775, true)) {
						throw new Exception("Impossible de créer le dossier : " . $uploadDir);
					}
				}

				$allowedMimeTypes = [
					"image/jpeg" => "jpg",
					"image/png"  => "png"
				];

				foreach ($_FILES["photos_init"]["name"] as $index => $originalName) {
					if ($_FILES["photos_init"]["error"][$index] !== UPLOAD_ERR_OK) {
						continue;
					}

					$tmpName = $_FILES["photos_init"]["tmp_name"][$index];

					if (!is_uploaded_file($tmpName)) {
						continue;
					}

					$mimeType = mime_content_type($tmpName);

					if (!isset($allowedMimeTypes[$mimeType])) {
						continue;
					}

					$extension = $allowedMimeTypes[$mimeType];

					$safeBaseName = pathinfo($originalName, PATHINFO_FILENAME);
					$safeBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $safeBaseName);
					$safeBaseName = strtolower($safeBaseName);

					if ($safeBaseName === "") {
						$safeBaseName = "photo_init";
					}

					$newFileName = $safeBaseName . "_" . uniqid("", true) . "." . $extension;

					$destination = $uploadDir . "/" . $newFileName;
					$publicPath = $publicDir . "/" . $newFileName;

					if (!move_uploaded_file($tmpName, $destination)) {
						throw new Exception("Impossible de déplacer l'image : " . $originalName);
					}

					$insertOk = $photosInitModel->add([
						"id_inter"    => $id_inter,
						"nom_fichier" => $newFileName,
						"titre"       => $safeBaseName,
						"chemin"      => $publicPath
					]);

					if (!$insertOk) {
						throw new Exception("Image copiée mais non enregistrée en base : " . $originalName);
					}
				}
			}

			/*
			|--------------------------------------------------------------------------
			| Création / mise à jour du fichier JSON NoSQL
			|--------------------------------------------------------------------------
			*/

			$exportOk = $this->exportNoSqlIntervention($id_inter);

			if (!$exportOk) {
				$this->jsonResponse([
					"success" => false,
					"message" => "État initial enregistré, mais erreur lors de la génération du fichier JSON.",
					"id_inter" => $id_inter,
					"export_json" => false
				], 500);
			}

			$this->jsonResponse([
				"success" => true,
				"message" => "État initial et fichier JSON enregistrés avec succès",
				"id_inter" => $id_inter,
				"export_json" => true
			]);
		}

		public function update_inter_travaux()
		{
		    if (!isset($_POST["id_inter"])) {
		        $this->jsonResponse([
				    "success" => false,
				    "message" => "id_inter manquant"
				], 400);
		    }

		    $id_inter = (int) $_POST["id_inter"];

		    $travaux = new travauxModel();
		    $travaux->set_id_inter($id_inter);
		    $travaux->set_id_av_trav((int) ($_POST["id_av_trav"] ?? 1));
		    $travaux->set_nettoyage((int) ($_POST["nettoyage"] ?? 0));
		    $travaux->set_passage_four((int) ($_POST["passage_four"] ?? 0));
		    $travaux->set_chang_resistance((int) ($_POST["chang_resistance"] ?? 0));
		    $travaux->set_nbr_chang_resistance((int) ($_POST["nbr_chang_resistance"] ?? 0));
		    $travaux->set_chang_sonde((int) ($_POST["chang_sonde"] ?? 0));
		    $travaux->set_nbr_chang_sonde((int) ($_POST["nbr_chang_sonde"] ?? 0));
		    $travaux->set_modif_cablage_elec((int) ($_POST["modif_cablage_elec"] ?? 0));
		    $travaux->set_modif_cir_eau((int) ($_POST["modif_cir_eau"] ?? 0));
		    $travaux->set_modif_cir_huile((int) ($_POST["modif_cir_huile"] ?? 0));
		    $travaux->set_modif_cir_elec((int) ($_POST["modif_cir_elec"] ?? 0));
		    $travaux->set_modif_cir_air((int) ($_POST["modif_cir_air"] ?? 0));
		    $travaux->set_modif_meca((int) ($_POST["modif_meca"] ?? 0));
		    $travaux->set_modif_meca_tete((int) ($_POST["modif_meca_tete"] ?? 0));
		    $travaux->set_nbr_modif_meca_tete((int) ($_POST["nbr_modif_meca_tete"] ?? 0));
		    $travaux->set_modif_meca_rectif((int) ($_POST["modif_meca_rectif"] ?? 0));
		    $travaux->set_nbr_modif_meca_rectif((int) ($_POST["nbr_modif_meca_rectif"] ?? 0));
		    $travaux->set_modif_meca_corp((int) ($_POST["modif_meca_corp"] ?? 0));
		    $travaux->set_desc_modif_meca_corp(trim($_POST["desc_modif_meca_corp"] ?? ""));

		    $travauxModel = new travauxModel();

		    if ($travauxModel->getByInterventionId($id_inter)) {
		        $travauxModel->update($travaux);
		    } else {
		        $travauxModel->add($travaux);
		    }

		    $this->exportNoSqlIntervention($id_inter);

		    $this->jsonResponse([
			    "success" => true,
			    "message" => "Travaux enregistrés avec succès",
			    "id_inter" => $id_inter
			]);
		}

		public function update_inter_controles()
		{
			try {
				if (!isset($_POST["id_inter"])) {
					$this->jsonResponse([
						"success" => false,
						"message" => "id_inter manquant"
					], 400);
				}

				$id_inter = (int) $_POST["id_inter"];

				if ($id_inter <= 0) {
					$this->jsonResponse([
						"success" => false,
						"message" => "id_inter invalide"
					], 400);
				}

				/*
				|--------------------------------------------------------------------------
				| Contrôles
				|--------------------------------------------------------------------------
				*/

				$test = new testsModel();
				$test->set_id_inter($id_inter);

				$test->set_tt_validation($_POST["tt_validation"] ?? "");
				$test->set_tt_date($_POST["tt_date"] ?? null);

				$test->set_tt_eg_propre($_POST["tt_eg_propre"] ?? "");
				$test->set_tt_eg_etatgene($_POST["tt_eg_etatgene"] ?? "");
				$test->set_tt_eg_avis_tech($_POST["tt_eg_avis_tech"] ?? "");

				$test->set_tt_mec_etatgene($_POST["tt_mec_etatgene"] ?? "");
				$test->set_tt_mec_eta_entre_mat($_POST["tt_mec_eta_entre_mat"] ?? "");
				$test->set_tt_mec_eta_sorti_mat($_POST["tt_mec_eta_sorti_mat"] ?? "");
				$test->set_tt_mec_huile_fuit($_POST["tt_mec_huile_fuit"] ?? "");
				$test->set_tt_mec_bleu($_POST["tt_mec_bleu"] ?? "");
				$test->set_tt_mec_avis_tech($_POST["tt_mec_avis_tech"] ?? "");

				$test->set_tt_ele_etatgene($_POST["tt_ele_etatgene"] ?? "");
				$test->set_tt_ele_etatcable($_POST["tt_ele_etatcable"] ?? "");
				$test->set_tt_ele_resit($_POST["tt_ele_resit"] ?? "");
				$test->set_tt_rec_obtu($_POST["tt_rec_obtu"] ?? "");
				$test->set_tt_ele_sond($_POST["tt_ele_sond"] ?? "");
				$test->set_tt_ele_avis_tech($_POST["tt_ele_avis_tech"] ?? "");

				$test->set_tt_th_etatgene($_POST["tt_th_etatgene"] ?? "");
				$test->set_tt_th_stable($_POST["tt_th_stable"] ?? "");
				$test->set_tt_th_inerti($_POST["tt_th_inerti"] ?? "");
				$test->set_tt_th_temp_test((int) ($_POST["tt_th_temp_test"] ?? 0));
				$test->set_tt_th_pilotage($_POST["tt_th_pilotage"] ?? "");
				$test->set_tt_th_avis_therm($_POST["tt_th_avis_therm"] ?? "");
				$test->set_tt_th_dur_mont((int) ($_POST["tt_th_dur_mont"] ?? 0));

				$testsModel = new testsModel();
				$testExistant = $testsModel->getByInterventionId($id_inter);

				if ($testExistant) {
					$test->set_id((int) $testExistant["id"]);
					$testsModel->update($test);
				} else {
					$testsModel->add($test);
				}

				/*
				|--------------------------------------------------------------------------
				| Prises finales
				|--------------------------------------------------------------------------
				*/

				$systemesModel = new systemesModel();
				$systeme = $systemesModel->getByInterventionId($id_inter);

				$nbr_prise = (int) ($systeme["nbr_prise"] ?? 0);
				$nbr_obtu = (int) ($systeme["nbr_obtu"] ?? 0);

				$ttPrisesModel = new tt_prisesModel();
				$ttPrisesModel->deleteByEtatInit($id_inter);

				for ($i = 1; $i <= $nbr_prise; $i++) {
					$prise = new tt_prisesModel();

					$prise->set_id_eta_init($id_inter);
					$prise->set_num_prise($i);

					for ($pin = 1; $pin <= 8; $pin++) {
						$prise->{"set_type" . $pin}($_POST["type_" . $pin . $i] ?? "non_cable");
						$prise->{"set_etat" . $pin}((int) ($_POST["etat_" . $pin . $i] ?? 0));
						$prise->{"set_iso" . $pin}((int) ($_POST["iso_" . $pin . $i] ?? 0));

						if (method_exists($prise, "set_val" . $pin)) {
							$prise->{"set_val" . $pin}((float) ($_POST["val_" . $pin . $i] ?? 0));
						}
					}

					$ttPrisesModel->add($prise);
				}

				/*
				|--------------------------------------------------------------------------
				| Obturateurs finaux
				|--------------------------------------------------------------------------
				*/

				$ttObtuModel = new tt_obtuModel();
				$ttObtuModel->deleteByEtatInit($id_inter);

				for ($i = 1; $i <= $nbr_obtu; $i++) {
					$obtu = new tt_obtuModel();

					$obtu->set_id_eta_init($id_inter);
					$obtu->set_num_obtu($i);
					$obtu->set_jeu_guide(0);
					$obtu->set_etat_obtu($_POST["eg_" . $i] ?? "correct");
					$obtu->set_etat_guide($_POST["e_guide_" . $i] ?? "correct");
					$obtu->set_attel_etat($_POST["e_attel_" . $i] ?? "correct");

					$ttObtuModel->add($obtu);
				}

				/*
				|--------------------------------------------------------------------------
				| Photos finales
				|--------------------------------------------------------------------------
				*/

				$photosFinModel = new photos_finModel();

				if (!empty($_POST["photos_titres"]) && is_array($_POST["photos_titres"])) {
					foreach ($_POST["photos_titres"] as $id_photo => $titre) {
						$photosFinModel->updateTitre((int) $id_photo, trim($titre));
					}
				}

				if (!empty($_POST["photos_delete"]) && is_array($_POST["photos_delete"])) {
					foreach ($_POST["photos_delete"] as $id_photo) {
						$photosFinModel->delete((int) $id_photo);
					}
				}

				if (isset($_FILES["photos_fin"]) && !empty($_FILES["photos_fin"]["name"][0])) {
					$uploadDir = ROOT_PATH . "/storage/images/fin/" . $id_inter;
					$publicDir = "storage/images/fin/" . $id_inter;

					if (!is_dir($uploadDir)) {
						if (!mkdir($uploadDir, 0775, true)) {
							throw new Exception("Impossible de créer le dossier : " . $uploadDir);
						}
					}

					$allowedMimeTypes = [
						"image/jpeg" => "jpg",
						"image/png"  => "png"
					];

					foreach ($_FILES["photos_fin"]["name"] as $index => $originalName) {
						if ($_FILES["photos_fin"]["error"][$index] !== UPLOAD_ERR_OK) {
							continue;
						}

						$tmpName = $_FILES["photos_fin"]["tmp_name"][$index];

						if (!is_uploaded_file($tmpName)) {
							continue;
						}

						$mimeType = mime_content_type($tmpName);

						if (!isset($allowedMimeTypes[$mimeType])) {
							continue;
						}

						$extension = $allowedMimeTypes[$mimeType];

						$safeBaseName = pathinfo($originalName, PATHINFO_FILENAME);
						$safeBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $safeBaseName);
						$safeBaseName = strtolower($safeBaseName);

						if ($safeBaseName === "") {
							$safeBaseName = "photo_fin";
						}

						$newFileName = $safeBaseName . "_" . uniqid("", true) . "." . $extension;

						$destination = $uploadDir . "/" . $newFileName;
						$publicPath = $publicDir . "/" . $newFileName;

						if (!move_uploaded_file($tmpName, $destination)) {
							throw new Exception("Impossible de déplacer l'image : " . $originalName);
						}

						$insertOk = $photosFinModel->add([
							"id_inter"     => $id_inter,
							"nom_fichier"  => $newFileName,
							"chemin"       => $publicPath,
						]);

						if (!$insertOk) {
							throw new Exception("Image copiée mais non enregistrée en base : " . $originalName);
						}
					}
				}

				/*
				|--------------------------------------------------------------------------
				| Export NoSQL
				|--------------------------------------------------------------------------
				*/

				$exportOk = $this->exportNoSqlIntervention($id_inter);

				if (!$exportOk) {
					$this->jsonResponse([
						"success" => false,
						"message" => "Contrôles enregistrés, mais erreur lors de la génération du fichier JSON.",
						"id_inter" => $id_inter,
						"export_json" => false
					], 500);
				}

				$this->jsonResponse([
					"success" => true,
					"message" => "Contrôles, photos finales et fichier JSON enregistrés avec succès",
					"id_inter" => $id_inter,
					"export_json" => true
				]);

			} catch (Throwable $e) {
				$this->jsonResponse([
					"success" => false,
					"message" => "Erreur PHP : " . $e->getMessage()
				], 500);
			}
		}

		public function update_inter_validation()
		{
		    if (!isset($_POST["id"])) {
		        $this->jsonResponse([
		            "success" => false,
		            "message" => "ID intervention manquant"
		        ], 400);
		    }

		    $id_inter = (int) $_POST["id"];

		    $intervention = new f_interModel();

		    $intervention->set_id($id_inter);
		    $intervention->set_id_avancements((int) ($_POST["id_avancements"] ?? 0));
		    $intervention->set_duree_cont((int) ($_POST["duree_cont"] ?? 0));
		    $intervention->set_duree_trav((int) ($_POST["duree_trav"] ?? 0));
		    $intervention->set_comm_client(trim($_POST["comm_client"] ?? ""));
		    $intervention->set_comm_inter(trim($_POST["comm_inter"] ?? ""));
		    $intervention->set_visa_client(trim($_POST["visa_client"] ?? "vise"));

		    $fInterModel = new f_interModel();
		    $fInterModel->updateValidation($intervention);

		    $this->exportNoSqlIntervention($id_inter);

		    $this->jsonResponse([
		        "success" => true,
		        "message" => "Validation enregistrée avec succès",
		        "id_inter" => $id_inter
		    ]);
		}	

		// Suppression d'une intervention cloturee
		public function delete_inter_clot() {
			

			if(isset($_POST["id"])) {
				$id=$_POST['id'];

				$requete = $bdd->query("DELETE FROM f_inter WHERE id='$id'");

			}

			echo "<div class=\"succes\">Client supprimé avec succès</div>";
			header('location:index.php?c=transverse&a=fprod_cloture');

		}

		// Edition d'une intervention cloturee
		public function edit_inter_clot() {
			if(isset($_POST["id_client"])) {
			include "views/f_prod/edit_inter_clot.php";}
		}

		public function update_inter_clot() {

			include('elements_bdd.php');

			if(isset($_POST["id_client"])) {
			$id=$_POST['id_client'];

			$nom=$_POST['nom'];
			$adresse=$_POST['adresse'];
			$c_postal=$_POST['c_postal'];
			$ville=$_POST['ville'];
			$num_tel=$_POST['num_tel'];
			$mail=$_POST['mail'];
			$representant=$_POST['representant'];

			$requete = $bdd->query("UPDATE clients SET nom='$nom', adresse='$adresse', c_postal='$c_postal', ville='$ville', num_tel='$num_tel', mail='$mail', representant='$representant' WHERE id=".$id);}

			echo "<div class=\"succes\">Client modifié avec succès</div>";
			header('location:index.php?c=transverse&a=fprod_cloture');
		}


		// Affichage du listing des interventions
		public function fprod_cloture() {
			include "views/f_prod/inter_cloture.php";
		}

		// Affichage du compte de l'utilisateurs
		public function mon_compte() {

			// Récupération des fonctions
			$fonctions = new fonctionsModel;
			$fonctions = $fonctions->getAll();

			include "views/mon_compte.php";
		}


		// Procédure de modification du mot de passe
		public function proc_modifier_mdp() {

			if(isset($_POST["password_reinit"]) && isset($_POST["confirm_password_reinit"])) {

				// On vérifie que les 2 mots de passe sont identiques
				if($_POST["password_reinit"] != $_POST["confirm_password_reinit"]) {
					echo "<div class=\"erreur\">Les deux mots de passe ne sont pas identiques</div>";
				}
				else {
					// Création de l'objet utilisateurs pour ajout dans la base de données
					$password_util = new utilisateursModel;
					$password_util->set_id($_SESSION["utilisateurs"]["id"]);
					$password_util->set_password($_POST["password_reinit"]);
					$password_util->modifierMotDePasse($password_util);

					// On met à jour la variable de session pour le mot de passe
					$_SESSION["utilisateurs"]["password"] = md5($_POST["password_reinit"]);

					echo "<div class=\"succes\">Mot de passe modifié avec succès</div>";
				}

				$this->mon_compte();
			}
		}

		// Affichage du tableau de bord
		public function dashboard() {
			include "views/dashboard.php";
		}

		public function generate_inter_pdf()
		{
			require_once(ROOT_PATH . "/services/InterventionPdfGenerator.php");

			$id_inter = 0;

			if (isset($_GET["id_inter"])) {
				$id_inter = (int) $_GET["id_inter"];
			} elseif (isset($_GET["id"])) {
				$id_inter = (int) $_GET["id"];
			} elseif (isset($_POST["id_inter"])) {
				$id_inter = (int) $_POST["id_inter"];
			} elseif (isset($_POST["id"])) {
				$id_inter = (int) $_POST["id"];
			}

			InterventionPdfGenerator::generate($id_inter);
		}

		public function generate_inter_full_pdf()
		{
			require_once(ROOT_PATH . "/services/InterventionFullPdfGenerator.php");

			$id_inter = isset($_GET["id_inter"]) ? (int) $_GET["id_inter"] : 0;

			InterventionFullPdfGenerator::generate($id_inter);
		}

		private static function sanitizeFilename(string $filename): string
		{
			$filename = trim($filename);

			$filename = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $filename);

			$filename = preg_replace('/[^A-Za-z0-9_\- ]/', '', $filename);

			$filename = preg_replace('/\s+/', '_', $filename);

			return $filename;
		}

		public function download_inter_zip()
		{
			require_once(ROOT_PATH . "/services/InterventionPdfGenerator.php");
			require_once(ROOT_PATH . "/services/InterventionFullPdfGenerator.php");

			$id_inter = isset($_GET["id_inter"]) ? (int) $_GET["id_inter"] : 0;

			if ($id_inter <= 0) {
				http_response_code(400);
				exit("Intervention invalide");
			}

			$zipDir = ROOT_PATH . "/storage/tmp";

			if (!is_dir($zipDir)) {
				mkdir($zipDir, 0777, true);
			}

			$zipPath = $zipDir . "/intervention_" . $id_inter . ".zip";

			if (file_exists($zipPath)) {
				unlink($zipPath);
			}

			$zip = new ZipArchive();

			if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
				http_response_code(500);
				exit("Impossible de créer le fichier ZIP");
			}

			try {
				// PDF 1 : fiche récapitulative
				$zip->addFromString(
					"fiche_recapitulative_intervention_" . $id_inter . ".pdf",
					InterventionPdfGenerator::output($id_inter)
				);

				// PDF 2 : dossier complet
				$zip->addFromString(
					"dossier_complet_intervention_" . $id_inter . ".pdf",
					InterventionFullPdfGenerator::output($id_inter)
				);

				// Images initiales
				$photosInitModel = new photos_initModel();

				foreach ($photosInitModel->getByIntervention($id_inter) as $photo) {

					if (!file_exists($photo["chemin"])) {
						continue;
					}

					$extension = pathinfo($photo["nom_fichier"], PATHINFO_EXTENSION);

					$nomZip = self::sanitizeFilename($photo["titre"]);

					if ($nomZip === "") {
						$nomZip = pathinfo($photo["nom_fichier"], PATHINFO_FILENAME);
					}

					$zip->addFile(
						$photo["chemin"],
						"images_initiales/" . $nomZip . "." . $extension
					);
				}

				// Images finales
				$photosFinModel = new photos_finModel();

				foreach ($photosFinModel->getByIntervention($id_inter) as $photo) {

					if (!file_exists($photo["chemin"])) {
						continue;
					}

					$extension = pathinfo($photo["nom_fichier"], PATHINFO_EXTENSION);

					$nomZip = self::sanitizeFilename($photo["titre"]);

					if ($nomZip === "") {
						$nomZip = pathinfo($photo["nom_fichier"], PATHINFO_FILENAME);
					}

					$zip->addFile(
						$photo["chemin"],
						"images_finales/" . $nomZip . "." . $extension
					);
				}

				$zip->close();

				while (ob_get_level()) {
					ob_end_clean();
				}

				header("Content-Type: application/zip");
				header("Content-Disposition: attachment; filename=intervention_" . $id_inter . ".zip");
				header("Content-Length: " . filesize($zipPath));
				header("Cache-Control: no-cache, must-revalidate");
				header("Pragma: public");

				readfile($zipPath);
				unlink($zipPath);
				exit;

			} catch (Exception $e) {
				$zip->close();

				if (file_exists($zipPath)) {
					unlink($zipPath);
				}

				http_response_code(500);
				exit("Erreur ZIP : " . $e->getMessage());
			}
		}

		private static function addFolderToZip(ZipArchive $zip, string $folderPath, string $zipFolder): void
		{
			$files = scandir($folderPath);

			foreach ($files as $file) {
				if ($file === "." || $file === "..") {
					continue;
				}

				$fullPath = $folderPath . "/" . $file;

				if (is_file($fullPath)) {
					$zip->addFile($fullPath, $zipFolder . "/" . $file);
				}
			}
		}
	}
?>
