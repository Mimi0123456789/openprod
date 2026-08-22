 <!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style/form_style.css" media="all"/>
</head>

<body>

<div id="element">
  <?php
  include_once("./elements_bdd.php");

  $id = $_POST['id_inter'];

    $requete_inter = $bdd->query('SELECT f_inter.*, clients.nom as nom_client, utilisateurs.nom as nom_utilisateur, avancements.libelle_avance FROM f_inter, clients, utilisateurs, avancements WHERE f_inter.id_clients=clients.id AND f_inter.id_responsable=utilisateurs.id AND f_inter.id_avancements=avancements.ID AND f_inter.id='.$id) ; 

    $donnees_inter=$requete_inter->fetch();

    if ($donnees_inter['lieu']=='Site Client') {
      $check_1_lieu = 'checked="checked"';
      $check_2_lieu = "";
    }
    if ($donnees_inter['lieu']=='Site MECALYS') {
      $check_1_lieu = "";
      $check_2_lieu = 'checked="checked"';
    }
    if ($donnees_inter['demande']=='EXPERTISE') {
      $check_1_demande = 'checked="checked"';
      $check_2_demande = "";
    }
    if ($donnees_inter['demande']=='CONFIRMÉE') {
      $check_1_demande = "";
      $check_2_demande = 'checked="checked"';
    }
    if ($donnees_inter['facturation']=='Sous contrat') {
      $check_1_facturation = 'checked="checked"';
      $check_2_facturation = "";
      $check_3_facturation = "";
    }
    if ($donnees_inter['facturation']=='Avec facture') {
      $check_1_facturation = "";
      $check_2_facturation = 'checked="checked"';
      $check_3_facturation = "";
    }
    if ($donnees_inter['facturation']=='Sans facture') {
      $check_1_facturation = "";
      $check_2_facturation = "";
      $check_3_facturation = 'checked="checked"';
    }
  ?>

  <page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;" style="width:100%; height: 100%; font-family: Arial;">
    <div class="html2pdf__page-break">
      <div class="gros_bloc">
        <h2>Intervention n° <?php echo $id_inter ?> </h2>
        <form method="POST" action="index.php?c=transverse&a=update_inter_general">
          <table>
            <tr>
              <td colspan="3">
                <input type="hidden" name="id_inter" required="required" value="<?php echo $donnees_inter['id'] ?>">
                <label>Client :</label>
                <select name="id_clients">
                  <?php
                    // Affichage des clients
                    $requete = $bdd->query('SELECT f_inter.*, clients.* FROM f_inter, clients WHERE f_inter.id='.$id .' AND f_inter.id_clients=clients.id');
                    while ($donnees=$requete->fetch()) { ?>
                      <option value="<?php echo $donnees['id'] ?>"><?php echo $donnees['nom'] ?></option>;
                    <?php
                    }
                  ?>
                </select>
              </td>
              <td colspan="3">
                <label>Avancement :</label>
                <select name="id_avancements">
                  <?php
                    // Affichage des clients
                    $requete = $bdd->query('SELECT f_inter.*, avancements.* FROM f_inter, avancements WHERE f_inter.id='.$id .' AND f_inter.id_avancements=avancements.ID');
                    while ($donnees=$requete->fetch()) { ?>
                      <option value="<?php echo $donnees['ID'] ?>"><?php echo $donnees['libelle_avance'] ?></option>;
                    <?php
                    }
                  ?>
                </select>
              <br><br>
              <label>Durée prévisionnelle (en heure):</label>
              <input type="int" name="duree_init" required="required" value="<?php echo $donnees_inter['duree_init']; ?>">
            </td>
          </tr>
          <tr>
              <td colspan="2">

              <label>Date de création :</label>
              <input type="date" name="date_crea" required="required" value="<?php echo $donnees_inter['date_crea']; ?>">
              <br><br>
              <label>Délai max :</label>
              <input type="date" name="date_max" required="required" value="<?php echo $donnees_inter['date_max']; ?>">
              <br><br>
              <label>Date début :</label>
              <input type="date" name="date_debut" required="required" value="<?php echo $donnees_inter['date_debut']; ?>">
              <br><br>
              <label>Date fin :</label>
              <input type="date" name="date_fin" required="required" value="<?php echo $donnees_inter['date_fin']; ?>">
              <br><br>
              <label>Priorité :</label>
              <select name="id_priorite">
                <?php
                  // Affichage des clients
                  $requete = $bdd->query('SELECT f_inter.*, priorites.* FROM f_inter, priorites WHERE f_inter.id='.$id .' AND f_inter.id_priorite=priorites.ID');
                  while ($donnees=$requete->fetch()) { ?>
                    <option value="<?php echo $donnees['ID'] ?>"><?php echo $donnees['libelle_ct_prio'] ?></option>;
                  <?php
                  }
                ?>
              </select>
            </td>
            <td colspan="2">
              <label>Responsable :</label>
              <select name="id_responsable" required="required">
                <?php
                  // Affichage des clients
                  $requete = $bdd->query('SELECT f_inter.*, utilisateurs.* FROM f_inter, utilisateurs WHERE f_inter.id='.$id .' AND f_inter.id_responsable=utilisateurs.id');
                  while ($donnees=$requete->fetch()) { ?>
                    <option value="<?php echo $donnees['id'] ?>"><?php echo $donnees['nom']." ".$donnees['prenom'] ?></option>
                  <?php
                  }
                ?>
              </select>
              <br><br>
              <label>Intervenant :</label>
              <select name="id_intervenant" required="required">
                <?php
                  // Affichage des clients
                  $requete = $bdd->query('SELECT f_inter.*, utilisateurs.* FROM f_inter, utilisateurs WHERE f_inter.id='.$id .' AND f_inter.id_intervenant=utilisateurs.id');
                  while ($donnees=$requete->fetch()) { ?>
                    <option value="<?php echo $donnees['id'] ?>"><?php echo $donnees['nom']." ".$donnees['prenom'] ?></option>
                  <?php
                  }
                ?>
              </select>
              <br><br>
              <label>Lieu de l'intervention :</label><br>
                  <input type="radio" name="lieu" value="Site Client" <?php echo $check_1_lieu ?>> Site Client<br>
                  <input type="radio" name="lieu" value="Site MECALYS" <?php echo $check_2_lieu ?>> Site MECALYS
            </td>
            
            <td colspan="2">
              <label>N° devis :</label>
              <input type="text" name="num_devis" value="<?php echo $donnees_inter['num_devis'] ?>">
              <br><br>
              <label>État de l'intervention :</label><br>
              <?php ?>
                  <input type="radio" name="demande" value="EXPERTISE" required="required" <?php echo $check_1_demande ?>> EXPERTISE <br>
                  <input type="radio" name="demande" value="CONFIRMÉE" required="required" <?php echo $check_2_demande ?>> CONFIRMÉE
              <?php ?>
              <br><br>
              <label style="margin-top: 4%;">Intervention :</label><br>
              <?php ?>
                  <input type="radio" name="facturation" value="Sous contrat" required="required" <?php echo $check_1_facturation ?>> Sous contrat<br>
                  <input type="radio" name="facturation" value="Avec facture" required="required" <?php echo $check_2_facturation ?>> Avec facture<br>
                  <input type="radio" name="facturation" value="Sans facture" required="required" <?php echo $check_3_facturation ?>> Sans facture
              <?php ?>
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <label>Anomalie :</label><br><br>
              <textarea type="text" name="anomalie" style="width: 100%;"><?php echo $donnees_inter['anomalie']; ?></textarea>
              <br><br>
              <label>Descriptions des travaux :</label><br><br>
              <textarea type="text" name="desc_travaux" style="width: 100%;"><?php echo $donnees_inter['desc_travaux']; ?></textarea>
              <br><br>
              <label>Communication au client :</label><br><br>
              <textarea type="text" name="comm_client" style="width: 100%;"><?php echo $donnees_inter['comm_client']; ?></textarea>
              <br><br>
            </td>
          </tr>
        </table>
        </div>
      </form>
    </div>

    <?php
      $requete_syst = $bdd->query('SELECT * FROM systemes WHERE id='.$id) ;

      $donnees_syst=$requete_syst->fetch();

      if ($donnees_syst['embout']=='Topless') {
        $check_2_embout = 'checked="checked"';
        $check_1_embout = "";
      }
      if ($donnees_syst['embout']!='Topless') {
        $check_1_embout = 'checked="checked"';
        $check_2_embout = "";
      }
      if ($donnees_syst['type_obturation']=='Obturation électrique' || $donnees_syst['type_obturation']=='') {
        $check_1_type_obturation = 'checked="checked"';
        $check_2_type_obturation = "";
        $check_3_type_obturation = "";
      }
      if ($donnees_syst['type_obturation']=='Obturation hydraulique') {
        $check_1_type_obturation = "";
        $check_2_type_obturation = 'checked="checked"';
        $check_3_type_obturation = "";
      }
      if ($donnees_syst['type_obturation']=='Obturation pneumatique') {
        $check_1_type_obturation = "";
        $check_2_type_obturation = "";
        $check_3_type_obturation = 'checked="checked"';
      }
      $type_moule = $donnees_syst['type'];
    ?>

    <div class="html2pdf__page-break">
      <div class="gros_bloc">
        <h2>Système</h2>

        <form method="POST" action="index.php?c=transverse&a=update_inter_syst">
          <table>
            <tr>
              <td colspan="3">
                <input type="hidden" name="id_inter" value="<?php echo $id_inter ?>" >
                <label>Type :</label>
                <select name="type">
                  <option value="<?php echo $type_moule ?>"><?php echo $type_moule ?></option>
                  <option value="BLOC CHAUD">BLOC CHAUD</option>
                  <option value="MOULE ENTIER">MOULE ENTIER</option>
                  <option value="DEMI MOULE">DEMI MOULE</option>
                  <option value="BUSE DE PRESSE">BUSE DE PRESSE</option>
                  <option value="ENSEMBLE DE BUSETTES">ENSEMBLE DE BUSETTES</option>
                </select>
                <br><br>

                <label>Référence :</label>
                <input type="text" name="reference" value="<?php echo $donnees_syst['reference']; ?>"><br><br>
                <label>Marque :</label>
                <input type="text" name="marque" value="<?php echo $donnees_syst['marque']; ?>"><br><br>
                <label>N° immatriculation :</label>
                <input type="text" name="num_immat_sys" value="<?php echo $donnees_syst['num_immat_sys']; ?>">
              </td>
              <td colspan="3">
                <label>Matière injectée :</label>
                <select name="mat_inject">
                  <?php
                    // Affichage des clients
                    $requete = $bdd->query('SELECT systemes.*, matieres.* FROM systemes, matieres WHERE systemes.id='.$id .' AND systemes.mat_inject=matieres.id');
                    while ($donnees=$requete->fetch()) { ?>
                      <option value="<?php echo $donnees['id'] ?>"><?php echo $donnees['libelle_mat'] ." - ".strtoupper($donnees['libelle_mat_lg']) ?></option>;
                    <?php
                    }
                  ?>
                </select>
                <br><br>
                <label>Température d'injection (°C) :</label>
                <input type="int" name="temp_inject" value="<?php echo $donnees_syst['temp_inject']; ?>" required>
                <br><br>
                <label>Nb points d'injection :</label>
                <input type="int" name="nbr_pt" value="<?php echo $donnees_syst['nbr_pt']; ?>">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <label>Nb de résistances :</label>
                <input type="int" name="nbr_resistance" value="<?php echo $donnees_syst['nbr_resistance']; ?>">
                <br><br>
                <label>Nb de sondes :</label>
                <input type="int" name="nbr_sonde" value="<?php echo $donnees_syst['nbr_sonde']; ?>">
                <br><br>
                <label>Nb de prises :</label>
                <input type="int" name="nbr_prise" value="<?php echo $donnees_syst['nbr_prise']; ?>">        
              </td>
              <td colspan="2">
                <label>Nb d'obturateurs:</label>
                <input type="int" name="nbr_obtu" value="<?php echo $donnees_syst['nbr_obtu'] ?>">
                <br><br><br><hr><br>
                <label>Type d'obturation :</label><br><br>
                <input type="radio" name="type_obturation" value="Obturation électrique" <?php echo $check_1_type_obturation ?>> Electrique<br>
                <input type="radio" name="type_obturation" value="Obturation hydraulique" <?php echo $check_2_type_obturation ?>> Hydraulique<br>
                <input type="radio" name="type_obturation" value="Obturation pneumatique" <?php echo $check_3_type_obturation ?>> Pneumatique<br>
              </td>
              <td colspan="2">
              <label>Type d'embout :</label><br><br>
              <input type="radio" name="embout" value="Débouchant" required="required" <?php echo $check_1_embout ?>> Débouchant <br>
              <input type="radio" name="embout" value="Topless" required="required" <?php echo $check_2_embout ?>> Topless <br>
              </td>
            </tr>
            <tr>
              <td colspan="6">
                <label>Description :</label><br><br>
                <textarea type="text" name="description" style="width: 100%;"><?php echo $donnees_syst['description']; ?></textarea>
                <br><br>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>

    <?php
      $requete_inter = $bdd->query('SELECT * FROM etat_init WHERE id='.$id_inter) ;

      $donnees_inter=$requete_inter->fetch();

      if ($donnees_inter['eg_propre']=='CORRECT' || $donnees_inter['eg_propre']=='') {
        $selected_eg_propre_1 = 'selected="selected"';
        $selected_eg_propre_2 = "";
      }
      if ($donnees_inter['eg_propre']=='A REVOIR') {
        $selected_eg_propre_2 = 'selected="selected"';
        $selected_eg_propre_1 = "";
      }
      if ($donnees_inter['eg_ancien']=='CORRECT' || $donnees_inter['eg_ancien']=='') {
        $selected_eg_ancien_1 = 'selected="selected"';
        $selected_eg_ancien_2 = "";
      }
      if ($donnees_inter['eg_ancien']=='A REVOIR') {
        $selected_eg_ancien_2 = 'selected="selected"';
        $selected_eg_ancien_1 = "";
      }
      if ($donnees_inter['eg_etatgene']=='CORRECT' || $donnees_inter['eg_etatgene']=='') {
        $selected_eg_etatgene_1 = 'selected="selected"';
        $selected_eg_etatgene_2 = "";
      }
      if ($donnees_inter['eg_etatgene']=='A REVOIR') {
        $selected_eg_etatgene_2 = 'selected="selected"';
        $selected_eg_etatgene_1 = "";
      }
      if ($donnees_inter['eg_aspectgene']=='FISSURE(S)') {
        $selected_eg_aspectgene_1 = 'selected="selected"';
        $selected_eg_aspectgene_2 = "";
        $selected_eg_aspectgene_3 = "";
      }
      if ($donnees_inter['eg_aspectgene']=='CORRECT' || $donnees_inter['eg_aspectgene']=='') {
        $selected_eg_aspectgene_1 = "";
        $selected_eg_aspectgene_2 = 'selected="selected"';
        $selected_eg_aspectgene_3 = "";
      }
      if ($donnees_inter['eg_aspectgene']=='CHOC(S)') {
        $selected_eg_aspectgene_1 = "";
        $selected_eg_aspectgene_2 = "";
        $selected_eg_aspectgene_3 = 'selected="selected"';
      }
      if ($donnees_inter['eg_rouille']=='AUCUNE' || $donnees_inter['eg_rouille']=='') {
        $selected_eg_rouille_1 = 'selected="selected"';
        $selected_eg_rouille_2 = "";
        $selected_eg_rouille_3 = "";
      }
      if ($donnees_inter['eg_rouille']=='PARTIELLE') {
        $selected_eg_rouille_1 = "";
        $selected_eg_rouille_2 = 'selected="selected"';
        $selected_eg_rouille_3 = "";
      }
      if ($donnees_inter['eg_rouille']=='TOTALE') {
        $selected_eg_rouille_1 = "";
        $selected_eg_rouille_2 = "";
        $selected_eg_aspectgene_3 = 'selected="selected"';
      }
      if ($donnees_inter['eg_demontage']=='INCORRECT' || $donnees_inter['eg_demontage']=='') {
        $selected_eg_demontage_1 = 'selected="selected"';
        $selected_eg_demontage_2 = "";
        $selected_eg_demontage_3 = "";
      }
      if ($donnees_inter['eg_demontage']=='PARTIEL') {
        $selected_eg_demontage_1 = "";
        $selected_eg_demontage_2 = 'selected="selected"';
        $selected_eg_demontage_3 = "";
      }
      if ($donnees_inter['eg_demontage']=='TOTAL') {
        $selected_eg_demontage_1 = "";
        $selected_eg_demontage_2 = "";
        $selected_eg_demontage_3 = 'selected="selected"';
      }
      if ($donnees_inter['mec_etatgene']=='CORRECT' || $donnees_inter['mec_etatgene']=='') {
        $selected_mec_etatgene_1 = 'selected="selected"';
        $selected_mec_etatgene_2 = "";
      }
      if ($donnees_inter['mec_etatgene']=='A REVOIR') {
        $selected_mec_etatgene_2 = 'selected="selected"';
        $selected_mec_etatgene_1 = "";
      }
      if ($donnees_inter['mec_eta_entre_mat']=='CORRECT' || $donnees_inter['mec_eta_entre_mat']=='') {
        $selected_mec_eta_entre_mat_1 = 'selected="selected"';
        $selected_mec_eta_entre_mat_2 = "";
      }
      if ($donnees_inter['mec_eta_entre_mat']=='A REVOIR') {
        $selected_mec_eta_entre_mat_1 = "";
        $selected_mec_eta_entre_mat_2 = 'selected="selected"';
      }
      if ($donnees_inter['mec_eta_entre_mat_pre']=='INCORRECT' || $donnees_inter['mec_eta_entre_mat_pre']=='') {
        $selected_mec_eta_entre_mat_pre_1 = 'selected="selected"';
        $selected_mec_eta_entre_mat_pre_2 = "";
      }
      if ($donnees_inter['mec_eta_entre_mat_pre']=='CORRECT') {
        $selected_mec_eta_entre_mat_pre_1 = "";
        $selected_mec_eta_entre_mat_pre_2 = 'selected="selected"';
      }
      if ($donnees_inter['mec_eta_sorti_mat']=='CORRECT' || $donnees_inter['mec_eta_sorti_mat']=='') {
        $selected_mec_eta_sorti_mat_1 = 'selected="selected"';
        $selected_mec_eta_sorti_mat_2 = "";
      }
      if ($donnees_inter['mec_eta_sorti_mat']=='A REVOIR') {
        $selected_mec_eta_sorti_mat_1 = "";
        $selected_mec_eta_sorti_mat_2 = 'selected="selected"';
      }
      if ($donnees_inter['mec_eta_sorti_mat_pre']=='INCORRECT' || $donnees_inter['mec_eta_sorti_mat_pre']=='') {
        $selected_mec_eta_sorti_mat_pre_1 = 'selected="selected"';
        $selected_mec_eta_sorti_mat_pre_2 = "";
      }
      if ($donnees_inter['mec_eta_sorti_mat_pre']=='CORRECT') {
        $selected_mec_eta_sorti_mat_pre_1 = "";
        $selected_mec_eta_sorti_mat_pre_2 = 'selected="selected"';
      }
      if ($donnees_inter['mec_huile_fuit']=='INCORRECT' || $donnees_inter['mec_huile_fuit']=='') {
        $selected_mec_huile_fuit_1 = 'selected="selected"';
        $selected_mec_huile_fuit_2 = "";
      }
      if ($donnees_inter['mec_huile_fuit']=='CORRECT') {
        $selected_mec_huile_fuit_1 = "";
        $selected_mec_huile_fuit_2 = 'selected="selected"';
      }
      if ($donnees_inter['ele_etatgene']=='CORRECT' || $donnees_inter['ele_etatgene']=='') {
        $selected_ele_etatgene_1 = 'selected="selected"';
        $selected_ele_etatgene_2 = "";
      }
      if ($donnees_inter['ele_etatgene']=='A REVOIR') {
        $selected_ele_etatgene_2 = 'selected="selected"';
        $selected_ele_etatgene_1 = "";
      }
      if ($donnees_inter['ele_etatcable']=='CORRECT' || $donnees_inter['ele_etatcable']=='') {
        $selected_etatcable_1= 'selected="selected"';
        $selected_etatcable_2 = "";
      }
      if ($donnees_inter['ele_etatcable']=='A REVOIR') {
        $selected_etatcable_2 = 'selected="selected"';
        $selected_etatcable_1 = "";
      }
      if ($donnees_inter['ele_etatprotec']=='CORRECT' || $donnees_inter['ele_etatprotec']=='') {
        $selected_ele_etatprotec_1 = 'selected="selected"';
        $selected_ele_etatprotec_2 = "";
      }
      if ($donnees_inter['ele_etatprotec']=='A REVOIR') {
        $selected_ele_etatprotec_2 = 'selected="selected"';
        $selected_ele_etatprotec_1 = "";
      }
      if ($donnees_inter['th_etatgene']=='CORRECT' || $donnees_inter['th_etatgene']=='') {
        $selected_th_etatgene_1 = 'selected="selected"';
        $selected_th_etatgene_2 = "";
      }
      if ($donnees_inter['th_etatgene']=='A REVOIR') {
        $selected_th_etatgene_2 = 'selected="selected"';
        $selected_th_etatgene_1 = "";
      }
      if ($donnees_inter['th_test']=='VALIDÉ' || $donnees_inter['th_test']=='') {
        $selected_th_test_1 = 'selected="selected"';
        $selected_th_test_2 = "";
        $selected_th_test_3 = "";
      }
      if ($donnees_inter['th_test']=='A REVOIR') {
        $selected_th_test_1 = "";
        $selected_th_test_2 = 'selected="selected"';
        $selected_th_test_3 = "";
      }
      if ($donnees_inter['th_test']=='INCORRECT RÉALISÉ') {
        $selected_th_test_1 = "";
        $selected_th_test_2 = "";
        $selected_th_test_3 = 'selected="selected"';
      }
      if ($donnees_inter['th_stable']=='VALIDÉ' || $donnees_inter['th_stable']=='') {
        $selected_th_stable_1 = 'selected="selected"';
        $selected_th_stable_2 = "";
        $selected_th_stable_3 = "";
      }
      if ($donnees_inter['th_stable']=='A REVOIR') {
        $selected_th_stable_1 = "";
        $selected_th_stable_2 = 'selected="selected"';
        $selected_th_stable_3 = "";
      }
      if ($donnees_inter['th_stable']=='INCORRECT RÉALISÉ') {
        $selected_th_stable_1 = "";
        $selected_th_stable_2 = "";
        $selected_th_stable_3 = 'selected="selected"';
      }
      if ($donnees_inter['th_inerti']=='VALIDÉ' || $donnees_inter['th_inerti']=='') {
        $selected_th_inerti_1 = 'selected="selected"';
        $selected_th_inerti_2 = "";
        $selected_th_inerti_3 = "";
      }
      if ($donnees_inter['th_inerti']=='A REVOIR') {
        $selected_th_inerti_1 = "";
        $selected_th_inerti_2 = 'selected="selected"';
        $selected_th_inerti_3 = "";
      }
      if ($donnees_inter['th_inerti']=='INCORRECT RÉALISÉ') {
        $selected_th_inerti_1 = "";
        $selected_th_inerti_2 = "";
        $selected_th_inerti_3 = 'selected="selected"';
      }
      if ($donnees_inter['th_pilotage']=='VALIDÉ' || $donnees_inter['th_pilotage']=='') {
        $selected_th_pilotage_1 = 'selected="selected"';
        $selected_th_pilotage_2 = "";
        $selected_th_pilotage_3 = "";
      }
      if ($donnees_inter['th_pilotage']=='A REVOIR') {
        $selected_th_pilotage_1 = "";
        $selected_th_pilotage_2 = 'selected="selected"';
        $selected_th_pilotage_3 = "";
      }
      if ($donnees_inter['th_pilotage']=='INCORRECT RÉALISÉ') {
        $selected_th_pilotage_1 = "";
        $selected_th_pilotage_2 = "";
        $selected_th_pilotage_3 = 'selected="selected"';
      }

    ?>

    <div class="html2pdf__page-break">
      <div class="gros_bloc">
      <h2>État Initial</h2>

      <form method="POST" action="index.php?c=transverse&a=update_inter_etat_init" enctype="multipart/form-data">
        <table>
          <tr>
            <td colspan="1">
              <h3>Général</h3>
              <input type="hidden" name="id_inter" value="<?php echo $donnees_inter['id'] ?>">
                <label>Propreté générale :</label>
                <select name="eg_propre">
                  <option value="CORRECT" <?php echo $selected_eg_propre_1 ?>>CORRECT</option>
                  <option value="A REVOIR" <?php echo $selected_eg_propre_2 ?>>A REVOIR</option>
                </select>
                <br><br>
                <label>Ancienneté :</label>
                <select name="eg_ancien">
                  <option value="CORRECT" <?php echo $selected_eg_ancien_1 ?>>CORRECT</option>
                  <option value="A REVOIR" <?php echo $selected_eg_ancien_2 ?>>A REVOIR</option>
                </select>
                <br><br>
                <label>Etat général :</label>
                <select name="eg_etatgene">
                  <option value="CORRECT" <?php echo $selected_eg_etatgene_1 ?>>CORRECT</option>
                  <option value="A REVOIR" <?php echo $selected_eg_etatgene_2 ?>>A REVOIR</option>
                </select>
                <br><br>
                    <label>Vision extérieure :</label>
                <select name="eg_aspectgene">
                  <option value="CORRECT" <?php echo $selected_eg_aspectgene_2 ?>>CORRECT</option>
                  <option value="CHOC(S)" <?php echo $selected_eg_aspectgene_3 ?>>CHOC(S)</option>
                  <option value="FISSURE(S)" <?php echo $selected_eg_aspectgene_1 ?>>FISSURE(S)</option>
                </select>
                <br><br>
                <label>Présence de rouille :</label>
                <select name="eg_rouille">
                  <option value="AUCUNE" <?php echo $selected_eg_rouille_1 ?>>AUCUNE</option>
                  <option value="PARTIELLE" <?php echo $selected_eg_rouille_2 ?>>PARTIELLE</option>
                  <option value="TOTALE" <?php echo $selected_eg_rouille_3 ?>>TOTALE</option>
                </select>
                <br><br>
                <label>Nécessite un démontage :</label>
                <select name="eg_demontage">
                  <option value="INCORRECT" <?php echo $selected_eg_demontage_1 ?>>INCORRECT</option>
                  <option value="PARTIEL" <?php echo $selected_eg_demontage_2 ?>>PARTIEL</option>
                  <option value="TOTAL" <?php echo $selected_eg_demontage_3 ?>>TOTAL</option>
                </select>
                <br><br>
                <label>Fuite de matière :</label>
                <select name="eg_fuite_mat">
                  <option value="INCORRECT">INCORRECT</option>
                  <option value="PARTIELLE">PARTIELLE</option>
                  <option value="TOTALE">TOTALE</option>
                </select>
                <br><br>
                  <label>Avis technique :</label><br><br>
                <textarea type="text" name="eg_avis_etatgene" style="width: 100%;"><?php echo $donnees_inter['eg_avis_etatgene']; ?></textarea>        
              </td>
              <td colspan="1">
                <h3>Mécanique</h3>
                <br>
                <label>Etat mécanique :</label>
                <select name="mec_etatgene">
                  <option value="CORRECT" <?php echo $selected_mec_etatgene_1 ?>>CORRECT</option>
                  <option value="A REVOIR" <?php echo $selected_mec_etatgene_2 ?>>A REVOIR</option>
                </select>
                <br><br>
                <label>Etat entrée matière :</label>
                <select name="mec_eta_entre_mat">
                  <option value="CORRECT" <?php echo $selected_mec_eta_entre_mat_1 ?>>CORRECT</option>
                  <option value="A REVOIR" <?php echo $selected_mec_eta_entre_mat_2 ?>>A REVOIR</option>
                </select>
                <br><br>
                <label>Présence de matière à l'entrée :</label>
                <select name="mec_eta_entre_mat_pre">
                  <option value="INCORRECT" <?php echo $selected_mec_eta_entre_mat_pre_1 ?>>INCORRECT</option>
                  <option value="CORRECT" <?php echo $selected_mec_eta_entre_mat_pre_2 ?>>CORRECT</option>
                </select>
                <br><br>
                <label>Etat sortie matière :</label>
                <select name="mec_eta_sorti_mat">
                  <option value="CORRECT" <?php echo $selected_mec_eta_sorti_mat_1 ?>>CORRECT</option>
                  <option value="A REVOIR" <?php echo $selected_mec_eta_sorti_mat_2 ?>>A REVOIR</option>
                </select>
                <br><br>
                <label>Présence de matière à la sortie :</label>
                <select name="mec_eta_sorti_mat_pre">
                  <option value="INCORRECT" <?php echo $selected_mec_eta_sorti_mat_pre_1 ?>>INCORRECT</option>
                  <option value="CORRECT" <?php echo $selected_mec_eta_sorti_mat_pre_2 ?>>CORRECT</option>
                </select>
                <br><br>
                <label>Présence anormale de gras :</label>
                <select name="mec_huile_fuit">
                  <option value="INCORRECT" <?php echo $selected_mec_huile_fuit_1 ?>>INCORRECT</option>
                  <option value="CORRECT" <?php echo $selected_mec_huile_fuit_2 ?>>CORRECT</option>
                </select>
                <br><br>
                <label>Avis technique :</label><br><br>
                <textarea type="text" name="mec_avis_tech" style="width: 100%;"><?php echo $donnees_inter['mec_avis_tech']; ?></textarea>            
              </td>
          </tr>
          <tr>
            <td colspan="1">
              <h3>Electrique</h3>
              <label>Etat général :</label>
              <select name="ele_etatgene">
                <option value="CORRECT" <?php echo $selected_ele_etatgene_1 ?>>CORRECT</option>
                <option value="A REVOIR" <?php echo $selected_mec_etatgene_2 ?>>A REVOIR</option>
              </select>
              <br><br>
              <label>Etat câblage :</label>
              <select name="ele_etatcable">
                <option value="CORRECT" <?php echo $selected_etatcable_1 ?>>CORRECT</option>
                <option value="A REVOIR" <?php echo $selected_etatcable_2 ?>>A REVOIR</option>
              </select>
              <br><br>
              <label>Etat de la protection :</label>
              <select name="ele_etatprotec">
                <option value="CORRECT" <?php echo $selected_ele_etatprotec_1 ?>>CORRECT</option>
                <option value="A REVOIR" <?php echo $selected_ele_etatprotec_2 ?>>A REVOIR</option>
              </select>
              <br><br>
              <label>Nombre de résistance HS :</label>
              <input type="int" name="ele_resis_hs" value="<?php echo $donnees_inter['ele_resis_hs'] ?>" required>
              <br><br>
              <label>Nombre de sonde HS :</label>
              <input type="int" name="ele_sonde_hs" value="<?php echo $donnees_inter['ele_sonde_hs'] ?>" required>
              <br><br>
              <label>Avis technique :</label><br><br>
              <textarea type="text" name="ele_avis_tech" style="width: 100%;"><?php echo $donnees_inter['ele_avis_tech']; ?></textarea>          
            </td>
            <td colspan="1">
              <h3>Thermique</h3>
              <label>Etat général :</label>
              <select name="th_etatgene">
                <option value="CORRECT" <?php echo $selected_th_etatgene_1 ?>>CORRECT</option>
                <option value="A REVOIR" <?php echo $selected_th_etatgene_2 ?>>A REVOIR</option>
              </select>
              <br><br>
              <label>Essai en chauffe :</label>
              <select name="th_test">
                <option value="VALIDÉ" <?php echo $selected_th_test_1 ?>>VALIDÉ</option>
                <option value="A REVOIR" <?php echo $selected_th_test_2 ?>>A REVOIR</option>
                <option value="NON RÉALISÉ" <?php echo $selected_th_test_3 ?>>NON RÉALISÉ</option>
              </select>
              <br><br>
              <label>Stabilité en température :</label>
              <select name="th_stable">
                <option value="VALIDÉ" <?php echo $selected_th_stable_1 ?>>VALIDÉ</option>
                <option value="A REVOIR" <?php echo $selected_th_stable_2 ?>>A REVOIR</option>
                <option value="NON RÉALISÉ" <?php echo $selected_th_stable_3 ?>>NON RÉALISÉ</option>
              </select>
              <br><br>
              <label>Montée en température :</label>
              <select name="th_pilotage">
                <option value="VALIDÉ" <?php echo $selected_th_pilotage_1 ?>>VALIDÉ</option>
                <option value="A REVOIR" <?php echo $selected_th_pilotage_2 ?>>A REVOIR</option>
                <option value="NON RÉALISÉ" <?php echo $selected_th_pilotage_3 ?>>NON RÉALISÉ</option>
              </select>
              <br><br>
              <label>Essai en température :</label>
              <select name="th_inerti">
                <option value="VALIDÉ" <?php echo $selected_th_inerti_1 ?>>VALIDÉ</option>
                <option value="A REVOIR" <?php echo $selected_th_inerti_2 ?>>A REVOIR</option>
                <option value="NON RÉALISÉ" <?php echo $selected_th_inerti_3 ?>>NON RÉALISÉ</option>
              </select>
              <br><br>
              <label>Avis technique :</label><br><br>
              <textarea type="text" name="th_avis_therm" style="width: 100%;"><?php echo $donnees_inter['th_avis_therm']; ?></textarea>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>

<?php              
$requete_nbr_prise = $bdd->query ("SELECT COUNT(id) as nb_id_inter FROM prises_init WHERE id_eta_init='$id_inter'");
$nbligne_prise = $requete_nbr_prise->fetch();;
$nbligne_prise = $nbligne_prise['nb_id_inter'];
$requete_systeme = $bdd->query('SELECT * FROM systemes WHERE id='.$id_inter) ;

$donnees_syst =$requete_systeme->fetch();
$nbr_prise = $donnees_syst['nbr_prise'];
$nbr_obtu = $donnees_syst['nbr_obtu'];

for ($i=1; $i <= $nbr_prise ; $i++) {  ?>
  <h4 style="text-align: center">
  <?php
  echo "Prise n°".$i; ?></h4>

  <div class="html2pdf__page-break">
    <div class="gros_bloc">
      <h2>État Initial</h2>
      <form method="POST" action="index.php?c=transverse&a=update_inter_etat_init" enctype="multipart/form-data">
        <table>
          <tr>
            <td colspan="2">
                <h3>Prises</h3>
                        <?php

                        if ($nbligne_prise!=0) {
                          $requete_prise = $bdd->query('SELECT * FROM prises_init WHERE id_eta_init='.$id_inter.' AND num_prise='.$i ) ;
                          $donnees_prise=$requete_prise->fetch();


                          if ($donnees_prise['type1']=='non_cable') {
                            $selected_type_11 = 'selected="selected"';
                            $selected_type_12 = '';
                            $selected_type_13 = '';
                          }
                          if ($donnees_prise['type1']=='resistance') {
                            $selected_type_12 = 'selected="selected"';
                            $selected_type_11 = '';
                            $selected_type_13 = '';
                          }
                          if ($donnees_prise['type1']=='sonde') {
                            $selected_type_13 = 'selected="selected"';
                            $selected_type_12 = '';
                            $selected_type_11 = '';
                          }
                          if ($donnees_prise['type2']=='non_cable') {
                            $selected_type_21 = 'selected="selected"';
                            $selected_type_22 = '';
                            $selected_type_23 = '';
                          }
                          if ($donnees_prise['type2']=='resistance') {
                            $selected_type_22 = 'selected="selected"';
                            $selected_type_21 = '';
                            $selected_type_23 = '';
                          }
                          if ($donnees_prise['type2']=='sonde') {
                            $selected_type_23 = 'selected="selected"';
                            $selected_type_22 = '';
                            $selected_type_21 = '';
                          }
                          if ($donnees_prise['type3']=='non_cable') {
                            $selected_type_31 = 'selected="selected"';
                            $selected_type_32 = '';
                            $selected_type_33 = '';
                          }
                          if ($donnees_prise['type3']=='resistance') {
                            $selected_type_32 = 'selected="selected"';
                            $selected_type_31 = '';
                            $selected_type_33 = '';
                          }
                          if ($donnees_prise['type3']=='sonde') {
                            $selected_type_33 = 'selected="selected"';
                            $selected_type_32 = '';
                            $selected_type_31 = '';
                          }
                          if ($donnees_prise['type4']=='non_cable') {
                            $selected_type_41 = 'selected="selected"';
                            $selected_type_42 = '';
                            $selected_type_43 = '';
                          }
                          if ($donnees_prise['type4']=='resistance') {
                            $selected_type_42 = 'selected="selected"';
                            $selected_type_41 = '';
                            $selected_type_43 = '';
                          }
                          if ($donnees_prise['type4']=='sonde') {
                            $selected_type_43 = 'selected="selected"';
                            $selected_type_42 = '';
                            $selected_type_41 = '';
                          }
                          if ($donnees_prise['type5']=='non_cable') {
                            $selected_type_51 = 'selected="selected"';
                            $selected_type_52 = '';
                            $selected_type_53 = '';
                          }
                          if ($donnees_prise['type5']=='resistance') {
                            $selected_type_52 = 'selected="selected"';
                            $selected_type_51 = '';
                            $selected_type_53 = '';
                          }
                          if ($donnees_prise['type5']=='sonde') {
                            $selected_type_53 = 'selected="selected"';
                            $selected_type_52 = '';
                            $selected_type_51 = '';
                          }
                          if ($donnees_prise['type6']=='non_cable') {
                            $selected_type_61 = 'selected="selected"';
                            $selected_type_62 = '';
                            $selected_type_63 = '';
                          }
                          if ($donnees_prise['type6']=='resistance') {
                            $selected_type_62 = 'selected="selected"';
                            $selected_type_61 = '';
                            $selected_type_63 = '';
                          }
                          if ($donnees_prise['type6']=='sonde') {
                            $selected_type_63 = 'selected="selected"';
                            $selected_type_62 = '';
                            $selected_type_61 = '';
                          }
                          if ($donnees_prise['type7']=='non_cable') {
                            $selected_type_71 = 'selected="selected"';
                            $selected_type_72 = '';
                            $selected_type_73 = '';
                          }
                          if ($donnees_prise['type7']=='resistance') {
                            $selected_type_72 = 'selected="selected"';
                            $selected_type_71 = '';
                            $selected_type_73 = '';
                          }
                          if ($donnees_prise['type7']=='sonde') {
                            $selected_type_73 = 'selected="selected"';
                            $selected_type_72 = '';
                            $selected_type_71 = '';
                          }
                          if ($donnees_prise['type8']=='non_cable') {
                            $selected_type_81 = 'selected="selected"';
                            $selected_type_82 = '';
                            $selected_type_83 = '';
                          }
                          if ($donnees_prise['type8']=='resistance') {
                            $selected_type_82 = 'selected="selected"';
                            $selected_type_81 = '';
                            $selected_type_83 = '';
                          }
                          if ($donnees_prise['type8']=='sonde') {
                            $selected_type_83 = 'selected="selected"';
                            $selected_type_82 = '';
                            $selected_type_81 = '';
                          }
                          if ($donnees_prise['etat1']=='0') {
                            $checked_etat_01=  'checked="checked"';
                            $checked_etat_11=  '';
                          }
                          if ($donnees_prise['etat1']=='1') {
                            $checked_etat_11=  'checked="checked"';
                            $checked_etat_01=  '';
                          }
                          if ($donnees_prise['etat2']=='0') {
                            $checked_etat_02=  'checked="checked"';
                            $checked_etat_12=  '';
                          }
                          if ($donnees_prise['etat2']=='1') {
                            $checked_etat_12=  'checked="checked"';
                            $checked_etat_02=  '';
                          }
                          if ($donnees_prise['etat3']=='0') {
                            $checked_etat_03=  'checked="checked"';
                            $checked_etat_13=  '';
                          }
                          if ($donnees_prise['etat3']=='1') {
                            $checked_etat_13=  'checked="checked"';
                            $checked_etat_03=  '';
                          }
                          if ($donnees_prise['etat4']=='0') {
                            $checked_etat_04=  'checked="checked"';
                            $checked_etat_14=  '';
                          }
                          if ($donnees_prise['etat4']=='1') {
                            $checked_etat_14=  'checked="checked"';
                            $checked_etat_04=  '';
                          }
                          if ($donnees_prise['etat5']=='0') {
                            $checked_etat_05=  'checked="checked"';
                            $checked_etat_15=  '';
                          }
                          if ($donnees_prise['etat5']=='1') {
                            $checked_etat_15=  'checked="checked"';
                            $checked_etat_05=  '';
                          }
                          if ($donnees_prise['etat6']=='0') {
                            $checked_etat_06=  'checked="checked"';
                            $checked_etat_16=  '';
                          }
                          if ($donnees_prise['etat6']=='1') {
                            $checked_etat_16=  'checked="checked"';
                            $checked_etat_06=  '';
                          }
                          if ($donnees_prise['etat7']=='0') {
                            $checked_etat_07=  'checked="checked"';
                            $checked_etat_17=  '';
                          }
                          if ($donnees_prise['etat7']=='1') {
                            $checked_etat_17=  'checked="checked"';
                            $checked_etat_07=  '';
                          }
                          if ($donnees_prise['etat8']=='0') {
                            $checked_etat_08=  'checked="checked"';
                            $checked_etat_18=  '';
                          }
                          if ($donnees_prise['etat8']=='1') {
                            $checked_etat_18=  'checked="checked"';
                            $checked_etat_08=  '';
                          }
                          if ($donnees_prise['iso1']=='0') {
                            $checked_iso_01=  'checked="checked"';
                            $checked_iso_11=  '';
                          }
                          if ($donnees_prise['iso1']=='1') {
                            $checked_iso_11=  'checked="checked"';
                            $checked_iso_01=  '';
                          }
                          if ($donnees_prise['iso2']=='0') {
                            $checked_iso_02=  'checked="checked"';
                            $checked_iso_12=  '';
                          }
                          if ($donnees_prise['iso2']=='1') {
                            $checked_iso_12=  'checked="checked"';
                            $checked_iso_02=  '';
                          }
                          if ($donnees_prise['iso3']=='0') {
                            $checked_iso_03=  'checked="checked"';
                            $checked_iso_13=  '';
                          }
                          if ($donnees_prise['iso3']=='1') {
                            $checked_iso_13=  'checked="checked"';
                            $checked_iso_03=  '';
                          }
                          if ($donnees_prise['iso4']=='0') {
                            $checked_iso_04=  'checked="checked"';
                            $checked_iso_14=  '';
                          }
                          if ($donnees_prise['iso4']=='1') {
                            $checked_iso_14=  'checked="checked"';
                            $checked_iso_04=  '';
                          }
                          if ($donnees_prise['iso5']=='0') {
                            $checked_iso_05=  'checked="checked"';
                            $checked_iso_15=  '';
                          }
                          if ($donnees_prise['iso5']=='1') {
                            $checked_iso_15=  'checked="checked"';
                            $checked_iso_05=  '';
                          }
                          if ($donnees_prise['iso6']=='0') {
                            $checked_iso_06=  'checked="checked"';
                            $checked_iso_16=  '';
                          }
                          if ($donnees_prise['iso6']=='1') {
                            $checked_iso_16=  'checked="checked"';
                            $checked_iso_06=  '';
                          }
                          if ($donnees_prise['iso7']=='0') {
                            $checked_iso_07=  'checked="checked"';
                            $checked_iso_17=  '';
                          }
                          if ($donnees_prise['iso7']=='1') {
                            $checked_iso_17=  'checked="checked"';
                            $checked_iso_07=  '';
                          }
                          if ($donnees_prise['iso8']=='0') {
                            $checked_iso_08=  'checked="checked"';
                            $checked_iso_18=  '';
                          }
                          if ($donnees_prise['iso8']=='1') {
                            $checked_iso_18=  'checked="checked"';
                            $checked_iso_08=  '';
                          }
                        }

                       ?>

                        <table style="margin:1%">
                        <thead>
                          <th style="width: 5%; text-align:center;">PIN</th>
                          <th style="width: 15%; text-align:center;">TYPE</th>
                          <th style="width: 40%; text-align:center;">FONCTIONNEMENT CORRECT</th>
                          <th style="width: 40%; text-align:center;">ISOLATION CORRECTE</th>
                        </thead>

                        <tbody>
                          <tr>
                            <td>1-9</td>
                            <td style="width: 30px">
                              <select name=<?php echo "type_1".$i; ?>>
                                <option value="non_cable" <?php echo $selected_type_11 ?>>NON CABLÉ</option>
                                <option value="resistance" <?php echo $selected_type_12 ?>>RÉSISTANCE</option>
                                <option value="sonde" <?php echo $selected_type_13 ?>>SONDE</option>
                              </select>
                            </td>
                           <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name="<?php echo "etat_1".$i; ?>" <?php echo $checked_etat_01?>>
                                <input type="checkbox" value="1" name="<?php echo "etat_1".$i; ?>" <?php echo $checked_etat_11?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name="<?php echo "iso_1".$i; ?>" <?php echo $checked_iso_01 ?> >
                                <input type="checkbox" value="1" name="<?php echo "iso_1".$i; ?>" <?php echo $checked_iso_11?>><span></span>
                              </label>
                            </td>     
                          </tr>
                          <tr>
                            <td>2-10</td>
                            <td style="width: 30px">
                              <select name=<?php echo "type_2".$i; ?>>
                                <option value="non_cable" <?php echo $selected_type_21 ?>>NON CABLÉ</option>
                                <option value="resistance" <?php echo $selected_type_22 ?>>RÉSISTANCE</option>
                                <option value="sonde" <?php echo $selected_type_23 ?>>SONDE</option>
                              </select>
                            </td>
                           <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "etat_2".$i; ?> <?php echo $checked_etat_02?>>
                                <input type="checkbox" value="1" name=<?php echo "etat_2".$i; ?> <?php echo $checked_etat_12?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "iso_2".$i; ?> <?php echo $checked_iso_02?>>
                                <input type="checkbox" value="1" name=<?php echo "iso_2".$i; ?> <?php echo $checked_iso_12?>><span></span>
                              </label>
                            </td>         
                          </tr>
                          <tr>
                            <td>3-11</td>
                            <td style="width: 30px">
                              <select name=<?php echo "type_3".$i; ?>>
                                <option value="non_cable" <?php echo $selected_type_31 ?>>NON CABLÉ</option>
                                <option value="resistance" <?php echo $selected_type_32 ?>>RÉSISTANCE</option>
                                <option value="sonde" <?php echo $selected_type_33 ?>>SONDE</option>
                              </select>
                            </td>
                           <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "etat_3".$i; ?> <?php echo $checked_etat_03?>>
                                <input type="checkbox" value="1" name=<?php echo "etat_3".$i; ?> <?php echo $checked_etat_13?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "iso_3".$i; ?> <?php echo $checked_iso_03?>>
                                <input type="checkbox" value="1" name=<?php echo "iso_3".$i; ?> <?php echo $checked_iso_13?>><span></span>
                              </label>
                            </td>             
                          </tr>
                          <tr>
                            <td>4-12</td>
                            <td style="width: 30px">
                              <select name=<?php echo "type_4".$i; ?>>
                                <option value="non_cable" <?php echo $selected_type_41 ?>>NON CABLÉ</option>
                                <option value="resistance" <?php echo $selected_type_42 ?>>RÉSISTANCE</option>
                                <option value="sonde" <?php echo $selected_type_43 ?>>SONDE</option>
                              </select>
                            </td>
                           <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "etat_4".$i; ?> <?php echo $checked_etat_04?>>
                                <input type="checkbox" value="1" name=<?php echo "etat_4".$i; ?> <?php echo $checked_etat_14?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "iso_4".$i; ?> <?php echo $checked_iso_04?>>
                                <input type="checkbox" value="1" name=<?php echo "iso_4".$i; ?> <?php echo $checked_iso_14?>><span></span>
                              </label>
                            </td>             
                          </tr>
                          <tr>
                            <td>5-13</td>
                            <td style="width: 30px">
                              <select name=<?php echo "type_5".$i; ?>>
                                <option value="non_cable" <?php echo $selected_type_51 ?>>NON CABLÉ</option>
                                <option value="resistance" <?php echo $selected_type_52 ?>>RÉSISTANCE</option>
                                <option value="sonde" <?php echo $selected_type_53 ?>>SONDE</option>
                              </select>
                            </td>
                           <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "etat_5".$i; ?> <?php echo $checked_etat_05 ?>>
                                <input type="checkbox" value="1" name=<?php echo "etat_5".$i; ?> <?php echo $checked_etat_15 ?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "iso_5".$i; ?> <?php echo $checked_iso_05 ?>>
                                <input type="checkbox" value="1" name=<?php echo "iso_5".$i; ?> <?php echo $checked_iso_15 ?>><span></span>
                              </label>
                            </td>          
                          </tr>
                          <tr>
                            <td>6-14</td>
                            <td style="width: 30px">
                              <select name=<?php echo "type_6".$i; ?>>
                                <option value="non_cable" <?php echo $selected_type_61 ?>>NON CABLÉ</option>
                                <option value="resistance" <?php echo $selected_type_62 ?>>RÉSISTANCE</option>
                                <option value="sonde" <?php echo $selected_type_63 ?>>SONDE</option>
                            </select>
                            </td>
                           <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "etat_6".$i; ?> <?php echo $checked_etat_06 ?>>
                                <input type="checkbox" value="1" name=<?php echo "etat_6".$i; ?> <?php echo $checked_etat_16 ?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "iso_6".$i; ?> <?php echo $checked_iso_06 ?>>
                                <input type="checkbox" value="1" name=<?php echo "iso_6".$i; ?> <?php echo $checked_iso_16 ?>><span></span>
                              </label>
                            </td>        
                          </tr>
                          <tr>
                            <td>7-15</td>
                            <td style="width: 30px">
                              <select name=<?php echo "type_7".$i; ?>>
                                <option value="non_cable" <?php echo $selected_type_71 ?>>NON CABLÉ</option>
                                <option value="resistance" <?php echo $selected_type_72 ?>>RÉSISTANCE</option>
                                <option value="sonde" <?php echo $selected_type_73 ?>>SONDE</option>
                              </select>
                            </td>
                           <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "etat_7".$i; ?> <?php echo $checked_etat_07?>>
                                <input type="checkbox" value="1" name=<?php echo "etat_7".$i; ?> <?php echo $checked_etat_17?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "iso_7".$i; ?> <?php echo $checked_iso_07?>>
                                <input type="checkbox" value="1" name=<?php echo "iso_7".$i; ?> <?php echo $checked_iso_17?>><span></span>
                              </label>
                            </td>            
                          </tr>
                          <tr>
                            <td>8-16</td>
                            <td style="width: 30px">
                              <select name=<?php echo "type_8".$i; ?>>
                                <option value="non_cable" <?php echo $selected_type_81 ?>>NON CABLÉ</option>
                                <option value="resistance" <?php echo $selected_type_82 ?>>RÉSISTANCE</option>
                                <option value="sonde" <?php echo $selected_type_83 ?>>SONDE</option>
                              </select>
                            </td>
                           <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "etat_8".$i; ?> <?php echo $checked_etat_08?>>
                                <input type="checkbox" value="1" name=<?php echo "etat_8".$i; ?> <?php echo $checked_etat_18?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "iso_8".$i; ?> <?php echo $checked_iso_08?>>
                                <input type="checkbox" value="1" name=<?php echo "iso_8".$i; ?> <?php echo $checked_iso_18?>><span></span>
                              </label>
                            </td>               
                          </tr>
                        </tbody>

                        </table>
                        <br>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <?php 
  } 
?>
  <div class="html2pdf__page-break">
    <div class="gros_bloc">
      <h2>État Initial</h2>
      <form method="POST" action="index.php?c=transverse&a=update_inter_etat_init" enctype="multipart/form-data">
        <table>
          <tr>
          <td colspan="2">
                <h3>Obturateurs</h3>
                <?php

              $requete_nbr_obtu = $bdd->query ("SELECT COUNT(id) as nb_id_inter FROM obturateurs_init WHERE id_eta_init='$id_inter'");
              $nbligne_obtu = $requete_nbr_obtu->fetch();;
              $nbligne_obtu = $nbligne_obtu['nb_id_inter'];

              for ($i=1; $i <= $nbr_obtu ; $i++) {  ?>
                <h4 style="text-align: center">
                <?php
                echo "Obturateur n°".$i;
               ?>
              </h4>

              <?php
                $selected_etat_obtu_1 = '';
                $selected_etat_obtu_2 = '';
                $selected_etat_obtu_3 = '';
                $selected_etat_obtu_4 = '';

                $selected_etat_guide_1 = '';
                $selected_etat_guide_2 = '';
                $selected_etat_guide_3 = '';
                $selected_etat_guide_4 = '';

                $selected_attel_etat_3 = '';
                $selected_attel_etat_2 = '';
                $selected_attel_etat_1 = '';
                $selected_attel_etat_4 = '';

                $checked_jeu_obtu_0=  '';
                $checked_jeu_obtu_1=  '';

                $checked_jeu_guide_0=  '';
                $checked_jeu_guide_1=  '';

                if ($nbligne_obtu!=0) {
                  $requete_obtu = $bdd->query('SELECT * FROM obturateurs_init WHERE id_eta_init='.$id_inter.' AND num_obtu='.$i ) ;
                  $donnees_obtu=$requete_obtu->fetch();

                  if ($donnees_obtu['etat_obtu']=='use') {
                    $selected_etat_obtu_1 = 'selected="selected"';
                    $selected_etat_obtu_2 = '';
                    $selected_etat_obtu_3 = '';
                    $selected_etat_obtu_4 = '';
                  }
                  if ($donnees_obtu['etat_obtu']=='casse') {
                    $selected_etat_obtu_2 = 'selected="selected"';
                    $selected_etat_obtu_1 = '';
                    $selected_etat_obtu_3 = '';
                    $selected_etat_obtu_4 = '';
                  }
                  if ($donnees_obtu['etat_obtu']=='abime') {
                    $selected_etat_obtu_3 = 'selected="selected"';
                    $selected_etat_obtu_2 = '';
                    $selected_etat_obtu_1 = '';
                    $selected_etat_obtu_4 = '';
                  }
                  if ($donnees_obtu['etat_obtu']=='correct') {
                    $selected_etat_obtu_1 = '';
                    $selected_etat_obtu_2 = '';
                    $selected_etat_obtu_3 = '';
                    $selected_etat_obtu_4 = 'selected="selected"';
                  }


                  if ($donnees_obtu['etat_guide']=='use') {
                    $selected_etat_guide_1 = 'selected="selected"';
                    $selected_etat_guide_2 = '';
                    $selected_etat_guide_3 = '';
                    $selected_etat_guide_4 = '';
                  }
                  if ($donnees_obtu['etat_guide']=='casse') {
                    $selected_etat_guide_2 = 'selected="selected"';
                    $selected_etat_guide_1 = '';
                    $selected_etat_guide_3 = '';
                    $selected_etat_guide_4 = '';
                  }
                  if ($donnees_obtu['etat_guide']=='abime') {
                    $selected_etat_guide_3 = 'selected="selected"';
                    $selected_etat_guide_2 = '';
                    $selected_etat_guide_1 = '';
                    $selected_etat_guide_4 = '';
                  }
                  if ($donnees_obtu['etat_guide']=='correct') {
                    $selected_etat_guide_1 = '';
                    $selected_etat_guide_2 = '';
                    $selected_etat_guide_3 = '';
                    $selected_etat_guide_4 = 'selected="selected"';
                  }
                  if ($donnees_obtu['attel_etat']=='use') {
                    $selected_attel_etat_1 = 'selected="selected"';
                    $selected_attel_etat_2 = '';
                    $selected_attel_etat_3 = '';
                    $selected_attel_etat_4 = '';
                  }
                  if ($donnees_obtu['attel_etat']=='casse') {
                    $selected_attel_etat_2 = 'selected="selected"';
                    $selected_attel_etat_1 = '';
                    $selected_attel_etat_3 = '';
                    $selected_attel_etat_4 = '';
                  }
                  if ($donnees_obtu['attel_etat']=='abime') {
                    $selected_attel_etat_3 = 'selected="selected"';
                    $selected_attel_etat_2 = '';
                    $selected_attel_etat_1 = '';
                    $selected_attel_etat_4 = '';
                  }
                  if ($donnees_obtu['attel_etat']=='correct') {
                    $selected_attel_etat_1 = '';
                    $selected_attel_etat_2 = '';
                    $selected_attel_etat_3 = '';
                    $selected_attel_etat_4 = 'selected="selected"';
                  }

                  if ($donnees_obtu['jeu_obtu']=='0') {
                    $checked_jeu_obtu_0=  'checked="checked"';
                    $checked_jeu_obtu_1=  '';
                  }
                  if ($donnees_obtu['jeu_obtu']=='1') {
                    $checked_jeu_obtu_1=  'checked="checked"';
                    $checked_jeu_obtu_0=  '';
                  }
                  if ($donnees_obtu['jeu_guide']=='0') {
                    $checked_jeu_guide_0=  'checked="checked"';
                    $checked_jeu_guide_1=  '';
                  }
                  if ($donnees_obtu['jeu_guide']=='1') {
                    $checked_jeu_guide_1=  'checked="checked"';
                    $checked_jeu_guide_0=  '';
                  }
                }

              ?>
                <table>
                    <thead>
                      <th style="width:25%">Jeu sur l'obturateur</th>
                      <th style="width:25%">Jeu sur le guide</th>
                      <th style="width:20%">Etat général</th>
                      <th style="width:20%">Etat guide</th>
                      <th style="width:20%">Etat atelage</th>
                    </thead>
                  <tr>
                     <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "jeu_obtu_".$i; ?> <?php echo $checked_jeu_obtu_0 ?>>
                            <input type="checkbox" value="1" name=<?php echo "jeu_obtu_".$i; ?> <?php echo $checked_jeu_obtu_1 ?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "jeu_guide_".$i; ?> <?php echo $checked_jeu_guide_0 ?>>
                            <input type="checkbox" value="1" name=<?php echo "jeu_guide_".$i; ?> <?php echo $checked_jeu_guide_1 ?>><span></span>
                          </label>
                        </td>     
                    <td class="center">
                      <select name=<?php echo "eg_".$i; ?>>
                        <option value="use" <?php echo $selected_etat_obtu_1 ?>>USE</option>
                        <option value="casse" <?php echo $selected_etat_obtu_2 ?>>CASSE</option>
                        <option value="abime" <?php echo $selected_etat_obtu_3 ?>>ABIME</option>
                        <option value="correct" <?php echo $selected_etat_obtu_4 ?>>CORRECT</option>
                      </select>
                    </td>   
                    <td class="center">
                      <select name=<?php echo "e_guide_".$i; ?>>
                        <option value="use" <?php echo $selected_etat_guide_1 ?>>USE</option>
                        <option value="casse" <?php echo $selected_etat_guide_2 ?>>CASSE</option>
                        <option value="abime" <?php echo $selected_etat_guide_3 ?>>ABIME</option>
                        <option value="correct" <?php echo $selected_etat_guide_4 ?>>CORRECT</option>
                      </select>
                    </td>   
                    <td class="center">
                      <select name=<?php echo "e_attel_".$i; ?>>
                        <option value="use" <?php echo $selected_attel_etat_1 ?>>USE</option>
                        <option value="casse" <?php echo $selected_attel_etat_2 ?>>CASSE</option>
                        <option value="abime" <?php echo $selected_attel_etat_3 ?>>ABIME</option>
                        <option value="correct" <?php echo $selected_attel_etat_4 ?>>CORRECT</option>
                      </select>
                    </td>   
                  </tr>
              </table>
              <br>
              <?php 
                } 
              ?>
            </td>
          </tr>
          <tr>
            <td colspan="2">          
              <label>Complément de description :</label><br><br>
              <textarea type="text" name="eg_aspectdesc" style="width: 100%;"><?php echo $donnees_inter['eg_aspectdesc']; ?></textarea>
              <br><br>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>

    <?php
      $requete_inter = $bdd->query('SELECT * FROM travaux WHERE id='.$id_inter) ;

      $donnees_inter=$requete_inter->fetch();
      if ($donnees_inter['nettoyage']=='0') {
        $check_nettoyage = '';}
      if ($donnees_inter['nettoyage']=='1') {
        $check_nettoyage = 'checked';}
      if ($donnees_inter['passage_four']=='0') {
        $check_passage_four = '';}
      if ($donnees_inter['passage_four']=='1') {
        $check_passage_four = 'checked';}
      if ($donnees_inter['chang_resistance']=='0') {
        $check_chang_resistance = '';}
      if ($donnees_inter['chang_resistance']=='1') {
        $check_chang_resistance = 'checked';}
      if ($donnees_inter['chang_sonde']=='0') {
        $check_chang_sonde = '';}
      if ($donnees_inter['chang_sonde']=='1') {
        $check_chang_sonde = 'checked';}
      if ($donnees_inter['modif_cablage_elec']=='0') {
        $check_modif_cablage_elec = '';}
      if ($donnees_inter['modif_cablage_elec']=='1') {
        $check_modif_cablage_elec = 'checked';}
      if ($donnees_inter['modif_cir_eau']=='0') {
        $check_modif_cir_eau = '';}
      if ($donnees_inter['modif_cir_eau']=='1') {
        $check_modif_cir_eau = 'checked';}
      if ($donnees_inter['modif_cir_huile']=='0') {
        $check_modif_cir_huile = '';}
      if ($donnees_inter['modif_cir_huile']=='1') {
        $check_modif_cir_huile = 'checked';}
      if ($donnees_inter['modif_cir_elec']=='0') {
        $check_modif_cir_ele = '';}
      if ($donnees_inter['modif_cir_elec']=='1') {
        $check_modif_cir_ele = 'checked';}
      if ($donnees_inter['modif_cir_air']=='0') {
        $check_modif_cir_air = '';}
      if ($donnees_inter['modif_cir_air']=='1') {
        $check_modif_cir_air = 'checked';}
      if ($donnees_inter['modif_meca']=='0') {
        $check_modif_meca = '';}
      if ($donnees_inter['modif_meca']=='1') {
        $check_modif_meca = 'checked';}
      if ($donnees_inter['modif_meca_tete']=='0') {
        $check_modif_meca_tete = '';}
      if ($donnees_inter['modif_meca_tete']=='1') {
        $check_modif_meca_tete = 'checked';}
      if ($donnees_inter['modif_meca_rectif']=='0') {
        $check_modif_meca_rectif = '';}
      if ($donnees_inter['modif_meca_rectif']=='1') {
        $check_modif_meca_rectif = 'checked';}
      if ($donnees_inter['modif_meca_corp']=='0') {
        $check_modif_meca_corp = '';}
      if ($donnees_inter['modif_meca_corp']=='1') {
        $check_modif_meca_corp = 'checked';}
    ?>

    <div class="html2pdf__page-break">
      <div class="gros_bloc">
        <h2>Travaux</h2>
        <form method="POST" action="index.php?c=transverse&a=update_inter_travaux">
          <table>
            <tr>
              <td colspan="3">
                <input type="hidden" name="id_inter" value="<?php echo $donnees_inter['id'] ?>">
                <label>Avancement :</label> 
                <select name="id_av_trav">
                  <?php
                    // Affichage des clients
                    $requete = $bdd->query('SELECT travaux.*, av_technique.* FROM travaux, av_technique WHERE travaux.id='.$id .' AND travaux.id_av_trav=av_technique.id');
                    while ($donnees=$requete->fetch()) { ?>
                      <option value="<?php echo $donnees['id'] ?>"><?php echo $donnees['libelle_av_tech'] ?></option>;
                    <?php
                    }
                    $requete = $bdd->query('SELECT * FROM av_technique');
                    while ($donnees=$requete->fetch()) { ?>
                      <option value="<?php echo $donnees['id'] ?>"><?php echo $donnees['libelle_av_tech'] ?></option>;
                    <?php
                    }
                  ?>
                </select>     
              </td>
            </tr>
            <tr>
              <td colspan="1">
                <label>Nettoyage :
                <input type="hidden" name="nettoyage" value="0">
                <input type="checkbox" name="nettoyage" value="1" <?php echo $check_nettoyage ?>></label>
                <br><br>
                <label>Passage au four :
                <input type="hidden" name="passage_four" value="0">
                <input type="checkbox" name="passage_four" value="1" <?php echo $check_passage_four ?>></label>
              </td>
              <td colspan="1">
                <label style="display: block;">Intervention sur circuit électrique :
                <span><input type="hidden" name="modif_cir_elec" value="0">
                <input type="checkbox" name="modif_cir_elec" value="1" <?php echo $check_modif_cir_ele ?>></span></label><br><hr><br>
                <label style="display: block;">Changement de résistance(s) :
                <span><input type="hidden" name="chang_resistance" value="0">
                <input type="checkbox" name="chang_resistance" value="1" <?php echo $check_chang_resistance ?>></span></label><br><br>
                <label style="display: block;">Nbr changement de résistance(s) :
                <input type="int" name="nbr_chang_resistance" value="<?php echo $donnees_inter['nbr_chang_resistance']?>"></label><br><br><hr><br>
                <label>Changement de sonde(s) :
                <input type="hidden" name="chang_sonde" value="0">
                <input type="checkbox" name="chang_sonde" value="1" <?php echo $check_chang_sonde ?>></label><br><br>
                <label>Nbr changement de sonde(s) :
                <input type="int" name="nbr_chang_sonde" value="<?php echo $donnees_inter['nbr_chang_sonde']?>"></label><br><br><br><hr><br>
                <label>Modification câblage électrique :
                <input type="hidden" name="modif_cablage_elec" value="0">
                <input type="checkbox" name="modif_cablage_elec" value="1" <?php echo $check_modif_cablage_elec ?>></label><br><br>
              </td>
              <td colspan="1">
                <label>Intervention sur circuit d'eau :
                <input type="hidden" name="modif_cir_eau" value="0">
                <input type="checkbox" name="modif_cir eau" value="1" <?php echo $check_modif_cir_eau ?>></label><br><br>
                <label>Intervention sur circuit d'huile :
                <input type="hidden" name="modif_cir_huile" value="0">
                <input type="checkbox" name="modif_cir_huile" value="1" <?php echo $check_modif_cir_huile ?>></label><br><br>
                <label>Intervention sur circuit d'air :
                <input type="hidden" name="modif_cir_air" value="0">
                <input type="checkbox" name="modif_cir_air" value="1" <?php echo $check_modif_cir_air ?>></label>  
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <label style="display: block;">Intervention mécanique :
                <span><input type="hidden" name="modif_meca" value="0">
                <input type="checkbox" name="modif_meca" value="1" <?php echo $check_modif_meca ?>></span></label><br><hr><br>
                <label>Intervention sur les têtes d'injection:
                <input type="hidden" name="modif_meca_tete" value="0">
                <input type="checkbox" name="modif_meca_tete" value="1" <?php echo $check_modif_meca_tete ?>></label><br><br>
                <label>Nbr de têtes modifiées :
                <input type="int" name="nbr_modif_meca_tete" value="<?php echo $donnees_inter['nbr_modif_meca_tete']?>"></label><br><br><br><hr><br>
                <label>Rectification(s) :
                <input type="hidden" name="modif_meca_rectif" value="0">
                <input type="checkbox" name="modif_meca_rectif" value="1" <?php echo $check_modif_meca_rectif ?>></label><br><br>
                <label>Nombre de rectification(s) :
                <input type="int" name="nbr_modif_meca_rectif" value="<?php echo $donnees_inter['nbr_modif_meca_rectif']?>"></label><br><br><br><hr><br>
                <label>Modification mécanique du corps :
                <input type="hidden" name="modif_meca_corp" value="0">
                <input type="checkbox" name="modif_meca_corp" value="1" <?php echo $check_modif_meca_corp ?>></label><br><br>
                <label>Description modification :</label><br><br>
                <textarea name="desc_modif_meca_corp" style="width: 100%;"><?php echo $donnees_inter['desc_modif_meca_corp'] ?></textarea>
                <br><br>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>

    <?php
      $requete_inter = $bdd->query('SELECT * FROM tests WHERE id='.$id_inter) ;

      $donnees_inter=$requete_inter->fetch();

      if ($donnees_inter['tt_validation']=='NON VALIDÉ' || $donnees_inter['tt_validation']=='') {
        $selected_tt_validation_1 = 'selected="selected"';
        $selected_tt_validation_2 = "";
      }
      if ($donnees_inter['tt_validation']=='VALIDÉ') {
        $selected_tt_validation_2 = 'selected="selected"';
        $selected_tt_validation_1 = "";
      }
      if ($donnees_inter['tt_eg_propre']=='NON CORRECT' || $donnees_inter['tt_eg_propre']=='') {
        $selected_tt_eg_propre_1 = 'selected="selected"';
        $selected_tt_eg_propre_2 = "";
      }
      if ($donnees_inter['tt_eg_propre']=='CORRECT') {
        $selected_tt_eg_propre_2 = 'selected="selected"';
        $selected_tt_eg_propre_1 = "";
      }
      if ($donnees_inter['tt_eg_etatgene']=='NON CORRECT' || $donnees_inter['tt_eg_etatgene']=='') {
        $selected_tt_eg_etatgene_1 = 'selected="selected"';
        $selected_tt_eg_etatgene_2 = "";
        $selected_tt_eg_etatgene_3 ="";
      }
      if ($donnees_inter['tt_eg_etatgene']=='CORRECT') {
        $selected_tt_eg_etatgene_2 = 'selected="selected"';
        $selected_tt_eg_etatgene_1 = "";
        $selected_tt_eg_etatgene_3 ="";
      }
      if ($donnees_inter['tt_eg_etatgene']=='NEUF') {
        $selected_tt_eg_etatgene_3 = 'selected="selected"';
        $selected_tt_eg_etatgene_1 = "";
        $selected_tt_eg_etatgene_2 ="";
      }
      if ($donnees_inter['tt_mec_etatgene']=='NON CORRECT' || $donnees_inter['tt_eg_etatgene']=='') {
        $selected_tt_mec_etatgene_1 = 'selected="selected"';
        $selected_tt_mec_etatgene_2 = "";
        $selected_tt_mec_etatgene_3 ="";
      }
      if ($donnees_inter['tt_mec_etatgene']=='CORRECT') {
        $selected_tt_mec_etatgene_2 = 'selected="selected"';
        $selected_tt_mec_etatgene_1 = "";
        $selected_tt_mec_etatgene_3 ="";
      }
      if ($donnees_inter['tt_mec_etatgene']=='NEUF') {
        $selected_tt_mec_etatgene_3 = 'selected="selected"';
        $selected_tt_mec_etatgene_1 = "";
        $selected_tt_mec_etatgene_2 ="";
      }
      if ($donnees_inter['tt_mec_eta_entre_mat']=='NON CORRECT' || $donnees_inter['tt_mec_eta_entre_mat']=='') {
        $selected_tt_mec_eta_entre_mat_1 = 'selected="selected"';
        $selected_tt_mec_eta_entre_mat_2 = "";
        $selected_tt_mec_eta_entre_mat_3 ="";
      }
      if ($donnees_inter['tt_mec_eta_entre_mat']=='CORRECT') {
        $selected_tt_mec_eta_entre_mat_2 = 'selected="selected"';
        $selected_tt_mec_eta_entre_mat_1 = "";
        $selected_tt_mec_eta_entre_mat_3 ="";
      }
      if ($donnees_inter['tt_mec_eta_entre_mat']=='NEUF') {
        $selected_tt_mec_eta_entre_mat_3 = 'selected="selected"';
        $selected_tt_mec_eta_entre_mat_1 = "";
        $selected_tt_mec_eta_entre_mat_2 ="";
      }
      if ($donnees_inter['tt_mec_eta_sorti_mat']=='NON CORRECT' || $donnees_inter['tt_mec_eta_sorti_mat']=='') {
        $selected_tt_mec_eta_sorti_mat_1 = 'selected="selected"';
        $selected_tt_mec_eta_sorti_mat_2 = "";
        $selected_tt_mec_eta_sorti_mat_3 ="";
      }
      if ($donnees_inter['tt_mec_eta_sorti_mat']=='CORRECT') {
        $selected_tt_mec_eta_sorti_mat_2 = 'selected="selected"';
        $selected_tt_mec_eta_sorti_mat_1 = "";
        $selected_tt_mec_eta_sorti_mat_3 ="";
      }
      if ($donnees_inter['tt_mec_eta_sorti_mat']=='NEUF') {
        $selected_tt_mec_eta_sorti_mat_3 = 'selected="selected"';
        $selected_tt_mec_eta_sorti_mat_1 = "";
        $selected_tt_mec_eta_sorti_mat_2 ="";
      }
      if ($donnees_inter['tt_mec_huile_fuit']=='NON CORRECT' || $donnees_inter['tt_mec_huile_fuit']=='') {
        $selected_tt_mec_huile_fuit_1 = 'selected="selected"';
        $selected_tt_mec_huile_fuit_2 = "";
        $selected_tt_mec_huile_fuit_3 ="";
      }
      if ($donnees_inter['tt_mec_huile_fuit']=='CORRECT') {
        $selected_tt_mec_huile_fuit_2 = 'selected="selected"';
        $selected_tt_mec_huile_fuit_1 = "";
        $selected_tt_mec_huile_fuit_3 ="";
      }
      if ($donnees_inter['tt_mec_huile_fuit']=='NEUF') {
        $selected_tt_mec_huile_fuit_3 = 'selected="selected"';
        $selected_tt_mec_huile_fuit_1 = "";
        $selected_tt_mec_huile_fuit_2 ="";
      }
      if ($donnees_inter['tt_mec_bleu']=='NON CORRECT' || $donnees_inter['tt_mec_bleu']=='') {
        $selected_tt_mec_bleu_1 = 'selected="selected"';
        $selected_tt_mec_bleu_2 = "";
        $selected_tt_mec_bleu_3 ="";
      }
      if ($donnees_inter['tt_mec_bleu']=='CORRECT') {
        $selected_tt_mec_bleu_2 = 'selected="selected"';
        $selected_tt_mec_bleu_1 = "";
        $selected_tt_mec_bleu_3 ="";
      }
      if ($donnees_inter['tt_mec_bleu']=='NEUF') {
        $selected_tt_mec_bleu_3 = 'selected="selected"';
        $selected_tt_mec_bleu_1 = "";
        $selected_tt_mec_bleu_2 ="";
      }
      if ($donnees_inter['tt_ele_etatgene']=='NON CORRECT' || $donnees_inter['tt_ele_etatgene']=='') {
        $selected_tt_ele_etatgene_1 = 'selected="selected"';
        $selected_tt_ele_etatgene_2 = "";
        $selected_tt_ele_etatgene_3 ="";
      }
      if ($donnees_inter['tt_ele_etatgene']=='CORRECT') {
        $selected_tt_ele_etatgene_2 = 'selected="selected"';
        $selected_tt_ele_etatgene_1 = "";
        $selected_tt_ele_etatgene_3 ="";
      }
      if ($donnees_inter['tt_ele_etatgene']=='NEUF') {
        $selected_tt_ele_etatgene_3 = 'selected="selected"';
        $selected_tt_ele_etatgene_1 = "";
        $selected_tt_ele_etatgene_2 ="";
      }
      if ($donnees_inter['tt_ele_etatcable']=='NON CORRECT' || $donnees_inter['tt_ele_etatcable']=='') {
        $selected_tt_ele_etatcable_1 = 'selected="selected"';
        $selected_tt_ele_etatcable_2 = "";
        $selected_tt_ele_etatcable_3 ="";
      }
      if ($donnees_inter['tt_ele_etatcable']=='CORRECT') {
        $selected_tt_ele_etatcable_2 = 'selected="selected"';
        $selected_tt_ele_etatcable_1 = "";
        $selected_tt_ele_etatcable_3 ="";
      }
      if ($donnees_inter['tt_ele_etatcable']=='NEUF') {
        $selected_tt_ele_etatcable_3 = 'selected="selected"';
        $selected_tt_ele_etatcable_1 = "";
        $selected_tt_ele_etatcable_2 ="";
      }
      if ($donnees_inter['tt_ele_resit']=='NON CORRECT' || $donnees_inter['tt_ele_resit']=='') {
        $selected_tt_ele_resit_1 = 'selected="selected"';
        $selected_tt_ele_resit_2 = "";
        $selected_tt_ele_resit_3 ="";
      }
      if ($donnees_inter['tt_ele_resit']=='CORRECT') {
        $selected_tt_ele_resit_2 = 'selected="selected"';
        $selected_tt_ele_resit_1 = "";
        $selected_tt_ele_resit_3 ="";
      }
      if ($donnees_inter['tt_ele_resit']=='NEUF') {
        $selected_tt_ele_resit_3 = 'selected="selected"';
        $selected_tt_ele_resit_1 = "";
        $selected_tt_ele_resit_2 ="";
      }
      if ($donnees_inter['tt_rec_obtu']=='NON CORRECT' || $donnees_inter['tt_rec_obtu']=='') {
        $selected_tt_rec_obtu_1 = 'selected="selected"';
        $selected_tt_rec_obtu_2 = "";
        $selected_tt_rec_obtu_3 ="";
      }
      if ($donnees_inter['tt_rec_obtu']=='CORRECT') {
        $selected_tt_rec_obtu_2 = 'selected="selected"';
        $selected_tt_rec_obtu_1 = "";
        $selected_tt_rec_obtu_3 ="";
      }
      if ($donnees_inter['tt_rec_obtu']=='NEUF') {
        $selected_tt_rec_obtu_3 = 'selected="selected"';
        $selected_tt_rec_obtu_1 = "";
        $selected_tt_rec_obtu_2 ="";
      }
      if ($donnees_inter['tt_ele_sond']=='NON CORRECT' || $donnees_inter['tt_ele_sond']=='') {
        $selected_tt_ele_sonde_1 = 'selected="selected"';
        $selected_tt_ele_sonde_2 = "";
        $selected_tt_ele_sonde_3 ="";
      }
      if ($donnees_inter['tt_ele_sond']=='CORRECT') {
        $selected_tt_ele_sonde_2 = 'selected="selected"';
        $selected_tt_ele_sonde_1 = "";
        $selected_tt_ele_sonde_3 ="";
      }
      if ($donnees_inter['tt_ele_sond']=='NEUF') {
        $selected_tt_ele_sonde_3 = 'selected="selected"';
        $selected_tt_ele_sonde_1 = "";
        $selected_tt_ele_sonde_2 ="";
      }
      if ($donnees_inter['tt_th_etatgene']=='NON CORRECT' || $donnees_inter['tt_th_etatgene']=='') {
        $selected_tt_th_etatgene_1 = 'selected="selected"';
        $selected_tt_th_etatgene_2 = "";
        $selected_tt_th_etatgene_3 ="";
      }
      if ($donnees_inter['tt_th_etatgene']=='CORRECT') {
        $selected_tt_th_etatgene_2 = 'selected="selected"';
        $selected_tt_th_etatgene_1 = "";
        $selected_tt_th_etatgene_3 ="";
      }
      if ($donnees_inter['tt_th_etatgene']=='NEUF') {
        $selected_tt_th_etatgene_3 = 'selected="selected"';
        $selected_tt_th_etatgene_1 = "";
        $selected_tt_th_etatgene_2 ="";
      }
      if ($donnees_inter['tt_th_stable']=='STABLE' || $donnees_inter['tt_th_stable']=='') {
        $selected_tt_th_stable_1 = 'selected="selected"';
        $selected_tt_th_stable_2 = "";
      }
      if ($donnees_inter['tt_th_stable']=='NON STABLE') {
        $selected_tt_th_stable_2 = 'selected="selected"';
        $selected_tt_th_stable_1 = "";
      }
      if ($donnees_inter['tt_th_inerti']=='NON CORRECT' || $donnees_inter['tt_th_inerti']=='') {
        $selected_tt_th_inerti_1 = 'selected="selected"';
        $selected_tt_th_inerti_2 = "";
      }
      if ($donnees_inter['tt_th_inerti']=='CORRECT ( < 15min)') {
        $selected_tt_th_inerti_2 = 'selected="selected"';
        $selected_tt_th_inerti_1 = "";
      }
      if ($donnees_inter['tt_th_pilotage']=='NON CORRECT' || $donnees_inter['tt_th_pilotage']=='') {
        $selected_tt_th_pilotage_1 = 'selected="selected"';
        $selected_tt_th_pilotage_2 = "";
      }
      if ($donnees_inter['tt_th_pilotage']=='CORRECT ( +/- 10°C)') {
        $selected_tt_th_pilotage_2 = 'selected="selected"';
        $selected_tt_th_pilotage_1 = "";
      }
    ?>

    <div class="html2pdf__page-break">
      <div class="gros_bloc">
        <h2>Contrôles</h2>

        <form method="POST" action="index.php?c=transverse&a=update_inter_controles">
          <table>
            <tr>
              <td colspan="2">
                <input type="hidden" name="id_inter" required="required" value="<?php echo $donnees_inter['id'] ?>">

                <label>Contrôles réalisés avec succès :</label>
                <select name="tt_validation">
                    <option value="NON VALIDÉ" <?php echo $selected_tt_validation_1 ?>;>NON VALIDÉ</option>
                    <option value="VALIDÉ" <?php echo $selected_tt_validation_2 ?>>VALIDÉ</option>
                </select>
                <br><br>
                <label>Date de validation : </label>
                <input type="date" name="tt_date" required="required" value="<?php echo $donnees_inter['tt_date'] ?>">
              </td>
            </tr>
            <tr>
              <td colspan="1">
                <h3>Général</h3>
                <label>Propreté générale :</label>
                <select name="tt_eg_propre">
                    <option value="NON CORRECT" <?php echo $selected_tt_eg_propre_1;?>>NON CORRECT</option>
                    <option value="CORRECT" <?php echo $selected_tt_eg_propre_2;?>>CORRECT</option>
                </select>
                <br><br>
                <label>Etat générale :</label>
                <select name="tt_eg_etatgene">
                    <option value="NON CORRECT" <?php echo $selected_tt_eg_etatgene_1;?>>NON CORRECT</option>
                    <option value="CORRECT" <?php echo $selected_tt_eg_etatgene_2;?>>CORRECT</option>
                    <option value="NEUF" <?php echo $selected_tt_eg_etatgene_3;?>>NEUF</option>
                </select>
                <br><br>
                <label>Avis technique :</label><br><br>
                <textarea name="tt_eg_avis_tech"><?php echo $donnees_inter['tt_eg_avis_tech'] ?></textarea>
              </td><br>
              <td colspan="1">
              <h3>Mécanique</h3>
              <label>Etat mécanique:</label>
              <select name="tt_mec_etatgene">
                  <option value="NON CORRECT" <?php echo $selected_tt_mec_etatgene_1;?>>NON CORRECT</option>
                  <option value="CORRECT" <?php echo $selected_tt_mec_etatgene_1;?>>CORRECT</option>
                  <option value="NEUF" <?php echo $selected_tt_mec_etatgene_1;?>>NEUF</option>
              </select>
              <br><br>
              <label>Etat entrée matière :</label>
              <select name="tt_mec_eta_entre_mat">
                  <option value="NON CORRECT" <?php echo $selected_tt_mec_eta_entre_mat_1;?>>NON CORRECT</option>
                  <option value="CORRECT" <?php echo $selected_tt_mec_eta_entre_mat_2;?>>CORRECT</option>
                  <option value="NEUF" <?php echo $selected_tt_mec_eta_entre_mat_3;?>>NEUF</option>
              </select>
              <br><br>
              <label>Etat sortie matière :</label>
              <select name="tt_mec_eta_sorti_mat">
                  <option value="NON CORRECT" <?php echo $selected_tt_mec_eta_sorti_mat_1;?>>NON CORRECT</option>
                  <option value="CORRECT" <?php echo $selected_tt_mec_eta_sorti_mat_2;?>>CORRECT</option>
                  <option value="NEUF" <?php echo $selected_tt_mec_eta_sorti_mat_3;?>>NEUF</option>
              </select>
              <br><br>
              <label>Etat circuit hydraulique :</label>
              <select name="tt_mec_huile_fuit">
                  <option value="NON CORRECT" <?php echo $selected_tt_mec_huile_fuit_1;?>>NON CORRECT</option>
                  <option value="CORRECT" <?php echo $selected_tt_mec_huile_fuit_2;?>>CORRECT</option>
                  <option value="NEUF" <?php echo $selected_tt_mec_huile_fuit_3;?>>NEUF</option>
              </select>
              <br><br>
              <label>Contrôle des portages :</label>
              <select name="tt_mec_bleu">
                  <option value="NON CORRECT" <?php echo $selected_tt_mec_bleu_1;?>>NON CORRECT</option>
                  <option value="CORRECT" <?php echo $selected_tt_mec_bleu_2;?>>CORRECT</option>
                  <option value="NEUF" <?php echo $selected_tt_mec_bleu_3;?>>NEUF</option>
              </select>
              <br><br>
              <label>Avis technique :</label><br><br>
              <textarea name="tt_mec_avis_tech"><?php echo $donnees_inter['tt_mec_avis_tech'] ?></textarea>
              </td>
            </tr>
            <tr>
              <td colspan="1">
                <h3>Electrique</h3>
                <label>Etat électrique:</label>
                <select name="tt_ele_etatgene">
                    <option value="NON CORRECT" <?php echo $selected_tt_ele_etatgene_1;?>>NON CORRECT</option>
                    <option value="CORRECT" <?php echo $selected_tt_ele_etatgene_2;?>>CORRECT</option>
                    <option value="NEUF" <?php echo $selected_tt_ele_etatgene_3;?>>NEUF</option>
                </select>
                <br><br>
                <label>Etat câblage :</label>
                <select name="tt_ele_etatcable">
                    <option value="NON CORRECT" <?php echo $selected_tt_ele_etatcable_1;?>>NON CORRECT</option>
                    <option value="CORRECT" <?php echo $selected_tt_ele_etatcable_2;?>>CORRECT</option>
                    <option value="NEUF" <?php echo $selected_tt_ele_etatcable_3;?>>NEUF</option>
                </select>
                <br><br>
                <label>Toutes résistances correctes :</label>
                <select name="tt_ele_resit">
                    <option value="NON CORRECT" <?php echo $selected_tt_ele_resit_1;?>>NON CORRECT</option>
                    <option value="CORRECT" <?php echo $selected_tt_ele_resit_2;?>>CORRECT</option>
                    <option value="NEUF" <?php echo $selected_tt_ele_resit_3;?>>NEUF</option>
                </select>
                <br><br>
                <label>Obturateurs corrects :</label>
                <select name="tt_rec_obtu">
                    <option value="NON CORRECT" <?php echo $selected_tt_rec_obtu_1;?>>NON CORRECT</option>
                    <option value="CORRECT" <?php echo $selected_tt_rec_obtu_2;?>>CORRECT</option>
                    <option value="NEUF" <?php echo $selected_tt_rec_obtu_3;?>>NEUF</option>
                </select>
                <br><br>
                <label>Toutes sondes correctes :</label>
                <select name="tt_ele_sond">
                    <option value="NON CORRECT" <?php echo $selected_tt_ele_sonde_1;?>>NON CORRECT</option>
                    <option value="CORRECT" <?php echo $selected_tt_ele_sonde_2;?>>CORRECT</option>
                    <option value="NEUF" <?php echo $selected_tt_ele_sonde_3;?>>NEUF</option>
                </select>
                <br><br>
                <label>Avis technique :</label><br><br>
                <textarea name="tt_ele_avis_tech"><?php echo $donnees_inter['tt_ele_avis_tech'] ?></textarea>
              </td>
              <td colspan="1">
                <h3>Thermique</h3>
                <label>Etat thermique:</label>
                <select name="tt_th_etatgene">
                    <option value="NON CORRECT" <?php echo $selected_tt_th_etatgene_1;?>>NON CORRECT</option>
                    <option value="CORRECT" <?php echo $selected_tt_th_etatgene_2;?>>CORRECT</option>
                    <option value="NEUF" <?php echo $selected_tt_th_etatgene_3;?>>NEUF</option>
                </select>
                <br><br>
                <label>Stabilité en chauffe :</label>
                <select name="tt_th_stable">
                    <option value="STABLE" <?php echo $selected_tt_th_stable_1;?>>STABLE</option>
                    <option value="NON STABLE" <?php echo $selected_tt_th_stable_2;?>>NON STABLE</option>
                </select>
                <br><br>
                <label>Inertie de température :</label>
                <select name="tt_th_inerti">
                    <option value="NON CORRECT" <?php echo $selected_tt_th_inerti_1;?>>NON CORRECT</option>
                    <option value="CORRECT ( < 15min)" <?php echo $selected_tt_th_inerti_2;?>>CORRECT ( < 15 min)</option>
                </select>
                <br><br>
                <label>Température d'essai (°C) :</label>
                <input type="int" name="tt_th_temp_test" required="required" value="<?php echo $donnees_inter['tt_th_temp_test'] ?>">
                <br><br>
                <label>Temps de montée :</label>
                <input type="int" name="tt_th_dur_mont" required="required" value="<?php echo $donnees_inter['tt_th_dur_mont'] ?>">
                <br><br>
                <label>Etat pilotage :</label>
                <select name="tt_th_pilotage">
                    <option value="NON CORRECT" <?php echo $selected_tt_th_pilotage_1 ?>>NON CORRECT</option>
                    <option value="CORRECT ( +/- 10°C)" <?php echo $selected_tt_th_pilotage_2 ?>>CORRECT ( +/- 10°C)</option>
                </select>
                <br><br>
                <label>Avis technique :</label><br><br>
                <textarea name="tt_th_avis_therm"><?php echo $donnees_inter['tt_th_avis_therm'] ?></textarea>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <div class="html2pdf__page-break">
      <div class="gros_bloc">
        <h2>Contrôles</h2>

        <form method="POST" action="index.php?c=transverse&a=update_inter_controles">
          <table>
            <tr>
              <td colspan="2">
                <h3>Prises</h3>
                <?php              
                  $requete_nbr_prise = $bdd->query ("SELECT COUNT(id) as nb_id_inter FROM tt_prises WHERE id_eta_init='$id_inter'");
                  $nbligne_prise = $requete_nbr_prise->fetch();;
                  $nbligne_prise = $nbligne_prise['nb_id_inter'];
                  $requete_systeme = $bdd->query('SELECT * FROM systemes WHERE id='.$id_inter) ;

                  $donnees_syst =$requete_systeme->fetch();
                  $nbr_prise = $donnees_syst['nbr_prise'];
                  $nbr_obtu = $donnees_syst['nbr_obtu'];

                  for ($i=1; $i <= $nbr_prise ; $i++) {  ?>
                    <h4 style="text-align: center">
                    <?php
                    echo "Prise n°".$i; ?></h4>
                    <?php

                      $val1 = 0;
                      $val2 = 0;
                      $val3 = 0;
                      $val4 = 0;
                      $val5 = 0;
                      $val6 = 0;
                      $val7 = 0;
                      $val8 = 0;

                      $selected_type_11 = '';
                      $selected_type_12 = '';
                      $selected_type_13 = '';

                      $selected_type_21 = '';
                      $selected_type_22 = '';
                      $selected_type_23 = '';

                      $selected_type_31 = '';
                      $selected_type_32 = '';
                      $selected_type_33 = '';

                      $selected_type_41 = '';
                      $selected_type_42 = '';
                      $selected_type_43 = '';

                      $selected_type_51 = '';
                      $selected_type_52 = '';
                      $selected_type_53 = '';

                      $selected_type_61 = '';
                      $selected_type_62 = '';
                      $selected_type_63 = '';

                      $selected_type_71 = '';
                      $selected_type_72 = '';
                      $selected_type_73 = '';

                      $selected_type_81 = '';
                      $selected_type_82 = '';
                      $selected_type_83 = '';

                      $checked_etat_11=  '';
                      $checked_etat_01=  '';
                      $checked_etat_12=  '';
                      $checked_etat_02=  '';
                      $checked_etat_13=  '';
                      $checked_etat_03=  '';
                      $checked_etat_14=  '';
                      $checked_etat_04=  '';
                      $checked_etat_15=  '';
                      $checked_etat_05=  '';
                      $checked_etat_16=  '';
                      $checked_etat_06=  '';
                      $checked_etat_17=  '';
                      $checked_etat_07=  '';
                      $checked_etat_18=  '';
                      $checked_etat_08=  '';

                      $checked_iso_11=  '';
                      $checked_iso_01=  '';
                      $checked_iso_12=  '';
                      $checked_iso_02=  '';
                      $checked_iso_13=  '';
                      $checked_iso_03=  '';
                      $checked_iso_14=  '';
                      $checked_iso_04=  '';
                      $checked_iso_15=  '';
                      $checked_iso_05=  '';
                      $checked_iso_16=  '';
                      $checked_iso_06=  '';
                      $checked_iso_17=  '';
                      $checked_iso_07=  '';
                      $checked_iso_18=  '';
                      $checked_iso_08=  '';
                    if ($nbligne_prise!=0) {
                      $requete_prise = $bdd->query('SELECT * FROM tt_prises WHERE id_eta_init='.$id_inter.' AND num_prise='.$i ) ;
                      $donnees_prise=$requete_prise->fetch();

                      $val1 = $donnees_prise['val1'];
                      $val2 = $donnees_prise['val2'];
                      $val3 = $donnees_prise['val3'];
                      $val4 = $donnees_prise['val4'];
                      $val5 = $donnees_prise['val5'];
                      $val6 = $donnees_prise['val6'];
                      $val7 = $donnees_prise['val7'];
                      $val8 = $donnees_prise['val8'];
                      if ($donnees_prise['type1']=='non_cable') {
                        $selected_type_11 = 'selected="selected"';
                        $selected_type_12 = '';
                        $selected_type_13 = '';
                      }
                      if ($donnees_prise['type1']=='resistance') {
                        $selected_type_12 = 'selected="selected"';
                        $selected_type_11 = '';
                        $selected_type_13 = '';
                      }
                      if ($donnees_prise['type1']=='sonde') {
                        $selected_type_13 = 'selected="selected"';
                        $selected_type_12 = '';
                        $selected_type_11 = '';
                      }
                      if ($donnees_prise['type2']=='non_cable') {
                        $selected_type_21 = 'selected="selected"';
                        $selected_type_22 = '';
                        $selected_type_23 = '';
                      }
                      if ($donnees_prise['type2']=='resistance') {
                        $selected_type_22 = 'selected="selected"';
                        $selected_type_21 = '';
                        $selected_type_23 = '';
                      }
                      if ($donnees_prise['type2']=='sonde') {
                        $selected_type_23 = 'selected="selected"';
                        $selected_type_22 = '';
                        $selected_type_21 = '';
                      }
                      if ($donnees_prise['type3']=='non_cable') {
                        $selected_type_31 = 'selected="selected"';
                        $selected_type_32 = '';
                        $selected_type_33 = '';
                      }
                      if ($donnees_prise['type3']=='resistance') {
                        $selected_type_32 = 'selected="selected"';
                        $selected_type_31 = '';
                        $selected_type_33 = '';
                      }
                      if ($donnees_prise['type3']=='sonde') {
                        $selected_type_33 = 'selected="selected"';
                        $selected_type_32 = '';
                        $selected_type_31 = '';
                      }
                      if ($donnees_prise['type4']=='non_cable') {
                        $selected_type_41 = 'selected="selected"';
                        $selected_type_42 = '';
                        $selected_type_43 = '';
                      }
                      if ($donnees_prise['type4']=='resistance') {
                        $selected_type_42 = 'selected="selected"';
                        $selected_type_41 = '';
                        $selected_type_43 = '';
                      }
                      if ($donnees_prise['type4']=='sonde') {
                        $selected_type_43 = 'selected="selected"';
                        $selected_type_42 = '';
                        $selected_type_41 = '';
                      }
                      if ($donnees_prise['type5']=='non_cable') {
                        $selected_type_51 = 'selected="selected"';
                        $selected_type_52 = '';
                        $selected_type_53 = '';
                      }
                      if ($donnees_prise['type5']=='resistance') {
                        $selected_type_52 = 'selected="selected"';
                        $selected_type_51 = '';
                        $selected_type_53 = '';
                      }
                      if ($donnees_prise['type5']=='sonde') {
                        $selected_type_53 = 'selected="selected"';
                        $selected_type_52 = '';
                        $selected_type_51 = '';
                      }
                      if ($donnees_prise['type6']=='non_cable') {
                        $selected_type_61 = 'selected="selected"';
                        $selected_type_62 = '';
                        $selected_type_63 = '';
                      }
                      if ($donnees_prise['type6']=='resistance') {
                        $selected_type_62 = 'selected="selected"';
                        $selected_type_61 = '';
                        $selected_type_63 = '';
                      }
                      if ($donnees_prise['type6']=='sonde') {
                        $selected_type_63 = 'selected="selected"';
                        $selected_type_62 = '';
                        $selected_type_61 = '';
                      }
                      if ($donnees_prise['type7']=='non_cable') {
                        $selected_type_71 = 'selected="selected"';
                        $selected_type_72 = '';
                        $selected_type_73 = '';
                      }
                      if ($donnees_prise['type7']=='resistance') {
                        $selected_type_72 = 'selected="selected"';
                        $selected_type_71 = '';
                        $selected_type_73 = '';
                      }
                      if ($donnees_prise['type7']=='sonde') {
                        $selected_type_73 = 'selected="selected"';
                        $selected_type_72 = '';
                        $selected_type_71 = '';
                      }
                      if ($donnees_prise['type8']=='non_cable') {
                        $selected_type_81 = 'selected="selected"';
                        $selected_type_82 = '';
                        $selected_type_83 = '';
                      }
                      if ($donnees_prise['type8']=='resistance') {
                        $selected_type_82 = 'selected="selected"';
                        $selected_type_81 = '';
                        $selected_type_83 = '';
                      }
                      if ($donnees_prise['type8']=='sonde') {
                        $selected_type_83 = 'selected="selected"';
                        $selected_type_82 = '';
                        $selected_type_81 = '';
                      }
                      if ($donnees_prise['etat1']=='0') {
                        $checked_etat_01=  'checked="checked"';
                        $checked_etat_11=  '';
                      }
                      if ($donnees_prise['etat1']=='1') {
                        $checked_etat_11=  'checked="checked"';
                        $checked_etat_01=  '';
                      }
                      if ($donnees_prise['etat2']=='0') {
                        $checked_etat_02=  'checked="checked"';
                        $checked_etat_12=  '';
                      }
                      if ($donnees_prise['etat2']=='1') {
                        $checked_etat_12=  'checked="checked"';
                        $checked_etat_02=  '';
                      }
                      if ($donnees_prise['etat3']=='0') {
                        $checked_etat_03=  'checked="checked"';
                        $checked_etat_13=  '';
                      }
                      if ($donnees_prise['etat3']=='1') {
                        $checked_etat_13=  'checked="checked"';
                        $checked_etat_03=  '';
                      }
                      if ($donnees_prise['etat4']=='0') {
                        $checked_etat_04=  'checked="checked"';
                        $checked_etat_14=  '';
                      }
                      if ($donnees_prise['etat4']=='1') {
                        $checked_etat_14=  'checked="checked"';
                        $checked_etat_04=  '';
                      }
                      if ($donnees_prise['etat5']=='0') {
                        $checked_etat_05=  'checked="checked"';
                        $checked_etat_15=  '';
                      }
                      if ($donnees_prise['etat5']=='1') {
                        $checked_etat_15=  'checked="checked"';
                        $checked_etat_05=  '';
                      }
                      if ($donnees_prise['etat6']=='0') {
                        $checked_etat_06=  'checked="checked"';
                        $checked_etat_16=  '';
                      }
                      if ($donnees_prise['etat6']=='1') {
                        $checked_etat_16=  'checked="checked"';
                        $checked_etat_06=  '';
                      }
                      if ($donnees_prise['etat7']=='0') {
                        $checked_etat_07=  'checked="checked"';
                        $checked_etat_17=  '';
                      }
                      if ($donnees_prise['etat7']=='1') {
                        $checked_etat_17=  'checked="checked"';
                        $checked_etat_07=  '';
                      }
                      if ($donnees_prise['etat8']=='0') {
                        $checked_etat_08=  'checked="checked"';
                        $checked_etat_18=  '';
                      }
                      if ($donnees_prise['etat8']=='1') {
                        $checked_etat_18=  'checked="checked"';
                        $checked_etat_08=  '';
                      }
                      if ($donnees_prise['iso1']=='0') {
                        $checked_iso_01=  'checked="checked"';
                        $checked_iso_11=  '';
                      }
                      if ($donnees_prise['iso1']=='1') {
                        $checked_iso_11=  'checked="checked"';
                        $checked_iso_01=  '';
                      }
                      if ($donnees_prise['iso2']=='0') {
                        $checked_iso_02=  'checked="checked"';
                        $checked_iso_12=  '';
                      }
                      if ($donnees_prise['iso2']=='1') {
                        $checked_iso_12=  'checked="checked"';
                        $checked_iso_02=  '';
                      }
                      if ($donnees_prise['iso3']=='0') {
                        $checked_iso_03=  'checked="checked"';
                        $checked_iso_13=  '';
                      }
                      if ($donnees_prise['iso3']=='1') {
                        $checked_iso_13=  'checked="checked"';
                        $checked_iso_03=  '';
                      }
                      if ($donnees_prise['iso4']=='0') {
                        $checked_iso_04=  'checked="checked"';
                        $checked_iso_14=  '';
                      }
                      if ($donnees_prise['iso4']=='1') {
                        $checked_iso_14=  'checked="checked"';
                        $checked_iso_04=  '';
                      }
                      if ($donnees_prise['iso5']=='0') {
                        $checked_iso_05=  'checked="checked"';
                        $checked_iso_15=  '';
                      }
                      if ($donnees_prise['iso5']=='1') {
                        $checked_iso_15=  'checked="checked"';
                        $checked_iso_05=  '';
                      }
                      if ($donnees_prise['iso6']=='0') {
                        $checked_iso_06=  'checked="checked"';
                        $checked_iso_16=  '';
                      }
                      if ($donnees_prise['iso6']=='1') {
                        $checked_iso_16=  'checked="checked"';
                        $checked_iso_06=  '';
                      }
                      if ($donnees_prise['iso7']=='0') {
                        $checked_iso_07=  'checked="checked"';
                        $checked_iso_17=  '';
                      }
                      if ($donnees_prise['iso7']=='1') {
                        $checked_iso_17=  'checked="checked"';
                        $checked_iso_07=  '';
                      }
                      if ($donnees_prise['iso8']=='0') {
                        $checked_iso_08=  'checked="checked"';
                        $checked_iso_18=  '';
                      }
                      if ($donnees_prise['iso8']=='1') {
                        $checked_iso_18=  'checked="checked"';
                        $checked_iso_08=  '';
                      }
                    }

                   ?>

                    <table style="margin:1%">
                    <thead>
                      <th style="width: 5%; text-align:center;">PIN</th>
                      <th style="width: 15%; text-align:center;">TYPE</th>
                      <th style="width: 40%; text-align:center;">FONCTIONNEMENT CORRECT</th>
                      <th style="width: 40%; text-align:center;">ISOLATION CORRECTE</th>
                      <th style="width: 40%; text-align:center;"> VALEUR (Ω)</th>
                    </thead>

                    <tbody>
                      <tr>
                        <td>1-9</td>
                        <td>
                          <select name=<?php echo "type_1".$i; ?>>
                            <option value="non_cable" <?php echo $selected_type_11 ?>>NON CABLÉ</option>
                            <option value="resistance" <?php echo $selected_type_12 ?>>RÉSISTANCE</option>
                            <option value="sonde" <?php echo $selected_type_13 ?>>SONDE</option>
                          </select>
                        </td>
                       <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name="<?php echo "etat_1".$i; ?>" <?php echo $checked_etat_01?>>
                            <input type="checkbox" value="1" name="<?php echo "etat_1".$i; ?>" <?php echo $checked_etat_11?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name="<?php echo "iso_1".$i; ?>" <?php echo $checked_iso_01 ?> >
                            <input type="checkbox" value="1" name="<?php echo "iso_1".$i; ?>" <?php echo $checked_iso_11?>><span></span>
                          </label>
                        </td>  
                        <td class="center">
                          <input type="number" step="0.01" name="<?php echo "val_1".$i; ?>" value=<?php echo $val1 ?>>
                        </td>   
                      </tr>
                      <tr>
                        <td>2-10</td>
                        <td>
                          <select name=<?php echo "type_2".$i; ?>>
                            <option value="non_cable" <?php echo $selected_type_21 ?>>NON CABLÉ</option>
                            <option value="resistance" <?php echo $selected_type_22 ?>>RÉSISTANCE</option>
                            <option value="sonde" <?php echo $selected_type_23 ?>>SONDE</option>
                          </select>
                        </td>
                       <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "etat_2".$i; ?> <?php echo $checked_etat_02?>>
                            <input type="checkbox" value="1" name=<?php echo "etat_2".$i; ?> <?php echo $checked_etat_12?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "iso_2".$i; ?> <?php echo $checked_iso_02?>>
                            <input type="checkbox" value="1" name=<?php echo "iso_2".$i; ?> <?php echo $checked_iso_12?>><span></span>
                          </label>
                        </td> 
                        <td class="center">
                          <input type="number" step="0.01" name="<?php echo "val_2".$i; ?>" value=<?php echo $val2 ?>>
                        </td>        
                      </tr>
                      <tr>
                        <td>3-11</td>
                        <td>
                          <select name=<?php echo "type_3".$i; ?>>
                            <option value="non_cable" <?php echo $selected_type_31 ?>>NON CABLÉ</option>
                            <option value="resistance" <?php echo $selected_type_32 ?>>RÉSISTANCE</option>
                            <option value="sonde" <?php echo $selected_type_33 ?>>SONDE</option>
                          </select>
                        </td>
                       <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "etat_3".$i; ?> <?php echo $checked_etat_03?>>
                            <input type="checkbox" value="1" name=<?php echo "etat_3".$i; ?> <?php echo $checked_etat_13?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "iso_3".$i; ?> <?php echo $checked_iso_03?>>
                            <input type="checkbox" value="1" name=<?php echo "iso_3".$i; ?> <?php echo $checked_iso_13?>><span></span>
                          </label>
                        </td>   
                        <td class="center">
                          <input type="number" step="0.01" name="<?php echo "val_3".$i; ?>" value=<?php echo $val3 ?>>
                        </td>          
                      </tr>
                      <tr>
                        <td>4-12</td>
                        <td>
                          <select name=<?php echo "type_4".$i; ?>>
                            <option value="non_cable" <?php echo $selected_type_41 ?>>NON CABLÉ</option>
                            <option value="resistance" <?php echo $selected_type_42 ?>>RÉSISTANCE</option>
                            <option value="sonde" <?php echo $selected_type_43 ?>>SONDE</option>
                          </select>
                        </td>
                       <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "etat_4".$i; ?> <?php echo $checked_etat_04?>>
                            <input type="checkbox" value="1" name=<?php echo "etat_4".$i; ?> <?php echo $checked_etat_14?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "iso_4".$i; ?> <?php echo $checked_iso_04?>>
                            <input type="checkbox" value="1" name=<?php echo "iso_4".$i; ?> <?php echo $checked_iso_14?>><span></span>
                          </label>
                        </td>  
                        <td class="center">
                          <input type="number" step="0.01" name="<?php echo "val_4".$i; ?>" value=<?php echo $val4 ?>>
                        </td>           
                      </tr>
                      <tr>
                        <td>5-13</td>
                        <td>
                          <select name=<?php echo "type_5".$i; ?>>
                            <option value="non_cable" <?php echo $selected_type_51 ?>>NON CABLÉ</option>
                            <option value="resistance" <?php echo $selected_type_52 ?>>RÉSISTANCE</option>
                            <option value="sonde" <?php echo $selected_type_53 ?>>SONDE</option>
                          </select>
                        </td>
                       <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "etat_5".$i; ?> <?php echo $checked_etat_05 ?>>
                            <input type="checkbox" value="1" name=<?php echo "etat_5".$i; ?> <?php echo $checked_etat_15 ?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "iso_5".$i; ?> <?php echo $checked_iso_05 ?>>
                            <input type="checkbox" value="1" name=<?php echo "iso_5".$i; ?> <?php echo $checked_iso_15 ?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <input type="number" step="0.01" name="<?php echo "val_5".$i; ?>" value=<?php echo $val5 ?>>
                        </td>          
                      </tr>
                      <tr>
                        <td>6-14</td>
                        <td>
                          <select name=<?php echo "type_6".$i; ?>>
                            <option value="non_cable" <?php echo $selected_type_61 ?>>NON CABLÉ</option>
                            <option value="resistance" <?php echo $selected_type_62 ?>>RÉSISTANCE</option>
                            <option value="sonde" <?php echo $selected_type_63 ?>>SONDE</option>
                        </select>
                        </td>
                       <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "etat_6".$i; ?> <?php echo $checked_etat_06 ?>>
                            <input type="checkbox" value="1" name=<?php echo "etat_6".$i; ?> <?php echo $checked_etat_16 ?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "iso_6".$i; ?> <?php echo $checked_iso_06 ?>>
                            <input type="checkbox" value="1" name=<?php echo "iso_6".$i; ?> <?php echo $checked_iso_16 ?>><span></span>
                          </label>
                        </td>  
                        <td class="center">
                          <input type="number" step="0.01" name="<?php echo "val_6".$i; ?>" value=<?php echo $val6 ?>>
                        </td>      
                      </tr>
                      <tr>
                        <td>7-15</td>
                        <td>
                          <select name=<?php echo "type_7".$i; ?>>
                            <option value="non_cable" <?php echo $selected_type_71 ?>>NON CABLÉ</option>
                            <option value="resistance" <?php echo $selected_type_72 ?>>RÉSISTANCE</option>
                            <option value="sonde" <?php echo $selected_type_73 ?>>SONDE</option>
                          </select>
                        </td>
                       <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "etat_7".$i; ?> <?php echo $checked_etat_07?>>
                            <input type="checkbox" value="1" name=<?php echo "etat_7".$i; ?> <?php echo $checked_etat_17?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "iso_7".$i; ?> <?php echo $checked_iso_07?>>
                            <input type="checkbox" value="1" name=<?php echo "iso_7".$i; ?> <?php echo $checked_iso_17?>><span></span>
                          </label>
                        </td>   
                        <td class="center">
                          <input type="number" step="0.01" name="<?php echo "val_7".$i; ?>" value=<?php echo $val7 ?>>
                        </td>         
                      </tr>
                      <tr>
                        <td>8-16</td>
                        <td>
                          <select name=<?php echo "type_8".$i; ?>>
                            <option value="non_cable" <?php echo $selected_type_81 ?>>NON CABLÉ</option>
                            <option value="resistance" <?php echo $selected_type_82 ?>>RÉSISTANCE</option>
                            <option value="sonde" <?php echo $selected_type_83 ?>>SONDE</option>
                          </select>
                        </td>
                       <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "etat_8".$i; ?> <?php echo $checked_etat_08?>>
                            <input type="checkbox" value="1" name=<?php echo "etat_8".$i; ?> <?php echo $checked_etat_18?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <label class="switch">
                            <input type="hidden"  value="0" name=<?php echo "iso_8".$i; ?> <?php echo $checked_iso_08?>>
                            <input type="checkbox" value="1" name=<?php echo "iso_8".$i; ?> <?php echo $checked_iso_18?>><span></span>
                          </label>
                        </td>
                        <td class="center">
                          <input type="number" step="0.01" name="<?php echo "val_8".$i; ?>" value=<?php echo $val8 ?>>
                        </td>               
                      </tr>
                    </tbody>

                    </table>
                <br>
                <?php 
                  } 
                ?>        
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>

    <div class="html2pdf__page-break">
      <div class="gros_bloc">
        <h2>Contrôles</h2>

        <form method="POST" action="index.php?c=transverse&a=update_inter_controles">
          <table>
            <tr>
              <td colspan="2">

                <h3>Obturateurs</h3>
                    <?php
                  $requete_nbr_obtu = $bdd->query ("SELECT COUNT(id) as nb_id_inter FROM tt_obtu WHERE id_eta_init='$id_inter'");
                  $nbligne_obtu = $requete_nbr_obtu->fetch();;
                  $nbligne_obtu = $nbligne_obtu['nb_id_inter'];
                    
            for ($i=1; $i <= $nbr_obtu ; $i++) {  ?>
              <h4 style="text-align: center">
              <?php
              echo "Obturateur n°".$i;
             ?>
            </h4>

                  <?php
                    $selected_etat_obtu_1 = '';
                    $selected_etat_obtu_2 = '';
                    $selected_etat_obtu_3 = '';
                    $selected_etat_obtu_4 = '';

                    $selected_etat_guide_1 = '';
                    $selected_etat_guide_2 = '';
                    $selected_etat_guide_3 = '';
                    $selected_etat_guide_4 = '';

                    $selected_attel_etat_3 = '';
                    $selected_attel_etat_2 = '';
                    $selected_attel_etat_1 = '';
                    $selected_attel_etat_4 = '';

                    $checked_jeu_obtu_0=  '';
                    $checked_jeu_obtu_1=  '';

                    $checked_jeu_guide_0=  '';
                    $checked_jeu_guide_1=  '';

                    if ($nbligne_obtu!=0) {
                      $requete_obtu = $bdd->query('SELECT * FROM tt_obtu WHERE id_eta_init='.$id_inter.' AND num_obtu='.$i ) ;
                      $donnees_obtu=$requete_obtu->fetch();

                      if ($donnees_obtu['etat_obtu']=='use') {
                        $selected_etat_obtu_1 = 'selected="selected"';
                        $selected_etat_obtu_2 = '';
                        $selected_etat_obtu_3 = '';
                        $selected_etat_obtu_4 = '';
                      }
                      if ($donnees_obtu['etat_obtu']=='casse') {
                        $selected_etat_obtu_2 = 'selected="selected"';
                        $selected_etat_obtu_1 = '';
                        $selected_etat_obtu_3 = '';
                        $selected_etat_obtu_4 = '';
                      }
                      if ($donnees_obtu['etat_obtu']=='abime') {
                        $selected_etat_obtu_3 = 'selected="selected"';
                        $selected_etat_obtu_2 = '';
                        $selected_etat_obtu_1 = '';
                        $selected_etat_obtu_4 = '';
                      }
                      if ($donnees_obtu['etat_obtu']=='correct') {
                        $selected_etat_obtu_1 = '';
                        $selected_etat_obtu_2 = '';
                        $selected_etat_obtu_3 = '';
                        $selected_etat_obtu_4 = 'selected="selected"';
                      }


                      if ($donnees_obtu['etat_guide']=='use') {
                        $selected_etat_guide_1 = 'selected="selected"';
                        $selected_etat_guide_2 = '';
                        $selected_etat_guide_3 = '';
                        $selected_etat_guide_4 = '';
                      }
                      if ($donnees_obtu['etat_guide']=='casse') {
                        $selected_etat_guide_2 = 'selected="selected"';
                        $selected_etat_guide_1 = '';
                        $selected_etat_guide_3 = '';
                        $selected_etat_guide_4 = '';
                      }
                      if ($donnees_obtu['etat_guide']=='abime') {
                        $selected_etat_guide_3 = 'selected="selected"';
                        $selected_etat_guide_2 = '';
                        $selected_etat_guide_1 = '';
                        $selected_etat_guide_4 = '';
                      }
                      if ($donnees_obtu['etat_guide']=='correct') {
                        $selected_etat_guide_1 = '';
                        $selected_etat_guide_2 = '';
                        $selected_etat_guide_3 = '';
                        $selected_etat_guide_4 = 'selected="selected"';
                      }
                      if ($donnees_obtu['attel_etat']=='use') {
                        $selected_attel_etat_1 = 'selected="selected"';
                        $selected_attel_etat_2 = '';
                        $selected_attel_etat_3 = '';
                        $selected_attel_etat_4 = '';
                      }
                      if ($donnees_obtu['attel_etat']=='casse') {
                        $selected_attel_etat_2 = 'selected="selected"';
                        $selected_attel_etat_1 = '';
                        $selected_attel_etat_3 = '';
                        $selected_attel_etat_4 = '';
                      }
                      if ($donnees_obtu['attel_etat']=='abime') {
                        $selected_attel_etat_3 = 'selected="selected"';
                        $selected_attel_etat_2 = '';
                        $selected_attel_etat_1 = '';
                        $selected_attel_etat_4 = '';
                      }
                      if ($donnees_obtu['attel_etat']=='correct') {
                        $selected_attel_etat_1 = '';
                        $selected_attel_etat_2 = '';
                        $selected_attel_etat_3 = '';
                        $selected_attel_etat_4 = 'selected="selected"';
                      }

                      if ($donnees_obtu['jeu_obtu']=='0') {
                        $checked_jeu_obtu_0=  'checked="checked"';
                        $checked_jeu_obtu_1=  '';
                      }
                      if ($donnees_obtu['jeu_obtu']=='1') {
                        $checked_jeu_obtu_1=  'checked="checked"';
                        $checked_jeu_obtu_0=  '';
                      }
                      if ($donnees_obtu['jeu_guide']=='0') {
                        $checked_jeu_guide_0=  'checked="checked"';
                        $checked_jeu_guide_1=  '';
                      }
                      if ($donnees_obtu['jeu_guide']=='1') {
                        $checked_jeu_guide_1=  'checked="checked"';
                        $checked_jeu_guide_0=  '';
                      }
                    }

                  ?>
                    <table>
                        <thead>
                          <th style="width:25%">Jeu sur l'obturateur</th>
                          <th style="width:25%">Jeu sur le guide</th>
                          <th style="width:20%">Etat général</th>
                          <th style="width:20%">Etat guide</th>
                          <th style="width:20%">Etat atelage</th>
                        </thead>
                      <tr>
                         <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "jeu_obtu_".$i; ?> <?php echo $checked_jeu_obtu_0 ?>>
                                <input type="checkbox" value="1" name=<?php echo "jeu_obtu_".$i; ?> <?php echo $checked_jeu_obtu_1 ?>><span></span>
                              </label>
                            </td>
                            <td class="center">
                              <label class="switch">
                                <input type="hidden"  value="0" name=<?php echo "jeu_guide_".$i; ?> <?php echo $checked_jeu_guide_0 ?>>
                                <input type="checkbox" value="1" name=<?php echo "jeu_guide_".$i; ?> <?php echo $checked_jeu_guide_1 ?>><span></span>
                              </label>
                            </td>     
                        <td class="center">
                          <select name=<?php echo "eg_".$i; ?>>
                            <option value="use" <?php echo $selected_etat_obtu_1 ?>>USE</option>
                            <option value="casse" <?php echo $selected_etat_obtu_2 ?>>CASSE</option>
                            <option value="abime" <?php echo $selected_etat_obtu_3 ?>>ABIME</option>
                            <option value="correct" <?php echo $selected_etat_obtu_4 ?>>CORRECT</option>
                          </select>
                        </td>   
                        <td class="center">
                          <select name=<?php echo "e_guide_".$i; ?>>
                            <option value="use" <?php echo $selected_etat_guide_1 ?>>USE</option>
                            <option value="casse" <?php echo $selected_etat_guide_2 ?>>CASSE</option>
                            <option value="abime" <?php echo $selected_etat_guide_3 ?>>ABIME</option>
                            <option value="correct" <?php echo $selected_etat_guide_4 ?>>CORRECT</option>
                          </select>
                        </td>   
                        <td class="center">
                          <select name=<?php echo "e_attel_".$i; ?>>
                            <option value="use" <?php echo $selected_attel_etat_1 ?>>USE</option>
                            <option value="casse" <?php echo $selected_attel_etat_2 ?>>CASSE</option>
                            <option value="abime" <?php echo $selected_attel_etat_3 ?>>ABIME</option>
                            <option value="correct" <?php echo $selected_attel_etat_4 ?>>CORRECT</option>
                          </select>
                        </td>   
                      </tr>
                  </table>
                  
                  <?php 
                    } 
                  ?>          
                  <br><br>
              </td>
            </tr>
          </table>

        </form>
      </div>
    </div>

    <?php
      $id_inter=$_POST['id_inter'];
      $requete_inter = $bdd->query('SELECT f_inter.*, avancements.libelle_avance FROM f_inter, avancements WHERE f_inter.id_avancements=avancements.ID AND f_inter.id='.$id_inter) ;

      $donnees_inter=$requete_inter->fetch();

      if ($donnees_inter['visa_client']=='refus') {
        $selected_visa_0 ='selected="selected"';
        $selected_visa_1 ='';
      }

      if ($donnees_inter['visa_client']=='vise') {
        $selected_visa_1 ='selected="selected"';
        $selected_visa_0 ='';
      }
    ?>

    <div class="html2pdf__page-break">
      <div class="gros_bloc">
        <h2>Validation</h2>
        <form method="POST" action="index.php?c=transverse&a=update_inter_validation">
          
          <table>
            <tr>
              <td colspan="1">
                <input type="hidden" name="id_inter" value="<?php echo $donnees_inter['id'] ?>">
                <label>Avancement :</label>
                  <select name="id_avancements" required="required" style="width: 70%;">
                    <?php
                      // Affichage des clients
                      $requete = $bdd->query('SELECT f_inter.*, avancements.* FROM f_inter, avancements WHERE f_inter.id='.$id_inter .' AND f_inter.id_avancements=avancements.ID');
                      while ($donnees=$requete->fetch()) { ?>
                        <option value="<?php echo $donnees['ID'] ?>"><?php echo $donnees['libelle_avance'] ?></option>;
                      <?php
                      }
                      $requete = $bdd->query('SELECT * FROM avancements');
                      while ($donnees=$requete->fetch()) { ?>
                        <option value="<?php echo $donnees['ID'] ?>"><?php echo $donnees['libelle_avance'] ?></option>;
                      <?php
                      }
                    ?>
                  </select>
              </td>
              <td colspan="1">
                <label>Durée initialement prévue (h) :</label>
                <input type="int" name="duree_init" disabled="disabled" style="color: grey;" value="<?php echo $donnees_inter['duree_init']; ?>">
                <br><br>
                <label>Durée des travaux (h):</label>
                <input type="int" name="duree_trav" value="<?php echo $donnees_inter['duree_trav'] ?>" required>
                <br><br>
                <label>Durée des contrôles (h):</label>
                <input type="int" name="duree_cont" value="<?php echo $donnees_inter['duree_cont']; ?>" required>
              </td>
            </tr>
            <tr>
              <td colspan="2">        
                <label>Commentaire MECALYS :</label><br><br>
                <textarea name="comm_inter" style="width: 100%;"><?php echo $donnees_inter['comm_inter'] ?></textarea><br><br>
                <label>Commentaire Client :</label><br><br>
                <textarea name="comm_client" style="width: 100%;"><?php echo $donnees_inter['comm_client'] ?></textarea>
                <br><br>
                <label>Visa Client :</label>
                <select name="visa_client" style="width: 20%;">
                  <option value="refus" <?php echo $selected_visa_0 ?>>REFUS DE VISA</option>
                  <option value="vise" <?php echo $selected_visa_1 ?>>VISÉ</option>
                </select>

                <br><br><br>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </page>

</div>
</body>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js"></script>

  <script src="es6-promise.auto.min.js"></script>
  <script src="jspdf.min.js"></script>
  <script src="html2canvas.min.js"></script>
  <script src="html2pdf.min.js"></script>

<script>
  let element = document.getElementById('element');
  html2pdf(element);
</script>
</html>
