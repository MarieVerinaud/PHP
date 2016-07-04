<?php
class Partie
{
    private $lettresTrouvées = array();
    private $pendu;
    private $mot;

    const MOT_TROUVE = 1;
    const ESSAIS_EPUISES = 2;

    public function initialiserPartie()
    {

    }
    public function __construct()
    {
        $this->pendu = new Pendu();
        $this->mot = new Mot();
    }

    public function proposerUneLettre($lettre)
    {
        if ($this->pendu->partiePerdue() == true)
        {
            return self::ESSAIS_EPUISES;
        }

        if ($this->mot->lettrePresente($lettre))
        {
            array_push($this->lettresTrouvées, $lettre);
        }
        else
        {
            $this->pendu->setEssais($this->pendu->getEssais()+1);
        }
    }

    public function trouverLeMot()
    {

    }
    public function commencerNouvellePartie()
    {

    }
}
class Mot
{
    private $MotAtrouver;
    public function __construct()
    {
        $this->MotAtrouver = new BDDMot();
    }
    public function lettrePresente($lettre)
    {
        if (strpos($this->MotAtrouver, $lettre) !== false)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
class BDDMot
{
    // requête SQL qui va piocher un mot au hasard dans la BDD
    public function _construct()
    {

    }
}
class Pendu
{
    private $essais;
    public function partiePerdue()
    {
        if ($this->essais === 10)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getEssais()
    {
        return $this->essais;
    }
    public function setEssais($essais)
    {
        $this->essais = $essais;
    }
}

$partie = new Partie();