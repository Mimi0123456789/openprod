<?php

require_once(ROOT_PATH . "/dao/clients.php");

class clientsModel
{
    private $id;
    private $nom;
    private $adresse;
    private $c_postal;
    private $ville;
    private $num_tel;
    private $mail;
    private $representant;

    private $dao;

    public function __construct()
    {
        $this->dao = new clientsDAO();
    }

    public function get_id() { return $this->id; }
    public function get_nom() { return $this->nom; }
    public function get_adresse() { return $this->adresse; }
    public function get_c_postal() { return $this->c_postal; }
    public function get_ville() { return $this->ville; }
    public function get_num_tel() { return $this->num_tel; }
    public function get_mail() { return $this->mail; }
    public function get_representant() { return $this->representant; }

    public function set_id($valeur) { $this->id = $valeur; }
    public function set_nom($valeur) { $this->nom = $valeur; }
    public function set_adresse($valeur) { $this->adresse = $valeur; }
    public function set_c_postal($valeur) { $this->c_postal = $valeur; }
    public function set_ville($valeur) { $this->ville = $valeur; }
    public function set_num_tel($valeur) { $this->num_tel = $valeur; }
    public function set_mail($valeur) { $this->mail = $valeur; }
    public function set_representant($valeur) { $this->representant = $valeur; }

    public function getAll()
    {
        return $this->dao->getAll();
    }

    public function getById($id)
    {
        return $this->dao->getById((int)$id);
    }

    public function add($client)
    {
        return $this->dao->add($client);
    }

    public function update($client)
    {
        return $this->dao->update($client);
    }

    public function delete($id)
    {
        return $this->dao->delete((int)$id);
    }
}