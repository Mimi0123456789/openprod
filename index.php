<?php
require_once(__DIR__ . '/core/bootstrap.php');

include_once "controller/principale.php";

$controller = new principale;

/*
|--------------------------------------------------------------------------
| Actions qui doivent retourner uniquement du JSON
|--------------------------------------------------------------------------
*/

$ajaxActions = [
    'add_inter',
    'update_inter_general',
    'update_inter_syst',
    'update_inter_etat_init',
    'update_inter_travaux',
    'update_inter_controles',
    'update_inter_validation',
    'generate_inter_pdf',
    'generate_inter_full_pdf',
    'download_inter_zip',
];

if (
    isset($_GET["c"], $_GET["a"]) &&
    in_array($_GET["a"], $ajaxActions, true)
) {
    $controller->afficher(
        $_GET["c"],
        $_GET["a"]
    );

    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>MECALYS S.A.V</title>

  <link rel="icon" type="image/ico" href="style/images/favicon.png">
  <link rel="stylesheet" href="./style/bootstrap.css">
  <link rel="stylesheet" href="./style/style.css">
  <script src="js/39912f35e9.js" crossorigin="anonymous"></script>
</head>

<body>

<?php 

  if (isset($_SESSION["utilisateurs"])) { ?>

  <nav class="topbar-connected">
    <a href="index.php?c=transverse&a=dashboard">
      <i class="fa-solid fa-table"></i> Tableau de bord
    </a>

    <a href="deconnexion.php">
      <i class="fa-solid fa-person-walking-arrow-right"></i> Se déconnecter
    </a>
  </nav>

<?php } else { ?>

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
        <a href="connexion.php">
          <i class="fa-regular fa-user"></i> Se connecter
        </a>
      </div>
    </div>
  </header>

<?php } ?>

<main class="page-content">
<?php

if (isset($_GET["c"]) && isset($_GET["a"])) {
  $controller->afficher($_GET["c"], $_GET["a"]);
} else {
  if (isset($_SESSION["utilisateurs"])) {
    $controller->afficher("views", "dashboard");
  } else {
    $controller->afficher("transverse", "etat_avancement");
  }
}

?>
</main>

</body>
</html>