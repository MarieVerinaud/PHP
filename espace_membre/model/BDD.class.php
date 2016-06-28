<?php

class BDD
{
	private $connexion;
	
	public function __construct()
	{
		try
		{
		    $this->connexion = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', 'root');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}
	}

	public function getConnexion()
	{
		return $this->connexion;
	}
}