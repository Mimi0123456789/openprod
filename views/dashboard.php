<section class="dashboard-page">

  <?php if (isset($_SESSION["utilisateurs"])) { ?>

    <div class="dashboard-header">
      <div>
        <h1>Tableau de bord</h1>
        <p>
          Bienvenue dans l’espace interne de gestion du SAV.
        </p>
      </div>

      <div class="dashboard-user">
        <i class="fa-solid fa-user-shield"></i>
        <span>
          <?php echo $_SESSION["utilisateurs"]["login"] ?? "Utilisateur"; ?>
        </span>
      </div>
    </div>

    <div class="dashboard-grid">

      <a class="dashboard-card" href="index.php?c=transverse&a=mon_compte">
        <div class="dashboard-icon orange">
          <i class="fa-solid fa-key"></i>
        </div>
        <h3>Mon compte</h3>
        <p>Consulter ou modifier vos informations personnelles.</p>
      </a>

      <?php if ($_SESSION["utilisateurs"]["id_fonctions"] == "1" || $_SESSION["utilisateurs"]["id_fonctions"] == "3") { ?>
      <a class="dashboard-card" href="index.php?c=transverse&a=listing_clients">
        <div class="dashboard-icon blue">
          <i class="fa-solid fa-user-tie"></i>
        </div>
        <h3>Clients</h3>
        <p>Accéder à la liste des clients et à leurs interventions.</p>
      </a>

      <?php } ?>

      <a class="dashboard-card highlight" href="index.php?c=transverse&a=fprod_en_cours">
        <div class="dashboard-icon green">
          <i class="fa-solid fa-industry"></i>
        </div>
        <h3>En cours</h3>
        <p>Suivre les interventions actuellement actives.</p>
      </a>

      <?php if ($_SESSION["utilisateurs"]["id_fonctions"] == "1" || $_SESSION["utilisateurs"]["id_fonctions"] == "3") { ?>
      <a class="dashboard-card" href="index.php?c=transverse&a=fprod_cloture">
        <div class="dashboard-icon grey">
          <i class="fa-solid fa-box-archive"></i>
        </div>
        <h3>Archives</h3>
        <p>Consulter les interventions terminées ou clôturées.</p>
      </a>

      <?php } ?>

      <?php if ($_SESSION["utilisateurs"]["id_fonctions"] == "3") { ?>

        <a class="dashboard-card admin" href="index.php?c=administration&a=gestion_utilisateurs">
          <div class="dashboard-icon purple">
            <i class="fa-solid fa-users"></i>
          </div>
          <h3>Utilisateurs</h3>
          <p>Gérer les comptes et les accès des utilisateurs.</p>
        </a>

        <?php } ?>

        <?php if ($_SESSION["utilisateurs"]["id_fonctions"] == "1" || $_SESSION["utilisateurs"]["id_fonctions"] == "3") { ?>
        <a class="dashboard-card admin" href="index.php?c=administration&a=stats">
          <div class="dashboard-icon cyan">
            <i class="fa-solid fa-chart-line"></i>
          </div>
          <h3>Statistiques</h3>
          <p>Analyser les volumes, délais et performances SAV.</p>
        </a>

      <?php } ?>

    </div>

  <?php } ?>

</section>