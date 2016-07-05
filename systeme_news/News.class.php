<?php

class News
{
    private $id;
    private $auteur;
    private $titre;
    private $contenu;
    private $dateAjout;
    private $dateModif;

    public function construct__(array $donnees)
    {
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

    public function id()
    {
        return $this->id;
    }
    public function auteur()
    {
        return $this->auteur;
    }
    public function titre()
    {
        return $this->titre;
    }
    public function contenu()
    {
        return $this->contenu;
    }
    public function dateAjout()
    {
        return $this->dateAjout;
    }
    public function dateModif()
    {
        return $this->dateModif;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;
    }
}