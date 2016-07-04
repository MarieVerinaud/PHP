<?php
class Partie
{
    private $pendu;
    private $mot;
    private $joueur;

    public function __construct(Joueur $joueur)
    {
        $this->joueur = $joueur;
        $this->pendu = new Pendu();
        $this->mot = new Mot();
    }

    public function vérifierLettre($lettre)
    {
        if ($this->mot->lettrePresente($lettre))
        {
            $this->mot->ajouteLettreTrouvée($lettre);
        }
        else
        {
            $this->pendu->rajouterEssai();
        }
    }

    public function partieTerminée()
    {
        return $this->partiePerdue() OR $this->partieGagnée();
    }

    private function partiePerdue()
    {
        return $this->pendu->plusDessais();
    }

    private function partieGagnée()
    {
        return $this->mot->motTrouve();
    }

    public function continuerPartie()
    {
        $lettre = $this->joueur->proposerLettre();
        $this->vérifierLettre($lettre);
    }
}
class Mot
{
    private $MotAtrouver;
    private $lettresTrouvées = array();
    public function __construct()
    {
        $this->MotAtrouver = BDDMot::générerMot();
    }
    public function lettrePresente($lettre)
    {
        return (strpos($this->MotAtrouver, $lettre) !== false);
    }

    public function motTrouve()
    {
        return true; //TO DO
    }

    public function ajouteLettreTrouvée($lettre)
    {
        array_push($this->lettresTrouvées, $lettre);
    }
}
class BDDMot
{
    // requête SQL qui va piocher un mot au hasard dans la BDD
    public static function générerMot()
    {
        return 'Cacahuete';
    }
}
class Pendu
{
    private $essais;
    public function plusDessais()
    {
        return $this->essais === 10;
    }
    public function rajouterEssai()
    {
        $this->essais++;
    }
}
class Joueur
{
    private $nom;

    public static function demanderNom()
    {
        return "Marie";
    }
    public function __construct($nom)
    {
        $this->nom = $nom;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function proposerLettre()
    {
        return "a";
    }
}

$nom = Joueur::demanderNom();
$joueur = new Joueur($nom);
$partie = new Partie($joueur);
while(!$partie->partieTerminée())
{
    $partie->continuerPartie();
}
