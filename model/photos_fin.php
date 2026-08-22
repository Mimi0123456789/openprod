<?php

require_once(ROOT_PATH . "/dao/photos_fin.php");

class photos_finModel
{
    private photos_finDAO $dao;

    public function __construct()
    {
        $this->dao = new photos_finDAO();
    }

    public function getByInterventionId(int $id_inter): array
    {
        return $this->dao->getByInterventionId($id_inter);
    }

    public function add(array $photo): bool
    {
        return $this->dao->add($photo);
    }

    public function updateTitre(int $id, string $titre): bool
    {
        return $this->dao->updateTitre($id, $titre);
    }

    public function getByIntervention(int $id_inter): array
    {
        return $this->dao->getByIntervention($id_inter);
    }

    public function delete(int $id): bool
    {
        return $this->dao->delete($id);
    }
}