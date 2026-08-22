<header>
  <link rel="stylesheet" type="text/css" href="./style/jquery.dataTables.min.css">
  <script type="text/javascript" src="./js/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
</header>

<?php
require_once("model/clients.php");

$clientsModel = new clientsModel();
$clients = $clientsModel->getAll();
?>

<section class="clients-page">

  <div class="clients-header">
    <div>
      <h1>Gestion des clients</h1>
      <p>Consultez, modifiez et administrez votre portefeuille client.</p>
    </div>

    <button type="button" class="btn-add-client" onclick="openAddClientModal()">
      <i class="fa-solid fa-user-plus"></i>
      Ajouter un client
    </button>
  </div>

  <div class="clients-card">

    <table id="clients" class="display clients-table" style="width:100%">
      <thead>
        <tr>
          <th></th>
          <th>Nom</th>
          <th>Adresse</th>
          <th>Code postal</th>
          <th>Ville</th>
          <th>Téléphone</th>
          <th>Mail</th>
          <th>Représentant</th>
          <th>Suppr.</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($clients as $donnees) { ?>
          <tr>
            <td>
              <button
                type="button"
                class="table-action edit"
                title="Modifier"
                onclick="openEditClientModal(this)"
                data-id="<?php echo htmlspecialchars($donnees['id']); ?>"
                data-nom="<?php echo htmlspecialchars($donnees['nom']); ?>"
                data-adresse="<?php echo htmlspecialchars($donnees['adresse']); ?>"
                data-c_postal="<?php echo htmlspecialchars($donnees['c_postal']); ?>"
                data-ville="<?php echo htmlspecialchars($donnees['ville']); ?>"
                data-num_tel="<?php echo htmlspecialchars($donnees['num_tel']); ?>"
                data-mail="<?php echo htmlspecialchars($donnees['mail']); ?>"
                data-representant="<?php echo htmlspecialchars($donnees['representant']); ?>"
              >
                <i class="fa-solid fa-pen"></i>
              </button>
            </td>

            <td><strong><?php echo htmlspecialchars($donnees['nom']); ?></strong></td>
            <td><?php echo htmlspecialchars($donnees['adresse']); ?></td>

            <td>
              <span class="postal-badge">
                <?php echo htmlspecialchars($donnees['c_postal']); ?>
              </span>
            </td>

            <td><?php echo htmlspecialchars($donnees['ville']); ?></td>

            <td>
              <span class="phone-badge">
                <i class="fa-solid fa-phone"></i>
                <?php echo htmlspecialchars($donnees['num_tel']); ?>
              </span>
            </td>

            <td><?php echo htmlspecialchars($donnees['mail']); ?></td>

            <td>
              <span class="representant-badge">
                <?php echo htmlspecialchars($donnees['representant']); ?>
              </span>
            </td>

            <td>
              <form action="index.php?c=transverse&a=delete_clients" method="POST">
                <input type="hidden" name="id_client" value="<?php echo htmlspecialchars($donnees['id']); ?>">
                <button
                  type="submit"
                  name="delete_client"
                  class="table-action delete"
                  title="Supprimer"
                  onclick="return confirm('Confirmer la suppression de ce client ?');"
                >
                  <i class="fa-solid fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
</section>

<!-- MODALE AJOUT CLIENT -->
<div id="addClientModal" class="custom-modal">
  <div class="custom-modal-content">

    <div class="custom-modal-header">
      <div>
        <h2>Ajouter un client</h2>
        <p>Créer une nouvelle fiche client.</p>
      </div>

      <button type="button" class="modal-close" onclick="closeClientModals()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form method="POST" action="index.php?c=transverse&a=add_clients" class="client-form">

      <div class="form-grid">
        <div class="form-group-custom">
          <label>Nom</label>
          <input type="text" name="nom" required>
        </div>

        <div class="form-group-custom">
          <label>Représentant</label>
          <input type="text" name="representant">
        </div>

        <div class="form-group-custom full">
          <label>Adresse</label>
          <input type="text" name="adresse">
        </div>

        <div class="form-group-custom">
          <label>Code postal</label>
          <input type="text" name="c_postal">
        </div>

        <div class="form-group-custom">
          <label>Ville</label>
          <input type="text" name="ville">
        </div>

        <div class="form-group-custom">
          <label>Téléphone</label>
          <input type="text" name="num_tel">
        </div>

        <div class="form-group-custom">
          <label>Mail</label>
          <input type="email" name="mail">
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" class="btn-secondary-modal" onclick="closeClientModals()">Annuler</button>
        <button type="submit" name="submit" class="btn-primary-modal">
          <i class="fa-solid fa-check"></i>
          Enregistrer
        </button>
      </div>

    </form>
  </div>
</div>


<!-- MODALE EDIT CLIENT -->
<div id="editClientModal" class="custom-modal">
  <div class="custom-modal-content">

    <div class="custom-modal-header">
      <div>
        <h2>Modifier un client</h2>
        <p>Mettre à jour les informations du client.</p>
      </div>

      <button type="button" class="modal-close" onclick="closeClientModals()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form method="POST" action="index.php?c=transverse&a=add_clients" class="client-form">

      <input type="hidden" name="id_client" id="edit_id_client">

      <div class="form-grid">
        <div class="form-group-custom">
          <label>Nom</label>
          <input type="text" name="nom" id="edit_nom" required>
        </div>

        <div class="form-group-custom">
          <label>Représentant</label>
          <input type="text" name="representant" id="edit_representant">
        </div>

        <div class="form-group-custom full">
          <label>Adresse</label>
          <input type="text" name="adresse" id="edit_adresse">
        </div>

        <div class="form-group-custom">
          <label>Code postal</label>
          <input type="text" name="c_postal" id="edit_c_postal">
        </div>

        <div class="form-group-custom">
          <label>Ville</label>
          <input type="text" name="ville" id="edit_ville">
        </div>

        <div class="form-group-custom">
          <label>Téléphone</label>
          <input type="text" name="num_tel" id="edit_num_tel">
        </div>

        <div class="form-group-custom">
          <label>Mail</label>
          <input type="email" name="mail" id="edit_mail">
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" class="btn-secondary-modal" onclick="closeClientModals()">Annuler</button>
        <button type="submit" name="submit" class="btn-primary-modal">
          <i class="fa-solid fa-check"></i>
          Modifier
        </button>
      </div>

    </form>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function () {
  $('#clients').DataTable({
    ordering: true,
    language: {
      search: "Rechercher :",
      lengthMenu: "Afficher _MENU_ clients",
      info: "Affichage de _START_ à _END_ sur _TOTAL_ clients",
      infoEmpty: "Aucun client disponible",
      infoFiltered: "(filtré sur _MAX_ clients)",
      zeroRecords: "Aucun résultat trouvé",
      paginate: {
        previous: "Précédent",
        next: "Suivant"
      }
    }
  });
});

function openAddClientModal() {
  document.getElementById('addClientModal').classList.add('show');
}

function openEditClientModal(button) {
  document.getElementById('edit_id_client').value = button.dataset.id;
  document.getElementById('edit_nom').value = button.dataset.nom;
  document.getElementById('edit_adresse').value = button.dataset.adresse;
  document.getElementById('edit_c_postal').value = button.dataset.c_postal;
  document.getElementById('edit_ville').value = button.dataset.ville;
  document.getElementById('edit_num_tel').value = button.dataset.num_tel;
  document.getElementById('edit_mail').value = button.dataset.mail;
  document.getElementById('edit_representant').value = button.dataset.representant;

  document.getElementById('editClientModal').classList.add('show');
}

function closeClientModals() {
  document.getElementById('addClientModal').classList.remove('show');
  document.getElementById('editClientModal').classList.remove('show');
}

window.onclick = function(event) {
  if (event.target.classList.contains('custom-modal')) {
    closeClientModals();
  }
}
</script>