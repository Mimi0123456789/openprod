<?php

require_once(ROOT_PATH . "/model/clients.php");
require_once(ROOT_PATH . "/model/utilisateurs.php");
require_once(ROOT_PATH . "/model/f_inter.php");
require_once(ROOT_PATH . "/model/priorites.php");
require_once(ROOT_PATH . "/model/avancements.php");

$clientsModel = new clientsModel();
$clients = $clientsModel->getAll();

$utilisateursModel = new utilisateursModel();
$utilisateurs = $utilisateursModel->getAll();

$prioritesModel = new prioritesModel();
$priorites = $prioritesModel->getAll();

$avancementsModel = new avancementsModel();
$avancements = $avancementsModel->getAll();

$dateJour = date('Y-m-d');
$dateMax = date('Y-m-d', strtotime('+7 days'));

if (!function_exists('h')) {
  function h($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
  }
}
?>

<form method="POST"
      action="index.php?c=transverse&a=add_inter"
      class="sav-form edit-inter-tablette inter-form-tablette">

  <div class="form-section" id="add-general">
    <h3><i class="fa-solid fa-file-circle-plus"></i> Informations générales</h3>

    <div class="form-grid">

      <div class="form-group-custom">
        <label>Client</label>
        <select name="id_clients" required>
          <option value="">Sélectionner un client</option>
          <?php foreach ($clients as $client) { ?>
            <option value="<?php echo h($client['id']); ?>">
              <?php echo h($client['nom']); ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group-custom">
        <label>Avancement</label>
        <select name="id_avancements" required>
          <option value="">Sélectionner un état d'avancement</option>
          <?php foreach ($avancements as $avancement) { ?>
            <option value="<?php echo h($avancement['ID']); ?>">
              <?php echo h($avancement['libelle_avance']); ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group-custom">
        <label>Durée prévisionnelle</label>
        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="duree_init">−</button>
          <input id="duree_init" type="number" name="duree_init" min="0" value="0" required>
          <button type="button" class="step-btn" data-step="1" data-target="duree_init">+</button>
        </div>
      </div>

      <div class="form-group-custom">
        <label>N° devis</label>
        <input type="text" name="num_devis" maxlength="32" placeholder="Ex : DEV-2026-001">
      </div>

    </div>
  </div>

  <div class="form-section" id="add-planning">
    <h3><i class="fa-solid fa-calendar-days"></i> Planning</h3>

    <div class="form-grid">

      <div class="form-group-custom">
        <label>Date création</label>
        <input type="date" name="date_crea" value="<?php echo h($dateJour); ?>" required>
      </div>

      <div class="form-group-custom">
        <label>Date limite</label>
        <input type="date" name="date_max" value="<?php echo h($dateMax); ?>" required>
      </div>

      <div class="form-group-custom">
        <label>Date début</label>
        <input type="date" name="date_debut">
      </div>

      <div class="form-group-custom">
        <label>Date fin</label>
        <input type="date" name="date_fin">
      </div>

      <div class="form-group-custom">
        <label>Priorité</label>
        <select name="id_priorite" required>
          <option value="">Sélectionner une priorité</option>
          <?php foreach ($priorites as $priorite) { ?>
            <option value="<?php echo h($priorite['ID']); ?>">
              <?php echo h($priorite['libelle_lg_prio']); ?>
            </option>
          <?php } ?>
        </select>
      </div>

    </div>
  </div>

  <div class="form-section" id="add-affectation">
    <h3><i class="fa-solid fa-users-gear"></i> Affectation</h3>

    <div class="form-grid">

      <div class="form-group-custom">
        <label>Responsable</label>
        <select name="id_responsable" required>
          <option value="">Sélectionner</option>
          <?php foreach ($utilisateurs as $utilisateur) { ?>
            <?php if ((int)($utilisateur['id_fonctions'] ?? 0) !== 6) { ?>
              <option value="<?php echo h($utilisateur['id']); ?>">
                <?php echo h($utilisateur['nom'] . ' ' . $utilisateur['prenom']); ?>
              </option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>

      <div class="form-group-custom">
        <label>Intervenant</label>
        <select name="id_intervenant" required>
          <option value="">Sélectionner</option>
          <?php foreach ($utilisateurs as $utilisateur) { ?>
            <?php if ((int)($utilisateur['id_fonctions'] ?? 0) !== 6) { ?>
              <option value="<?php echo h($utilisateur['id']); ?>">
                <?php echo h($utilisateur['nom'] . ' ' . $utilisateur['prenom']); ?>
              </option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>

    </div>

    <div class="choice-grid">

      <div class="choice-card">
        <span class="choice-label">Lieu intervention</span>
        <input type="hidden" name="lieu" value="Site Client" required>

          <button
            type="button"
            class="cycle-choice is-ok"
            data-target="lieu"
            data-values='["Site Client","Site MECALYS"]'
          >
            Site Client
          </button>
      </div>

      <div class="choice-card">
        <span class="choice-label">Type demande</span>
        <input type="hidden" name="demande" value="EXPERTISE" required>

        <button
          type="button"
          class="cycle-choice is-bad"
          data-target="demande"
          data-values='["EXPERTISE","CONFIRMÉE"]'
        >
          EXPERTISE
        </button>
      </div>

      <div class="choice-card">
        <span class="choice-label">Facturation</span>
        <input type="hidden" name="facturation" value="Sous contrat" required>

        <button
          type="button"
          class="cycle-choice is-ok"
          data-target="facturation"
          data-values='["Sous contrat","Avec facture","Sans facture"]'
        >
          Sous contrat
        </button>
      </div>

    </div>
  </div>

  <div class="form-section" id="add-description">
    <h3><i class="fa-solid fa-comment-dots"></i> Description</h3>

    <div class="form-grid one-col">

      <div class="form-group-custom">
        <label>Anomalie constatée</label>
        <textarea name="anomalie"></textarea>
      </div>

      <div class="form-group-custom">
        <label>Description des travaux</label>
        <textarea name="desc_travaux"></textarea>
      </div>

      <div class="form-group-custom">
        <label>Communication client</label>
        <textarea name="comm_client"></textarea>
      </div>

    </div>
  </div>

  <div class="modal-actions">
    <button type="button"
            class="btn-secondary-modal"
            onclick="closeInterModal()">
      Annuler
    </button>

    <button type="submit"
            name="submit"
            class="btn-primary-modal">
      <i class="fa-solid fa-check"></i>
      Créer l’intervention
    </button>
  </div>

</form>

<script>
  document.addEventListener('click', function (event) {
    const cycleButton = event.target.closest('.inter-form-tablette .cycle-choice');

    if (cycleButton) {
      const form = cycleButton.closest('.inter-form-tablette');
      const targetName = cycleButton.dataset.target;
      const values = JSON.parse(cycleButton.dataset.values || '[]');
      const hiddenInput = form.querySelector('input[name="' + targetName + '"]');

      if (!hiddenInput || values.length === 0) {
        return;
      }

      const currentIndex = values.indexOf(hiddenInput.value);
      const nextIndex = currentIndex >= 0 ? (currentIndex + 1) % values.length : 0;
      const nextValue = values[nextIndex];

      hiddenInput.value = nextValue;
      cycleButton.textContent = nextValue;

      cycleButton.classList.remove('is-ok', 'is-alert', 'is-bad');

      if (nextValue === 'Sans facture' || nextValue === 'EXPERTISE') {
        cycleButton.classList.add('is-bad');
      } else if (nextValue === 'Avec facture') {
        cycleButton.classList.add('is-alert');
      } else {
        cycleButton.classList.add('is-ok');
      }

      return;
    }

    const stepButton = event.target.closest('.inter-form-tablette .step-btn');

    if (!stepButton) {
      return;
    }

    const form = stepButton.closest('.inter-form-tablette');
    const targetId = stepButton.dataset.target;
    const step = parseInt(stepButton.dataset.step || '0', 10);
    const input = form.querySelector('#' + targetId);

    if (!input) {
      return;
    }

    const currentValue = parseInt(input.value || '0', 10);
    const minValue = parseInt(input.getAttribute('min') || '0', 10);
    const nextValue = Math.max(minValue, currentValue + step);

    input.value = nextValue;
  });

  function updateInterCycleStyle(button, value) {
    button.classList.remove('is-ok', 'is-alert', 'is-bad');

    if (value === 'Sans facture' || value === 'EXPERTISE') {
      button.classList.add('is-bad');
    } else if (value === 'Avec facture') {
      button.classList.add('is-alert');
    } else {
      button.classList.add('is-ok');
    }
  }

</script>