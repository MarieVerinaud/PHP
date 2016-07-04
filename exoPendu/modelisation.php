<?php
class Partie
{
    private lettresTrouvées[];

    const MOT_TROUVE = 1;
    const ESSAIS_EPUISES = 2;

    public function initialiserPartie()
    {

    }
    public function __construct()
    {

    }

    public function  proposeruneLettre($lettre)
    {
        if (Pendu::partiePerdu == true)
        {
            return ESSAIS_EPUISES;
        }

        if (Mot::lettrePresente($lettre))
        {
            array_push($this->lettresTrouvées, $lettre);
        }
        else
        {
            Pendu::setEssais(Pendu::getEssais()++)
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
    private $longueurMot;
    public function __construct()
    {
        $this->MotAtrouver = BDDMot::générerMot();
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
    public function générerMot()
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
