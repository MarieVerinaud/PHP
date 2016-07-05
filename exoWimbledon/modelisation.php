<?php
class Joueur
{
    private $nom;
    private $classement;
    private $sexe;
    private $nbSetsGagnés;

    public function __contruct($classement)//infos à chercher en BDD
    {
        $this->classement = $classement;
        $infosJoueur = BDDATP::infosJoueur($classement);
        $this->hydrate($infosJoueur);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
    
    public static function demanderClassement()
    {
        return 1;
    }

    public function setNom($nom)
    {
        if (is_string($nom))
        {
            $this->nom = $nom;
        }
    }

    public function setSexe($sexe)
    {
        if (is_string($sexe))
        {
            $this->sexe = $sexe;
        }
    }

    public function setnbSetsGagnés($nbSetsGagnés)
    {
        if (is_int($nbSetsGagnés))
        {
            $this->nbSetsGagnés = $nbSetsGagnés;
        }
    }

    public function aGagne3Sets()
    {
        return $this->nbSetsGagnés >= 3;
    }

}

class BDDATP
{
    private $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }

    public static function infosJoueur($classement)
    {
        //Requête SQL qui va chercher les infos en fonction du classement
        $q = $this->db->prepare('SELECT * FROM  WHERE classement = :classement');
        $q->execute([':classement' => $classement]);
        $infosJoueur = $q->fetch(PDO::FETCH_ASSOC);

        $q->closeCursor();
        return $infosJoueur;
    }
}

class Partie
{
    private $joueur1;
    private $joueur2;

    public function __construct(Joueur $joueur1, Joueur $joueur2)
    {
        $this->joueur1 = $joueur1;
        $this->joueur2 = $joueur2;
    }

    public function partieTerminée()
    {
        return $this->partiePerdue() OR $this->partieGagnee();
    }

    public function partiePerdue()
    {
        return $this->joueur1->aGagne3Sets() OR $this->joueur2->aGagne3Sets();
    }

    public function partieGagnee()
    {
        return $this->joueur1->aGagne3Sets() OR $this->joueur2->aGagne3Sets();
    }

    public function continuer()
    {
        if (!$this->partieTerminée())
        {

        }
    }
}


$classement = Joueur::demanderClassement();
$joueur1 = new Joueur($classement);
$joueur2 = new Joueur($classement);
$partie = new Partie($joueur1, $joueur2);
while (!$partie -> partieTerminée())
{
    $partie->continuer();
}