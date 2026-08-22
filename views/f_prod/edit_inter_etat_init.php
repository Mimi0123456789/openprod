<?php

require_once(ROOT_PATH . "/model/etat_init.php");
require_once(ROOT_PATH . "/model/systemes.php");
require_once(ROOT_PATH . "/model/prises_init.php");
require_once(ROOT_PATH . "/model/obturateurs_init.php");
require_once(ROOT_PATH . "/model/photos_init.php");

$id_inter = (int) ($_POST['id'] ?? 0);

/*
|--------------------------------------------------------------------------
| État initial lié à l’intervention
|--------------------------------------------------------------------------
*/

$etatInitModel = new etat_initModel();
$donnees_inter = $etatInitModel->getByInterventionId($id_inter);

if (!$donnees_inter) {
  $donnees_inter = [
    'id' => 0,
    'id_inter' => $id_inter,

    'eg_propre' => '',
    'eg_ancien' => '',
    'eg_etatgene' => '',
    'eg_aspectgene' => '',
    'eg_aspectdesc' => '',
    'eg_rouille' => '',
    'eg_demontage' => '',
    'eg_fuite_mat' => '',
    'eg_avis_etatgene' => '',

    'mec_etatgene' => '',
    'mec_eta_entre_mat' => '',
    'mec_eta_entre_mat_pre' => '',
    'mec_eta_sorti_mat' => '',
    'mec_eta_sorti_mat_pre' => '',
    'mec_huile_fuit' => '',
    'mec_avis_tech' => '',

    'ele_etatgene' => '',
    'ele_etatcable' => '',
    'ele_etatprotec' => '',
    'ele_avis_tech' => '',
    'ele_resis_hs' => 0,
    'ele_sonde_hs' => 0,

    'th_etatgene' => '',
    'th_stable' => '',
    'th_inerti' => '',
    'th_test' => '',
    'th_temp_test' => '',
    'th_pilotage' => '',
    'th_avis_therm' => ''
  ];
}

/*
|--------------------------------------------------------------------------
| Système lié à l’intervention
|--------------------------------------------------------------------------
*/

$systemesModel = new systemesModel();
$donnees_syst = $systemesModel->getByInterventionId($id_inter);

$nbr_prise = (int) ($donnees_syst['nbr_prise'] ?? 0);
$nbr_obtu  = (int) ($donnees_syst['nbr_obtu'] ?? 0);

/*
|--------------------------------------------------------------------------
| Prises initiales
|--------------------------------------------------------------------------
*/

$prisesInitModel = new prises_initModel();
$prisesInit = $prisesInitModel->getByEtatInit($id_inter);

$prisesByNum = [];

foreach ($prisesInit as $prise) {
  $prisesByNum[(int) $prise['num_prise']] = $prise;
}

/*
|--------------------------------------------------------------------------
| Obturateurs initiaux
|--------------------------------------------------------------------------
*/

$obturateursInitModel = new obturateurs_initModel();
$obturateursInit = $obturateursInitModel->getByEtatInit($id_inter);

$obturateursByNum = [];

foreach ($obturateursInit as $obturateur) {
  $obturateursByNum[(int) $obturateur['num_obtu']] = $obturateur;
}

/*
|--------------------------------------------------------------------------
| Photos initiales
|--------------------------------------------------------------------------
*/

$photosInitModel = new photos_initModel();
$photosInit = $photosInitModel->getByInterventionId($id_inter);

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

if (!function_exists('checkedValue')) {
  function checkedValue($current, $expected, $default = false) {
    if ($current == $expected || ($default && ($current == '' || $current === null))) {
      return 'checked="checked"';
    }

    return '';
  }
}

if (!function_exists('cycleChoiceInit')) {
  function cycleChoiceInit($name, $label, $choices, $current, $defaultIndex = 0) {
    $currentIndex = $defaultIndex;

    foreach ($choices as $index => $choice) {
      if (($current !== '' && $current !== null) && $current == $choice['value']) {
        $currentIndex = $index;
        break;
      }
    }

    $values  = array_column($choices, 'value');
    $labels  = array_column($choices, 'label');
    $classes = array_column($choices, 'class');

    $currentChoice = $choices[$currentIndex];
    ?>
      <div class="init-cycle-group">
        <span class="choice-label"><?php echo htmlspecialchars($label); ?></span>

        <input
          type="hidden"
          name="<?php echo htmlspecialchars($name); ?>"
          value="<?php echo htmlspecialchars($currentChoice['value']); ?>"
        >

        <button
          type="button"
          class="init-cycle-btn <?php echo htmlspecialchars($currentChoice['class']); ?>"
          data-index="<?php echo (int)$currentIndex; ?>"
          data-values="<?php echo htmlspecialchars(json_encode($values), ENT_QUOTES, 'UTF-8'); ?>"
          data-labels="<?php echo htmlspecialchars(json_encode($labels), ENT_QUOTES, 'UTF-8'); ?>"
          data-classes="<?php echo htmlspecialchars(json_encode($classes), ENT_QUOTES, 'UTF-8'); ?>"
        >
          <?php echo htmlspecialchars($currentChoice['label']); ?>
        </button>
      </div>
    <?php
  }
}

/*
|--------------------------------------------------------------------------
| Choix cycliques
|--------------------------------------------------------------------------
*/

$choicesCorrectARevoir = [
  ['value' => 'CORRECT', 'label' => 'CORRECT', 'class' => 'init-cycle-ok'],
  ['value' => 'A REVOIR', 'label' => 'À REVOIR', 'class' => 'init-cycle-alert']
];

$choicesCorrectIncorrect = [
  ['value' => 'INCORRECT', 'label' => 'INCORRECT', 'class' => 'init-cycle-bad'],
  ['value' => 'CORRECT', 'label' => 'CORRECT', 'class' => 'init-cycle-ok']
];

$choicesAspect = [
  ['value' => 'CORRECT', 'label' => 'CORRECT', 'class' => 'init-cycle-ok'],
  ['value' => 'CHOC(S)', 'label' => 'CHOC(S)', 'class' => 'init-cycle-alert'],
  ['value' => 'FISSURE(S)', 'label' => 'FISSURE(S)', 'class' => 'init-cycle-bad']
];

$choicesRouille = [
  ['value' => 'AUCUNE', 'label' => 'AUCUNE', 'class' => 'init-cycle-ok'],
  ['value' => 'PARTIELLE', 'label' => 'PARTIELLE', 'class' => 'init-cycle-alert'],
  ['value' => 'TOTALE', 'label' => 'TOTALE', 'class' => 'init-cycle-bad']
];

$choicesNiveau = [
  ['value' => 'INCORRECT', 'label' => 'INCORRECT', 'class' => 'init-cycle-ok'],
  ['value' => 'PARTIEL', 'label' => 'PARTIEL', 'class' => 'init-cycle-alert'],
  ['value' => 'TOTAL', 'label' => 'TOTAL', 'class' => 'init-cycle-bad']
];

$choicesFuite = [
  ['value' => 'INCORRECT', 'label' => 'INCORRECT', 'class' => 'init-cycle-ok'],
  ['value' => 'PARTIELLE', 'label' => 'PARTIELLE', 'class' => 'init-cycle-alert'],
  ['value' => 'TOTALE', 'label' => 'TOTALE', 'class' => 'init-cycle-bad']
];

$choicesThermique = [
  ['value' => 'VALIDÉ', 'label' => 'VALIDÉ', 'class' => 'init-cycle-ok'],
  ['value' => 'A REVOIR', 'label' => 'À REVOIR', 'class' => 'init-cycle-alert'],
  ['value' => 'NON RÉALISÉ', 'label' => 'NON RÉALISÉ', 'class' => 'init-cycle-neutral']
];

$choicesTypePrise = [
  ['value' => 'non_cable', 'label' => 'NON CÂBLÉ', 'class' => 'init-cycle-neutral'],
  ['value' => 'resistance', 'label' => 'RÉSISTANCE', 'class' => 'init-cycle-alert'],
  ['value' => 'sonde', 'label' => 'SONDE', 'class' => 'init-cycle-ok']
];

$choicesEtatObtu = [
  ['value' => 'correct', 'label' => 'CORRECT', 'class' => 'init-cycle-ok'],
  ['value' => 'use', 'label' => 'USÉ', 'class' => 'init-cycle-alert'],
  ['value' => 'abime', 'label' => 'ABÎMÉ', 'class' => 'init-cycle-alert'],
  ['value' => 'casse', 'label' => 'CASSÉ', 'class' => 'init-cycle-bad']
];

?>

<form method="POST" action="index.php?c=transverse&a=update_inter_etat_init" enctype="multipart/form-data" class="sav-form edit-inter-systeme-tablette">

  <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$id_inter); ?>">
  <input type="hidden" name="id_inter" value="<?php echo htmlspecialchars((string)$id_inter); ?>">

  <div class="form-section">
    <h3><i class="fa-solid fa-clipboard-check"></i> Général</h3>

    <div class="form-grid">
      <?php
        cycleChoiceInit('eg_propre', 'Propreté générale', $choicesCorrectARevoir, $donnees_inter['eg_propre'] ?? '', 0);
        cycleChoiceInit('eg_ancien', 'Ancienneté', $choicesCorrectARevoir, $donnees_inter['eg_ancien'] ?? '', 0);
        cycleChoiceInit('eg_etatgene', 'État général', $choicesCorrectARevoir, $donnees_inter['eg_etatgene'] ?? '', 0);
        cycleChoiceInit('eg_aspectgene', 'Vision extérieure', $choicesAspect, $donnees_inter['eg_aspectgene'] ?? '', 0);
        cycleChoiceInit('eg_rouille', 'Présence de rouille', $choicesRouille, $donnees_inter['eg_rouille'] ?? '', 0);
        cycleChoiceInit('eg_demontage', 'Nécessite un démontage', $choicesNiveau, $donnees_inter['eg_demontage'] ?? '', 0);
        cycleChoiceInit('eg_fuite_mat', 'Fuite de matière', $choicesFuite, $donnees_inter['eg_fuite_mat'] ?? '', 0);
      ?>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Avis technique</label>
        <textarea name="eg_avis_etatgene"><?php echo htmlspecialchars($donnees_inter['eg_avis_etatgene'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-section">
    <h3><i class="fa-solid fa-gears"></i> Mécanique</h3>

    <div class="form-grid">
      <?php
        cycleChoiceInit('mec_etatgene', 'État mécanique', $choicesCorrectARevoir, $donnees_inter['mec_etatgene'] ?? '', 0);
        cycleChoiceInit('mec_eta_entre_mat', 'État entrée matière', $choicesCorrectARevoir, $donnees_inter['mec_eta_entre_mat'] ?? '', 0);
        cycleChoiceInit('mec_eta_entre_mat_pre', 'Présence de matière à l’entrée', $choicesCorrectIncorrect, $donnees_inter['mec_eta_entre_mat_pre'] ?? '', 0);
        cycleChoiceInit('mec_eta_sorti_mat', 'État sortie matière', $choicesCorrectARevoir, $donnees_inter['mec_eta_sorti_mat'] ?? '', 0);
        cycleChoiceInit('mec_eta_sorti_mat_pre', 'Présence de matière à la sortie', $choicesCorrectIncorrect, $donnees_inter['mec_eta_sorti_mat_pre'] ?? '', 0);
        cycleChoiceInit('mec_huile_fuit', 'Présence anormale de gras', $choicesCorrectIncorrect, $donnees_inter['mec_huile_fuit'] ?? '', 0);
      ?>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Avis technique</label>
        <textarea name="mec_avis_tech"><?php echo htmlspecialchars($donnees_inter['mec_avis_tech'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-section">
    <h3><i class="fa-solid fa-bolt"></i> Électrique</h3>

    <div class="form-grid">
      <?php
        cycleChoiceInit('ele_etatgene', 'État général', $choicesCorrectARevoir, $donnees_inter['ele_etatgene'] ?? '', 0);
        cycleChoiceInit('ele_etatcable', 'État câblage', $choicesCorrectARevoir, $donnees_inter['ele_etatcable'] ?? '', 0);
        cycleChoiceInit('ele_etatprotec', 'État de la protection', $choicesCorrectARevoir, $donnees_inter['ele_etatprotec'] ?? '', 0);
      ?>

      <div class="form-group-custom">
        <label>Nombre de résistance HS</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="ele_resis_hs">−</button>
          <input id="ele_resis_hs" type="number" name="nbr_prise" min="0" value="<?php echo htmlspecialchars((string)($donnees_syst['ele_resis_hs'] ?? 0)); ?>" required>
          <button type="button" class="step-btn" data-step="1" data-target="ele_resis_hs">+</button>
        </div>
      </div>

      <div class="form-group-custom">
        <label>Nombre de sonde HS</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="ele_sonde_hs">−</button>
          <input id="ele_sonde_hs" type="number" name="ele_sonde_hs" min="0" value="<?php echo htmlspecialchars((string)($donnees_syst['ele_sonde_hs'] ?? 0)); ?>" required>
          <button type="button" class="step-btn" data-step="1" data-target="ele_sonde_hs">+</button>
        </div>
      </div>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Avis technique</label>
        <textarea name="ele_avis_tech"><?php echo htmlspecialchars($donnees_inter['ele_avis_tech'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-section">
    <h3><i class="fa-solid fa-temperature-high"></i> Thermique</h3>

    <div class="form-grid">
      <?php
        cycleChoiceInit('th_etatgene', 'État général', $choicesCorrectARevoir, $donnees_inter['th_etatgene'] ?? '', 0);
        cycleChoiceInit('th_test', 'Essai en chauffe', $choicesThermique, $donnees_inter['th_test'] ?? '', 0);
        cycleChoiceInit('th_stable', 'Stabilité en température', $choicesThermique, $donnees_inter['th_stable'] ?? '', 0);
        cycleChoiceInit('th_pilotage', 'Montée en température', $choicesThermique, $donnees_inter['th_pilotage'] ?? '', 0);
        cycleChoiceInit('th_inerti', 'Essai en température', $choicesThermique, $donnees_inter['th_inerti'] ?? '', 0);
      ?>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Avis technique</label>
        <textarea name="th_avis_therm"><?php echo htmlspecialchars($donnees_inter['th_avis_therm'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-section collapsible-section">
    <button type="button" class="collapse-toggle" data-collapse-target="prises-collapse">
      <span>
        <i class="fa-solid fa-plug"></i>
        Prises
        <small><?php echo (int)$nbr_prise; ?> prise(s)</small>
      </span>
      <i class="fa-solid fa-chevron-down collapse-icon"></i>
    </button>

    <div id="prises-collapse" class="collapse-content">
      <?php if ($nbr_prise <= 0) { ?>
        <p>Aucune prise déclarée sur ce système.</p>
      <?php } else { ?>

        <div class="tablet-tabs" data-tabs-group="prises">
          <?php for ($i = 1; $i <= $nbr_prise; $i++) { ?>
            <button type="button" class="tablet-tab <?php echo $i === 1 ? 'active' : ''; ?>" data-tab-target="prise-panel-<?php echo $i; ?>">
              Prise <?php echo $i; ?>
            </button>
          <?php } ?>
        </div>

        <?php
        $pins = [
          1 => '1-9',
          2 => '2-10',
          3 => '3-11',
          4 => '4-12',
          5 => '5-13',
          6 => '6-14',
          7 => '7-15',
          8 => '8-16'
        ];

        for ($i = 1; $i <= $nbr_prise; $i++) {
          $donnees_prise = $prisesByNum[$i] ?? [];
        ?>
          <div id="prise-panel-<?php echo $i; ?>" class="tablet-panel <?php echo $i === 1 ? 'active' : ''; ?>">
            <div class="technical-card">
              <h4>Prise n°<?php echo $i; ?></h4>

              <?php foreach ($pins as $pinNumber => $pinLabel) { ?>
                <div class="pin-card">
                  <div class="pin-card-title">PIN <?php echo htmlspecialchars($pinLabel); ?></div>

                  <div class="pin-grid">
                    <div class="field-box">
                      <?php
                        cycleChoiceInit(
                          'type_' . $pinNumber . $i,
                          'Type',
                          $choicesTypePrise,
                          $donnees_prise['type'.$pinNumber] ?? '',
                          0
                        );
                      ?>
                    </div>

                    <div class="field-box switch-zone">
                      <span class="choice-label">Fonctionnement correct</span>
                      <label class="big-switch">
                        <input type="hidden" value="0" name="etat_<?php echo $pinNumber . $i; ?>">
                        <input type="checkbox" value="1" name="etat_<?php echo $pinNumber . $i; ?>" <?php echo checkedValue($donnees_prise['etat'.$pinNumber] ?? '', '1'); ?>>
                        <span></span>
                      </label>
                    </div>

                    <div class="field-box switch-zone">
                      <span class="choice-label">Isolation correcte</span>
                      <label class="big-switch">
                        <input type="hidden" value="0" name="iso_<?php echo $pinNumber . $i; ?>">
                        <input type="checkbox" value="1" name="iso_<?php echo $pinNumber . $i; ?>" <?php echo checkedValue($donnees_prise['iso'.$pinNumber] ?? '', '1'); ?>>
                        <span></span>
                      </label>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

  <div class="form-section collapsible-section">
    <button type="button" class="collapse-toggle" data-collapse-target="obturateurs-collapse">
      <span>
        <i class="fa-solid fa-circle-nodes"></i>
        Obturateurs
        <small><?php echo (int)$nbr_obtu; ?> obturateur(s)</small>
      </span>
      <i class="fa-solid fa-chevron-down collapse-icon"></i>
    </button>

    <div id="obturateurs-collapse" class="collapse-content">
      <?php if ($nbr_obtu <= 0) { ?>
        <p>Aucun obturateur déclaré sur ce système.</p>
      <?php } else { ?>

        <div class="tablet-tabs" data-tabs-group="obturateurs">
          <?php for ($i = 1; $i <= $nbr_obtu; $i++) { ?>
            <button type="button" class="tablet-tab <?php echo $i === 1 ? 'active' : ''; ?>" data-tab-target="obtu-panel-<?php echo $i; ?>">
              Obtu. <?php echo $i; ?>
            </button>
          <?php } ?>
        </div>

        <?php
        for ($i = 1; $i <= $nbr_obtu; $i++) {
          $donnees_obtu = $obturateursByNum[$i] ?? [];
        ?>
          <div id="obtu-panel-<?php echo $i; ?>" class="tablet-panel <?php echo $i === 1 ? 'active' : ''; ?>">
            <div class="technical-card">
              <h4>Obturateur n°<?php echo $i; ?></h4>

              <div class="init-obtu-grid">
                <div class="init-obtu-item switch-zone">
                  <span class="choice-label">Jeu obturateur</span>
                  <label class="big-switch">
                    <input type="hidden" value="0" name="jeu_obtu_<?php echo $i; ?>">
                    <input type="checkbox" value="1" name="jeu_obtu_<?php echo $i; ?>" <?php echo checkedValue($donnees_obtu['jeu_obtu'] ?? '', '1'); ?>>
                    <span></span>
                  </label>
                </div>

                <div class="init-obtu-item switch-zone">
                  <span class="choice-label">Jeu guide</span>
                  <label class="big-switch">
                    <input type="hidden" value="0" name="jeu_guide_<?php echo $i; ?>">
                    <input type="checkbox" value="1" name="jeu_guide_<?php echo $i; ?>" <?php echo checkedValue($donnees_obtu['jeu_guide'] ?? '', '1'); ?>>
                    <span></span>
                  </label>
                </div>

                <div class="init-obtu-item">
                  <?php
                    cycleChoiceInit(
                      'eg_' . $i,
                      'État général',
                      $choicesEtatObtu,
                      $donnees_obtu['etat_obtu'] ?? '',
                      0
                    );
                  ?>
                </div>

                <div class="init-obtu-item">
                  <?php
                    cycleChoiceInit(
                      'e_guide_' . $i,
                      'État guide',
                      $choicesEtatObtu,
                      $donnees_obtu['etat_guide'] ?? '',
                      0
                    );
                  ?>
                </div>

                <div class="init-obtu-item">
                  <?php
                    cycleChoiceInit(
                      'e_attel_' . $i,
                      'État attelage',
                      $choicesEtatObtu,
                      $donnees_obtu['attel_etat'] ?? '',
                      0
                    );
                  ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

  <div class="form-section" id="photos-initiales">
    <h3><i class="fa-solid fa-images"></i> Photos initiales</h3>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label for="photos_init">Ajouter des images</label>

        <input
          id="photos_init"
          type="file"
          name="photos_init[]"
          accept="image/jpeg,image/png"
          multiple
        >

        <small>Formats acceptés : JPG et PNG.</small>
      </div>
    </div>

    <?php if (!empty($photosInit)) { ?>
      <div class="photos-init-grid">

        <?php foreach ($photosInit as $photo) {
          $photoId = (int) ($photo["id"] ?? 0);
          $photoChemin = $photo["chemin"] ?? "";
          $photoTitre = $photo["titre"] ?? "";
          $photoNomFichier = $photo["nom_fichier"] ?? "";
          $alt = $photoTitre !== "" ? $photoTitre : $photoNomFichier;
        ?>

          <div class="photo-init-card">

            <a
              href="<?php echo htmlspecialchars($photoChemin); ?>"
              target="_blank"
              rel="noopener"
              class="photo-thumb-link"
              title="Voir l'image"
            >
              <img
                class="photo-thumb"
                src="<?php echo htmlspecialchars($photoChemin); ?>"
                alt="<?php echo htmlspecialchars($alt); ?>"
              >
            </a>

            <div class="photo-init-body">

              <label for="photo_init_<?php echo $photoId; ?>">
                Titre de la photo
              </label>

              <input
                id="photo_init_<?php echo $photoId; ?>"
                type="text"
                name="photos_titres[<?php echo $photoId; ?>]"
                value="<?php echo htmlspecialchars($photoTitre); ?>"
                placeholder="Ex : Vue initiale avant démontage"
              >

              <label class="photo-delete-btn">
                <input
                  type="checkbox"
                  name="photos_delete[]"
                  value="<?php echo $photoId; ?>"
                >

                <span>
                  <i class="fa-solid fa-trash"></i>
                  Supprimer
                </span>
              </label>

            </div>

          </div>

        <?php } ?>

      </div>
    <?php } else { ?>

      <div class="empty-photos-message">
        <i class="fa-regular fa-image"></i>
        Aucune photo initiale enregistrée.
      </div>

    <?php } ?>
  </div>

  <div class="form-section">
    <h3><i class="fa-solid fa-align-left"></i> Complément</h3>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Complément de description</label>
        <textarea name="eg_aspectdesc"><?php echo htmlspecialchars($donnees_inter['eg_aspectdesc'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="modal-actions">
    <button type="button" class="btn-secondary-modal" onclick="closeInterModal()">Annuler</button>

    <button type="submit" name="submit" class="btn-primary-modal">
      <i class="fa-solid fa-check"></i>
      Enregistrer
    </button>
  </div>

</form>

<script>
  document.addEventListener('click', function (event) {
    const cycleButton = event.target.closest('.init-cycle-btn');

    if (cycleButton) {
      const group = cycleButton.closest('.init-cycle-group');
      const hiddenInput = group.querySelector('input[type="hidden"]');

      const values = JSON.parse(cycleButton.dataset.values || '[]');
      const labels = JSON.parse(cycleButton.dataset.labels || '[]');
      const classes = JSON.parse(cycleButton.dataset.classes || '[]');

      let currentIndex = parseInt(cycleButton.dataset.index || '0', 10);
      let nextIndex = currentIndex + 1;

      if (nextIndex >= values.length) {
        nextIndex = 0;
      }

      cycleButton.dataset.index = nextIndex;
      hiddenInput.value = values[nextIndex];
      cycleButton.textContent = labels[nextIndex];

      classes.forEach(function (className) {
        cycleButton.classList.remove(className);
      });

      cycleButton.classList.add(classes[nextIndex]);

      return;
    }

    const collapseButton = event.target.closest('.collapse-toggle');

    if (collapseButton) {
      const targetId = collapseButton.dataset.collapseTarget;
      const target = document.getElementById(targetId);

      if (target) {
        collapseButton.classList.toggle('active');
        target.classList.toggle('open');
      }

      return;
    }

    const tab = event.target.closest('.tablet-tab');

    if (!tab) {
      return;
    }

    const tabsContainer = tab.closest('.tablet-tabs');
    const targetId = tab.dataset.tabTarget;

    if (!tabsContainer || !targetId) {
      return;
    }

    const formSection = tabsContainer.closest('.form-section');

    tabsContainer.querySelectorAll('.tablet-tab').forEach(function (item) {
      item.classList.remove('active');
    });

    formSection.querySelectorAll('.tablet-panel').forEach(function (panel) {
      panel.classList.remove('active');
    });

    tab.classList.add('active');

    const targetPanel = formSection.querySelector('#' + targetId);

    if (targetPanel) {
      targetPanel.classList.add('active');
    }
  });

  document.addEventListener('click', function (event) {

      const stepButton = event.target.closest(
          '.edit-inter-systeme-tablette .step-btn'
      );

      if (!stepButton) {
          return;
      }

      const form = stepButton.closest(
          '.edit-inter-systeme-tablette'
      );

      if (!form) {
          return;
      }

      const targetId = stepButton.dataset.target;

      const step = parseInt(
          stepButton.dataset.step || '0',
          10
      );

      const input = form.querySelector(
          '#' + targetId
      );

      if (!input) {
          console.error(
              'Input introuvable pour le stepper :',
              targetId
          );
          return;
      }

      const currentValue = parseInt(
          input.value || '0',
          10
      );

      const minValue = parseInt(
          input.getAttribute('min') || '0',
          10
      );

      const nextValue = Math.max(
          minValue,
          currentValue + step
      );

      input.value = nextValue;

      input.dispatchEvent(
          new Event('change', {
              bubbles: true
          })
      );
  });

</script>