<?php
class Joueur
{
    private $nom;
    private $classement;
    private $sexe;

    public function __contruct($classement)//infos à chercher en BDD
    {
        $this->classement = $classement;
        $this->hydrate($donnees);
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
        $infosJoueur = [];

        $q = $this->db->prepare('SELECT * FROM  WHERE classement = :classement');
        $q->execute([':classement' => $classement]);

        $q->closeCursor();
        return $infosJoueur;
    }
        
    
}

class Partie
{

}



$joueur1 = new Joueur($classement);
$joueur2 = new Joueur($classement);
$partie = new Partie();
while (!$partie -> partieTerminée())
{
    $partie->continuer();
}