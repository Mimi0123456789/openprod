<?php

require_once(ROOT_PATH . "/model/f_inter.php");
require_once(ROOT_PATH . "/model/systemes.php");
require_once(ROOT_PATH . "/model/etat_init.php");
require_once(ROOT_PATH . "/model/travaux.php");
require_once(ROOT_PATH . "/model/tests.php");

class InterventionNoSqlExporter
{
    public static function generate(int $id_inter): bool
    {
        if ($id_inter <= 0) {
            return false;
        }

        $interventionModel = new f_interModel();
        $systemesModel = new systemesModel();
        $etatInitModel = new etat_initModel();
        $travauxModel = new travauxModel();
        $testsModel = new testsModel();

        $intervention = $interventionModel->getById($id_inter);

        if (!$intervention) {
            return false;
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

        $dir = ROOT_PATH . '/storage/nosql/interventions';

        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $file = $dir . '/intervention_' . $id_inter . '.json';

        return file_put_contents(
            $file,
            json_encode($fiche, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        ) !== false;
    }
}