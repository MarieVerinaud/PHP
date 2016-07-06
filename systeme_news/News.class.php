<?php

class News
{
    private $erreurs=[];
    private $id;
    private $auteur;
    private $titre;
    private $contenu;
    private $dateAjout;
    private $dateModif;

    const AUTEUR_INVALIDE = 1;
    const TITRE_INVALIDE = 2;
    const CONTENU_INVALIDE = 3;

    public function construct__($valeurs=[])
    {
        if (!empty($valeurs))
        {
            $this->hydrate($valeurs);
        }
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $attribut => $value)
        {
            $method = 'set'.ucfirst($attribut);

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
    public function erreurs()
    {
        return $this->erreurs;
    }
    public function setId($id)
    {
        $this->id = (int) $id;
    }
    public function setAuteur($auteur)
    {
        if(is_string($auteur) AND !empty($auteur))
        {
            $this->auteur = $auteur;
        }
        else
        {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        }

    }
    public function setTitre($titre)
    {
        if(is_string($titre) AND !empty($titre))
        {
            $this->titre = $titre;
        }
        else
        {
            $this->erreurs[] = self::TITRE_INVALIDE;
        }
    }
    public function setContenu($contenu)
    {
        if(is_string($contenu) AND !empty($contenu))
        {
            $this->contenu = $contenu;
        }
        else
        {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }
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