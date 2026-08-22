<?php

require_once(__DIR__ . '/core/bootstrap.php');

require_once(ROOT_PATH . "/model/utilisateurs.php");

if (
    isset($_POST["login"], $_POST["password"]) &&
    trim($_POST["login"]) !== "" &&
    trim($_POST["password"]) !== ""
) {
    $login = trim($_POST["login"]);
    $password = $_POST["password"];

    $utilisateursModel = new utilisateursModel();
    $utilisateur = $utilisateursModel->seConnecter($login, $password);

    if ($utilisateur !== false && is_array($utilisateur)) {

        unset($utilisateur["password"]);

        session_regenerate_id(true);

        $_SESSION["utilisateurs"] = $utilisateur;

        header("Location: index.php?c=transverse&a=dashboard");
        exit;
    }

    header("Location: connexion.php?err=1");
    exit;
}

header("Location: connexion.php?err=1");
exit;