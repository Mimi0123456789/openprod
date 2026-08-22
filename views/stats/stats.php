<style>
    body {
        margin: 0;
        background: #eef3f8;
    }

    .dashboard-page {
        width: 100%;
        max-width: none;
        min-height: calc(100vh - 70px);
        margin: 0;
        padding: 28px 36px;
        color: #111827;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        margin-bottom: 24px;
    }

    .dashboard-header h1 {
        margin: 0;
        font-size: 42px;
        font-weight: 900;
        line-height: 1;
    }

    .dashboard-header p {
        margin: 8px 0 0;
        color: #6b7280;
        font-size: 15px;
    }

    .dashboard-search {
        width: 430px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 13px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
    }

    .dashboard-search input {
        border: none;
        outline: none;
        flex: 1;
        font-size: 14px;
    }

    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    .kpi-card {
        min-height: 118px;
        background: #fff;
        border-radius: 22px;
        padding: 22px 24px;
        display: flex;
        gap: 18px;
        align-items: center;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        border: 1px solid #e8edf3;
    }

    .kpi-icon {
        width: 62px;
        height: 62px;
        border-radius: 18px;
        color: #fff;
        display: grid;
        place-items: center;
        font-size: 26px;
        flex: 0 0 auto;
    }

    .kpi-card strong {
        display: block;
        font-size: 34px;
        line-height: 1;
        font-weight: 900;
    }

    .kpi-card span {
        display: block;
        margin-top: 6px;
        font-size: 14px;
        color: #6b7280;
        font-weight: 700;
    }

    .blue .kpi-icon { background: linear-gradient(135deg, #2563eb, #38bdf8); }
    .orange .kpi-icon { background: linear-gradient(135deg, #f97316, #facc15); }
    .red .kpi-icon { background: linear-gradient(135deg, #ef4444, #fb7185); }
    .purple .kpi-icon { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
    .green .kpi-icon { background: linear-gradient(135deg, #16a34a, #34d399); }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-template-areas:
            "pipeline alerts"
            "table health"
            "systeme travaux"
            "priorite priorite";
        gap: 22px;
    }

    .panel {
        background: #fff;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        border: 1px solid #e8edf3;
        min-height: 280px;
    }

    .panel-large {
        grid-area: pipeline;
        min-height: 340px;
    }

    .alert-panel {
        grid-area: alerts;
        background: #fff7f7;
    }

    .table-panel {
        grid-area: table;
        min-height: 430px;
    }

    .dashboard-grid > .panel:nth-of-type(2) {
        grid-area: systeme;
    }

    .dashboard-grid > .panel:nth-of-type(5) {
        grid-area: travaux;
    }

    .dashboard-grid > .panel:nth-of-type(6) {
        grid-area: health;
    }

    .dashboard-grid > .panel:nth-of-type(7) {
        grid-area: priorite;
    }

    .panel-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .panel-title h2 {
        font-size: 19px;
        font-weight: 900;
        margin: 0;
        color: #111827;
    }

    .pipeline {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 14px;
        align-items: start;
        min-height: 205px;
        padding-top: 14px;
    }

    .pipeline-step {
        text-align: center;
        position: relative;
        min-width: 0;
    }

    .pipeline-step:not(:last-child)::after {
        content: "";
        position: absolute;
        top: 35px;
        right: -50%;
        width: 100%;
        height: 3px;
        background: #dbeafe;
        z-index: 0;
    }

    .pipeline-circle {
        width: 72px;
        height: 72px;
        margin: 0 auto 12px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #2563eb, #22c55e);
        color: #fff;
        font-size: 22px;
        font-weight: 900;
        position: relative;
        z-index: 1;
        box-shadow: 0 10px 22px rgba(37, 99, 235, 0.25);
    }

    .pipeline-step strong {
        display: block;
        font-size: 13px;
        line-height: 1.25;
        min-height: 34px;
        color: #111827;
    }

    .pipeline-step span {
        display: block;
        margin-top: 5px;
        color: #6b7280;
        font-size: 12px;
        font-weight: 700;
    }

    .progress-global {
        display: grid;
        grid-template-columns: 160px 1fr 55px;
        gap: 14px;
        align-items: center;
        margin-top: 28px;
        font-size: 14px;
        color: #374151;
        font-weight: 800;
    }

    .progress-global div {
        height: 14px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
    }

    .progress-global b {
        display: block;
        height: 100%;
        background: linear-gradient(90deg, #2563eb, #22c55e);
        border-radius: 999px;
    }

    .alert-item {
        display: flex;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #fee2e2;
        color: #991b1b;
    }

    .alert-item i {
        margin-top: 3px;
        font-size: 16px;
    }

    .alert-item strong {
        display: block;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .alert-item span {
        display: block;
        font-size: 13px;
    }

    .empty {
        color: #6b7280;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        font-size: 13px;
        color: #6b7280;
        padding: 13px 14px;
        border-bottom: 1px solid #e5e7eb;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    td {
        padding: 15px 14px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 14px;
    }

    tr:hover td {
        background: #f9fafb;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 11px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .blue-badge {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .green-badge {
        background: #dcfce7;
        color: #15803d;
    }

    .red-badge {
        background: #fee2e2;
        color: #b91c1c;
    }

    .text-danger {
        color: #dc2626;
        font-weight: 900;
    }

    .health-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }

    .health-grid div {
        min-height: 118px;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 18px;
        background: #f8fafc;
    }

    .health-grid i {
        font-size: 24px;
        color: #2563eb;
    }

    .health-grid strong {
        display: block;
        font-size: 30px;
        font-weight: 900;
        margin-top: 12px;
        color: #111827;
    }

    .health-grid span {
        color: #6b7280;
        font-size: 13px;
        font-weight: 700;
    }

    canvas {
        width: 100% !important;
        height: 260px !important;
        max-height: none !important;
    }

    @media (min-width: 1600px) {
        .dashboard-page {
            padding: 34px 48px;
        }

        .dashboard-grid {
            grid-template-columns: 2.2fr 1fr;
        }

        canvas {
            height: 300px !important;
        }

        .table-panel {
            min-height: 470px;
        }
    }

    @media (max-width: 1200px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .dashboard-search {
            width: 100%;
        }

        .kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
            grid-template-areas:
                "pipeline"
                "alerts"
                "table"
                "health"
                "systeme"
                "travaux"
                "priorite";
        }

        .pipeline {
            grid-template-columns: repeat(4, 1fr);
        }

        .pipeline-step:not(:last-child)::after {
            display: none;
        }
    }

    @media (max-width: 700px) {
        .dashboard-page {
            padding: 20px 14px;
        }

        .dashboard-header h1 {
            font-size: 32px;
        }

        .kpi-grid {
            grid-template-columns: 1fr;
        }

        .pipeline {
            grid-template-columns: repeat(2, 1fr);
        }

        .health-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php

$dir = ROOT_PATH . '/storage/nosql/interventions';
$interventions = [];

foreach (glob($dir . '/intervention_*.json') as $file) {
    $json = file_get_contents($file);
    $data = json_decode($json, true);

    if (is_array($data) && isset($data['id_inter'])) {
        $interventions[] = $data;
    }
}

$total = count($interventions);
$urgentes = 0;
$retards = 0;
$nonValidees = 0;
$atelier = 0;

$today = date('Y-m-d');

$parAvancement = [];
$parTypeSysteme = [];
$priorites = [
    'Urgente' => 0,
    'Haute' => 0,
    'Moyenne' => 0,
    'Basse' => 0
];

$sante = [
    'resistances_hs' => 0,
    'sondes_hs' => 0,
    'fuites' => 0,
    'non_valides' => 0
];

$travauxStats = [
    'Passage four' => 0,
    'Nettoyage' => 0,
    'Modif câblage' => 0,
    'Circuit eau' => 0,
    'Mécanique' => 0
];

$alertes = [];

foreach ($interventions as $fiche) {
    $inter = $fiche['intervention'] ?? [];
    $systeme = $fiche['systeme'] ?? [];
    $etat = $fiche['etat_initial'] ?? [];
    $travaux = $fiche['travaux'] ?? [];
    $controle = $fiche['controles'] ?? [];

    $id = $fiche['id_inter'];

    $avancement = (int)($inter['id_avancements'] ?? 0);
    $parAvancement[$avancement] = ($parAvancement[$avancement] ?? 0) + 1;

    $typeSysteme = $systeme['type'] ?? 'Non renseigné';
    $parTypeSysteme[$typeSysteme] = ($parTypeSysteme[$typeSysteme] ?? 0) + 1;

    if (($inter['id_priorite'] ?? 0) >= 7) {
        $urgentes++;
        $priorites['Urgente']++;
    } elseif (($inter['id_priorite'] ?? 0) >= 5) {
        $priorites['Haute']++;
    } elseif (($inter['id_priorite'] ?? 0) >= 3) {
        $priorites['Moyenne']++;
    } else {
        $priorites['Basse']++;
    }

    if (!empty($inter['date_max']) && $inter['date_max'] < $today && $avancement < 7) {
        $retards++;
        $alertes[] = [
            'id' => $id,
            'titre' => $systeme['type'] ?? $inter['demande'] ?? 'Intervention',
            'message' => 'Date max dépassée',
            'niveau' => 'danger'
        ];
    }

    if ($avancement >= 4 && $avancement < 7) {
        $atelier++;
    }

    if (($controle['tt_validation'] ?? '') !== 'VALIDÉ') {
        $nonValidees++;
        $sante['non_valides']++;
    }

    $sante['resistances_hs'] += (int)($etat['ele_resis_hs'] ?? 0);
    $sante['sondes_hs'] += (int)($etat['ele_sonde_hs'] ?? 0);

    if (($etat['mec_huile_fuit'] ?? '') === 'INCORRECT') {
        $sante['fuites']++;
    }

    if (!empty($travaux['passage_four'])) {
        $travauxStats['Passage four']++;
    }

    if (!empty($travaux['nettoyage'])) {
        $travauxStats['Nettoyage']++;
    }

    if (!empty($travaux['modif_cablage_elec'])) {
        $travauxStats['Modif câblage']++;
    }

    if (!empty($travaux['modif_cir_eau'])) {
        $travauxStats['Circuit eau']++;
    }

    if (!empty($travaux['modif_meca'])) {
        $travauxStats['Mécanique']++;
    }
}

$validationRate = $total > 0 ? round((($total - $nonValidees) / $total) * 100) : 0;

usort($interventions, function ($a, $b) {
    return ($b['id_inter'] ?? 0) <=> ($a['id_inter'] ?? 0);
});

$recentes = array_slice($interventions, 0, 6);
$alertes = array_slice($alertes, 0, 5);

function h($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>

<link rel="stylesheet" href="assets/css/dashboard_nosql.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="dashboard-page">

    <div class="dashboard-header">
        <div>
            <h1>Tableau de bord</h1>
            <p>Vue d’ensemble de votre activité SAV</p>
        </div>

        <div class="dashboard-search">
            <input type="text" id="dashboardSearch" placeholder="Rechercher intervention, système, demande...">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card blue">
            <div class="kpi-icon"><i class="fa-solid fa-clipboard-list"></i></div>
            <div>
                <strong><?= $total ?></strong>
                <span>Interventions</span>
            </div>
        </div>

        <div class="kpi-card orange">
            <div class="kpi-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div>
                <strong><?= $urgentes ?></strong>
                <span>Urgentes</span>
            </div>
        </div>

        <div class="kpi-card red">
            <div class="kpi-icon"><i class="fa-solid fa-clock"></i></div>
            <div>
                <strong><?= $retards ?></strong>
                <span>En retard</span>
            </div>
        </div>

        <div class="kpi-card purple">
            <div class="kpi-icon"><i class="fa-solid fa-industry"></i></div>
            <div>
                <strong><?= $atelier ?></strong>
                <span>En atelier</span>
            </div>
        </div>

        <div class="kpi-card green">
            <div class="kpi-icon"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <strong><?= $validationRate ?>%</strong>
                <span>Validation</span>
            </div>
        </div>
    </div>

    <div class="dashboard-grid">

        <section class="panel panel-large">
            <div class="panel-title">
                <h2>Pipeline des interventions</h2>
            </div>

            <div class="pipeline">
                <?php
                $labelsAv = [
                    1 => 'Prise en charge',
                    2 => 'Étude en cours',
                    3 => 'Attente',
                    4 => 'Atelier',
                    5 => 'Livraison',
                    6 => 'Installation',
                    7 => 'Terminé',
                    8 => 'Clôturé'
                ];
                ?>

                <?php foreach ($labelsAv as $idAv => $label): 
                    $count = $parAvancement[$idAv] ?? 0;
                    $percent = $total > 0 ? round(($count / $total) * 100) : 0;
                ?>
                    <div class="pipeline-step">
                        <div class="pipeline-circle"><?= $count ?></div>
                        <strong><?= h($label) ?></strong>
                        <span><?= $percent ?>%</span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="progress-global">
                <span>Avancement global</span>
                <div>
                    <b style="width: <?= $validationRate ?>%"></b>
                </div>
                <strong><?= $validationRate ?>%</strong>
            </div>
        </section>

        <section class="panel">
            <div class="panel-title">
                <h2>Répartition par système</h2>
            </div>
            <canvas id="systemeChart"></canvas>
        </section>

        <section class="panel alert-panel">
            <div class="panel-title">
                <h2>Urgences</h2>
            </div>

            <?php if (empty($alertes)): ?>
                <p class="empty">Aucune alerte critique.</p>
            <?php endif; ?>

            <?php foreach ($alertes as $alerte): ?>
                <div class="alert-item">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <strong>#<?= h($alerte['id']) ?> - <?= h($alerte['titre']) ?></strong>
                        <span><?= h($alerte['message']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="panel table-panel">
            <div class="panel-title">
                <h2>Interventions récentes</h2>
            </div>

            <table id="interventionsTable">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Demande</th>
                        <th>Système</th>
                        <th>Avancement</th>
                        <th>Échéance</th>
                        <th>Contrôle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentes as $fiche):
                        $inter = $fiche['intervention'] ?? [];
                        $systeme = $fiche['systeme'] ?? [];
                        $controle = $fiche['controles'] ?? [];
                        $isLate = !empty($inter['date_max']) && $inter['date_max'] < $today && ((int)($inter['id_avancements'] ?? 0) < 7);
                    ?>
                        <tr>
                            <td>#<?= h($fiche['id_inter']) ?></td>
                            <td><?= h($inter['demande'] ?? '') ?></td>
                            <td><?= h($systeme['type'] ?? 'Non renseigné') ?></td>
                            <td>
                                <span class="badge blue-badge">
                                    Av. <?= h($inter['id_avancements'] ?? '') ?>
                                </span>
                            </td>
                            <td class="<?= $isLate ? 'text-danger' : '' ?>">
                                <?= h($inter['date_max'] ?? '') ?>
                            </td>
                            <td>
                                <span class="badge <?= ($controle['tt_validation'] ?? '') === 'VALIDÉ' ? 'green-badge' : 'red-badge' ?>">
                                    <?= h($controle['tt_validation'] ?? 'Non renseigné') ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="panel">
            <div class="panel-title">
                <h2>Activité atelier</h2>
            </div>
            <canvas id="travauxChart"></canvas>
        </section>

        <section class="panel">
            <div class="panel-title">
                <h2>Santé technique</h2>
            </div>

            <div class="health-grid">
                <div>
                    <i class="fa-solid fa-temperature-high"></i>
                    <strong><?= $sante['resistances_hs'] ?></strong>
                    <span>Résistances HS</span>
                </div>
                <div>
                    <i class="fa-solid fa-bolt"></i>
                    <strong><?= $sante['sondes_hs'] ?></strong>
                    <span>Sondes HS</span>
                </div>
                <div>
                    <i class="fa-solid fa-droplet"></i>
                    <strong><?= $sante['fuites'] ?></strong>
                    <span>Fuites</span>
                </div>
                <div>
                    <i class="fa-solid fa-circle-xmark"></i>
                    <strong><?= $sante['non_valides'] ?></strong>
                    <span>Non validés</span>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-title">
                <h2>Priorités</h2>
            </div>
            <canvas id="prioriteChart"></canvas>
        </section>

    </div>
</div>

<script>
const systemeLabels = <?= json_encode(array_keys($parTypeSysteme), JSON_UNESCAPED_UNICODE) ?>;
const systemeValues = <?= json_encode(array_values($parTypeSysteme)) ?>;

const travauxLabels = <?= json_encode(array_keys($travauxStats), JSON_UNESCAPED_UNICODE) ?>;
const travauxValues = <?= json_encode(array_values($travauxStats)) ?>;

const prioriteLabels = <?= json_encode(array_keys($priorites), JSON_UNESCAPED_UNICODE) ?>;
const prioriteValues = <?= json_encode(array_values($priorites)) ?>;
</script>

<script src="assets/js/dashboard_nosql.js"></script>