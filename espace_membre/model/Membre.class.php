<?php
class Membre
{
    private $pseudo;
    private $email;
    private $pass;

    public function getPseudo()
    {
        return $this->pseudo;
    }    

    public function setPseudo($nouveauPseudo)
    {
        if (!empty($nouveauPseudo))
        {
        	$this->pseudo = $nouveauPseudo;
        	return true;
        }
        else
        {
        	return false;
        }
        
    }
    public function getEmail()
    {
        return $this->email;
    }    

    public function setEmail($nouvelEmail)
    {
        if (!empty($nouvelEmail) AND preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $nouvelEmail))
    	{
        	$this->email = $nouvelEmail;
        	return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function envoyerEMail($titre, $message)
    {
        mail($this->email, $titre, $message);
    }

    public function setMotdePasse($nouveauPass)
    {
        if (!empty($nouveauPass))
    	{
        	$this->pass = sha1($nouveauPass);
        	return true;
    	}
    	else
    	{
    		return false;
    	}
    }
}