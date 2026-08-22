<header>
  <link rel="stylesheet" type="text/css" href="./style/jquery.dataTables.min.css">
  <script type="text/javascript" src="./js/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
</header>

<?php

require_once(ROOT_PATH . "/model/f_inter.php");

$fInterModel = new f_interModel();
$interventions = $fInterModel->getEnCoursAvecDetails();

?>

<section class="inter-page">

  <div class="inter-header">
    <div>
      <h1>Interventions en cours</h1>
      <p>Consultez, filtrez et accédez rapidement aux formulaires de chaque intervention.</p>
    </div>

    <button
      type="button"
      class="btn-add-inter"
      onclick="openInterModal('add_inter', '', 'Nouvelle intervention')"
    >
      <i class="fa-solid fa-plus"></i>
      Nouvelle intervention
    </button>
  </div>

  <div class="inter-card">

    <table id="inter" class="display inter-table" style="width:100%">
      <thead>
        <tr>
          <th></th>
          <th>Client</th>
          <th>N°</th>
          <th>Responsable</th>
          <th>Créée le</th>
          <th>Délai</th>
          <th>Avancement</th>
          <th>Priorité</th>
          <th>État</th>
          <th>Lieu</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($interventions as $donnees) {

          $couleur_avancement = "#14395b";

          if ($donnees["libelle_avance"] === "ÉTUDE EN COURS") {
            $couleur_avancement = "#f47a00";
          } elseif ($donnees["libelle_avance"] === "ATTENTE DE FOURNITURES") {
            $couleur_avancement = "#dc3545";
          } elseif (
            $donnees["libelle_avance"] === "RÉALISATION EN ATELIER" ||
            $donnees["libelle_avance"] === "LIVRAISON EN COURS" ||
            $donnees["libelle_avance"] === "INTALLATION EN COURS" ||
            $donnees["libelle_avance"] === "TERMINÉ" ||
            $donnees["libelle_avance"] === "CLÔTURÉ"
          ) {
            $couleur_avancement = "#198754";
          }

          $couleur_prio = "#14395b";

          if (
            $donnees["libelle_prio"] === "Urgent" ||
            $donnees["libelle_prio"] === "12h" ||
            $donnees["libelle_prio"] === "24h"
          ) {
            $couleur_prio = "#dc3545";
          } elseif ($donnees["libelle_prio"] === "48H") {
            $couleur_prio = "#f47a00";
          } elseif (
            $donnees["libelle_prio"] === "7 JOURS" ||
            $donnees["libelle_prio"] === "15 Jours"
          ) {
            $couleur_prio = "#198754";
          }

          $newDate = !empty($donnees["date_crea"])
            ? date("d-m-Y", strtotime($donnees["date_crea"]))
            : "";

          $newDate_2 = !empty($donnees["date_max"])
            ? date("d-m-Y", strtotime($donnees["date_max"]))
            : "";

          $couleur_date_max = "#198754";

          if (!empty($donnees["date_max"])) {
            $datediff = time() - strtotime($donnees["date_max"]);
            $couleur_date_max = ($datediff / (60 * 60 * 24) >= 0) ? "#dc3545" : "#198754";
          }
        ?>

          <tr>
            <td>
              <button
                type="button"
                class="table-action expand-row"
                title="Afficher les actions"
                data-id="<?php echo htmlspecialchars((string)$donnees['id']); ?>"
                data-client="<?php echo htmlspecialchars($donnees['nom_client'] ?? ''); ?>"
                data-avancement="<?php echo htmlspecialchars($donnees['libelle_avance'] ?? ''); ?>"
                data-priorite="<?php echo htmlspecialchars($donnees['libelle_prio'] ?? ''); ?>"
              >
                <i class="fa-solid fa-chevron-down"></i>
              </button>
            </td>

            <td><strong><?php echo htmlspecialchars($donnees['nom_client'] ?? ''); ?></strong></td>

            <td>
              <span class="inter-number-badge">
                <?php echo htmlspecialchars((string)$donnees['id']); ?>
              </span>
            </td>

            <td><?php echo htmlspecialchars($donnees['nom_utilisateur'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($newDate); ?></td>

            <td>
              <span class="date-badge" style="color:<?php echo $couleur_date_max; ?>">
                <?php echo htmlspecialchars($newDate_2); ?>
              </span>
            </td>

            <td>
              <span class="status-pill" style="background:<?php echo $couleur_avancement; ?>">
                <?php echo htmlspecialchars($donnees['libelle_avance'] ?? ''); ?>
              </span>
            </td>

            <td>
              <span class="priority-pill" style="color:<?php echo $couleur_prio; ?>">
                <?php echo htmlspecialchars($donnees['libelle_prio'] ?? ''); ?>
              </span>
            </td>

            <td><?php echo htmlspecialchars($donnees['demande'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($donnees['lieu'] ?? ''); ?></td>
          </tr>

        <?php } ?>
      </tbody>
    </table>

  </div>

</section>

<div id="interModal" class="custom-modal">
  <div class="custom-modal-content large-modal">

    <div class="custom-modal-header">
      <div>
        <h2 id="interModalTitle">Intervention</h2>
      </div>

      <button type="button" class="modal-close" onclick="closeInterModal()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div id="interModalBody" class="modal-body-content">
      Chargement...
    </div>

  </div>
</div>

<script>

$(document).ready(function () {

    function formButton(action, idValue, icon, label) {
        return `
            <button
                type="button"
                class="inter-child-btn inter-form-btn"
                onclick="openInterModal('${action}', '${idValue}', '${label}')"
            >
                <span class="inter-form-btn-icon">
                    <i class="${icon}"></i>
                </span>

                <span class="inter-form-btn-content">
                    <span class="inter-form-btn-title">${label}</span>
                </span>

                <span class="inter-form-btn-arrow">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            </button>
        `;
    }

    function formatChild(button) {

        const id = button.data('id');
        const client = button.data('client');
        const avancement = button.data('avancement');
        const priorite = button.data('priorite');

        return `
            <div class="inter-child-panel">

                <div class="inter-child-header">
                    <div>
                        <h3>Intervention n°${id}</h3>
                        <p>${client}</p>
                    </div>

                    <div class="inter-child-badges">
                        <span class="inter-status">${avancement}</span>
                        <span class="inter-priority">${priorite}</span>
                    </div>
                </div>

                <div class="inter-child-grid">
                    ${formButton('edit_inter_general', id, 'fa-solid fa-file-lines', 'Général')}
                    ${formButton('edit_inter_syst', id, 'fa-solid fa-gears', 'Système')}
                    ${formButton('edit_inter_etat_init', id, 'fa-solid fa-clipboard-list', 'État initial')}
                    ${formButton('edit_inter_travaux', id, 'fa-solid fa-screwdriver-wrench', 'Travaux')}
                    ${formButton('edit_inter_controles', id, 'fa-solid fa-list-check', 'Contrôles')}
                    ${formButton('edit_inter_validation', id, 'fa-solid fa-circle-check', 'Validation')}
                </div>

            </div>
        `;
    }

    const table = $('#inter').DataTable({
        ordering: true,
        language: {
            search: "Rechercher :",
            lengthMenu: "Afficher _MENU_ interventions",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ interventions",
            infoEmpty: "Aucune intervention disponible",
            infoFiltered: "(filtré sur _MAX_ interventions)",
            zeroRecords: "Aucun résultat trouvé",
            paginate: {
                previous: "Précédent",
                next: "Suivant"
            }
        }
    });

    $('#inter tbody').on('click', '.expand-row', function () {

        const button = $(this);
        const tr = button.closest('tr');
        const row = table.row(tr);

        if (row.child.isShown()) {

            row.child.hide();
            tr.removeClass('shown');

            button.find('i')
                .removeClass('fa-chevron-up')
                .addClass('fa-chevron-down');

        } else {

            row.child(formatChild(button)).show();
            tr.addClass('shown');

            button.find('i')
                .removeClass('fa-chevron-down')
                .addClass('fa-chevron-up');
        }
    });

});

function openInterModal(action, id, title) {

    $('#interModalTitle').text(title);

    $('#interModalBody').html(`
        <div class="modal-loading">
            Chargement...
        </div>
    `);

    $('#interModal').addClass('show');

    $.ajax({
        url: 'views/f_prod/ajax/load_inter_form.php',
        type: 'POST',
        data: {
            action: action,
            id: id
        },
        success: function(response) {
            $('#interModalBody').html(response);
        },
        error: function(xhr) {

            $('#interModalBody').html(`
                <div class="modal-error">
                    Erreur lors du chargement du formulaire.<br>
                    ${xhr.responseText}
                </div>
            `);
        }
    });
}

function closeInterModal() {
    $('#interModal').removeClass('show');
    $('#interModalBody').html('');
}

$(document).on('click', '#interModal', function(e) {

    if (e.target === this) {
        closeInterModal();
    }
});

$(document).on("submit", ".sav-form", function (e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    $.ajax({
        url: $(form).attr("action"),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",

        success: function (response) {
          if (response.success) {
              closeInterModal();
              window.location.reload();
          } else {
              alert(
                  response.message ||
                  "Erreur lors de l'enregistrement."
              );
          }
      },

    });
});

</script>