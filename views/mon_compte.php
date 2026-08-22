<section class="account-page">

  <div class="account-header">
    <div>
      <h1>Mon compte</h1>
      <p>Consultez vos informations et modifiez votre mot de passe.</p>
    </div>

    <div class="account-avatar">
      <i class="fa-solid fa-user-shield"></i>
    </div>
  </div>

  <div class="account-grid">

    <div class="account-card">
      <div class="account-card-header">
        <h2><i class="fa-solid fa-id-card"></i> Informations</h2>
      </div>

      <form name="modifier_compte" id="modifier_compte" action="index.php?c=transverse&a=proc_modifier_compte" method="post">

        <div class="form-grid">
          <div class="form-group-custom">
            <label>Fonction</label>
            <select name="fonctions" id="fonctions" disabled>
              <?php foreach ($fonctions as $link) { ?>
                <option value="<?php echo htmlspecialchars($link["ID"]); ?>"
                  <?php echo ($_SESSION["utilisateurs"]["id_fonctions"] == $link["ID"]) ? "selected" : ""; ?>>
                  <?php echo htmlspecialchars($link["libelle_fct"]); ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group-custom">
            <label>Nom</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION["utilisateurs"]["nom"]); ?>" disabled>
          </div>

          <div class="form-group-custom">
            <label>Prénom</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION["utilisateurs"]["prenom"]); ?>" disabled>
          </div>

          <div class="form-group-custom">
            <label>Login</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION["utilisateurs"]["login"]); ?>" disabled>
          </div>
        </div>

      </form>
    </div>

    <div class="account-card">
      <div class="account-card-header">
        <h2><i class="fa-solid fa-lock"></i> Sécurité</h2>
      </div>

      <form name="form_modifier_password" id="form_modifier_password" action="index.php?c=transverse&a=proc_modifier_mdp" method="post">

        <div class="form-grid one-col">
          <div class="form-group-custom">
            <label>Nouveau mot de passe</label>
            <input type="password" name="password_reinit" id="password_reinit" required>
          </div>

          <div class="form-group-custom">
            <label>Confirmation</label>
            <input type="password" name="confirm_password_reinit" id="confirm_password_reinit" required>
          </div>
        </div>

        <div class="modal-actions">
          <button type="submit" name="reinitialier_password" id="reinitialier_password" class="btn-primary-modal">
            <i class="fa-solid fa-key"></i>
            Réinitialiser
          </button>
        </div>

      </form>
    </div>

  </div>

</section>