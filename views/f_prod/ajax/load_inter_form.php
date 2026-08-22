<?php

require_once('../../../core/bootstrap.php');

if (!isset($_POST['id']) || !isset($_POST['action'])) {
  echo '<div class="modal-error">Paramètres manquants.</div>';
  exit;
}

$_POST['id'] = intval($_POST['id']);
$_POST['id_inter'] = intval($_POST['id']);

$action = $_POST['action'];

switch ($action) {

  case 'add_inter':
    include('../add_inter.php');
  break;

  case 'edit_inter_general':
    include('../edit_inter_general.php');
    break;

  case 'edit_inter_syst':
    include('../edit_inter_syst.php');
    break;

  case 'edit_inter_etat_init':
    include('../edit_inter_etat_init.php');
    break;

  case 'edit_inter_travaux':
    include('../edit_inter_travaux.php');
    break;

  case 'edit_inter_controles':
    include('../edit_inter_controles.php');
    break;

  case 'edit_inter_validation':
    include('../edit_inter_validation.php');
    break;

  case 'edit_inter_prises_init':
    include('../modal_prises_init.php');
    break;

  case 'edit_inter_obtu_init':
    include('../modal_obtu_init.php');
    break;
  
  default:
    echo '<div class="modal-error">Formulaire introuvable.</div>';
    break;
}