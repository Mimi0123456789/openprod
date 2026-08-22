<section class="sav-home">

  <div class="intro">
    <h1>Suivez votre intervention SAV en toute simplicité</h1>
    <p>
      Renseignez les informations ci-dessous pour consulter l’état d’avancement
      de votre intervention.
    </p>
  </div>

  <div class="sav-grid">

    <div class="tracking-card">
      <form name="form_suivi_prod" action="index.php?c=transverse&a=etat_avancement" method="POST">

        <div class="form-row">
          <div class="form-group-custom">
            <label>N° intervention <span>*</span></label>
            <div class="input-icon">
              <i class="fa-regular fa-clipboard"></i>
              <input type="text" name="id_inter" placeholder="Ex : 2024-000123" required>
            </div>
          </div>

          <div class="form-group-custom">
            <label>Code postal <span>*</span></label>
            <div class="input-icon">
              <i class="fa-solid fa-location-dot"></i>
              <input type="text" name="c_postal" placeholder="Ex : 69000" required>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group-custom">
            <label>Identifiant client</label>
            <div class="input-icon">
              <i class="fa-regular fa-user"></i>
              <input type="text" name="client_num" placeholder="Ex : CLI-00123">
            </div>
          </div>

          <div class="form-group-custom button-zone">
            <button type="submit" name="rechercher_f_prod" id="rechercher_f_prod">
              <i class="fa-solid fa-magnifying-glass"></i>
              Rechercher
            </button>
          </div>
        </div>

        <div class="security-note">
          <i class="fa-solid fa-shield-halved"></i>
          Vos données sont sécurisées et utilisées uniquement pour le suivi de votre intervention.
        </div>

      </form>
    </div>

    <aside class="info-card">
      <div class="info-content">
        <h2>Un suivi clair et transparent</h2>
        <div class="orange-line"></div>

        <div class="info-item">
          <i class="fa-regular fa-clock"></i>
          <div>
            <strong>Suivi en temps réel</strong>
            <p>Consultez l’avancement de votre intervention à chaque étape.</p>
          </div>
        </div>

        <div class="info-item">
          <i class="fa-regular fa-comments"></i>
          <div>
            <strong>Informations détaillées</strong>
            <p>Accédez aux commentaires et documents associés.</p>
          </div>
        </div>

        <div class="info-item">
          <i class="fa-regular fa-bell"></i>
          <div>
            <strong>Notifications</strong>
            <p>Soyez informé à chaque changement de statut.</p>
          </div>
        </div>
      </div>
    </aside>

  <?php if (!empty($reponse)) { ?>

    <div class="result-card" style="width: 100%; grid-column: 1 / -1;">

      <?php if ($reponse == 'PRIS EN CHARGE') { ?>
        <img src="style/images/01.png" alt="Pris en charge">

      <?php } elseif ($reponse == 'ÉTUDE EN COURS') { ?>
        <img src="style/images/02.png" alt="Étude en cours">

      <?php } elseif ($reponse == 'ATTENTE DE FOURNITURES' || $reponse == 'RÉALISATION EN ATELIER') { ?>
        <img src="style/images/03.png" alt="Réalisation en atelier">

      <?php } elseif ($reponse == 'LIVRAISON EN COURS' || $reponse == 'INTALLATION EN COURS') { ?>
        <img src="style/images/04.png" alt="Livraison en cours">

      <?php } elseif ($reponse == 'TERMINÉ') { ?>
        <img src="style/images/05.png" alt="Terminé">

      <?php } elseif ($reponse == 'CLÔTURÉ' || $reponse == 'Echec') { ?>
        <div class="error-message">
          Aucune correspondance n'a été trouvée, veuillez réessayer.
        </div>
      <?php } ?>

    </div>

  <?php } ?>

</section>