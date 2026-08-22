<?php

require_once(ROOT_PATH . "/model/clients.php");
require_once(ROOT_PATH . "/model/utilisateurs.php");
require_once(ROOT_PATH . "/model/f_inter.php");
require_once(ROOT_PATH . "/model/priorites.php");
require_once(ROOT_PATH . "/model/avancements.php");

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

$fInterModel = new f_interModel();
$clientsModel = new clientsModel();
$utilisateursModel = new utilisateursModel();
$prioritesModel = new prioritesModel();
$avancementsModel = new avancementsModel();

/*
|--------------------------------------------------------------------------
| Récupération de l'intervention
|--------------------------------------------------------------------------
*/

$donnees_inter = $fInterModel->getById($id);

if (!$donnees_inter) {
    exit('Intervention introuvable');
}

/*
|--------------------------------------------------------------------------
| Données pour les listes
|--------------------------------------------------------------------------
*/

$clients = $clientsModel->getAll();
$utilisateurs = $utilisateursModel->getAll();
$priorites = $prioritesModel->getAll();
$avancements = $avancementsModel->getAll();

/*
|--------------------------------------------------------------------------
| Sécurisation HTML
|--------------------------------------------------------------------------
*/

if (!function_exists('h')) {
    function h($value)
    {
        return htmlspecialchars(
            (string) ($value ?? ''),
            ENT_QUOTES,
            'UTF-8'
        );
    }
}

/*
|--------------------------------------------------------------------------
| Valeurs enregistrées
|--------------------------------------------------------------------------
*/

$lieuValue = $donnees_inter['lieu'] ?? 'Site Client';

$demandeValue = $donnees_inter['demande'] ?? 'EXPERTISE';

$facturationValue =
    $donnees_inter['facturation'] ?? 'Sous contrat';


/*
|--------------------------------------------------------------------------
| Classes visuelles initiales
|--------------------------------------------------------------------------
*/

$lieuClass = 'is-ok';

$demandeClass =
    $demandeValue === 'EXPERTISE'
        ? 'is-bad'
        : 'is-ok';

if ($facturationValue === 'Sans facture') {

    $facturationClass = 'is-bad';

} elseif ($facturationValue === 'Avec facture') {

    $facturationClass = 'is-alert';

} else {

    $facturationClass = 'is-ok';
}

?>

<form
    method="POST"
    action="index.php?c=transverse&a=update_inter_general"
    class="sav-form edit-inter-tablette inter-form-tablette"
>

    <input
        type="hidden"
        name="id"
        value="<?php echo h($donnees_inter['id']); ?>"
    >


    <!-- =========================================================
         INFORMATIONS GENERALES
    ========================================================== -->

    <div class="form-section" id="edit-general">

        <h3>
            <i class="fa-solid fa-file-lines"></i>
            Informations générales
        </h3>

        <div class="form-grid">

            <div class="form-group-custom">

                <label>Client</label>

                <select name="id_clients" required>

                    <option value="">
                        Sélectionner un client
                    </option>

                    <?php foreach ($clients as $client) { ?>

                        <option
                            value="<?php echo h($client['id']); ?>"
                            <?php
                            echo (
                                (int) $client['id']
                                ===
                                (int) $donnees_inter['id_clients']
                            )
                                ? 'selected'
                                : '';
                            ?>
                        >
                            <?php echo h($client['nom']); ?>
                        </option>

                    <?php } ?>

                </select>

            </div>


            <div class="form-group-custom">

                <label>Avancement</label>

                <select name="id_avancements" required>

                    <option value="">
                        Sélectionner un état d'avancement
                    </option>

                    <?php foreach ($avancements as $avancement) { ?>

                        <option
                            value="<?php echo h($avancement['ID']); ?>"
                            <?php
                            echo (
                                (int) $avancement['ID']
                                ===
                                (int) $donnees_inter['id_avancements']
                            )
                                ? 'selected'
                                : '';
                            ?>
                        >
                            <?php
                            echo h(
                                $avancement['libelle_avance']
                            );
                            ?>
                        </option>

                    <?php } ?>

                </select>

            </div>


            <div class="form-group-custom">

                <label>Durée prévisionnelle</label>

                <div class="number-stepper">

                    <button
                        type="button"
                        class="step-btn"
                        data-step="-1"
                        data-target="duree_init"
                    >
                        −
                    </button>

                    <input
                        id="duree_init"
                        type="number"
                        name="duree_init"
                        min="0"
                        value="<?php
                        echo h(
                            $donnees_inter['duree_init'] ?? 0
                        );
                        ?>"
                        required
                    >

                    <button
                        type="button"
                        class="step-btn"
                        data-step="1"
                        data-target="duree_init"
                    >
                        +
                    </button>

                </div>

            </div>


            <div class="form-group-custom">

                <label>N° devis</label>

                <input
                    type="text"
                    name="num_devis"
                    maxlength="32"
                    value="<?php
                    echo h(
                        $donnees_inter['num_devis'] ?? ''
                    );
                    ?>"
                    placeholder="Ex : DEV-2026-001"
                >

            </div>

        </div>

    </div>


    <!-- =========================================================
         PLANNING
    ========================================================== -->

    <div class="form-section" id="edit-planning">

        <h3>
            <i class="fa-solid fa-calendar-days"></i>
            Planning
        </h3>

        <div class="form-grid">

            <div class="form-group-custom">

                <label>Date création</label>

                <input
                    type="date"
                    name="date_crea"
                    value="<?php
                    echo h(
                        $donnees_inter['date_crea'] ?? ''
                    );
                    ?>"
                    required
                >

            </div>


            <div class="form-group-custom">

                <label>Date limite</label>

                <input
                    type="date"
                    name="date_max"
                    value="<?php
                    echo h(
                        $donnees_inter['date_max'] ?? ''
                    );
                    ?>"
                    required
                >

            </div>


            <div class="form-group-custom">

                <label>Date début</label>

                <input
                    type="date"
                    name="date_debut"
                    value="<?php
                    echo h(
                        $donnees_inter['date_debut'] ?? ''
                    );
                    ?>"
                >

            </div>


            <div class="form-group-custom">

                <label>Date fin</label>

                <input
                    type="date"
                    name="date_fin"
                    value="<?php
                    echo h(
                        $donnees_inter['date_fin'] ?? ''
                    );
                    ?>"
                >

            </div>


            <div class="form-group-custom">

                <label>Priorité</label>

                <select name="id_priorite" required>

                    <option value="">
                        Sélectionner une priorité
                    </option>

                    <?php foreach ($priorites as $priorite) { ?>

                        <option
                            value="<?php echo h($priorite['ID']); ?>"
                            <?php
                            echo (
                                (int) $priorite['ID']
                                ===
                                (int) $donnees_inter['id_priorite']
                            )
                                ? 'selected'
                                : '';
                            ?>
                        >
                            <?php
                            echo h(
                                $priorite['libelle_lg_prio']
                                ??
                                $priorite['libelle_ct_prio']
                                ??
                                ''
                            );
                            ?>
                        </option>

                    <?php } ?>

                </select>

            </div>

        </div>

    </div>


    <!-- =========================================================
         AFFECTATION
    ========================================================== -->

    <div class="form-section" id="edit-affectation">

        <h3>
            <i class="fa-solid fa-users-gear"></i>
            Affectation
        </h3>

        <div class="form-grid">


            <div class="form-group-custom">

                <label>Responsable</label>

                <select name="id_responsable" required>

                    <option value="">
                        Sélectionner
                    </option>

                    <?php foreach ($utilisateurs as $utilisateur) { ?>

                        <?php
                        if (
                            (int) (
                                $utilisateur['id_fonctions']
                                ?? 0
                            ) !== 6
                        ) {
                        ?>

                            <option
                                value="<?php
                                echo h(
                                    $utilisateur['id']
                                );
                                ?>"
                                <?php
                                echo (
                                    (int) $utilisateur['id']
                                    ===
                                    (int) $donnees_inter['id_responsable']
                                )
                                    ? 'selected'
                                    : '';
                                ?>
                            >
                                <?php
                                echo h(
                                    $utilisateur['nom']
                                    . ' '
                                    . $utilisateur['prenom']
                                );
                                ?>
                            </option>

                        <?php } ?>

                    <?php } ?>

                </select>

            </div>


            <div class="form-group-custom">

                <label>Intervenant</label>

                <select name="id_intervenant" required>

                    <option value="">
                        Sélectionner
                    </option>

                    <?php foreach ($utilisateurs as $utilisateur) { ?>

                        <?php
                        if (
                            (int) (
                                $utilisateur['id_fonctions']
                                ?? 0
                            ) !== 6
                        ) {
                        ?>

                            <option
                                value="<?php
                                echo h(
                                    $utilisateur['id']
                                );
                                ?>"
                                <?php
                                echo (
                                    (int) $utilisateur['id']
                                    ===
                                    (int) $donnees_inter['id_intervenant']
                                )
                                    ? 'selected'
                                    : '';
                                ?>
                            >
                                <?php
                                echo h(
                                    $utilisateur['nom']
                                    . ' '
                                    . $utilisateur['prenom']
                                );
                                ?>
                            </option>

                        <?php } ?>

                    <?php } ?>

                </select>

            </div>

        </div>


        <!-- =====================================================
             CHOIX CYCLIQUES
        ====================================================== -->

        <div class="choice-grid">


            <!-- LIEU -->

            <div class="choice-card">

                <span class="choice-label">
                    Lieu intervention
                </span>

                <input
                    type="hidden"
                    name="lieu"
                    value="<?php echo h($lieuValue); ?>"
                    required
                >

                <button
                    type="button"
                    class="cycle-choice <?php echo h($lieuClass); ?>"
                    data-target="lieu"
                    data-values='["Site Client","Site MECALYS"]'
                >
                    <?php echo h($lieuValue); ?>
                </button>

            </div>


            <!-- DEMANDE -->

            <div class="choice-card">

                <span class="choice-label">
                    Type demande
                </span>

                <input
                    type="hidden"
                    name="demande"
                    value="<?php echo h($demandeValue); ?>"
                    required
                >

                <button
                    type="button"
                    class="cycle-choice <?php echo h($demandeClass); ?>"
                    data-target="demande"
                    data-values='["EXPERTISE","CONFIRMÉE"]'
                >
                    <?php echo h($demandeValue); ?>
                </button>

            </div>


            <!-- FACTURATION -->

            <div class="choice-card">

                <span class="choice-label">
                    Facturation
                </span>

                <input
                    type="hidden"
                    name="facturation"
                    value="<?php echo h($facturationValue); ?>"
                    required
                >

                <button
                    type="button"
                    class="cycle-choice <?php echo h($facturationClass); ?>"
                    data-target="facturation"
                    data-values='["Sous contrat","Avec facture","Sans facture"]'
                >
                    <?php echo h($facturationValue); ?>
                </button>

            </div>


        </div>

    </div>


    <!-- =========================================================
         DESCRIPTION
    ========================================================== -->

    <div class="form-section" id="edit-description">

        <h3>
            <i class="fa-solid fa-comment-dots"></i>
            Description
        </h3>

        <div class="form-grid one-col">


            <div class="form-group-custom">

                <label>Anomalie constatée</label>

                <textarea
                    name="anomalie"
                ><?php
                echo h(
                    $donnees_inter['anomalie'] ?? ''
                );
                ?></textarea>

            </div>


            <div class="form-group-custom">

                <label>Description des travaux</label>

                <textarea
                    name="desc_travaux"
                ><?php
                echo h(
                    $donnees_inter['desc_travaux'] ?? ''
                );
                ?></textarea>

            </div>


            <div class="form-group-custom">

                <label>Communication client</label>

                <textarea
                    name="comm_client"
                ><?php
                echo h(
                    $donnees_inter['comm_client'] ?? ''
                );
                ?></textarea>

            </div>

        </div>

    </div>


    <!-- =========================================================
         ACTIONS
    ========================================================== -->

    <div class="modal-actions">

        <button
            type="button"
            class="btn-secondary-modal"
            onclick="closeInterModal()"
        >
            Annuler
        </button>

        <button
            type="submit"
            name="submit"
            class="btn-primary-modal"
        >
            <i class="fa-solid fa-check"></i>
            Enregistrer
        </button>

    </div>

</form>


<script>

document.addEventListener(
    'click',
    function (event) {

        /*
        |--------------------------------------------------------------------------
        | Boutons cycliques
        |--------------------------------------------------------------------------
        */

        const cycleButton =
            event.target.closest(
                '.inter-form-tablette .cycle-choice'
            );

        if (cycleButton) {

            const form =
                cycleButton.closest(
                    '.inter-form-tablette'
                );

            const targetName =
                cycleButton.dataset.target;

            const values =
                JSON.parse(
                    cycleButton.dataset.values || '[]'
                );

            const hiddenInput =
                form.querySelector(
                    'input[name="' +
                    targetName +
                    '"]'
                );

            if (
                !hiddenInput ||
                values.length === 0
            ) {
                return;
            }


            const currentIndex =
                values.indexOf(
                    hiddenInput.value
                );

            const nextIndex =
                currentIndex >= 0
                    ? (currentIndex + 1)
                        % values.length
                    : 0;

            const nextValue =
                values[nextIndex];


            hiddenInput.value =
                nextValue;

            cycleButton.textContent =
                nextValue;


            updateInterCycleStyle(
                cycleButton,
                nextValue
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Stepper durée
        |--------------------------------------------------------------------------
        */

        const stepButton =
            event.target.closest(
                '.inter-form-tablette .step-btn'
            );

        if (!stepButton) {
            return;
        }


        const form =
            stepButton.closest(
                '.inter-form-tablette'
            );


        const targetId =
            stepButton.dataset.target;


        const step =
            parseInt(
                stepButton.dataset.step || '0',
                10
            );


        const input =
            form.querySelector(
                '#' + targetId
            );


        if (!input) {
            return;
        }


        const currentValue =
            parseInt(
                input.value || '0',
                10
            );


        const minValue =
            parseInt(
                input.getAttribute('min')
                || '0',
                10
            );


        const nextValue =
            Math.max(
                minValue,
                currentValue + step
            );


        input.value =
            nextValue;
    }
);


/*
|--------------------------------------------------------------------------
| Couleurs des boutons cycliques
|--------------------------------------------------------------------------
*/

function updateInterCycleStyle(
    button,
    value
) {

    button.classList.remove(
        'is-ok',
        'is-alert',
        'is-bad'
    );


    if (
        value === 'Sans facture' ||
        value === 'EXPERTISE'
    ) {

        button.classList.add(
            'is-bad'
        );

    } else if (
        value === 'Avec facture'
    ) {

        button.classList.add(
            'is-alert'
        );

    } else {

        button.classList.add(
            'is-ok'
        );
    }
}

</script>