<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MECALYS S.A.V - Connexion</title>

  <link rel="icon" type="image/ico" href="style/images/favicon.png">
  <link rel="stylesheet" href="./style/bootstrap.css">
  <link rel="stylesheet" href="./style/style.css">
  <script src="js/39912f35e9.js" crossorigin="anonymous"></script>
</head>

<body>

<header class="sav-header">
  <div class="header-overlay">
    <div class="header-logo">
      <img src="style/images/MECALYS_logo.png" alt="MECALYS Group">
    </div>

    <div class="header-title">
      <a href="index.php">Suivi S.A.V</a>
      <span></span>
    </div>

    <div class="header-login">
      <a href="index.php">
        <i class="fa-solid fa-arrow-left"></i> Accueil
      </a>
    </div>
  </div>
</header>

<main class="login-page">

  <section class="login-card">

    <div class="login-icon">
      <i class="fa-solid fa-lock"></i>
    </div>

    <h1>Ouverture de session</h1>

    <p>
      Accédez à l’espace interne de gestion des interventions SAV.
    </p>

    <?php
      if (isset($_GET["err"]) && $_GET["err"] == 1) {
        echo '<div class="login-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                Mot de passe incorrect ou identifiant invalide.
              </div>';
      }
    ?>

    <form action="authentification.php" method="post">

      <div class="form-group-custom">
        <label for="login">Identifiant</label>
        <div class="input-icon">
          <i class="fa-regular fa-user"></i>
          <input
            type="text"
            id="login"
            name="login"
            placeholder="Nom de connexion"
            required
          >
        </div>
      </div>

      <div class="form-group-custom">
        <label for="password">Mot de passe</label>
        <div class="input-icon">
          <i class="fa-solid fa-key"></i>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Mot de passe"
            required
          >
        </div>
      </div>

      <button type="submit" class="login-button">
        <i class="fa-solid fa-right-to-bracket"></i>
        Se connecter
      </button>

    </form>

    <div class="login-footer">
      <i class="fa-solid fa-shield-halved"></i>
      Connexion sécurisée réservée au personnel autorisé.
    </div>

  </section>

</main>

</body>
</html>