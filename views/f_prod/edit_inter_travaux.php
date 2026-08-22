<?php

require_once(ROOT_PATH . "/model/travaux.php");

/*
|--------------------------------------------------------------------------
| ID intervention
|--------------------------------------------------------------------------
*/

$id_inter = (int) ($_POST['id'] ?? $_POST['id_inter'] ?? 0);

/*
|--------------------------------------------------------------------------
| Travaux liés à l’intervention
|--------------------------------------------------------------------------
*/

$travauxModel = new travauxModel();
$donnees_inter = $travauxModel->getByInterventionId($id_inter);

if (!$donnees_inter) {
    $donnees_inter = [
        'id' => 0,
        'id_inter' => $id_inter,
        'id_av_trav' => 1,

        'passage_four' => 0,
        'chang_resistance' => 0,
        'nbr_chang_resistance' => 0,

        'chang_sonde' => 0,
        'nbr_chang_sonde' => 0,

        'nettoyage' => 0,

        'modif_cablage_elec' => 0,
        'modif_cir_eau' => 0,
        'modif_cir_huile' => 0,
        'modif_cir_elec' => 0,
        'modif_cir_air' => 0,

        'modif_meca' => 0,
        'modif_meca_tete' => 0,
        'nbr_modif_meca_tete' => 0,

        'modif_meca_rectif' => 0,
        'nbr_modif_meca_rectif' => 0,

        'modif_meca_corp' => 0,
        'desc_modif_meca_corp' => ''
    ];
}

function checkedFlag($value)
{
    return ((int)$value === 1) ? 'checked="checked"' : '';
}

function activeFlag($value)
{
    return ((int)$value === 1) ? 'is-active' : '';
}

function selectedRadio($current, $expected)
{
    return ((int)$current === (int)$expected) ? 'checked="checked"' : '';
}

/*
|--------------------------------------------------------------------------
| Avancements techniques
|--------------------------------------------------------------------------
| À remplacer plus tard par av_techniqueModel si tu le crées.
|--------------------------------------------------------------------------
*/

require_once(ROOT_PATH . "/dao/database.php");

$db = (new database())->connexion();

$requeteAvancement = $db->query("
    SELECT *
    FROM av_technique
    ORDER BY libelle_av_tech
");

$avancementsTech = $requeteAvancement->fetchAll(PDO::FETCH_ASSOC);

?>

<form method="POST" action="index.php?c=transverse&a=update_inter_travaux" class="sav-form edit-inter-systeme-tablette">

  <input type="hidden" name="id_inter" value="<?php echo htmlspecialchars((string)$id_inter); ?>">

  <div class="form-section" id="trav-avancement">
    <h3><i class="fa-solid fa-list-check"></i> Avancement des travaux</h3>

    <div class="travaux-progress-grid">
      <?php foreach ($avancementsTech as $avancement) { ?>
        <label class="travaux-progress-choice">
          <input
            type="radio"
            name="id_av_trav"
            value="<?php echo htmlspecialchars((string)$avancement['id']); ?>"
            <?php echo selectedRadio($donnees_inter['id_av_trav'] ?? 1, $avancement['id']); ?>
          >
          <span><?php echo htmlspecialchars($avancement['libelle_av_tech']); ?></span>
        </label>
      <?php } ?>
    </div>
  </div>

  <div class="form-section" id="trav-preparation">
    <h3><i class="fa-solid fa-broom"></i> Préparation</h3>

    <div class="checkbox-grid">
      <label class="checkbox-card travaux-checkbox-card">
          <input type="hidden" name="nettoyage" value="0">
          <input type="checkbox" name="nettoyage" value="1">
          <span class="card-ui">Nettoyage</span>
      </label>

      <label class="checkbox-card travaux-checkbox-card">
        <input type="hidden" name="passage_four" value="0">
        <input type="checkbox" name="passage_four" value="1" <?php echo checkedFlag($donnees_inter['passage_four'] ?? 0); ?>>
        <span class="card-ui">Passage au four</span>
      </label>
    </div>
  </div>

  <div class="form-section" id="trav-electrique">
    <h3><i class="fa-solid fa-bolt"></i> Circuit électrique</h3>

    <div class="checkbox-grid">
      <label class="checkbox-card full">
        <input type="hidden" name="modif_cir_elec" value="0">
        <input type="checkbox" name="modif_cir_elec" value="1" <?php echo checkedFlag($donnees_inter['modif_cir_elec'] ?? 0); ?>>
        <span class="card-ui">Intervention sur circuit électrique</span>
      </label>

      <div class="travaux-work-card">
        <div class="travaux-work-card-title">Résistances</div>
        <div class="travaux-work-card-title">
          <label class="checkbox-card travaux-checkbox-card">
            <input type="hidden" name="chang_resistance" value="0">
            <input type="checkbox" name="chang_resistance" value="1" <?php echo checkedFlag($donnees_inter['chang_resistance'] ?? 0); ?>>
            <span class="card-ui">Changement de résistance(s)</span>
          </label>

          <div class="form-group-custom">
            <label>Nombre</label>
            <div class="travaux-number-stepper">
              <button type="button" class="travaux-step-btn" data-step="-1" data-target="nbr_chang_resistance">−</button>
              <input
                id="nbr_chang_resistance"
                type="number"
                min="0"
                name="nbr_chang_resistance"
                value="<?php echo htmlspecialchars((string)($donnees_inter['nbr_chang_resistance'] ?? 0)); ?>"
              >
              <button type="button" class="travaux-step-btn" data-step="1" data-target="nbr_chang_resistance">+</button>
            </div>
          </div>
        </div>
      </div>

      <div class="travaux-work-card">
        <div class="travaux-work-card-title">Sondes</div>
        <div class="travaux-work-card-title">
          <label class="checkbox-card travaux-checkbox-card">
            <input type="hidden" name="chang_sonde" value="0">
            <input type="checkbox" name="chang_sonde" value="1" <?php echo checkedFlag($donnees_inter['chang_sonde'] ?? 0); ?>>
            <span class="card-ui">Changement de sonde(s)</span>
          </label>

          <div class="form-group-custom">
            <label>Nombre</label>
            <div class="travaux-number-stepper">
              <button type="button" class="travaux-step-btn" data-step="-1" data-target="nbr_chang_sonde">−</button>
              <input
                id="nbr_chang_sonde"
                type="number"
                min="0"
                name="nbr_chang_sonde"
                value="<?php echo htmlspecialchars((string)($donnees_inter['nbr_chang_sonde'] ?? 0)); ?>"
              >
              <button type="button" class="travaux-step-btn" data-step="1" data-target="nbr_chang_sonde">+</button>
            </div>
          </div>
        </div>
      </div>

      <label class="checkbox-card full">
        <input type="hidden" name="modif_cablage_elec" value="0">
        <input type="checkbox" name="modif_cablage_elec" value="1" <?php echo checkedFlag($donnees_inter['modif_cablage_elec'] ?? 0); ?>>
        <span class="card-ui">Modification câblage électrique</span>
      </label>
    </div>
  </div>

  <div class="form-section" id="trav-fluides">
    <h3><i class="fa-solid fa-droplet"></i> Circuits fluides</h3>

    <div class="checkbox-grid">
      <label class="checkbox-card travaux-checkbox-card">
        <input type="hidden" name="modif_cir_eau" value="0">
        <input type="checkbox" name="modif_cir_eau" value="1" <?php echo checkedFlag($donnees_inter['modif_cir_eau'] ?? 0); ?>>
        <span class="card-ui">Intervention sur circuit d’eau</span>
      </label>

      <label class="checkbox-card travaux-checkbox-card">
        <input type="hidden" name="modif_cir_huile" value="0">
        <input type="checkbox" name="modif_cir_huile" value="1" <?php echo checkedFlag($donnees_inter['modif_cir_huile'] ?? 0); ?>>
        <span class="card-ui">Intervention sur circuit d’huile</span>
      </label>

      <label class="checkbox-card travaux-checkbox-card">
        <input type="hidden" name="modif_cir_air" value="0">
        <input type="checkbox" name="modif_cir_air" value="1" <?php echo checkedFlag($donnees_inter['modif_cir_air'] ?? 0); ?>>
        <span class="card-ui">Intervention sur circuit d’air</span>
      </label>
    </div>
  </div>

  <div class="form-section" id="trav-mecanique">
    <h3><i class="fa-solid fa-gears"></i> Intervention mécanique</h3>

    <div class="checkbox-grid">
      <label class="checkbox-card full">
        <input type="hidden" name="modif_meca" value="0">
        <input type="checkbox" name="modif_meca" value="1" <?php echo checkedFlag($donnees_inter['modif_meca'] ?? 0); ?>>
        <span class="card-ui">Intervention mécanique</span>
      </label>

      <div class="travaux-work-card">
        <div class="travaux-work-card-title">Têtes d’injection</div>
        <div class="travaux-work-card-title">
          <label class="checkbox-card travaux-checkbox-card">
            <input type="hidden" name="modif_meca_tete" value="0">
            <input type="checkbox" name="modif_meca_tete" value="1" <?php echo checkedFlag($donnees_inter['modif_meca_tete'] ?? 0); ?>>
            <span class="card-ui">Intervention sur les têtes</span>
          </label>

          <div class="form-group-custom">
            <label>Nombre</label>
            <div class="travaux-number-stepper">
              <button type="button" class="travaux-step-btn" data-step="-1" data-target="nbr_modif_meca_tete">−</button>
              <input
                id="nbr_modif_meca_tete"
                type="number"
                min="0"
                name="nbr_modif_meca_tete"
                value="<?php echo htmlspecialchars((string)($donnees_inter['nbr_modif_meca_tete'] ?? 0)); ?>"
              >
              <button type="button" class="travaux-step-btn" data-step="1" data-target="nbr_modif_meca_tete">+</button>
            </div>
          </div>
        </div>
      </div>

      <div class="travaux-work-card">
        <div class="travaux-work-card-title">Rectifications</div>
        <div class="travaux-work-card-title">
          <label class="checkbox-card travaux-checkbox-card">
            <input type="hidden" name="modif_meca_rectif" value="0">
            <input type="checkbox" name="modif_meca_rectif" value="1" <?php echo checkedFlag($donnees_inter['modif_meca_rectif'] ?? 0); ?>>
            <span class="card-ui">Rectification(s)</span>
          </label>

          <div class="form-group-custom">
            <label>Nombre</label>
            <div class="travaux-number-stepper">
              <button type="button" class="travaux-step-btn" data-step="-1" data-target="nbr_modif_meca_rectif">−</button>
              <input
                id="nbr_modif_meca_rectif"
                type="number"
                min="0"
                name="nbr_modif_meca_rectif"
                value="<?php echo htmlspecialchars((string)($donnees_inter['nbr_modif_meca_rectif'] ?? 0)); ?>"
              >
              <button type="button" class="travaux-step-btn" data-step="1" data-target="nbr_modif_meca_rectif">+</button>
            </div>
          </div>
        </div>
      </div>

      <label class="checkbox-card full">
        <input type="hidden" name="modif_meca_corp" value="0">
        <input type="checkbox" name="modif_meca_corp" value="1" <?php echo checkedFlag($donnees_inter['modif_meca_corp'] ?? 0); ?>>
        <span class="card-ui">Modification mécanique du corps</span>
      </label>
    </div>

    <div class="form-grid one-col">
      <div class="form-group-custom">
        <label>Description modification</label>
        <textarea name="desc_modif_meca_corp"><?php echo htmlspecialchars($donnees_inter['desc_modif_meca_corp'] ?? ''); ?></textarea>
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
    const button = event.target.closest('.travaux-step-btn');

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