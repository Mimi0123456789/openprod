<?php

require_once(ROOT_PATH . "/model/systemes.php");
require_once(ROOT_PATH . "/model/matieres.php");

/*
|--------------------------------------------------------------------------
| ID intervention
|--------------------------------------------------------------------------
*/

$id = (int) ($_POST['id'] ?? 0);

$systemesModel = new systemesModel();
$donnees_syst = $systemesModel->getByInterventionId($id);

/*
|--------------------------------------------------------------------------
| Valeurs par défaut si aucun système
|--------------------------------------------------------------------------
*/

if (!$donnees_syst) {
    $donnees_syst = [
        'id' => 0,
        'reference' => '',
        'marque' => '',
        'type' => '',
        'num_immat_sys' => '',

        'nbr_pt' => 0,
        'mat_inject' => 1,
        'temp_inject' => '',

        'obturation' => 0,
        'nbr_obtu' => 0,
        'type_obturation' => 'Obturation électrique',

        'embout' => 'Débouchant',

        'nbr_resistance' => 0,
        'nbr_sonde' => 0,
        'nbr_prise' => 0,

        'description' => ''
    ];
}

$matieresModel = new matieresModel();
$matieres = $matieresModel->getAll();

$check_1_embout = ($donnees_syst['embout'] != 'Topless') ? 'checked="checked"' : '';
$check_2_embout = ($donnees_syst['embout'] == 'Topless') ? 'checked="checked"' : '';

$check_1_type_obturation = (
  $donnees_syst['type_obturation'] == 'Obturation électrique' ||
  $donnees_syst['type_obturation'] == ''
) ? 'checked="checked"' : '';

$check_2_type_obturation = ($donnees_syst['type_obturation'] == 'Obturation hydraulique') ? 'checked="checked"' : '';
$check_3_type_obturation = ($donnees_syst['type_obturation'] == 'Obturation pneumatique') ? 'checked="checked"' : '';

$type_moule = $donnees_syst['type'];
?>

<form method="POST"
      action="index.php?c=transverse&a=update_inter_syst"
      class="sav-form edit-inter-systeme-tablette">

  <input type="hidden" name="id_inter" value="<?php echo htmlspecialchars((string)$id); ?>">

  <div class="form-section">
    <h3><i class="fa-solid fa-gears"></i> Identification système</h3>

    <div class="form-grid">

      <div class="form-group-custom">
        <label>Type</label>
        <select name="type">
          <?php
          $types = [
            'BLOC CHAUD',
            'MOULE ENTIER',
            'DEMI MOULE',
            'BUSE DE PRESSE',
            'ENSEMBLE DE BUSETTES'
          ];

          foreach ($types as $type) {
            $selected = ($type === $type_moule) ? 'selected' : '';
          ?>
            <option value="<?php echo htmlspecialchars($type); ?>" <?php echo $selected; ?>>
              <?php echo htmlspecialchars($type); ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group-custom">
        <label>Référence</label>
        <input type="text" name="reference" value="<?php echo htmlspecialchars($donnees_syst['reference'] ?? ''); ?>">
      </div>

      <div class="form-group-custom">
        <label>Marque</label>
        <input type="text" name="marque" value="<?php echo htmlspecialchars($donnees_syst['marque'] ?? ''); ?>">
      </div>

      <div class="form-group-custom">
        <label>N° immatriculation</label>
        <input type="text" name="num_immat_sys" value="<?php echo htmlspecialchars($donnees_syst['num_immat_sys'] ?? ''); ?>">
      </div>

    </div>
  </div>

  <div class="form-section">
    <h3><i class="fa-solid fa-fire-flame-curved"></i> Injection</h3>

    <div class="form-grid">

      <div class="form-group-custom">
        <label>Matière injectée</label>
        <select name="mat_inject">
          <?php foreach ($matieres as $matiere) {
            $selected = ($matiere['id'] == $donnees_syst['mat_inject']) ? 'selected' : '';
          ?>
            <option value="<?php echo htmlspecialchars((string)$matiere['id']); ?>" <?php echo $selected; ?>>
              <?php echo htmlspecialchars($matiere['libelle_mat'] . " - " . strtoupper($matiere['libelle_mat_lg'])); ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group-custom">
        <label>Température d’injection °C</label>
        <input type="number" name="temp_inject" value="<?php echo htmlspecialchars((string)($donnees_syst['temp_inject'] ?? '')); ?>" required>
      </div>

      <div class="form-group-custom">
        <label>Nb points d’injection</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="nbr_pt">−</button>
          <input id="nbr_pt" type="number" name="nbr_pt" min="0" value="<?php echo htmlspecialchars((string)($donnees_syst['nbr_pt'] ?? 0)); ?>" required>
          <button type="button" class="step-btn" data-step="1" data-target="nbr_pt">+</button>
        </div>
      </div>

    </div>
  </div>

  <div class="form-section">
    <h3><i class="fa-solid fa-plug-circle-bolt"></i> Équipements</h3>

    <div class="form-grid">

      <div class="form-group-custom">
        <label>Nb de résistances</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="nbr_resistance">−</button>
          <input id="nbr_resistance" type="number" name="nbr_resistance" min="0" value="<?php echo htmlspecialchars((string)($donnees_syst['nbr_resistance'] ?? 0)); ?>" required>
          <button type="button" class="step-btn" data-step="1" data-target="nbr_resistance">+</button>
        </div>
      </div>

      <div class="form-group-custom">
        <label>Nb de sondes</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="nbr_sonde">−</button>
          <input id="nbr_sonde" type="number" name="nbr_sonde" min="0" value="<?php echo htmlspecialchars((string)($donnees_syst['nbr_sonde'] ?? 0)); ?>" required>
          <button type="button" class="step-btn" data-step="1" data-target="nbr_sonde">+</button>
        </div>
      </div>

      <div class="form-group-custom">
        <label>Nb de prises</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="nbr_prise">−</button>
          <input id="nbr_prise" type="number" name="nbr_prise" min="0" value="<?php echo htmlspecialchars((string)($donnees_syst['nbr_prise'] ?? 0)); ?>" required>
          <button type="button" class="step-btn" data-step="1" data-target="nbr_prise">+</button>
        </div>
      </div>

      <div class="form-group-custom">
        <label>Nb d’obturateurs</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="nbr_obtu">−</button>
          <input id="nbr_obtu" type="number" name="nbr_obtu" min="0" value="<?php echo htmlspecialchars((string)($donnees_syst['nbr_obtu'] ?? 0)); ?>" required>
          <button type="button" class="step-btn" data-step="1" data-target="nbr_obtu">+</button>
        </div>
      </div>

    </div>

    <div class="choice-grid">

      <div class="choice-card">
        <label>Type d’obturation</label>

        <label class="radio-line">
          <input type="radio" name="type_obturation" value="Obturation électrique" <?php echo $check_1_type_obturation; ?>>
          <span>Électrique</span>
        </label>

        <label class="radio-line">
          <input type="radio" name="type_obturation" value="Obturation hydraulique" <?php echo $check_2_type_obturation; ?>>
          <span>Hydraulique</span>
        </label>

        <label class="radio-line">
          <input type="radio" name="type_obturation" value="Obturation pneumatique" <?php echo $check_3_type_obturation; ?>>
          <span>Pneumatique</span>
        </label>
      </div>

      <div class="choice-card">
        <label>Type d’embout</label>

        <label class="radio-line">
          <input type="radio" name="embout" value="Débouchant" required <?php echo $check_1_embout; ?>>
          <span>Débouchant</span>
        </label>

        <label class="radio-line">
          <input type="radio" name="embout" value="Topless" required <?php echo $check_2_embout; ?>>
          <span>Topless</span>
        </label>
      </div>

    </div>
  </div>

  <div class="form-section">
    <h3><i class="fa-solid fa-align-left"></i> Description</h3>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Description</label>
        <textarea name="description"><?php echo htmlspecialchars($donnees_syst['description'] ?? ''); ?></textarea>
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