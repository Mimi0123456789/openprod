<?php

require_once(ROOT_PATH . "/vendor/autoload.php");

use Dompdf\Dompdf;
use Dompdf\Options;

require_once(ROOT_PATH . "/model/f_inter.php");
require_once(ROOT_PATH . "/model/systemes.php");
require_once(ROOT_PATH . "/model/etat_init.php");
require_once(ROOT_PATH . "/model/travaux.php");
require_once(ROOT_PATH . "/model/tests.php");

class InterventionPdfGenerator
{
    public static function output(int $id_inter): string
    {
        if ($id_inter <= 0) {
            throw new Exception("Intervention invalide");
        }

        $interventionModel = new f_interModel();
        $systemesModel = new systemesModel();
        $etatInitModel = new etat_initModel();
        $travauxModel = new travauxModel();
        $testsModel = new testsModel();

        $intervention = $interventionModel->getById($id_inter);

        if (!$intervention) {
            throw new Exception("Intervention introuvable");
        }

        $fiche = [
            'type' => 'intervention',
            'id_inter' => $id_inter,
            'updated_at' => date('Y-m-d H:i:s'),
            'intervention' => $intervention,
            'systeme' => $systemesModel->getByInterventionId($id_inter),
            'etat_initial' => $etatInitModel->getByInterventionId($id_inter),
            'travaux' => $travauxModel->getByInterventionId($id_inter),
            'controles' => $testsModel->getByInterventionId($id_inter),
        ];

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

    public static function generate(int $id_inter): void
    {
        ini_set('display_errors', 0);
        error_reporting(E_ALL);

        if ($id_inter <= 0) {
            http_response_code(400);
            exit("Intervention invalide");
        }

        $interventionModel = new f_interModel();
        $systemesModel = new systemesModel();
        $etatInitModel = new etat_initModel();
        $travauxModel = new travauxModel();
        $testsModel = new testsModel();

        $intervention = $interventionModel->getById($id_inter);

        if (!$intervention) {
            http_response_code(404);
            exit("Intervention introuvable");
        }

        $fiche = [
            'type' => 'intervention',
            'id_inter' => $id_inter,
            'updated_at' => date('Y-m-d H:i:s'),
            'intervention' => $intervention,
            'systeme' => $systemesModel->getByInterventionId($id_inter),
            'etat_initial' => $etatInitModel->getByInterventionId($id_inter),
            'travaux' => $travauxModel->getByInterventionId($id_inter),
            'controles' => $testsModel->getByInterventionId($id_inter),
        ];

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
        header("Content-Disposition: inline; filename=fiche_intervention_" . $id_inter . ".pdf");
        header("Cache-Control: private, max-age=0, must-revalidate");
        header("Pragma: public");

        echo $dompdf->output();
        exit;
    }

    private static function renderHtml(array $fiche): string
    {
        $intervention = $fiche["intervention"] ?? [];
        $client       = $fiche["client"] ?? [];
        $systemes = $fiche["systeme"] ?? $fiche["systemes"] ?? [];
        $travaux      = $fiche["travaux"] ?? [];
        $controles    = $fiche["controles"] ?? [];
        $validation   = $fiche["validation"] ?? [];

        $h = fn($v) => htmlspecialchars((string)($v ?? ""), ENT_QUOTES, "UTF-8");

        $ouiNon = function ($v) {
            return ((string)$v === "1") ? "OUI" : (((string)$v === "0") ? "NON" : "");
        };

        return '
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 11px;
        color: #111827;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #000;
        padding: 5px;
        vertical-align: top;
    }

    .title {
        background: #80A9FF;
        font-size: 28px;
        text-align: center;
        font-weight: bold;
    }

    .section {
        background: #9ca3af;
        font-weight: bold;
        text-transform: uppercase;
    }

    .value {
        color: #1a15c0;
        font-weight: bold;
    }

    .center {
        text-align: center;
    }

    .large {
        height: 70px;
    }

    .signature {
        height: 60px;
    }
</style>
</head>
<body>

<table>
    <tr>
        <th colspan="17" class="title">Intervention<br>Hot Runner System</th>
        <th colspan="10" class="center">EPA</th>
    </tr>

    <tr>
        <th colspan="17">Intervention n° : <span class="value">' . $h($fiche["id_inter"] ?? "") . '</span></th>
        <th colspan="4">Émis le : ' . $h($intervention["date_crea"] ?? "") . '</th>
        <th colspan="6">N° devis : ' . $h($intervention["num_devis"] ?? "") . '</th>
    </tr>

    <tr>
        <td colspan="27" class="section">Demande d’intervention client</td>
    </tr>

    <tr>
        <td colspan="17">
            Client :
            <div class="value center">' . $h($client["nom"] ?? $intervention["client_nom"] ?? "") . '</div>
        </td>
        <td colspan="3">
            Contrat :
            <span class="value">' . $h($intervention["facturation"] ?? "") . '</span>
        </td>
        <td colspan="7" rowspan="2" class="center">
            Responsable EPA<br>
            <span class="value">' . $h($intervention["responsable_nom"] ?? "") . '</span><br>
            04.78.55.38.75
        </td>
    </tr>

    <tr>
        <td colspan="10">
            Date début :
            <div class="value center">' . $h($intervention["date_debut"] ?? "") . '</div>
        </td>
        <td colspan="2">
            Date fin :
            <div class="value center">' . $h($intervention["date_fin"] ?? "") . '</div>
        </td>
        <td colspan="8">
            Site d’intervention :
            <br><span class="value">' . $h($intervention["lieu"] ?? "") . '</span>
        </td>
    </tr>

    <tr>
        <td colspan="27" class="section">Intervention</td>
    </tr>

    <tr>
        <td colspan="7">État : <span class="value">' . $h($intervention["demande"] ?? "") . '</span></td>
        <td colspan="7">Délai souhaité : <span class="value">' . $h($intervention["date_max"] ?? "") . '</span></td>
        <td colspan="13">Intervenant EPA : <span class="value">' . $h($intervention["intervenant_nom"] ?? "") . '</span></td>
    </tr>

    <tr>
        <td colspan="20" rowspan="2" class="large">
            Nature de l’intervention :
            <div class="value">' . nl2br($h($intervention["desc_travaux"] ?? "")) . '</div>
        </td>
        <td colspan="7" class="center">
            N° Immatriculation
            <div class="value">' . $h($systemes["num_immat_sys"] ?? "") . '</div>
        </td>
    </tr>

    <tr>
        <td colspan="7" class="center">
            Type de système :
            <div class="value">' . $h($systemes["type"] ?? "") . '</div>
        </td>
    </tr>

    <tr>
        <td colspan="27" class="large">
            Observations :
            <div class="value">' . nl2br($h($intervention["anomalie"] ?? "")) . '</div>
        </td>
    </tr>

    <tr>
        <td colspan="6">Matière : <span class="value">' . $h($systemes["matiere"] ?? $systemes["mat_inject"] ?? "") . '</span></td>
        <td colspan="10">Température d’injection : <span class="value">' . $h($systemes["temp_inject"] ?? "") . ' °C</span></td>
        <td colspan="11">Nombre de points d’injection : <span class="value">' . $h($systemes["nbr_pt"] ?? "") . '</span></td>
    </tr>

    <tr>
        <td colspan="27" class="section">Analyse et travaux</td>
    </tr>

    <tr>
        <td colspan="22">L’intervention a nécessité des travaux de nettoyage :</td>
        <td colspan="5" class="center value">' . $ouiNon($travaux["nettoyage"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="22">L’intervention a nécessité des travaux d’origine électrique :</td>
        <td colspan="5" class="center value">' . $ouiNon($travaux["modif_cir_elec"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="22">L’intervention a nécessité des travaux d’origine mécanique :</td>
        <td colspan="5" class="center value">' . $ouiNon($travaux["modif_meca"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="22">L’intervention a nécessité des travaux d’origine hydraulique :</td>
        <td colspan="5" class="center value">' . $ouiNon($travaux["modif_cir_huile"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="27" class="section">Contrôles et tests</td>
    </tr>

    <tr>
        <td colspan="17" class="center"><strong>Récapitulatif du test de montée en température</strong></td>
        <td colspan="10" class="center"><strong>Fonctions</strong></td>
    </tr>

    <tr>
        <td colspan="17">Température demandée : <span class="value">' . $h($controles["tt_th_temp_test"] ?? "") . ' °C</span></td>
        <td colspan="5">État thermique :</td>
        <td colspan="5" class="center value">' . $h($controles["tt_th_etatgene"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="17">Inertie montée en température : <span class="value">' . $h($controles["tt_th_inerti"] ?? "") . '</span></td>
        <td colspan="5">État électrique :</td>
        <td colspan="5" class="center value">' . $h($controles["tt_ele_etatgene"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="17">Stabilité en chauffe : <span class="value">' . $h($controles["tt_th_stable"] ?? "") . '</span></td>
        <td colspan="5">État mécanique :</td>
        <td colspan="5" class="center value">' . $h($controles["tt_mec_etatgene"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="17">État du pilotage : <span class="value">' . $h($controles["tt_th_pilotage"] ?? "") . '</span></td>
        <td colspan="5">État général :</td>
        <td colspan="5" class="center value">' . $h($controles["tt_eg_etatgene"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="17"></td>
        <td colspan="5">Contrôles :</td>
        <td colspan="5" class="center value">' . $h($controles["tt_validation"] ?? "") . '</td>
    </tr>

    <tr>
        <td colspan="6" class="section center">Visas</td>
        <td colspan="16" class="section center">Commentaires</td>
        <td colspan="5" class="section center">Signature</td>
    </tr>

    <tr>
        <td colspan="6" class="signature">
            Client :<br>
            Représentant :<br>
            <span class="value">' . $h($client["representant"] ?? "") . '</span>
        </td>
        <td colspan="16">
            <span class="value">' . nl2br($h($intervention["comm_client"] ?? "")) . '</span>
        </td>
        <td colspan="5"></td>
    </tr>

    <tr>
        <td colspan="6" class="signature">
            SAV EPA<br>
            Intervenant :<br>
            <span class="value">' . $h($intervention["intervenant_nom"] ?? "") . '</span>
        </td>
        <td colspan="16">
            <span class="value">' . nl2br($h($intervention["comm_inter"] ?? "")) . '</span>
        </td>
        <td colspan="5"></td>
    </tr>
</table>

</body>
</html>';
    }
}