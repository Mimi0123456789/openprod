<?php

require_once(ROOT_PATH . "/vendor/autoload.php");

use Dompdf\Dompdf;
use Dompdf\Options;

class InterventionFullPdfGenerator
{
    public static function generate(int $id_inter): void
    {
        ini_set('display_errors', 0);
        error_reporting(E_ALL);

        if ($id_inter <= 0) {
            http_response_code(400);
            exit("Intervention invalide");
        }

        $jsonPath = ROOT_PATH . "/storage/nosql/interventions/intervention_" . $id_inter . ".json";

        if (!file_exists($jsonPath)) {
            http_response_code(404);
            exit("Fichier JSON introuvable : " . $jsonPath);
        }

        $fiche = json_decode(file_get_contents($jsonPath), true);

        if (!$fiche) {
            http_response_code(500);
            exit("JSON invalide");
        }

        $html = self::renderHtml($fiche);

        while (ob_get_level()) {
            ob_end_clean();
        }

        $options = new Options();
        $options->set("isRemoteEnabled", true);
        $options->set("defaultFont", "DejaVu Sans");

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, "UTF-8");
        $dompdf->setPaper("A4", "portrait");
        $dompdf->render();

        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=dossier_intervention_" . $id_inter . ".pdf");

        echo $dompdf->output();
        exit;
    }

    public static function output(int $id_inter): string
    {
        $jsonPath = ROOT_PATH . "/storage/nosql/interventions/intervention_" . $id_inter . ".json";

        if (!file_exists($jsonPath)) {
            throw new Exception("JSON introuvable");
        }

        $fiche = json_decode(file_get_contents($jsonPath), true);

        if (!$fiche) {
            throw new Exception("JSON invalide");
        }

        $html = self::renderHtml($fiche);

        $options = new Options();
        $options->set("isRemoteEnabled", true);
        $options->set("defaultFont", "DejaVu Sans");

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, "UTF-8");
        $dompdf->setPaper("A4", "portrait");
        $dompdf->render();

        return $dompdf->output();
    }
    private static function renderHtml(array $fiche): string
    {
        $h = fn($v) => htmlspecialchars((string)($v ?? ""), ENT_QUOTES, "UTF-8");

        $intervention = $fiche["intervention"] ?? [];
        $systeme      = $fiche["systeme"] ?? [];
        $etat         = $fiche["etat_initial"] ?? [];
        $travaux      = $fiche["travaux"] ?? [];
        $controles    = $fiche["controles"] ?? [];

        $bool = fn($v) => ((string)$v === "1") ? "Oui" : "Non";

        return '
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    body {
        font-family: DejaVu Sans, Arial, sans-serif;
        font-size: 11px;
        color: #111827;
    }

    h1 {
        font-size: 22px;
        margin: 0 0 8px;
        color: #111827;
    }

    h2 {
        font-size: 15px;
        margin: 18px 0 8px;
        padding: 7px 10px;
        background: #ff7900;
        color: #ffffff;
    }

    h3 {
        font-size: 13px;
        margin: 12px 0 6px;
        color: #ff7900;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
    }

    th, td {
        border: 1px solid #d1d5db;
        padding: 6px;
        vertical-align: top;
    }

    th {
        background: #f3f4f6;
        text-align: left;
    }

    .header {
        border: 2px solid #111827;
        padding: 12px;
        margin-bottom: 15px;
    }

    .muted {
        color: #6b7280;
    }

    .value {
        font-weight: bold;
        color: #1d4ed8;
    }

    .page-break {
        page-break-before: always;
    }

    .note {
        min-height: 45px;
    }
</style>
</head>
<body>

<div class="header">
    <h1>Dossier complet d’intervention n° ' . $h($fiche["id_inter"] ?? "") . '</h1>
    <div class="muted">Document généré depuis le fichier JSON NoSQL</div>
</div>

<h2>1. Informations générales</h2>

<table>
    <tr>
        <th>Client</th>
        <td>' . $h($intervention["client_nom"] ?? $intervention["id_clients"] ?? "") . '</td>
        <th>Avancement</th>
        <td>' . $h($intervention["avancement"] ?? $intervention["id_avancements"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Date création</th>
        <td>' . $h($intervention["date_crea"] ?? "") . '</td>
        <th>Délai max</th>
        <td>' . $h($intervention["date_max"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Date début</th>
        <td>' . $h($intervention["date_debut"] ?? "") . '</td>
        <th>Date fin</th>
        <td>' . $h($intervention["date_fin"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Demande</th>
        <td>' . $h($intervention["demande"] ?? "") . '</td>
        <th>Lieu</th>
        <td>' . $h($intervention["lieu"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Facturation</th>
        <td>' . $h($intervention["facturation"] ?? "") . '</td>
        <th>N° devis</th>
        <td>' . $h($intervention["num_devis"] ?? "") . '</td>
    </tr>
</table>

<h3>Anomalie</h3>
<table>
    <tr><td class="note">' . nl2br($h($intervention["anomalie"] ?? "")) . '</td></tr>
</table>

<h3>Description des travaux demandés</h3>
<table>
    <tr><td class="note">' . nl2br($h($intervention["desc_travaux"] ?? "")) . '</td></tr>
</table>

<h2>2. Système</h2>

<table>
    <tr>
        <th>Type</th>
        <td>' . $h($systeme["type"] ?? "") . '</td>
        <th>Référence</th>
        <td>' . $h($systeme["reference"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Marque</th>
        <td>' . $h($systeme["marque"] ?? "") . '</td>
        <th>N° immatriculation</th>
        <td>' . $h($systeme["num_immat_sys"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Matière injectée</th>
        <td>' . $h($systeme["mat_inject"] ?? "") . '</td>
        <th>Température injection</th>
        <td>' . $h($systeme["temp_inject"] ?? "") . ' °C</td>
    </tr>
    <tr>
        <th>Points injection</th>
        <td>' . $h($systeme["nbr_pt"] ?? "") . '</td>
        <th>Embout</th>
        <td>' . $h($systeme["embout"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Résistances</th>
        <td>' . $h($systeme["nbr_resistance"] ?? "") . '</td>
        <th>Sondes</th>
        <td>' . $h($systeme["nbr_sonde"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Prises</th>
        <td>' . $h($systeme["nbr_prise"] ?? "") . '</td>
        <th>Obturateurs</th>
        <td>' . $h($systeme["nbr_obtu"] ?? "") . '</td>
    </tr>
</table>

<h3>Description système</h3>
<table>
    <tr><td class="note">' . nl2br($h($systeme["description"] ?? "")) . '</td></tr>
</table>

<div class="page-break"></div>

<h2>3. État initial</h2>

<table>
    <tr>
        <th colspan="4">Général</th>
    </tr>
    <tr>
        <th>Propreté</th>
        <td>' . $h($etat["eg_propre"] ?? "") . '</td>
        <th>Ancienneté</th>
        <td>' . $h($etat["eg_ancien"] ?? "") . '</td>
    </tr>
    <tr>
        <th>État général</th>
        <td>' . $h($etat["eg_etatgene"] ?? "") . '</td>
        <th>Aspect extérieur</th>
        <td>' . $h($etat["eg_aspectgene"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Rouille</th>
        <td>' . $h($etat["eg_rouille"] ?? "") . '</td>
        <th>Démontage</th>
        <td>' . $h($etat["eg_demontage"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Fuite matière</th>
        <td>' . $h($etat["eg_fuite_mat"] ?? "") . '</td>
        <th>Avis</th>
        <td>' . $h($etat["eg_avis_etatgene"] ?? "") . '</td>
    </tr>
</table>

<table>
    <tr>
        <th colspan="4">Mécanique</th>
    </tr>
    <tr>
        <th>État mécanique</th>
        <td>' . $h($etat["mec_etatgene"] ?? "") . '</td>
        <th>Entrée matière</th>
        <td>' . $h($etat["mec_eta_entre_mat"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Sortie matière</th>
        <td>' . $h($etat["mec_eta_sorti_mat"] ?? "") . '</td>
        <th>Fuite huile / gras</th>
        <td>' . $h($etat["mec_huile_fuit"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Avis technique</th>
        <td colspan="3">' . nl2br($h($etat["mec_avis_tech"] ?? "")) . '</td>
    </tr>
</table>

<table>
    <tr>
        <th colspan="4">Électrique / Thermique</th>
    </tr>
    <tr>
        <th>État électrique</th>
        <td>' . $h($etat["ele_etatgene"] ?? "") . '</td>
        <th>État câblage</th>
        <td>' . $h($etat["ele_etatcable"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Résistances HS</th>
        <td>' . $h($etat["ele_resis_hs"] ?? "") . '</td>
        <th>Sondes HS</th>
        <td>' . $h($etat["ele_sonde_hs"] ?? "") . '</td>
    </tr>
    <tr>
        <th>État thermique</th>
        <td>' . $h($etat["th_etatgene"] ?? "") . '</td>
        <th>Essai chauffe</th>
        <td>' . $h($etat["th_test"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Stabilité</th>
        <td>' . $h($etat["th_stable"] ?? "") . '</td>
        <th>Pilotage</th>
        <td>' . $h($etat["th_pilotage"] ?? "") . '</td>
    </tr>
</table>

<h2>4. Travaux réalisés</h2>

<table>
    <tr>
        <th>Nettoyage</th>
        <td>' . $bool($travaux["nettoyage"] ?? 0) . '</td>
        <th>Passage four</th>
        <td>' . $bool($travaux["passage_four"] ?? 0) . '</td>
    </tr>
    <tr>
        <th>Changement résistances</th>
        <td>' . $bool($travaux["chang_resistance"] ?? 0) . ' — ' . $h($travaux["nbr_chang_resistance"] ?? 0) . '</td>
        <th>Changement sondes</th>
        <td>' . $bool($travaux["chang_sonde"] ?? 0) . ' — ' . $h($travaux["nbr_chang_sonde"] ?? 0) . '</td>
    </tr>
    <tr>
        <th>Circuit électrique</th>
        <td>' . $bool($travaux["modif_cir_elec"] ?? 0) . '</td>
        <th>Circuit eau</th>
        <td>' . $bool($travaux["modif_cir_eau"] ?? 0) . '</td>
    </tr>
    <tr>
        <th>Circuit huile</th>
        <td>' . $bool($travaux["modif_cir_huile"] ?? 0) . '</td>
        <th>Circuit air</th>
        <td>' . $bool($travaux["modif_cir_air"] ?? 0) . '</td>
    </tr>
    <tr>
        <th>Intervention mécanique</th>
        <td>' . $bool($travaux["modif_meca"] ?? 0) . '</td>
        <th>Têtes injection modifiées</th>
        <td>' . $bool($travaux["modif_meca_tete"] ?? 0) . ' — ' . $h($travaux["nbr_modif_meca_tete"] ?? 0) . '</td>
    </tr>
    <tr>
        <th>Rectifications</th>
        <td>' . $bool($travaux["modif_meca_rectif"] ?? 0) . ' — ' . $h($travaux["nbr_modif_meca_rectif"] ?? 0) . '</td>
        <th>Modification corps</th>
        <td>' . $bool($travaux["modif_meca_corp"] ?? 0) . '</td>
    </tr>
</table>

<div class="page-break"></div>

<h2>5. Contrôles finaux</h2>

<table>
    <tr>
        <th>Validation</th>
        <td>' . $h($controles["tt_validation"] ?? "") . '</td>
        <th>Date contrôle</th>
        <td>' . $h($controles["tt_date"] ?? "") . '</td>
    </tr>
    <tr>
        <th>État général</th>
        <td>' . $h($controles["tt_eg_etatgene"] ?? "") . '</td>
        <th>Propreté</th>
        <td>' . $h($controles["tt_eg_propre"] ?? "") . '</td>
    </tr>
    <tr>
        <th>État mécanique</th>
        <td>' . $h($controles["tt_mec_etatgene"] ?? "") . '</td>
        <th>Contrôle portages</th>
        <td>' . $h($controles["tt_mec_bleu"] ?? "") . '</td>
    </tr>
    <tr>
        <th>État électrique</th>
        <td>' . $h($controles["tt_ele_etatgene"] ?? "") . '</td>
        <th>Résistances</th>
        <td>' . $h($controles["tt_ele_resit"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Sondes</th>
        <td>' . $h($controles["tt_ele_sond"] ?? "") . '</td>
        <th>Obturateurs</th>
        <td>' . $h($controles["tt_rec_obtu"] ?? "") . '</td>
    </tr>
    <tr>
        <th>État thermique</th>
        <td>' . $h($controles["tt_th_etatgene"] ?? "") . '</td>
        <th>Stabilité chauffe</th>
        <td>' . $h($controles["tt_th_stable"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Température essai</th>
        <td>' . $h($controles["tt_th_temp_test"] ?? "") . ' °C</td>
        <th>Temps de montée</th>
        <td>' . $h($controles["tt_th_dur_mont"] ?? "") . '</td>
    </tr>
</table>

<h2>6. Validation et commentaires</h2>

<table>
    <tr>
        <th>Conclusion</th>
        <td>' . nl2br($h($intervention["conclu"] ?? "")) . '</td>
    </tr>
    <tr>
        <th>Commentaire MECALYS</th>
        <td>' . nl2br($h($intervention["comm_inter"] ?? "")) . '</td>
    </tr>
    <tr>
        <th>Commentaire client</th>
        <td>' . nl2br($h($intervention["comm_client"] ?? "")) . '</td>
    </tr>
    <tr>
        <th>Visa intervenant</th>
        <td>' . $h($intervention["visa_intervenant"] ?? "") . '</td>
    </tr>
    <tr>
        <th>Visa client</th>
        <td>' . $h($intervention["visa_client"] ?? "") . '</td>
    </tr>
</table>

</body>
</html>';
    }
}