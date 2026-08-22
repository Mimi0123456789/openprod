<?php
require_once("model/utilisateurs.php");
require_once("model/fonctions.php");

$utilisateursModel = new utilisateursModel();
$fonctionsModel = new fonctionsModel();

$utilisateurs = $utilisateursModel->getutilisateursEtFonction();
$fonctions = $fonctionsModel->getAll();
?>

<link rel="stylesheet" href="./style/jquery.dataTables.min.css">
<script src="./js/jquery-3.5.1.js"></script>
<script src="./js/jquery.dataTables.min.js"></script>

<section class="users-page">

  <div class="users-header">
    <div>
      <h1>Gestion des utilisateurs</h1>
      <p>Consultez, modifiez et administrez les accès internes.</p>
    </div>

    <button type="button" class="btn-add-user" onclick="openAddUserModal()">
      <i class="fa-solid fa-user-plus"></i>
      Ajouter un utilisateur
    </button>
  </div>

  <div class="users-card">

    <table id="utilisateurs" class="display users-table" style="width:100%">
      <thead>
        <tr>
          <th></th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Login</th>
          <th>Fonction</th>
          <th>Réinit.</th>
          <th>Suppr.</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($utilisateurs as $donnees) { ?>
          <tr>
            <td>
              <button
                type="button"
                class="table-action edit"
                title="Modifier"
                onclick="openEditUserModal(this)"
                data-id="<?php echo htmlspecialchars($donnees['id']); ?>"
                data-nom="<?php echo htmlspecialchars($donnees['nom']); ?>"
                data-prenom="<?php echo htmlspecialchars($donnees['prenom']); ?>"
                data-login="<?php echo htmlspecialchars($donnees['login']); ?>"
                data-id_fonctions="<?php echo htmlspecialchars($donnees['id_fonctions']); ?>"
              >
                <i class="fa-solid fa-pen"></i>
              </button>
            </td>

            <td><?php echo htmlspecialchars($donnees['nom']); ?></td>
            <td><?php echo htmlspecialchars($donnees['prenom']); ?></td>

            <td>
              <span class="login-badge">
                <?php echo htmlspecialchars($donnees['login']); ?>
              </span>
            </td>

            <td>
              <span class="role-badge">
                <?php echo htmlspecialchars($donnees['libelle_fonction']); ?>
              </span>
            </td>

            <td>
              <form action="index.php?c=administration&a=reinit_mdp_utilisateurs" method="POST">
                <input type="hidden" name="id_utilisateurs" value="<?php echo htmlspecialchars($donnees['id']); ?>">
                <button
                  type="submit"
                  name="reinit_mdp_utilisateurs"
                  class="table-action reset"
                  title="Réinitialiser le mot de passe"
                  onclick="return confirm('Confirmer la réinitialisation du mot de passe ?');"
                >
                  <i class="fa-solid fa-rotate-right"></i>
                </button>
              </form>
            </td>

            <td>
              <form action="index.php?c=administration&a=delete_utilisateurs" method="POST">
                <input type="hidden" name="id_utilisateurs" value="<?php echo htmlspecialchars($donnees['id']); ?>">
                <button
                  type="submit"
                  name="delete_utilisateurs"
                  class="table-action delete"
                  title="Supprimer"
                  onclick="return confirm('Confirmer la suppression de cet utilisateur ?');"
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

<div id="addUserModal" class="custom-modal">
  <div class="custom-modal-content">

    <div class="custom-modal-header">
      <div>
        <h2>Ajouter un utilisateur</h2>
        <p>Créer un nouvel accès interne.</p>
      </div>

      <button type="button" class="modal-close" onclick="closeUserModals()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form method="POST" action="index.php?c=administration&a=add_utilisateurs" class="user-form">

      <div class="form-grid">
        <div class="form-group-custom">
          <label>Nom</label>
          <input type="text" name="nom" required>
        </div>

        <div class="form-group-custom">
          <label>Prénom</label>
          <input type="text" name="prenom" required>
        </div>

        <div class="form-group-custom">
          <label>Login</label>
          <input type="text" name="login" required>
        </div>

        <div class="form-group-custom">
          <label>Fonction</label>
          <select name="id_fonctions" required>
            <?php foreach ($fonctions as $fonction) { ?>
              <option value="<?php echo htmlspecialchars($fonction['ID']); ?>">
                <?php echo htmlspecialchars($fonction['libelle_fct']); ?>
              </option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" class="btn-secondary-modal" onclick="closeUserModals()">Annuler</button>
        <button type="submit" name="submit" class="btn-primary-modal">
          <i class="fa-solid fa-check"></i>
          Enregistrer
        </button>
      </div>

    </form>

  </div>
</div>

<div id="editUserModal" class="custom-modal">
  <div class="custom-modal-content">

    <div class="custom-modal-header">
      <div>
        <h2>Modifier un utilisateur</h2>
        <p>Mettre à jour les informations et la fonction.</p>
      </div>

      <button type="button" class="modal-close" onclick="closeUserModals()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form method="POST" action="index.php?c=administration&a=update_utilisateurs" class="user-form">

      <input type="hidden" name="id_utilisateurs" id="edit_id_utilisateurs">

      <div class="form-grid">
        <div class="form-group-custom">
          <label>Nom</label>
          <input type="text" name="nom" id="edit_user_nom" required>
        </div>

        <div class="form-group-custom">
          <label>Prénom</label>
          <input type="text" name="prenom" id="edit_user_prenom" required>
        </div>

        <div class="form-group-custom">
          <label>Login</label>
          <input type="text" name="login" id="edit_user_login" required>
        </div>

        <div class="form-group-custom">
          <label>Fonction</label>
          <select name="id_fonctions" id="edit_user_id_fonctions" required>
            <?php foreach ($fonctions as $fonction) { ?>
              <option value="<?php echo htmlspecialchars($fonction['ID']); ?>">
                <?php echo htmlspecialchars($fonction['libelle_fct']); ?>
              </option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" class="btn-secondary-modal" onclick="closeUserModals()">Annuler</button>
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
  $('#utilisateurs').DataTable({
    ordering: true,
    language: {
      search: "Rechercher :",
      lengthMenu: "Afficher _MENU_ utilisateurs",
      info: "Affichage de _START_ à _END_ sur _TOTAL_ utilisateurs",
      infoEmpty: "Aucun utilisateur disponible",
      infoFiltered: "(filtré sur _MAX_ utilisateurs)",
      zeroRecords: "Aucun résultat trouvé",
      paginate: {
        previous: "Précédent",
        next: "Suivant"
      }
    }
  });
});

function openAddUserModal() {
  document.getElementById('addUserModal').classList.add('show');
}

function openEditUserModal(button) {
  document.getElementById('edit_id_utilisateurs').value = button.dataset.id;
  document.getElementById('edit_user_nom').value = button.dataset.nom;
  document.getElementById('edit_user_prenom').value = button.dataset.prenom;
  document.getElementById('edit_user_login').value = button.dataset.login;
  document.getElementById('edit_user_id_fonctions').value = button.dataset.id_fonctions;

  document.getElementById('editUserModal').classList.add('show');
}

function closeUserModals() {
  document.getElementById('addUserModal').classList.remove('show');
  document.getElementById('editUserModal').classList.remove('show');
}

window.onclick = function(event) {
  if (event.target.classList.contains('custom-modal')) {
    closeUserModals();
  }
}
</script>