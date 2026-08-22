<?php

require_once(ROOT_PATH . '/model/f_inter.php');
require_once(ROOT_PATH . '/model/avancements.php');

$id = (int)($_POST['id'] ?? 0);

/*
|--------------------------------------------------------------------------
| Intervention
|--------------------------------------------------------------------------
*/

$interventionModel = new f_interModel();
$donnees_inter = $interventionModel->getById($id);

if (!$donnees_inter) {
    exit('Intervention introuvable');
}

/*
|--------------------------------------------------------------------------
| Avancements
|--------------------------------------------------------------------------
*/

$avancementModel = new avancementsModel();
$listeAvancements = $avancementModel->getAll();

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

if (!function_exists('radioChecked')) {
    function radioChecked($current, $expected, $default = false)
    {
        if ($current == $expected || ($default && ($current === '' || $current === null))) {
            return 'checked="checked"';
        }

        return '';
    }
}

if (!function_exists('h')) {
    function h($value)
    {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('selectedValue')) {
  function selectedValue($current, $expected, $default = false) {
    if ($current == $expected || ($default && ($current === '' || $current === null))) {
      return 'selected="selected"';
    }

    return '';
  }
}

?>

<form method="POST" action="index.php?c=transverse&a=update_inter_validation" class="sav-form validation-tablette">

  <input type="hidden" name="id" value="<?php echo h($donnees_inter['id']); ?>">


  <div class="form-section" id="validation-globale">
    <h3><i class="fa-solid fa-circle-check"></i> Validation globale</h3>

    <div class="form-grid">

      <div class="form-group-custom">
        <label for="id_avancements">Avancement</label>

        <select name="id_avancements" id="id_avancements" required>
          <option value="">Sélectionner un avancement</option>

          <?php foreach ($listeAvancements as $avancement) : ?>
            <option
              value="<?php echo h($avancement['ID']); ?>"
              <?php echo selectedValue($donnees_inter['id_avancements'] ?? '', $avancement['ID']); ?>
            >
              <?php echo h($avancement['libelle_avance']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group-custom">
        <label for="visa_client">Visa client</label>

        <select name="visa_client" id="visa_client">
          <option
            value="refus"
            <?php echo selectedValue($donnees_inter['visa_client'] ?? '', 'refus', true); ?>
          >
            REFUS DE VISA
          </option>

          <option
            value="vise"
            <?php echo selectedValue($donnees_inter['visa_client'] ?? '', 'vise'); ?>
          >
            VISÉ
          </option>
        </select>
      </div>

    </div>
  </div>

  <div class="form-section" id="validation-durees">
    <h3><i class="fa-solid fa-clock"></i> Durées</h3>

    <div class="form-grid">
      <div class="form-group-custom duration-card">
        <label>Durée prévue (h)</label>
        <input
          type="number"
          value="<?php echo h($donnees_inter['duree_init'] ?? 0); ?>"
          disabled
        >
      </div>

      <div class="form-group-custom duration-card">
        <label>Durée des travaux (h)</label>

        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="duree_trav">−</button>

          <input
            id="duree_trav"
            type="number"
            min="0"
            name="duree_trav"
            value="<?php echo h($donnees_inter['duree_trav'] ?? 0); ?>"
            required
          >

          <button type="button" class="step-btn" data-step="1" data-target="duree_trav">+</button>
        </div>
      </div>

      <div class="form-group-custom duration-card">
        <label>Durée des contrôles (h)</label>

        <div class="number-stepper">
          <button type="button" class="step-btn" data-step="-1" data-target="duree_cont">−</button>

          <input
            id="duree_cont"
            type="number"
            min="0"
            name="duree_cont"
            value="<?php echo h($donnees_inter['duree_cont'] ?? 0); ?>"
            required
          >

          <button type="button" class="step-btn" data-step="1" data-target="duree_cont">+</button>
        </div>
      </div>
    </div>
  </div>

  <div class="form-section" id="validation-commentaires">
    <h3><i class="fa-solid fa-comments"></i> Commentaires</h3>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Commentaire MECALYS</label>
        <textarea name="comm_inter"><?php echo h($donnees_inter['comm_inter'] ?? ''); ?></textarea>
      </div>

      <div class="form-group-custom">
        <label>Commentaire Client</label>
        <textarea name="comm_client"><?php echo h($donnees_inter['comm_client'] ?? ''); ?></textarea>
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
    const button = event.target.closest('.step-btn');

    if (!button) {
      return;
    }

    const targetId = button.dataset.target;
    const step = parseInt(button.dataset.step || '0', 10);
    const input = document.getElementById(targetId);

    if (!input) {
      return;
    }

    const currentValue = parseInt(input.value || '0', 10);
    const minValue = parseInt(input.getAttribute('min') || '0', 10);
    const nextValue = Math.max(minValue, currentValue + step);

    input.value = nextValue;
    input.dispatchEvent(new Event('change', { bubbles: true }));
  });
</script>
