<?php

require_once(ROOT_PATH . "/model/tests.php");
require_once(ROOT_PATH . "/model/systemes.php");
require_once(ROOT_PATH . "/model/tt_prises.php");
require_once(ROOT_PATH . "/model/tt_obtu.php");
require_once(ROOT_PATH . "/model/photos_fin.php");

$id_inter = (int) ($_POST['id'] ?? $_POST['id_inter'] ?? 0);

$testsModel = new testsModel();
$donnees_inter = $testsModel->getByInterventionId($id_inter);

if (!$donnees_inter) {
  $donnees_inter = [
    'id' => 0,
    'id_inter' => $id_inter,

    'tt_validation' => '',
    'tt_date' => date('Y-m-d'),

    'tt_eg_propre' => '',
    'tt_eg_etatgene' => '',
    'tt_eg_avis_tech' => '',

    'tt_mec_etatgene' => '',
    'tt_mec_eta_entre_mat' => '',
    'tt_mec_eta_sorti_mat' => '',
    'tt_mec_huile_fuit' => '',
    'tt_mec_bleu' => '',
    'tt_mec_avis_tech' => '',

    'tt_ele_etatgene' => '',
    'tt_ele_etatcable' => '',
    'tt_ele_resit' => '',
    'tt_ele_sond' => '',
    'tt_ele_avis_tech' => '',

    'tt_th_etatgene' => '',
    'tt_th_stable' => '',
    'tt_th_inerti' => '',
    'tt_th_temp_test' => 0,
    'tt_th_pilotage' => '',
    'tt_th_avis_therm' => '',

    'tt_rec_obtu' => '',
    'tt_th_dur_mont' => 0
  ];
}

$systemesModel = new systemesModel();
$donnees_syst = $systemesModel->getByInterventionId($id_inter);

$nbr_prise = (int) ($donnees_syst['nbr_prise'] ?? 0);
$nbr_obtu  = (int) ($donnees_syst['nbr_obtu'] ?? 0);

$ttPrisesModel = new tt_prisesModel();
$ttPrises = $ttPrisesModel->getByEtatInit($id_inter);

$prisesByNum = [];

foreach ($ttPrises as $prise) {
  $prisesByNum[(int) $prise['num_prise']] = $prise;
}

$ttObtuModel = new tt_obtuModel();
$ttObturateurs = $ttObtuModel->getByEtatInit($id_inter);

$obturateursByNum = [];

foreach ($ttObturateurs as $obturateur) {
  $obturateursByNum[(int) $obturateur['num_obtu']] = $obturateur;
}

if (!function_exists('checkedValue')) {
  function checkedValue($current, $expected, $default = false) {
    if ($current == $expected || ($default && ($current == '' || $current === null))) {
      return 'checked="checked"';
    }

    return '';
  }
}

if (!function_exists('radioChecked')) {
  function radioChecked($current, $expected, $default = false) {
    if ($current == $expected || ($default && ($current == '' || $current === null))) {
      return 'checked="checked"';
    }

    return '';
  }
}

if (!function_exists('touchChoice')) {
  function touchChoice($name, $value, $label, $current, $default = false, $class = '') {
    ?>
      <label class="touch-choice <?php echo htmlspecialchars($class); ?>">
        <input
          type="radio"
          name="<?php echo htmlspecialchars($name); ?>"
          value="<?php echo htmlspecialchars($value); ?>"
          <?php echo radioChecked($current, $value, $default); ?>
        >
        <span><?php echo htmlspecialchars($label); ?></span>
      </label>
    <?php
  }
}

if (!function_exists('cycleChoice')) {
  function cycleChoice($name, $label, $choices, $current, $defaultIndex = 0) {
    $currentIndex = $defaultIndex;

    foreach ($choices as $index => $choice) {
      if (($current !== '' && $current !== null) && $current == $choice['value']) {
        $currentIndex = $index;
        break;
      }
    }

    $values = array_column($choices, 'value');
    $labels = array_column($choices, 'label');
    $classes = array_column($choices, 'class');

    $currentChoice = $choices[$currentIndex];


    ?>
      <div class="form-group-custom cycle-choice-group">
        <span class="choice-label"><?php echo htmlspecialchars($label); ?></span>

        <input
          type="hidden"
          name="<?php echo htmlspecialchars($name); ?>"
          value="<?php echo htmlspecialchars($currentChoice['value']); ?>"
        >

        <button
          type="button"
          class="cycle-choice-btn <?php echo htmlspecialchars($currentChoice['class']); ?>"
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

$choicesCorrectNeuf = [
  ['value' => 'NON CORRECT', 'label' => 'NON CORRECT', 'class' => 'cycle-bad'],
  ['value' => 'CORRECT', 'label' => 'CORRECT', 'class' => 'cycle-ok'],
  ['value' => 'NEUF', 'label' => 'NEUF', 'class' => 'cycle-new']
];

$choicesCorrect = [
  ['value' => 'NON CORRECT', 'label' => 'NON CORRECT', 'class' => 'cycle-bad'],
  ['value' => 'CORRECT', 'label' => 'CORRECT', 'class' => 'cycle-ok']
];

$choicesValidation = [
  ['value' => 'NON VALIDÉ', 'label' => 'NON VALIDÉ', 'class' => 'cycle-bad'],
  ['value' => 'VALIDÉ', 'label' => 'VALIDÉ', 'class' => 'cycle-ok']
];

$choicesStable = [
  ['value' => 'STABLE', 'label' => 'STABLE', 'class' => 'cycle-ok'],
  ['value' => 'NON STABLE', 'label' => 'NON STABLE', 'class' => 'cycle-bad']
];

$choicesInertie = [
  ['value' => 'NON CORRECT', 'label' => 'NON CORRECT', 'class' => 'cycle-bad'],
  ['value' => 'CORRECT ( < 15min)', 'label' => 'CORRECT < 15 MIN', 'class' => 'cycle-ok']
];

$choicesPilotage = [
  ['value' => 'NON CORRECT', 'label' => 'NON CORRECT', 'class' => 'cycle-bad'],
  ['value' => 'CORRECT ( +/- 10°C)', 'label' => 'CORRECT ± 10°C', 'class' => 'cycle-ok']
];

$choicesTypePrise = [
  ['value' => 'non_cable', 'label' => 'NON CÂBLÉ', 'class' => 'cycle-neutral'],
  ['value' => 'resistance', 'label' => 'RÉSISTANCE', 'class' => 'cycle-alert'],
  ['value' => 'sonde', 'label' => 'SONDE', 'class' => 'cycle-ok']
];

$choicesEtatObtu = [
  ['value' => 'correct', 'label' => 'CORRECT', 'class' => 'cycle-ok'],
  ['value' => 'use', 'label' => 'USÉ', 'class' => 'cycle-alert'],
  ['value' => 'abime', 'label' => 'ABÎMÉ', 'class' => 'cycle-alert'],
  ['value' => 'casse', 'label' => 'CASSÉ', 'class' => 'cycle-bad']
];

/*
|--------------------------------------------------------------------------
| Photos finales
|--------------------------------------------------------------------------
*/

$photosFinModel = new photos_finModel();
$photosFin = $photosFinModel->getByInterventionId($id_inter);

?>

<form method="POST" action="index.php?c=transverse&a=update_inter_controles" class="sav-form edit-inter-systeme-tablette">

  <input type="hidden" name="id_inter" value="<?php echo htmlspecialchars((string)$id_inter); ?>">

  <div class="form-section" id="ctrl-validation">
    <h3><i class="fa-solid fa-list-check"></i> Validation des contrôles</h3>

    <div class="form-grid">
      <?php
        cycleChoice(
          'tt_validation',
          'Contrôles réalisés avec succès',
          $choicesValidation,
          $donnees_inter['tt_validation'] ?? '',
          0
        );
      ?>

      <div class="form-group-custom">
        <label>Date de validation</label>
        <input type="date" name="tt_date" required value="<?php echo htmlspecialchars($donnees_inter['tt_date'] ?? date('Y-m-d')); ?>">
      </div>
    </div>
  </div>

  <div class="form-section" id="ctrl-general">
    <h3><i class="fa-solid fa-clipboard-check"></i> Général</h3>

    <div class="form-grid">
      <?php
        cycleChoice(
          'tt_eg_propre',
          'Propreté générale',
          $choicesCorrect,
          $donnees_inter['tt_eg_propre'] ?? '',
          0
        );

        cycleChoice(
          'tt_eg_etatgene',
          'État général',
          $choicesCorrectNeuf,
          $donnees_inter['tt_eg_etatgene'] ?? '',
          0
        );
      ?>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Avis technique</label>
        <textarea name="tt_eg_avis_tech"><?php echo htmlspecialchars($donnees_inter['tt_eg_avis_tech'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-section" id="ctrl-mecanique">
    <h3><i class="fa-solid fa-gears"></i> Mécanique</h3>

    <div class="form-grid">
      <?php
        $mecaFields = [
          'tt_mec_etatgene' => 'État mécanique',
          'tt_mec_eta_entre_mat' => 'État entrée matière',
          'tt_mec_eta_sorti_mat' => 'État sortie matière',
          'tt_mec_huile_fuit' => 'État circuit hydraulique',
          'tt_mec_bleu' => 'Contrôle des portages'
        ];

        foreach ($mecaFields as $fieldName => $fieldLabel) {
          cycleChoice(
            $fieldName,
            $fieldLabel,
            $choicesCorrectNeuf,
            $donnees_inter[$fieldName] ?? '',
            0
          );
        }
      ?>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Avis technique</label>
        <textarea name="tt_mec_avis_tech"><?php echo htmlspecialchars($donnees_inter['tt_mec_avis_tech'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-section" id="ctrl-electrique">
    <h3><i class="fa-solid fa-bolt"></i> Électrique</h3>

    <div class="form-grid">
      <?php
        $eleFields = [
          'tt_ele_etatgene' => 'État électrique',
          'tt_ele_etatcable' => 'État câblage',
          'tt_ele_resit' => 'Toutes résistances correctes',
          'tt_rec_obtu' => 'Obturateurs corrects',
          'tt_ele_sond' => 'Toutes sondes correctes'
        ];

        foreach ($eleFields as $fieldName => $fieldLabel) {
          cycleChoice(
            $fieldName,
            $fieldLabel,
            $choicesCorrectNeuf,
            $donnees_inter[$fieldName] ?? '',
            0
          );
        }
      ?>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Avis technique</label>
        <textarea name="tt_ele_avis_tech"><?php echo htmlspecialchars($donnees_inter['tt_ele_avis_tech'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-section" id="ctrl-thermique">
    <h3><i class="fa-solid fa-temperature-high"></i> Thermique</h3>

    <div class="form-grid">
      <?php
        cycleChoice(
          'tt_th_etatgene',
          'État thermique',
          $choicesCorrectNeuf,
          $donnees_inter['tt_th_etatgene'] ?? '',
          0
        );

        cycleChoice(
          'tt_th_stable',
          'Stabilité en chauffe',
          $choicesStable,
          $donnees_inter['tt_th_stable'] ?? '',
          0
        );

        cycleChoice(
          'tt_th_inerti',
          'Inertie de température',
          $choicesInertie,
          $donnees_inter['tt_th_inerti'] ?? '',
          0
        );

        cycleChoice(
          'tt_th_pilotage',
          'État pilotage',
          $choicesPilotage,
          $donnees_inter['tt_th_pilotage'] ?? '',
          0
        );
      ?>

      <div class="form-group-custom">
        <label>Température d’essai °C</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-5" data-target="tt_th_temp_test">−</button>
          <input id="tt_th_temp_test" type="number" name="tt_th_temp_test" required value="<?php echo htmlspecialchars((string)($donnees_inter['tt_th_temp_test'] ?? 0)); ?>">
          <button type="button" class="step-btn" data-step="5" data-target="tt_th_temp_test">+</button>
        </div>
      </div>

      <div class="form-group-custom">
        <label>Temps de montée</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="tt_th_dur_mont">−</button>
          <input id="tt_th_dur_mont" type="number" min="0" name="tt_th_dur_mont" required value="<?php echo htmlspecialchars((string)($donnees_inter['tt_th_dur_mont'] ?? 0)); ?>">
          <button type="button" class="step-btn" data-step="1" data-target="tt_th_dur_mont">+</button>
        </div>
      </div>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Avis technique</label>
        <textarea name="tt_th_avis_therm"><?php echo htmlspecialchars($donnees_inter['tt_th_avis_therm'] ?? ''); ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-section collapsible-section" id="ctrl-prises">
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
                        cycleChoice(
                          'type_' . $pinNumber . $i,
                          'Type',
                          $choicesTypePrise,
                          $donnees_prise['type'.$pinNumber] ?? '',
                          0
                        );
                      ?>
                    </div>

                    <div class="field-box switch-zone">
                      <span class="choice-label">Fonctionnement</span>
                      <label class="big-switch">
                        <input type="hidden" value="0" name="etat_<?php echo $pinNumber . $i; ?>">
                        <input type="checkbox" value="1" name="etat_<?php echo $pinNumber . $i; ?>" <?php echo checkedValue($donnees_prise['etat'.$pinNumber] ?? '', '1'); ?>>
                        <span></span>
                      </label>
                    </div>

                    <div class="field-box switch-zone">
                      <span class="choice-label">Isolation</span>
                      <label class="big-switch">
                        <input type="hidden" value="0" name="iso_<?php echo $pinNumber . $i; ?>">
                        <input type="checkbox" value="1" name="iso_<?php echo $pinNumber . $i; ?>" <?php echo checkedValue($donnees_prise['iso'.$pinNumber] ?? '', '1'); ?>>
                        <span></span>
                      </label>
                    </div>

                    <div class="field-box">
                      <span class="choice-label">Valeur Ω</span>
                      <input
                        class="pin-value-input"
                        type="number"
                        step="0.01"
                        name="val_<?php echo $pinNumber . $i; ?>"
                        value="<?php echo htmlspecialchars((string)($donnees_prise['val'.$pinNumber] ?? 0)); ?>"
                      >
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

  <div class="form-section collapsible-section" id="ctrl-obturateurs">
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

              <div class="ctrl-obtu-grid">

                <div class="ctrl-obtu-item">
                  <?php
                    cycleChoice(
                      'e_attel_' . $i,
                      'État attelage',
                      $choicesEtatObtu,
                      $donnees_obtu['attel_etat'] ?? '',
                      0
                    );
                  ?>
                </div>

                <div class="ctrl-obtu-item">
                  <?php
                    cycleChoice(
                      'e_guide_' . $i,
                      'État guide',
                      $choicesEtatObtu,
                      $donnees_obtu['etat_guide'] ?? '',
                      0
                    );
                  ?>
                </div>

                <div class="ctrl-obtu-item">
                  <?php
                    cycleChoice(
                      'eg_' . $i,
                      'État général',
                      $choicesEtatObtu,
                      $donnees_obtu['etat_obtu'] ?? '',
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

  <div class="form-section" id="photos-finales">
    <h3><i class="fa-solid fa-images"></i> Photos finales</h3>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label for="photos_fin">Ajouter des images</label>

        <input
          id="photos_fin"
          type="file"
          name="photos_fin[]"
          accept="image/jpeg,image/png"
          multiple
        >

        <small>Formats acceptés : JPG et PNG.</small>
      </div>
    </div>

    <?php if (!empty($photosFin)) { ?>
      <div class="photos-init-grid">

        <?php foreach ($photosFin as $photo) {
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

              <label for="photo_fin_<?php echo $photoId; ?>">
                Titre de la photo
              </label>

              <input
                id="photo_fin_<?php echo $photoId; ?>"
                type="text"
                name="photos_titres[<?php echo $photoId; ?>]"
                value="<?php echo htmlspecialchars($photoTitre); ?>"
                placeholder="Ex : Contrôle final validé"
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
        Aucune photo finale enregistrée.
      </div>

    <?php } ?>
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
  const form = event.target.closest('.edit-inter-systeme-tablette');

  if (!form) {
    return;
  }

  const cycleButton = event.target.closest('.cycle-choice-btn');

  if (cycleButton) {
    const group = cycleButton.closest('.cycle-choice-group');
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
    const target = form.querySelector('#' + targetId);

    if (target) {
      collapseButton.classList.toggle('active');
      target.classList.toggle('open');
    }

    return;
  }

  const tab = event.target.closest('.tablet-tab');

  if (tab) {
    const tabsContainer = tab.closest('.tablet-tabs');
    const targetId = tab.dataset.tabTarget;
    const section = tab.closest('.form-section');

    if (!tabsContainer || !section || !targetId) {
      return;
    }

    tabsContainer.querySelectorAll('.tablet-tab').forEach(function (item) {
      item.classList.remove('active');
    });

    section.querySelectorAll('.tablet-panel').forEach(function (panel) {
      panel.classList.remove('active');
    });

    tab.classList.add('active');

    const targetPanel = section.querySelector('#' + targetId);

    if (targetPanel) {
      targetPanel.classList.add('active');
    }

    return;
  }

  const stepButton = event.target.closest('.step-btn');

  if (!stepButton) {
    return;
  }

  const targetId = stepButton.dataset.target;
  const step = parseFloat(stepButton.dataset.step || '0');
  const input = form.querySelector('#' + targetId);

  if (!input) {
    return;
  }

  const currentValue = parseFloat(input.value || '0');
  const minValue = parseFloat(input.getAttribute('min') || '0');
  const nextValue = Math.max(minValue, currentValue + step);

  input.value = nextValue;
  input.dispatchEvent(new Event('change', { bubbles: true }));
});
</script>